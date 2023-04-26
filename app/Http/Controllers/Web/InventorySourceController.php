<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\InventorySource;
use Illuminate\Http\Request;

class InventorySourceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $inventories = InventorySource::all();

        return view('inventories.index', compact('inventories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('inventories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
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

        InventorySource::create($data);

        return redirect()->route('admin.inventories.index')
            ->with('success', 'Запись успешно добавлена');
    }

    /**
     * Display the specified resource.
     */
    public function show(InventorySource $inventorySource)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(InventorySource $inventorySource)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, InventorySource $inventorySource)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(InventorySource $inventorySource)
    {
        if(InventorySource::all()->count() < 2){
            return redirect()->back()->with('fail', 'В системе должен быть минимум один склад');
        }

        $inventorySource->delete();

        return redirect()->route('admin.inventories.index')
            ->with('success', 'Запись успешно удалена');
    }
}
