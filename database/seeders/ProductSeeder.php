<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Creating B2B product
        Product::factory()->create([
            'title' => 'Apple MacBook Pro',
            'type' => '0',
            'price' => '1299',
            'image' => 'storage/images/products/macbook-pro-2.jpg',
            'stripe_id' => 'price_1Nt54YLcxz9ozpMPdrPFN0gR',
        ]);

        // Creating B2C product
        Product::factory()->create([
            'title' => 'Apple MacBook Pro',
            'type' => '1',
            'price' => '1499',
            'image' => 'storage/images/products/macbook-pro.jpg',
            'stripe_id' => 'price_1Nt544Lcxz9ozpMPPM4AaoB7',
        ]);
     }
}
