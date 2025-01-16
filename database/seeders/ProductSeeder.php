<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = [

            ['name' => 'Samsung QLED TV', 'description' => '55" Smart TV 4K UHD with HDR.', 'price' => 2999.99, 'stock' => 20, 'category_id' => 1],
            ['name' => 'LG OLED TV', 'description' => '65" Smart TV with OLED technology.', 'price' => 3999.99, 'stock' => 15, 'category_id' => 1],
            ['name' => 'Sony Soundbar', 'description' => 'Premium soundbar with Dolby Atmos.', 'price' => 799.99, 'stock' => 30, 'category_id' => 1],
            ['name' => 'Philips Home Cinema System', 'description' => '5.1 channel surround sound system.', 'price' => 1199.99, 'stock' => 10, 'category_id' => 1],
            ['name' => 'Tuner DVB-T2', 'description' => 'High-quality tuner for digital TV.', 'price' => 99.99, 'stock' => 50, 'category_id' => 1],
            ['name' => 'Uchwyt ścienny do TV', 'description' => 'Adjustable wall mount for TVs up to 70".', 'price' => 149.99, 'stock' => 40, 'category_id' => 1],

            ['name' => 'MacBook Pro 14"', 'description' => 'Apple M1 Pro chip, 16GB RAM, 512GB SSD.', 'price' => 8999.99, 'stock' => 8, 'category_id' => 2],
            ['name' => 'Dell XPS 13', 'description' => '13" Ultrabook with Intel i7 and 1TB SSD.', 'price' => 7999.99, 'stock' => 12, 'category_id' => 2],
            ['name' => 'Monitor LG UltraFine', 'description' => '27" 4K HDR monitor.', 'price' => 2499.99, 'stock' => 25, 'category_id' => 2],
            ['name' => 'Klawiatura mechaniczna', 'description' => 'RGB gaming keyboard with Cherry MX switches.', 'price' => 499.99, 'stock' => 50, 'category_id' => 2],
            ['name' => 'Mysz gamingowa', 'description' => 'High-performance gaming mouse with 12,000 DPI.', 'price' => 299.99, 'stock' => 40, 'category_id' => 2],
            ['name' => 'Słuchawki bezprzewodowe', 'description' => 'Noise-cancelling over-ear headphones.', 'price' => 699.99, 'stock' => 30, 'category_id' => 2],


            ['name' => 'iPhone 14 Pro', 'description' => 'Latest Apple smartphone with 128GB.', 'price' => 5999.99, 'stock' => 20, 'category_id' => 3],
            ['name' => 'Samsung Galaxy S22', 'description' => 'Flagship Android phone with 5G.', 'price' => 4999.99, 'stock' => 25, 'category_id' => 3],
            ['name' => 'iPad Air', 'description' => 'Apple tablet with 64GB and A14 chip.', 'price' => 3199.99, 'stock' => 15, 'category_id' => 3],
            ['name' => 'Huawei MatePad Pro', 'description' => 'High-end Android tablet.', 'price' => 2899.99, 'stock' => 18, 'category_id' => 3],
            ['name' => 'Smartwatch Garmin', 'description' => 'Fitness-oriented smartwatch.', 'price' => 1399.99, 'stock' => 30, 'category_id' => 3],
            ['name' => 'Etui na smartfon', 'description' => 'Shockproof case for smartphones.', 'price' => 99.99, 'stock' => 100, 'category_id' => 3],


            ['name' => 'Lodówka Samsung', 'description' => 'Side-by-side refrigerator with No Frost.', 'price' => 4499.99, 'stock' => 10, 'category_id' => 4],
            ['name' => 'Pralka Bosch', 'description' => '9kg washing machine with EcoSilence Drive.', 'price' => 2499.99, 'stock' => 15, 'category_id' => 4],
            ['name' => 'Zmywarka Whirlpool', 'description' => '12-place dishwasher with 6th Sense.', 'price' => 1999.99, 'stock' => 12, 'category_id' => 4],
            ['name' => 'Piekarnik Electrolux', 'description' => 'Multifunction oven with steam baking.', 'price' => 1799.99, 'stock' => 20, 'category_id' => 4],
            ['name' => 'Kuchenka mikrofalowa LG', 'description' => 'Inverter microwave oven.', 'price' => 599.99, 'stock' => 30, 'category_id' => 4],
            ['name' => 'Odkurzacz Xiaomi', 'description' => 'Cordless vacuum cleaner.', 'price' => 1399.99, 'stock' => 25, 'category_id' => 4],


            ['name' => 'Ekspres do kawy DeLonghi', 'description' => 'Automatic coffee machine with milk frother.', 'price' => 2999.99, 'stock' => 20, 'category_id' => 5],
            ['name' => 'Toster Philips', 'description' => 'Two-slice toaster with adjustable browning.', 'price' => 199.99, 'stock' => 50, 'category_id' => 5],
            ['name' => 'Mikser ręczny Bosch', 'description' => 'Hand mixer with 5 speeds.', 'price' => 299.99, 'stock' => 40, 'category_id' => 5],
            ['name' => 'Blender Braun', 'description' => 'Hand blender with multiple attachments.', 'price' => 349.99, 'stock' => 30, 'category_id' => 5],
            ['name' => 'Frytkownica Tefal', 'description' => 'Air fryer with low-fat technology.', 'price' => 799.99, 'stock' => 25, 'category_id' => 5],
            ['name' => 'Czajnik elektryczny Xiaomi', 'description' => 'Smart electric kettle.', 'price' => 199.99, 'stock' => 50, 'category_id' => 5],


            ['name' => 'Pilot uniwersalny', 'description' => 'Universal remote control for TVs.', 'price' => 49.99, 'stock' => 100, 'category_id' => 6],
            ['name' => 'Kabel HDMI', 'description' => 'High-speed HDMI cable with 4K support.', 'price' => 29.99, 'stock' => 200, 'category_id' => 6],
            ['name' => 'Przedłużacz elektryczny', 'description' => 'Power strip with surge protection.', 'price' => 59.99, 'stock' => 80, 'category_id' => 6],
            ['name' => 'Filtry do odkurzacza', 'description' => 'Replacement filters for vacuum cleaners.', 'price' => 39.99, 'stock' => 150, 'category_id' => 6],
            ['name' => 'Mata antypoślizgowa', 'description' => 'Anti-slip mat for washing machines.', 'price' => 79.99, 'stock' => 60, 'category_id' => 6],
            ['name' => 'Uchwyt na tablet', 'description' => 'Adjustable tablet holder.', 'price' => 99.99, 'stock' => 70, 'category_id' => 6],
        ];

        foreach ($products as $product) {
            Product::create($product);
        }
    }
}
