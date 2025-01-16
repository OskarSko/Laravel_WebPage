<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\Review;

class ReviewSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Pobierz wszystkie produkty
        $products = Product::all();

        // Przykładowe dane recenzji
        $reviewsData = [
            [
                'author' => 'John Doe',
                'rating' => 5,
                'comment' => 'Great product! Highly recommended.',
            ],
            [
                'author' => 'Jane Smith',
                'rating' => 4,
                'comment' => 'Good value for money. Satisfied with the quality.',
            ],
            [
                'author' => 'Mike Johnson',
                'rating' => 3,
                'comment' => 'Decent product, but there is room for improvement.',
            ],
            [
                'author' => 'Alice Brown',
                'rating' => 2,
                'comment' => 'Not as expected, but it works.',
            ],
            [
                'author' => 'Chris White',
                'rating' => 1,
                'comment' => 'Terrible experience. Would not buy again.',
            ],
        ];

        foreach ($products as $product) {
            // Losowo zdecyduj, czy produkt otrzyma recenzje
            if (rand(0, 1)) {
                // Dodaj 1 lub 2 recenzje
                $reviewsToAdd = rand(1, 2);

                for ($i = 0; $i < $reviewsToAdd; $i++) {
                    // Wybierz losową recenzję
                    $review = $reviewsData[array_rand($reviewsData)];

                    // Utwórz recenzję dla danego produktu
                    Review::create([
                        'product_id' => $product->id,
                        'author' => $review['author'],
                        'rating' => $review['rating'],
                        'comment' => $review['comment'],
                    ]);
                }
            }
        }
    }
}
