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
            if (!Schema::hasColumn('products', 'code')) {
                $table->string('code', 32)->nullable()->after('id');
            }
            if (!Schema::hasColumn('products', 'model')) {
                $table->string('model', 256)->nullable()->after('code');
            }
            if (!Schema::hasColumn('products', 'photo')) {
                $table->string('photo')->nullable()->after('price');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            if (Schema::hasColumn('products', 'code')) {
                $table->dropColumn('code');
            }
            if (Schema::hasColumn('products', 'model')) {
                $table->dropColumn('model');
            }
            if (Schema::hasColumn('products', 'photo')) {
                $table->dropColumn('photo');
            }
        });
    }
}; 