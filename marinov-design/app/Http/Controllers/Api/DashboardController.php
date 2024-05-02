<?php

namespace App\Http\Controllers\Api;

use App\Models\Type;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\MaterialProduct;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Models\ProductFavorite;
class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    public function getProductTypes()
    {
        $typeCounts = Product::select('type_id')->get()->groupBy('type_id')->map->count();

        $types = Type::all();

        $typeData = [
            'types' => $types->pluck('name'),
            'counts' => $types->map(function ($type) use ($typeCounts) {
                return $typeCounts[$type->id] ?? 0;
            }),
        ];

        return response()->json($typeData);
    }
    public function getMaterialChartData()
    {
        $materialCounts = MaterialProduct::select('material_id', DB::raw('count(*) as material_count'))
            ->groupBy('material_id')
            ->get();

        $labels = $materialCounts->map(function ($item) {
            return $item->material->name;
        })->toArray();

        $values = $materialCounts->pluck('material_count')->toArray();

        return response()->json([
            'materials' => $labels,
            'counts' => $values,
        ]);
    }

    public function getFavoriteProductsChartData()
    {
        $favoriteProductCounts = ProductFavorite::select('products.id', 'products.title', DB::raw('count(user_favorite_products.product_id) as favorite_count'))
            ->leftJoin('products', 'user_favorite_products.product_id', '=', 'products.id')
            ->groupBy('products.id', 'products.title')
            ->limit(5)
            ->get();

        $labels = $favoriteProductCounts->pluck('title')->toArray();
        $values = $favoriteProductCounts->pluck('favorite_count')->toArray();

        return response()->json([
            'products' => $labels,
            'counts' => $values,
        ]);
    }

    public function getMostOrderedProductsChartData()
    {
        $mostOrderedProducts = Product::select('products.id', 'products.title', DB::raw('count(order_product.product_id) as order_count'))
            ->leftJoin('order_product', 'products.id', '=', 'order_product.product_id')
            ->groupBy('products.id', 'products.title')
            ->orderByDesc('order_count')
            ->limit(5)
            ->get();

        $labels = $mostOrderedProducts->pluck('title')->toArray();
        $values = $mostOrderedProducts->pluck('order_count')->toArray();

        return response()->json([
            'products' => $labels,
            'counts' => $values,
        ]);
    }

    public function getMostRevenueProductsChartData()
    {
        $mostRevenueProducts = Product::select(
            'products.id',
            'products.title',
            DB::raw('SUM(products.sale_price) as total_revenue')
        )
            ->join('order_product', 'products.id', '=', 'order_product.product_id')
            ->groupBy('products.id', 'products.title')
            ->orderByDesc('total_revenue')
            ->limit(5) 
            ->get();

        $labels = $mostRevenueProducts->pluck('title')->toArray();
        $values = $mostRevenueProducts->pluck('total_revenue')->toArray();

        return response()->json([
            'products' => $labels,
            'revenue' => $values,
        ]);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
