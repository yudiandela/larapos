<?php

namespace Database\Seeders;

use App\Models\ProductCategory;
use Illuminate\Database\Seeder;

class ProductCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // ProductCategory::factory(20)->create();
        $datas = [
            [
                'title' => 'Minuman',
                'slug' => 'minuman',
                'image' => asset('images/category/minuman.svg')
            ],
            [
                'title' => 'Makanan',
                'slug' => 'makanan',
                'image' => asset('images/category/makanan.svg')
            ],
            [
                'title' => 'Snack',
                'slug' => 'snack',
                'image' => asset('images/category/snack.svg')
            ],
            [
                'title' => 'Pakaian',
                'slug' => 'pakaian',
                'image' => asset('images/category/pakaian.svg')
            ]
        ];
        foreach ($datas as $data) {
            ProductCategory::create($data);
        }
    }
}
