<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;
class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        Product::create([
            'name' => 'Smart TV',
            'description' => 'A high-quality Smart TV with 4K resolution.',
            'price' => 499.99,
            'stock' => 10,
            'category_id' => 1,
        ]);

        Product::create([
            'name' => 'Refrigerator',
            'description' => 'Energy-efficient refrigerator with a large capacity.',
            'price' => 799.99,
            'stock' => 5,
            'category_id' => 2,
        ]);

        Product::create([
            'name' => 'Microwave Oven',
            'description' => 'Compact microwave oven with multiple cooking modes.',
            'price' => 199.99,
            'stock' => 15,
            'category_id' => 1,
        ]);
    }
}
