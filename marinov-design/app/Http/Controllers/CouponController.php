<?php

namespace App\Http\Controllers;

use App\Http\Requests\CouponRequest;
use App\Models\Coupon;

class CouponController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $coupons = Coupon::all();

        return view('coupons.index', compact('coupons'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('coupons.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CouponRequest $request)
    {
        try {
            Coupon::create($request->validated());
            return redirect()->route('coupons.index')->with('success', 'Coupon record added successfully!');
        } catch (\Exception $e) {
            return redirect()
                ->route('coupons.create')
                ->withErrors(['error' => 'Failed to add coupon record. Please try again.'])
                ->withErrors($request->validated()->errors());
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Coupon $coupon)
    {
        return view('coupons.edit', compact('coupon'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CouponRequest $request, Coupon $coupon)
    {
        try {
            $coupon->update($request->validated());
            return redirect()->route('coupons.index')->with('success', 'Coupon record updated successfully!');
        } catch (\Exception $e) {
            return redirect()
                ->route('coupons.edit', $coupon->id)
                ->withErrors(['error' => 'Failed to update coupon record. Please try again.'])
                ->withErrors($request->validated()->errors());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Coupon $coupon)
    {
        $coupon->delete();

        return redirect()->route('coupons.index')->with('success', 'Coupon record deleted successfully!');
    }
}
