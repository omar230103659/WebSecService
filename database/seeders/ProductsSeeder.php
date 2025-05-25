<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\ProductInventory;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ProductsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $productsData = [
            [
                'code' => 'TV01',
                'name' => 'LG TV 50 Insh',
                'model' => 'LG8768787',
                'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.',
                'category_id' => 0,
                'price' => 28000.00,
                'photo' => 'lgtv50.jpg',
                'created_at' => null,
                'updated_at' => '2025-02-25 04:40:56',
                'deleted_at' => null,
                'grade_id' => null,
                'is_active' => 1,
            ],
            [
                'code' => 'RF01',
                'name' => 'Toshipa Refrigerator 14"',
                'model' => 'TS76634',
                'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.',
                'category_id' => 0,
                'price' => 22000.00,
                'photo' => 'tsrf50.jpg',
                'created_at' => null,
                'updated_at' => null,
                'deleted_at' => null,
                'grade_id' => null,
                'is_active' => 1,
            ],
            [
                'code' => 'RF02',
                'name' => 'Toshipa Refrigerator 18"',
                'model' => 'TS76634',
                'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.',
                'category_id' => 0,
                'price' => 28000.00,
                'photo' => 'rf2.jpg',
                'created_at' => null,
                'updated_at' => null,
                'deleted_at' => null,
                'grade_id' => null,
                'is_active' => 1,
            ],
            [
                'code' => 'RF03',
                'name' => 'Toshipa Refrigerator 19"',
                'model' => 'TS76634',
                'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.',
                'category_id' => 0,
                'price' => 32000.00,
                'photo' => 'rf3.jpg',
                'created_at' => null,
                'updated_at' => null,
                'deleted_at' => null,
                'grade_id' => null,
                'is_active' => 1,
            ],
            [
                'code' => 'TV02',
                'name' => 'LG TV 55"',
                'model' => 'LG8768787',
                'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.',
                'category_id' => 0,
                'price' => 23000.00,
                'photo' => 'tv2.jpg',
                'created_at' => null,
                'updated_at' => null,
                'deleted_at' => null,
                'grade_id' => null,
                'is_active' => 1,
            ],
            [
                'code' => 'RF04',
                'name' => 'LG Refrigerator 14"',
                'model' => 'TS76634',
                'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.',
                'category_id' => 0,
                'price' => 22000.00,
                'photo' => 'rf4.jpg',
                'created_at' => null,
                'updated_at' => null,
                'deleted_at' => null,
                'grade_id' => null,
                'is_active' => 1,
            ],
            [
                'code' => 'TV03',
                'name' => 'LG TV 60"',
                'model' => 'LG8768787',
                'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.',
                'category_id' => 0,
                'price' => 44000.00,
                'photo' => 'tv3.jpg',
                'created_at' => null,
                'updated_at' => null,
                'deleted_at' => null,
                'grade_id' => null,
                'is_active' => 1,
            ],
            [
                'code' => 'RF05',
                'name' => 'Toshipa Refrigerator 12"',
                'model' => 'TS76634',
                'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.',
                'category_id' => 0,
                'price' => 10700.00,
                'photo' => 'rf5.jpg',
                'created_at' => null,
                'updated_at' => null,
                'deleted_at' => null,
                'grade_id' => null,
                'is_active' => 1,
            ],
            [
                'code' => 'TV04',
                'name' => 'LG TV 99"',
                'model' => 'LG8768787',
                'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.',
                'category_id' => 0,
                'price' => 108000.00,
                'photo' => 'tv4.jpg',
                'created_at' => null,
                'updated_at' => null,
                'deleted_at' => null,
                'grade_id' => null,
                'is_active' => 1,
            ],
            [
                'code' => 'RF05',
                'name' => 'Toshipa Refrigerator 19" \\ bta3t kero',
                'model' => 'TS76634',
                'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.',
                'category_id' => 0,
                'price' => 44000.00,
                'photo' => 'rf4.jpg',
                'created_at' => '2025-02-25 01:18:04',
                'updated_at' => '2025-05-23 16:46:12',
                'deleted_at' => null,
                'grade_id' => null,
                'is_active' => 1,
            ],
            [
                'code' => 'TV01',
                'name' => 'LG TV 50"',
                'model' => 'LG8768787',
                'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.',
                'category_id' => 0,
                'price' => 18000.00,
                'photo' => 'lgtv50.jpg',
                'created_at' => '2025-02-25 01:24:04',
                'updated_at' => '2025-02-25 01:24:04',
                'deleted_at' => null,
                'grade_id' => null,
                'is_active' => 1,
            ],
        ];

        foreach ($productsData as $productData) {
            $product = Product::firstOrCreate(
                ['code' => $productData['code']], // Find by code
                $productData // Attributes to create if not found
            );

            // Ensure an inventory record exists for the product
            ProductInventory::firstOrCreate(
                ['product_id' => $product->id],
                ['quantity' => 10, 'location' => 'warehouse'] // Set a default initial quantity and location
            );
        }
    }
}
