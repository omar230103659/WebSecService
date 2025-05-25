<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('products', function (Blueprint $table) {
            // First drop the old category column if it exists
            if (Schema::hasColumn('products', 'category')) {
                $table->dropColumn('category');
            }

            // Add new columns if they don't exist
            if (!Schema::hasColumn('products', 'code')) {
                $table->string('code')->after('id');
            }
            if (!Schema::hasColumn('products', 'model')) {
                $table->string('model')->after('code');
            }
            if (!Schema::hasColumn('products', 'photo')) {
                $table->string('photo')->after('price');
            }
            if (!Schema::hasColumn('products', 'category_id')) {
                $table->foreignId('category_id')->after('description')->constrained('categories')->onDelete('cascade');
            }
            if (!Schema::hasColumn('products', 'price')) {
                $table->decimal('price', 10, 2)->default(0);
            }
            if (!Schema::hasColumn('products', 'stock')) {
                $table->integer('stock')->default(0);
            }
            if (!Schema::hasColumn('products', 'is_active')) {
                $table->boolean('is_active')->default(true);
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropForeign(['category_id']);
            $table->dropColumn(['code', 'model', 'photo', 'category_id', 'price', 'stock', 'is_active']);
            $table->string('category')->after('description');
        });
    }
}; 