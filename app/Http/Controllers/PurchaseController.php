<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Purchase;
use Illuminate\Http\Request;
use App\Models\Address;

class PurchaseController extends Controller
{
    public function index(Item $item)
    {
        $address = Address::where('user_id', auth()->id())
          ->where('item_id', $item->id)
          ->first();

        return view('purchase.index', compact(
          'item',
          'address'
        ));
    }

    public function store(Request $request, Item $item)
    {
       if ($item->purchase) {
          return back()->with('error', 'この商品は購入済みです');
       }

       $address = Address::where('user_id', auth()->id())
          ->where('item_id', $item->id)
          ->first();

       if (!$address) {
          $user = auth()->user();

          Address::create([
            'user_id' => $user->id,
            'item_id' => $item->id,
            'postal_code' => $user->postal_code,
            'address' => $user->address,
            'building' => $user->building,
         ]);
       }

       Purchase::create([
          'user_id' => auth()->id(),
          'item_id' => $item->id,
          'payment_method' => $request->payment_method,
       ]);

       return redirect('/');
    }
}