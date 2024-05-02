<?php

namespace App\Http\Controllers\api;

use App\Models\Product;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with(['brand', 'category', 'color', 'size', 'images'])->get();
        $groupedProducts = $products->groupBy('name');

        $gridProducts = $groupedProducts->map(function ($group) {
            $firstProduct = $group->first();
            $colors = $group->pluck('color')->unique('id');
            $sizes = $group->pluck('size')->unique('id');

            return [
                'id' => $firstProduct->id, 
                'name' => $firstProduct->name,
                'brand' => $firstProduct->brand->name,
                'category' => $firstProduct->category->name,
                'colors' => $colors->toArray(), 
                'sizes' => $sizes->toArray(),   
                'price' => $firstProduct->price,
                'images' => $firstProduct->images,
                'quantity' => $group->sum('quantity'),
            ];
        })->values();

        $finalData = [
            'list' => $products,
            'grid' => $gridProducts->toArray(),
        ];

        return response()->json($finalData);
    }


    /**
     * Store a newly created resource in storage.
     */


    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        $product->update($request->all());
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        $product->delete();
        return response()->json(['message' => 'Product deleted successfully']);
    }
}
