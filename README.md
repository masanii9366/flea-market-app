# フリマアプリ

Laravelを使用したフリマアプリです。
商品の出品、購入、いいね、コメント、マイリスト、プロフィール編集などの機能を実装しています。

## 使用技術

* PHP 8.x
* Laravel 8.x
* MySQL
* Docker / Docker Compose
* Laravel Fortify
* phpMyAdmin
* Git / GitHub

## 主な機能

* 会員登録
* ログイン / ログアウト
* プロフィール編集
* プロフィール画像アップロード
* 商品一覧表示
* 商品検索
* 商品詳細表示
* 商品出品
* 商品画像アップロード
* いいね機能
* コメント機能
* マイリスト表示
* 商品購入
* 配送先変更
* SOLD表示
* マイページ表示


## 環境構築

```bash
git clone https://github.com/masanii9366/flea-market-app.git
```

```bash
cd flea-market-app
```

```bash
docker compose up -d --build
```

PHPコンテナに入ります。

```bash
docker compose exec php bash
```

依存関係をインストールします。

```bash
composer install
```

`.env` を作成します。

```bash
cp .env.example .env
```

アプリケーションキーを作成します。

```bash
php artisan key:generate
```

マイグレーションとSeederを実行します。

```bash
php artisan migrate:fresh --seed
```

ストレージリンクを作成します。

```bash
php artisan storage:link
```

## テストユーザー

```text
メールアドレス: test@example.com
パスワード: password
```

## phpMyAdmin

```text
URL: http://localhost:8081
サーバー: mysql
ユーザー名: laravel_user
パスワード: laravel_pass
```

## アプリURL

```text
http://localhost:8080
```

## URL一覧

| 機能 | URL |
|------|------|
| 商品一覧 | / |
| ログイン | /login |
| 会員登録 | /register |
| 商品出品 | /sell |
| マイページ | /mypage |
| プロフィール編集 | /mypage/profile |





