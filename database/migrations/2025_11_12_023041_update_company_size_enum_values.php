<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Alterar o tipo da coluna de ENUM para VARCHAR
        DB::statement("ALTER TABLE company_profiles MODIFY COLUMN company_size VARCHAR(10) NULL");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Reverter para o ENUM original
        DB::statement("ALTER TABLE company_profiles MODIFY COLUMN company_size ENUM('micro', 'small', 'medium', 'large') NULL");
    }
};
