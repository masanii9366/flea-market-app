@extends('layouts.app')

@section('title', 'マイページ')

@section('content')

<h1>マイページ</h1>

@if ($user->profile_image)
    <img
        src="{{ asset('storage/' . $user->profile_image) }}"
        width="120"
        alt="プロフィール画像"
    >
@endif

<p>{{ $user->name }}</p>

<p>
    <a href="/mypage/profile">
        プロフィール編集
    </a>
</p>

<hr>

<h2>出品した商品</h2>

@forelse ($items as $item)
    <p>{{ $item->name }}</p>
@empty
    <p>出品商品はありません</p>
@endforelse

<hr>

<h2>購入した商品</h2>

@forelse ($purchases as $purchase)
    <p>{{ $purchase->item->name }}</p>
@empty
    <p>購入商品はありません</p>
@endforelse

@endsection