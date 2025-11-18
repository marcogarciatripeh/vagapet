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
        Schema::table('professional_profiles', function (Blueprint $table) {
            $table->boolean('is_public')->default(true)->after('applications_count');
            $table->boolean('show_in_search')->default(true)->after('is_public');
            $table->boolean('allow_direct_contact')->default(true)->after('show_in_search');
            $table->boolean('show_current_salary')->default(false)->after('allow_direct_contact');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('professional_profiles', function (Blueprint $table) {
            $table->dropColumn(['is_public', 'show_in_search', 'allow_direct_contact', 'show_current_salary']);
        });
    }
};
