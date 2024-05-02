<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\CustomOrderGallery;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    public function getUserCartItems(Request $request)
    {
        $userId = $request->query('user_id');


        if (!$userId) {
            return response()->json([
                'status' => 'error',
                'message' => 'user_id is required',
                'data' => null,
            ], 400);
        }



        $user = User::with(['cartProducts' => function ($query) {
            $query->orderBy('updated_at', 'desc');
        }])->find($userId);


        if (!$user) {
            return response()->json([
                'status' => 'error',
                'message' => 'User not found.',
                'data' => null,
            ], 404);
        }


        if ($user->cartProducts->isEmpty()) {
            return response()->json([
                'status' => 'error',
                'message' => 'No cart items found for the given user.',
                'data' => null,
            ], 404);
        }


        $cartItems = $user->cartProducts->map(function ($product) {

            $productArray = $product->toArray();


            unset($productArray['pivot']);

            return $productArray;
        });


        return response()->json([
            'status' => 'success',
            'message' => 'Cart items retrieved successfully.',
            'data' => $cartItems,
        ], 200);
    }

    public function getUserFavoriteItems(Request $request)
    {
        $userId = $request->query('user_id');


        if (!$userId) {
            return response()->json([
                'status' => 'error',
                'message' => 'user_id is required',
                'data' => null,
            ], 400);
        }


        $user = User::with(['favoriteProducts' => function ($query) {
            $query->orderBy('updated_at', 'desc');
        }])->find($userId);


        if (!$user) {
            return response()->json([
                'status' => 'error',
                'message' => 'User not found.',
                'data' => null,
            ], 404);
        }


        if ($user->favoriteProducts->isEmpty()) {
            return response()->json([
                'status' => 'error',
                'message' => 'No favorite items found for the given user.',
                'data' => null,
            ], 404);
        }


        $favoriteItems = $user->favoriteProducts->map(function ($product) {

            $productArray = $product->toArray();


            unset($productArray['pivot']);

            return $productArray;
        });


        return response()->json([
            'status' => 'success',
            'message' => 'Favorite items retrieved successfully.',
            'data' => $favoriteItems,
        ], 200);
    }
}
