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
            'type' => '0'
        ]);

        // Creating B2C product
        Product::factory()->create([
            'title' => 'Apple MacBook Pro',
            'type' => '1'
        ]);
     }
}
