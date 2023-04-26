<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\AttributeFamily;
use App\Models\Category;
use App\Models\InventorySource;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::all();

        return view('products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $attributeFamilies = AttributeFamily::with('groups')->get();

        return view('products.create', compact('attributeFamilies'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $attributeFamily = AttributeFamily::find($request->attribute_family_id)
            ->with('groups')->first();

        $product = Product::create([
            'attribute_family_id' => $attributeFamily->id,
            'specifications' => [
                'sku' => $request->sku
            ]
        ]);

        return redirect()->route('products.edit', $product)
            ->with('success', 'Запись успешно добавлена!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        //
    }

    private function getAllAttributeCodes($attribute_family_id)
    {
        $attributeFamily = AttributeFamily::find($attribute_family_id)
            ->with('groups')->first();
        $groups = $attributeFamily->groups;

        $codes = [];

        foreach ($groups as $group)
        {
            foreach ($group->attributes as $attribute)
            {
                $codes[] = $attribute->code;
            }
        }

        return $codes;
    }

    private function getRequiredAttributeCodes($attribute_family_id)
    {
        $attributeFamily = AttributeFamily::find($attribute_family_id)
            ->with('groups')->first();
        $groups = $attributeFamily->groups;

        $codes = [];

        foreach ($groups as $group)
        {
            $requiredAttributes = $group->attributes()->where('required', 1)->get();
            foreach ($requiredAttributes as $attribute)
            {
                $codes[] = $attribute->code;
            }
        }

        return $codes;
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        $rootCategory = Category::where('slug', 'root')->first();
        $inventories = InventorySource::where('status', 1)->get();

        $codes = $this->getRequiredAttributeCodes($product->attribute_family_id);

        return view('products.edit', compact( 'product', 'codes', 'inventories', 'rootCategory'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        $data = [];
        $codes = $this->getAllAttributeCodes($product->attribute_family_id);
        foreach ($codes as $code){
            $data[$code] = $request[$code] ?? null;
        }

        $product->specifications = $data;

        $product->categories()->sync($request->categories);

        $product->save();

        $inventoryCodes = InventorySource::all()->pluck('code');

        $product->inventories()->detach();
        foreach ($inventoryCodes as $inventoryCode)
        {
            $quantity = $request[$inventoryCode];
            if($quantity > 0){
                $inventory = InventorySource::where('code', $inventoryCode)->first();
                $product->inventories()->attach($inventory, ['quantity' => $quantity]);
            }
        }

        return redirect()->route('products.index')->with('success', 'Запись успешно изменена');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        try {
            $product->delete();
            return redirect()->route('products.index')->with('success', 'Запись успешно удалена');
        } catch (\Exception $exception) {
            return redirect()->route('products.index')->with('fail', 'Не удалось удалить запись');
        }
    }
}
