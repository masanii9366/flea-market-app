<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Item;

class ItemSeeder extends Seeder
{
    public function run()
    {
        $item = Item::create([
            'user_id' => 1,
            'condition_id' => 1,
            'name' => 'サンプル商品',
            'brand' => 'サンプルブランド',
            'description' => 'これはサンプル商品です',
            'price' => 5000,
            'image' => null,
        ]);

        $item->categories()->attach([1]);
    }
}