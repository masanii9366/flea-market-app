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

     Purchase::create([
        'user_id' => auth()->id(),
        'item_id' => $item->id,
        'payment_method' => $request->payment_method,
     ]);

        return redirect('/');
    }
}