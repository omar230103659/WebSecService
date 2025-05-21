<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('facebook_id')->nullable()->after('google_refresh_token');
            $table->string('facebook_token')->nullable()->after('facebook_id');
        });
    }
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['facebook_id', 'facebook_token']);
        });
    }
}; 