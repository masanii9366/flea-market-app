@extends('layouts.app')

@section('title', '配送先変更')

@section('content')

<h1>配送先変更</h1>

<form action="/purchase/address/{{ $item->id }}" method="POST">
     @csrf

     <p>
         商品名：{{ $item->name }}
     </p>

     <p>
         価格：¥{{ number_format($item->price) }}
     </p>

     <hr>

     @csrf

     <h2>配送先情報</h2>
    @csrf

    <p>
        郵便番号
        <input type="text"
               name="postal_code"
               value="{{ auth()->user()->postal_code }}">
    </p>

    <p>
        住所
        <input type="text"
               name="address"
               value="{{ auth()->user()->address }}">
    </p>

    <p>
        建物名
        <input type="text"
               name="building"
               value="{{ auth()->user()->building }}">
    </p>

    <button type="submit">
        更新する
    </button>

</form>

@endsection