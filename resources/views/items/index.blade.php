@extends('layouts.app')

@section('title', '商品一覧')

@section('content')

<h1>商品一覧</h1>

<form method="GET" action="/">
    <input
        type="text"
        name="keyword"
        placeholder="商品名で検索"
        value="{{ request('keyword') }}"
    >

    @if(request('tab'))
        <input
            type="hidden"
            name="tab"
            value="{{ request('tab') }}"
        >
    @endif

    <button type="submit">
        検索
    </button>
</form>

<p>
    <a href="/">おすすめ</a> |
    <a href="/?tab=mylist">マイリスト</a>
</p>

@foreach ($items as $item)

<div style="border:1px solid #000; margin-bottom:20px; padding:10px;">
    
    @if ($item->image)
       <img src="{{ asset('storage/' . $item->image) }}" width="150">
    @endif

    <h2>
       <a href="/item/{{ $item->id }}">
          {{ $item->name }}
       </a>
    </h2>

    @if ($item->purchase)
    <p style="color:red;">
        SOLD
    </p>
    @endif

    <p>
    カテゴリー：
    @foreach ($item->categories as $category)
        {{ $category->name }}
    @endforeach
    </p>

    <p>価格：¥{{ number_format($item->price) }}</p>

    <p>{{ $item->description }}</p>

</div>

@endforeach

@endsection