<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
use App\Models\Category;
use App\Models\Like;
use App\Models\Comment;

class ItemController extends Controller
{
    //商品一覧
    public function index(Request $request)
    {
        if ($request->tab === 'mylist') {

        if (!auth()->check()) {
            $items = collect();
        } else {
            $items = auth()->user()
                ->likedItems()
                ->with(['categories', 'condition', 'purchase'])
                ->get();
        }

       } else {

            $items = Item::with([
            'categories',
            'condition',
            'purchase',
            ])->get();
       }

       return view('items.index', compact('items'));
    }
    //showメソッド
    public function show(Item $item)
    {
        $item->load(['categories', 'condition', 'user', 'likes', 'comments']);

        return view('items.show', compact('item'));
    }

    public function create()
   {
      $categories = Category::all();

      return view('items.create', compact('categories'));
   }

    public function store(Request $request)
    {
       Item::create([
        'user_id' => auth()->id(),
        'category_id' => $request->category_id,
        'name' => $request->name,
        'brand' => $request->brand,
        'description' => $request->description,
        'price' => $request->price,
        'condition' => $request->condition,
      ]);

      return redirect('/');
   }
    //いいね登録
    public function like(Item $item)
    {
        Like::create([
            'user_id' => auth()->id(),
            'item_id' => $item->id,
        ]);

        return redirect()->back();
    }

    public function unlike(Item $item)
    {
        Like::where('user_id', auth()->id())->where('item_id', $item->id)->delete();

        return redirect()->back();
    }
//コメント投稿
    public function comment(Request $request, Item $item)
    {
        Comment::create([
            'user_id' => auth()->id(),
            'item_id' => $item->id,
            'content' => $request->content,
        ]);

        return redirect()->back();
    }
}
