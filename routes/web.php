<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\AddressController;
use App\Http\Controllers\MypageController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
/*確認用*/
Route::get('/home', function () {
    return '
        <p>ログイン成功</p>
        <form method="POST" action="/logout">
            ' . csrf_field() . '
            <button type="submit">ログアウト</button>
        </form>
    ';
})->middleware('auth');
/*ログアウト用*/
Route::post('/logout', function () {
    auth()->logout();
    request()->session()->invalidate();
    request()->session()->regenerateToken();

    return redirect('/login');
});
/*ルーティング追加*/
Route::get('/', [ItemController::class, 'index']);
/*商品詳細ルート*/
Route::get('/item/{item}', [ItemController::class, 'show']);
/*商品出品*/
Route::get('/sell', [ItemController::class, 'create'])->middleware('auth');
Route::post('/sell', [ItemController::class, 'store'])->middleware('auth');

/*いいね登録・解除ルート*/
Route::post('/item/{item}/like', [ItemController::class, 'like'])->middleware('auth');
Route::delete('/item/{item}/like', [ItemController::class, 'unlike'])->middleware('auth');
/*コメント投稿ルート*/
Route::post('/item/{item}/comment', [ItemController::class, 'comment'])
    ->middleware('auth');
/*プロフィール編集*/
Route::get('/mypage/profile', [ProfileController::class, 'edit'])
    ->middleware('auth');
Route::post('/mypage/profile', [ProfileController::class, 'update'])
    ->middleware('auth');

/*購入画面*/
Route::get('/purchase/{item}', [PurchaseController::class, 'index'])
    ->middleware('auth');
Route::post('/purchase/{item}', [PurchaseController::class, 'store'])
    ->middleware('auth');

/*配送先変更*/
Route::get('/purchase/address/{item}', [AddressController::class, 'edit'])
    ->middleware('auth');
Route::post('/purchase/address/{item}', [AddressController::class, 'update'])
    ->middleware('auth');

/*マイページ*/
Route::get('/mypage', [MypageController::class, 'index'])
    ->middleware('auth');    