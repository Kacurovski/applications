<?php

namespace App\Http\Controllers\api;

use App\Models\Status;
use App\Models\Discount;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DiscountController extends Controller
{
    public function index()
    {
        $activeStatusId = Status::where('name', 'active')->first()->id ?? null;
        $archivedStatusId = Status::where('name', 'archived')->first()->id ?? null;

        $activeDiscounts = Discount::with('discountCategories')->when($activeStatusId, function ($query) use ($activeStatusId) {
            $query->where('status_id', $activeStatusId);
        })->get();

        $archivedDiscounts = Discount::with('discountCategories')->when($archivedStatusId, function ($query) use ($archivedStatusId) {
            $query->where('status_id', $archivedStatusId);
        })->get();

        return response()->json([
            'active' => $activeDiscounts,
            'archived' => $archivedDiscounts
        ]);
    }
}
