<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;


class TypeController extends Controller
{
    protected function getTypesForCategory($categoryName, $successMessage)
    {
        try {
            $category = Category::where('name', $categoryName)->firstOrFail();
            $types = $category->types()->get(['id', 'name']);

            return response()->json([
                'status' => 'success',
                'message' => $successMessage,
                'data' => $types,
            ], 200);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json([
                'status' => 'error',
                'message' => "{$categoryName} category not found.",
                'data' => null,
            ], 404);
        }
    }

    public function getJewelryTypes(Request $request)
    {
        return $this->getTypesForCategory('Jewelry', 'Jewelry types retrieved successfully.');
    }

    public function getHomeDecorTypes(Request $request)
    {
        return $this->getTypesForCategory('Home Decor', 'Home Decor types retrieved successfully.');
    }
}
