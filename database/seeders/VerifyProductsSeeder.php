<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class VerifyProductsSeeder extends Seeder
{
    public function run()
    {
        // Show table structure
        $columns = Schema::getColumnListing('products');
        echo "Table columns: " . implode(', ', $columns) . "\n\n";

        // Show all products
        $products = DB::table('products')->get();
        foreach ($products as $product) {
            echo "Product: " . json_encode($product, JSON_PRETTY_PRINT) . "\n";
        }
    }
} 