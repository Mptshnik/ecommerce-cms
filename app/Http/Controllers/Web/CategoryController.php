<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application
     */
    public function index()
    {
        $categories = Category::all();

        return view('categories.index', compact('categories'));
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application
     */
    public function create()
    {
        $rootCategory = Category::where('slug', 'root')->first();

        return view('categories.create', compact('rootCategory'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        Category::create([
            'name' => $request->name,
            'category_id' => $request->category_id,
            'slug' => Str::slug($request->name),
            'description_and_images' => [
                'description' => $request->description
            ],
            'filterable_attributes' => [],
            'visible_in_menu' => $request->visible_in_menu ?? false
        ]);

        return redirect()->route('categories.index')->with('success', 'Запись успешно добавлена');
    }


    /**
     * @param Category $category
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application
     */
    public function edit(Category $category)
    {
        $rootCategory = Category::where('slug', 'root')->first();

        return view('categories.edit', compact('category', 'rootCategory'));
    }

    /**
     * @param Request $request
     * @param Category $category
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Category $category)
    {
        $category->update([
            'name' => $request->name,
            'category_id' => $request->category_id,
            'slug' => $category->slug == 'root' ? 'root' : Str::slug($request->name),
            'description_and_images' => [
                'description' => $request->description
            ],
            'filterable_attributes' => [],
            'visible_in_menu' => $request->visible_in_menu ?? false
        ]);

        return redirect()->route('categories.index')->with('success', 'Запись успешно изменена');
    }

    /**
     * @param Category $category
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Category $category)
    {
        if ($category->slug == "root") {
            return redirect()->route('categories.index')
                ->with('fail', 'Невозможно удалить корневую категорию');
        }

        $category->delete();

        return redirect()->route('categories.index')
            ->with('success', 'Запись успешно удалена');
    }
}
