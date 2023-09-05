<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\AttributeFamily;
use App\Models\Category;
use App\Models\Image;
use App\Models\InventorySource;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application
     */
    public function index()
    {
        $products = Product::all();

        return view('products.index', compact('products'));
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application
     */
    public function create()
    {
        $attributeFamilies = AttributeFamily::all();

        return view('products.create', compact('attributeFamilies'));
    }


    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $product = Product::create([
            'attribute_family_id' => $request->attribute_family_id,
            'specifications' => [
                'sku' => $request->sku
            ]
        ]);

        return redirect()->route('products.edit', $product)
            ->with('success', 'Запись успешно добавлена!');
    }


    /**
     * @param Product $product
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application
     */
    public function edit(Product $product)
    {
        $rootCategory = Category::where('slug', 'root')->first();
        $inventories = InventorySource::where('status', 1)->get();

        $codes = $product->attributeFamily->attributes()->where('required', 1)->get()->pluck('code');

        return view('products.edit', compact('product', 'codes', 'inventories', 'rootCategory'));
    }


    /**
     * @param Request $request
     * @param Product $product
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Product $product)
    {
        $data = [];
        $codes = $product->attributeFamily->attributes()->pluck('code');

        foreach ($codes as $code) {
            $data[$code] = $request[$code] ?? null;
        }

        $product->specifications = $data;

        $product->categories()->sync($request->categories);

        $product->save();

        $inventoryCodes = InventorySource::all()->pluck('code');

        $product->inventories()->detach();
        foreach ($inventoryCodes as $inventoryCode) {
            $quantity = $request[$inventoryCode];
            if ($quantity > 0) {
                $inventory = InventorySource::where('code', $inventoryCode)->first();
                $product->inventories()->attach($inventory, ['quantity' => $quantity]);
            }
        }

        if ($request->hasFile('images')) {
            foreach ($request->images as $image) {
                $path = Storage::disk('public')->put('/products/images', $image);
                Image::create([
                    'url' => $path,
                    'product_id' => $product->id
                ]);
            }
        }

        return redirect()->route('products.index')->with('success', 'Запись успешно изменена');
    }

    /**
     * @param Product $product
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Product $product)
    {
        try {
            $product->delete();
            foreach ($product->images as $image) {
                Storage::disk('public')->delete($image->url);
                $image->delete();
            }
            return redirect()->route('products.index')->with('success', 'Запись успешно удалена');
        } catch (\Exception $exception) {
            return redirect()->route('products.index')->with('fail', 'Не удалось удалить запись');
        }
    }

    /**
     * @param Image $image
     * @return \Illuminate\Http\RedirectResponse
     */
    public function deleteImage(Image $image)
    {
        try {
            Storage::disk('public')->delete($image->url);
            $image->delete();

            return redirect()->back()->with('success', 'Изображение удалено');
        } catch (\Exception $exception) {
            return redirect()->back()->with('fail', 'Не удалось удалить изображение');
        }
    }
}
