<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Address;
use Illuminate\Http\Request;

class AddressController extends Controller
{
    public function edit(Item $item)
    {
        return view('purchase.address', compact('item'));
    }

    public function update(Request $request, Item $item)
    {
        $request->validate([
            'postal_code' => 'required',
            'address' => 'required',
        ]);

        Address::updateOrCreate(
            [
                'user_id' => auth()->id(),
                'item_id' => $item->id,
            ],
            [
                'postal_code' => $request->postal_code,
                'address' => $request->address,
                'building' => $request->building,
            ]
        );

        return redirect('/purchase/' . $item->id);
    }
}