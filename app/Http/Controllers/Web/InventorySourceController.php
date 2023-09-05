<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\InventorySource;
use Illuminate\Http\Request;

class InventorySourceController extends Controller
{
    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application
     */
    public function index()
    {
        $inventories = InventorySource::all();

        return view('inventories.index', compact('inventories'));
    }


    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application
     */
    public function create()
    {
        return view('inventories.create');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        InventorySource::create($this->getData($request));

        return redirect()->route('inventories.index')
            ->with('success', 'Запись успешно добавлена');
    }


    /**
     * @param InventorySource $inventory
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application
     */
    public function edit(InventorySource $inventory)
    {
        return view('inventories.edit', compact('inventory'));
    }

    /**
     * @param Request $request
     * @return array
     */
    private function getData(Request $request)
    {
        $contact_information = [
            'full_name' => $request->full_name,
            'email' => $request->email,
            'phone_number' => $request->phone_number
        ];

        $address = [
            'country' => $request->country,
            'region' => $request->region,
            'city' => $request->city,
            'street' => $request->street,
            'house_number' => $request->house_number,
            'postal_code' => $request->postal_code,
        ];

        $data = [
            'name' => $request->name,
            'code' => $request->code,
            'status' => $request->status ?? false,
            'contact_information' => $contact_information,
            'address' => $address
        ];

        return $data;
    }

    /**
     * @param Request $request
     * @param InventorySource $inventory
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, InventorySource $inventory)
    {
        $inventory->update($this->getData($request));

        return redirect()->route('inventories.index')
            ->with('success', 'Запись успешно изменена');
    }

    /**
     * @param InventorySource $inventory
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(InventorySource $inventory)
    {
        if(InventorySource::all()->count() < 2){
            return redirect()->back()->with('fail', 'В системе должен быть минимум один склад');
        }

        $inventory->delete();

        return redirect()->route('inventories.index')
            ->with('success', 'Запись успешно удалена');
    }
}
