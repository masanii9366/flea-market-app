@extends('layouts.app')

@section('title', '商品出品')

@section('content')

<h1>商品出品</h1>

<form action="/sell" method="POST">
    @csrf

    <div>
        <label>商品名</label>
        <input type="text" name="name">
    </div>

    <div>
        <label>ブランド名</label>
        <input type="text" name="brand">
    </div>

    <div>
        <label>カテゴリー</label>

        <select name="category_id">
            @foreach ($categories as $category)
                <option value="{{ $category->id }}">
                    {{ $category->name }}
                </option>
            @endforeach
        </select>
    </div>

    <div>
        <label>商品の状態</label>
        <input type="text" name="condition">
    </div>

    <div>
        <label>価格</label>
        <input type="number" name="price">
    </div>

    <div>
        <label>商品説明</label>
        <textarea name="description"></textarea>
    </div>

    <button type="submit">
        出品する
    </button>

</form>

@endsection