<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if(isset($request->category_id)){
            $category_id = $request->category_id;
            $products = Product::whereHas('categories', function ($q) use ($category_id) {
                $q->where('id', '=', $category_id);
            })->get();

            return ProductResource::collection($products);
        }

        $products = Product::paginate(25);
        return ProductResource::collection($products);
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        return new ProductResource($product);
    }
}
