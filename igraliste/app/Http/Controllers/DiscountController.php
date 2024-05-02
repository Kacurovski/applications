<?php

namespace App\Http\Controllers;

use App\Models\Status;
use App\Models\Product;
use App\Models\Discount;
use Illuminate\Support\Arr;
use Illuminate\Http\Request;
use App\Models\DiscountCategory;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\DiscountRequest;

class DiscountController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('discounts.index');
    }

    /**
     * Show the form for creating a new discount.
     */
    public function create()
    {
        $categories = DiscountCategory::all();
        $statuses = Status::all();
        $products = Product::pluck('id');
        return view('discounts.create', compact('categories', 'statuses', 'products'));
    }

    /**
     * Store a newly created discount in storage.
     */
    public function store(DiscountRequest $request)
    {
        $validatedData = $request->validated();

        DB::transaction(function () use ($validatedData) {
            $discountData = Arr::only($validatedData, ['name', 'percent', 'status_id']);
            $discount = Discount::create($discountData);

            if (!empty($validatedData['categories'])) {
                $discount->discountCategories()->sync($validatedData['categories']);
            }

            if (!empty($validatedData['products'])) {
                $productIds = explode(',', $validatedData['products'][0]);
                Product::whereIn('id', $productIds)->update(['discount_id' => $discount->id]);
            }
        });

        return redirect()->route('discounts.index')->with('success', 'Попустот е успешно креиран.');
    }


    /**
     * Display the specified discount.
     */
    public function show(Discount $discount)
    {
        $discount->load('discountCategories');
        return view('discounts.show', compact('discount'));
    }

    /**
     * Show the form for editing the specified discount.
     */
    public function edit(Discount $discount)
    {
        $categories = DiscountCategory::all();
        $statuses = Status::all();
        $productIds = $discount->products->pluck('id');
        $discount->load('discountCategories');

        return view('discounts.edit', compact('discount', 'categories', 'statuses', 'productIds'));
    }

    /**
     * Update the specified discount in storage.
     */
    public function update(DiscountRequest $request, Discount $discount)
    {
        $validatedData = $request->validated();

        $discountData = Arr::except($validatedData, ['categories', 'products']);
        $discount->update($discountData);

        $discount->discountCategories()->sync($validatedData['categories'] ?? []);

        $archivedStatusId = Status::where('name', 'archived')->value('id');

        if ($discount->status_id == $archivedStatusId) {
            Product::where('discount_id', $discount->id)->update(['discount_id' => null]);
        } else {
            if (!empty($validatedData['products'])) {
                $productIds = explode(',', $validatedData['products'][0]);

                Product::whereIn('id', $productIds)->update(['discount_id' => $discount->id]);
            }

            $currentProductIds = explode(',', $validatedData['products'][0] ?? '');
            $discountedProductIds = $discount->products()->pluck('id')->toArray();

            $oldProductIds = array_diff($discountedProductIds, $currentProductIds);

            Product::whereIn('id', $oldProductIds)->update(['discount_id' => null]);
        }

        return redirect()->route('discounts.index')->with('success', 'Попустот е успешно ажуриран.');
    }

    /**
     * Remove the specified discount from storage.
     */
    // public function destroy(Discount $discount)
    // {
    //     $discount->delete();

    //     if (request()->wantsJson()) {
    //         return response()->json(['message' => 'Discount deleted successfully']);
    //     }

    //     return redirect()->route('discounts.index')->with('success', 'Discount deleted successfully');
    // }
}
