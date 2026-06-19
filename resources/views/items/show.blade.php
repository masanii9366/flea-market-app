<!-- 詳細ページblade -->

@extends('layouts.app')

@section('title', '商品詳細')

@section('content')

<h1>商品詳細</h1>

<div style="border:1px solid black; padding:20px;">

    @if ($item->image)
        <img src="{{ asset('storage/' . $item->image) }}" width="300">
    @endif

    <h2>{{ $item->name }}</h2>

    @if ($item->purchase)
    <p style="color:red;">
        SOLD
    </p>
    @else
      @auth
        <p>
            <a href="/purchase/{{ $item->id }}">
                購入する
            </a>
        </p>
      @endauth
    @endif

    <p>
        カテゴリー：
        @foreach ($item->categories as $category)
            {{ $category->name }}
        @endforeach
    </p>

    <p>ブランド：{{ $item->brand }}</p>

    <p>価格：¥{{ number_format($item->price) }}</p>

    <p>状態：{{ $item->condition->name }}</p>

    <p>説明：{{ $item->description }}</p>

    <p>いいね数：{{ $item->likes->count() }}</p>

   @auth
    @if ($item->likes->where('user_id', auth()->id())->count())
        <form action="/item/{{ $item->id }}/like" method="POST">
            @csrf
            @method('DELETE')
            <button type="submit">いいね解除</button>
        </form>
    @else
        <form action="/item/{{ $item->id }}/like" method="POST">
            @csrf
            <button type="submit">いいね</button>
        </form>
    @endif
   @endauth


<hr>

<h3>コメント一覧</h3>

@forelse ($item->comments as $comment)
    <div style="margin-bottom:10px;">
        <strong>{{ $comment->user->name }}</strong><br>
        {{ $comment->content }}
    </div>
@empty
    <p>コメントはまだありません</p>
@endforelse

@auth
<hr>

<h3>コメント投稿</h3>

@if ($errors->any())
    <div style="color:red;">
        @foreach ($errors->all() as $error)
            <p>{{ $error }}</p>
        @endforeach
    </div>
@endif

<form action="/item/{{ $item->id }}/comment" method="POST">
    @csrf

    <textarea
        name="content"
        rows="3"
        cols="50"
        required
    ></textarea>

    <br><br>

    <button type="submit">
        コメントする
    </button>
</form>
@endauth
</div>

@endsection