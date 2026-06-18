@extends('layouts.app')

@section('title', '商品購入')

@section('content')

@if(session('error'))
    <p style="color:red;">
        {{ session('error') }}
    </p>
@endif

<h1>商品購入</h1>

<h2>{{ $item->name }}</h2>

<p>価格：¥{{ number_format($item->price) }}</p>

<form action="/purchase/address/{{ $item->id }}" method="POST">
    @csrf

    <p>
        支払い方法
        <select name="payment_method">
            <option value="コンビニ払い">コンビニ払い</option>
            <option value="カード支払い">カード支払い</option>
        </select>
    </p>

    <h3>配送先</h3>

    <p>
    <a href="/purchase/address/{{ $item->id }}">
        配送先を変更する
    </a>
    </p>

    <p>
    郵便番号：
    {{ $address->postal_code ?? auth()->user()->postal_code }}
    </p>

    <p>
    住所：
    {{ $address->address ?? auth()->user()->address }}
    </p>

    <p>
    建物名：
    {{ $address->building ?? auth()->user()->building }}
    </p>

    <button type="submit">
        購入する
    </button>

</form>

@endsection