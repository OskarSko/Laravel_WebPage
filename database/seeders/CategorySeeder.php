<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;
class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Category::create(['name' => 'Telewizory i RTV']);
        Category::create(['name' => 'Komputery i Laptopy']);
        Category::create(['name' => 'Smartfony i Tablety']);
        Category::create(['name' => 'Sprzęt AGD']);
        Category::create(['name' => 'Małe AGD']);
        Category::create(['name' => 'Akcesoria RTV/AGD']);
    }
}
