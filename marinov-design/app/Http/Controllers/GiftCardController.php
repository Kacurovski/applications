<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\GiftCard;
use Illuminate\Http\Request;
use App\Http\Requests\GiftCardRequest;

class GiftCardController extends Controller
{
    public function index()
    {
        $giftCards = GiftCard::all();

        return view('gift_cards.index', compact('giftCards'));
    }

    public function create()
    {
        $users = User::where('role_id', '<>', 1)->get();

        return view('gift_cards.create', compact('users'));
    }

    public function store(GiftCardRequest $request)
    {
        try {
            $code = 'MARINOV-' . $request->input('code');

            GiftCard::create([
                'code' => $code,
                'value' => $request->input('value'),
                'is_redeemed' => $request->input('is_redeemed', false),
                'user_id' => $request->input('user_id'),
            ]);
            return redirect()->route('gift-cards.index')->with('success', 'Gift Card added successfully!');
        } catch (\Exception $e) {
            return redirect()
                ->route('gift-cards.create')
                ->withErrors(['error' => 'Failed to add a gift card. Please try again.'])
                ->withErrors($request->validated()->errors());
        }
    }

    public function edit($id)
    {
        $giftCard = GiftCard::find($id);
        $users = User::where('role_id', '<>', 1)->get();

        return view('gift_cards.edit', compact('giftCard', 'users'));
    }

    public function update(GiftCardRequest $request, GiftCard $giftCard)
    {
        try {
            $giftCard->update($request->validated());
            return redirect()->route('gift-cards.index')->with('success', 'Gift Card updated successfully!');
        } catch (\Exception $e) {
            return redirect()
                ->route('gift-cards.edit', $giftCard->id)
                ->withErrors(['error' => 'Failed to update a gift card. Please try again.'])
                ->withErrors($request->validated()->errors());
        }
    }

    public function destroy(GiftCard $giftCard)
    {
        $giftCard->delete();

        return redirect()->route('gift-cards.index')
            ->with('success', 'Gift card deleted successfully');
    }
}
