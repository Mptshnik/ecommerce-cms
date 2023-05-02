<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\AttributeType;
use App\Models\ProductAttribute;
use Illuminate\Http\Request;

class ProductAttributeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $attributes = ProductAttribute::all();

        return view('attributes.index', compact('attributes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $attributeTypes = AttributeType::all();

        return view('attributes.create', compact('attributeTypes'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        ProductAttribute::create([
            'attribute_type_value_fk' => $request->attribute_type_value_fk,
            'code' => $request->code,
            'label' => $request->name,
            'visible_on_frontend' => $request->visible_on_frontend,
            'input_validation' => $request->input_validation,
            'options' => $request->options,
            'required' => $request->required,
            'unique' => $request->unique
        ]);

        return redirect()->route('product-attributes.index')->with('success', 'Запись успешно добавлена');
    }

    /**
     * Display the specified resource.
     */
    public function show(ProductAttribute $productAttribute)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ProductAttribute $productAttribute)
    {
        $attributeTypes = AttributeType::all();

        return view('attributes.edit', compact('productAttribute', 'attributeTypes'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ProductAttribute $productAttribute)
    {
        $productAttribute->update([
            'label' => $request->name,
            'visible_on_frontend' => $request->visible_on_frontend,
            'options' => $request->options,
        ]);

        return redirect()->route('product-attributes.index')->with('success', 'Запись успешно изменена');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ProductAttribute $productAttribute)
    {
        if($productAttribute->default)
        {
            return redirect()->route('product-attributes.index')
                ->with('fail', 'Невозможно удалить системный атрибут');
        }

        $productAttribute->delete();

        return redirect()->route('product-attributes.index')
            ->with('success', 'Запись успешно удалена');
    }
}
