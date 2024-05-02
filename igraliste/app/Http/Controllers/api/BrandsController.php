<?php

namespace App\Http\Controllers\api;

use App\Models\Brand;
use App\Models\Status;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BrandsController extends Controller
{
    public function index()
    {
        $activeStatusId = Status::where('name', 'active')->first()->id ?? null;
        $archivedStatusId = Status::where('name', 'archived')->first()->id ?? null;

        $activeBrands = Brand::when($activeStatusId, function ($query) use ($activeStatusId) {
            $query->where('status_id', $activeStatusId);
        })->with('images', 'tags')->get();

        $archivedBrands = Brand::when($archivedStatusId, function ($query) use ($archivedStatusId) {
            $query->where('status_id', $archivedStatusId);
        })->with('images', 'tags')->get();

        return response()->json([
            'active' => $activeBrands,
            'archived' => $archivedBrands
        ]);
    }
}
