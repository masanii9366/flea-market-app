<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
use App\Models\Category;
use App\Models\Like;
use App\Models\Comment;
use App\Models\Condition;

class ItemController extends Controller
{
    //商品一覧
    public function index(Request $request)
    {
       $keyword = $request->keyword;

       if ($request->tab === 'mylist') {

        if (!auth()->check()) {

            $items = collect();

        } else {

            $query = auth()->user()
                ->likedItems()
                ->with([
                    'categories',
                    'condition',
                    'purchase',
                ]);

            if ($keyword) {
                $query->where('name', 'like', "%{$keyword}%");
            }

            $items = $query->get();
        }

          } else {

        $query = Item::with([
            'categories',
            'condition',
            'purchase',
        ]);

        if (auth()->check()) {
            $query->where('user_id', '!=', auth()->id());
        }

        if ($keyword) {
            $query->where('name', 'like', "%{$keyword}%");
        }

        $items = $query->get();
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
      $conditions = Condition::all();

      return view('items.create', compact('categories', 'conditions'));
   }

    public function store(Request $request)
    {
       $imagePath = null;

       if ($request->hasFile('image')) {
        $imagePath = $request->file('image')->store('items', 'public');
       }

       $item = Item::create([
         'user_id' => auth()->id(),
         'condition_id' => $request->condition_id,
         'name' => $request->name,
         'brand' => $request->brand,
         'description' => $request->description,
         'price' => $request->price,
         'image' => $imagePath,
       ]);

       $item->categories()->attach($request->category_id);

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
        $request->validate([
          'content' => 'required|max:255',
        ], [
          'content.required' => 'コメントを入力してください',
          'content.max' => 'コメントは255文字以内で入力してください',
        ]);

        Comment::create([
            'user_id' => auth()->id(),
            'item_id' => $item->id,
            'content' => $request->content,
        ]);

        return redirect()->back();
    }
}
