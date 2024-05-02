<?php

namespace App\Http\Controllers\Api;

use App\Models\CustomOrder;
use Illuminate\Http\Request;
use App\Models\CustomOrderGallery;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;

class CustomOrderController extends Controller
{
    public function getLatestImages()
    {
        $latestImages = DB::table('custom_order_galleries')
            ->orderBy('created_at', 'desc')
            ->take(8)
            ->pluck('image');

        if ($latestImages->isEmpty()) {
            return response()->json([
                'status' => 'error',
                'message' => 'No images found.',
                'data' => null,
            ], 404);
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Custom order images fetched successfully.',
            'data' => $latestImages,
        ], 200);
    }


    public function submitCustomOrder(Request $request)
    {

        $validated = $request->validate([
            'user_id' => 'required|integer|exists:users,id',
            'name' => 'nullable|string',
            'email' => 'required|email',
            'message' => 'required|string',
            'images' => 'nullable|string',
            'send_link' => 'nullable|string',
        ]);

        try {

            $customOrder = CustomOrder::create($validated);
            return response()->json([
                'status' => 'success',
                'message' => 'Custom order submitted successfully.',
                'data' => $customOrder,
            ], 200);
        } catch (\Exception $e) {
            Log::error('Failed to submit custom order: ' . $e->getMessage());
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to submit the custom order.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
}
