<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('certificate_serial')->nullable()->after('facebook_token');
            $table->string('certificate_subject')->nullable()->after('certificate_serial');
            $table->string('certificate_issuer')->nullable()->after('certificate_subject');
            $table->date('certificate_valid_from')->nullable()->after('certificate_issuer');
            $table->date('certificate_valid_to')->nullable()->after('certificate_valid_from');
        });
    }
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['certificate_serial', 'certificate_subject', 'certificate_issuer', 'certificate_valid_from', 'certificate_valid_to']);
        });
    }
}; 