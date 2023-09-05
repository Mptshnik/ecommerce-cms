<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\AttributeType;
use App\Models\ProductAttribute;
use Illuminate\Http\Request;

class ProductAttributeController extends Controller
{
    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application
     */
    public function index()
    {
        $attributes = ProductAttribute::all();

        return view('attributes.index', compact('attributes'));
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application
     */
    public function create()
    {
        $attributeTypes = AttributeType::all();

        return view('attributes.create', compact('attributeTypes'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
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
     * @param ProductAttribute $productAttribute
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application
     */
    public function edit(ProductAttribute $productAttribute)
    {
        $attributeTypes = AttributeType::all();

        return view('attributes.edit', compact('productAttribute', 'attributeTypes'));
    }

    /**
     * @param Request $request
     * @param ProductAttribute $productAttribute
     * @return \Illuminate\Http\RedirectResponse
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
     * @param ProductAttribute $productAttribute
     * @return \Illuminate\Http\RedirectResponse
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
