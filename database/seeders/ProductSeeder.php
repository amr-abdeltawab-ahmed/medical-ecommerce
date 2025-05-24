<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        Product::insert([
            [
                'name' => 'Paracetamol',
                'description' => 'Pain relief medication',
                'price' => 12.99,
                'category' => 'Tablets',
                'image' => 'products/first.png',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Cough Syrup',
                'description' => 'Soothes cough and sore throat',
                'price' => 8.50,
                'category' => 'Syrup',
                'image' => 'products/second.png',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Vitamin C',
                'description' => 'Boosts immunity',
                'price' => 5.25,
                'category' => 'Supplements',
                'image' => 'products/third.png',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Antiseptic Cream',
                'description' => 'Prevents infection in minor cuts',
                'price' => 6.75,
                'category' => 'Creams',
                'image' => 'products/fourth.png',
                'created_at' => now(),
                'updated_at' => now()
            ]
        ]);
    }
}
