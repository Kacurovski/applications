<?php

namespace App\Http\Controllers\Api;
use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class ProductController extends Controller
{
    public function types(Request $request)
    {
        $type = $request->input('type');
    
        if ($type) {
            $products = Product::where('type_id', $type)->get();
    
            if ($products->isEmpty()) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Products not found for the specified type.',
                    'data' => null,
                ], 404);
            }
    
            return response()->json([
                'status' => 'success',
                'message' => 'Products retrieved successfully.',
                'data' => $products,
            ], 200);
        }
    
        return response()->json([
            'status' => 'error',
            'message' => 'Type parameter is missing.',
            'data' => null,
        ], 400);
    }

    public function imageDelete($id)
    {
        try {

            $productImage = ProductImage::findOrFail($id);
            
            $productImage->delete();
    
            return response()->json(['success' => 'Image deleted successfully'], 200);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'Image not found'], 404);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to delete image'], 500);
        }
    }
}
