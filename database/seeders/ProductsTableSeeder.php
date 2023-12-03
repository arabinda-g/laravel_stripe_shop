<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('products')->insert([
            ['name' => 'Product 1', 'price' => 99.99, 'description' => 'Description for product 1'],
            ['name' => 'Product 2', 'price' => 199.99, 'description' => 'Description for product 2'],
            ['name' => 'Product 3', 'price' => 299.99, 'description' => 'Description for product 3'],
            ['name' => 'Product 4', 'price' => 399.99, 'description' => 'Description for product 4'],
            ['name' => 'Product 5', 'price' => 499.99, 'description' => 'Description for product 5'],
            ['name' => 'Product 6', 'price' => 599.99, 'description' => 'Description for product 6'],
            ['name' => 'Product 7', 'price' => 699.99, 'description' => 'Description for product 7'],
            ['name' => 'Product 8', 'price' => 799.99, 'description' => 'Description for product 8'],
            ['name' => 'Product 9', 'price' => 899.99, 'description' => 'Description for product 9'],
            ['name' => 'Product 10', 'price' => 999.99, 'description' => 'Description for product 10'],
        ]);
    }
}
