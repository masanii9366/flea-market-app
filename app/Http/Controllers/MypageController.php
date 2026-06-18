<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MypageController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        $items = $user->items;

        $purchases = $user->purchases;

        return view('mypage.index', compact(
            'user',
            'items',
            'purchases'
        ));
    }
}