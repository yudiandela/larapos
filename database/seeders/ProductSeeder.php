<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $datas = [
            [
                'product_category_id' => 1,
                'name' => 'Coca Cola',
                'slug' => 'coca-cola',
                'description' => 'Coca cola coke softdrink cools',
                'stock' => 120,
                'sell' => 15000,
                'buy' => 12000,
                'image' => asset('images/product/coca-cola.jpeg')
            ],
            [
                'product_category_id' => 2,
                'name' => 'SilverQueen',
                'slug' => 'silverqueen',
                'description' => 'Silverqueen coklat enak dan lezat maknyuss',
                'stock' => 55,
                'sell' => 17000,
                'buy' => 14000,
                'image' => asset('images/product/silver-queen.jpeg')
            ],
            [
                'product_category_id' => 2,
                'name' => 'Nike Shirt Blue',
                'slug' => 'nike-shirt-blue',
                'description' => 'Nike shirt blue with 3D animation',
                'stock' => 522,
                'sell' => 150000,
                'buy' => 120000,
                'image' => asset('images/product/nike-shirt-blue.jpg')
            ]
        ];

        foreach ($datas as $data) {
            Product::create($data);
        }
    }
}
