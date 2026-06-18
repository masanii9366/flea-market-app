@extends('layouts.app')

@section('content')

<h1>プロフィール設定</h1>

<form action="/mypage/profile" method="POST">
    @csrf

    <p>
        名前
        <input type="text"
               name="name"
               value="{{ auth()->user()->name }}">
    </p>

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