<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserRequest;
use App\Models\User;
use Illuminate\Contracts\Filesystem\Filesystem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application
     */
    public function index()
    {
        $users = User::all();
        return view('users.index', compact('users'));
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application
     */
    public function create(){
        return view('users.create');
    }

    /**
     * @param StoreUserRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreUserRequest $request){
        $profile_image = null;

        if($request->hasFile('profile_image')){
            $profile_image = Storage::disk()->put('/profile/images', $request->profile_image);
        }

        User::create([
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'name' => $request->name,
            'profile_image' => $profile_image
        ]);

        return redirect()->route('users.index')->with('success', 'Запись успешно добавлена');
    }

    /**
     * @param User $user
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(User $user)
    {
        if ($user->id == Auth::user()->id) {
            return redirect()->back()->with('fail', 'Невозможно удалить пользователя, под которым вы авторизованы');
        }

        if (User::all()->count() == 1) {
            return redirect()->back()->with('fail', 'В системе должен быть минимум один администратор');
        }

        if ($user->profile_image){
            Storage::disk()->delete($user->profile_image);
        }

        $user->delete();

        return redirect()->back()->with('success', 'Пользователь успешно удален');
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application
     */
    public function profile()
    {
        return view('users.profile');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateProfile(Request $request)
    {
        $data = [];
        $user = Auth::user();

        if ($request->hasFile('profile_image')) {
            Storage::disk('public')->delete($user->profile_image);
            $data['profile_image'] = Storage::disk('public')->put('/profile/images', $request['profile_image']);
        }

        $data['name'] = $request->name;

        $user->update($data);

        return redirect()->back()->with('success', 'Профиль успешно изменен');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function forgotPassword(Request $request)
    {
        Auth::user()->setRememberToken(null);
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('password.request');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function changePassword(Request $request)
    {
        if (!Hash::check($request->old_password, Auth::user()->getAuthPassword())) {
            return redirect()->back()->withErrors(['mismatch' => 'Не верно введен текущий пароль']);
        }

        Auth::user()->update([
            'password' => Hash::make($request->new_password)
        ]);

        return redirect()->back()->with(['success' => 'Пароль успешно изменен']);
    }
}
