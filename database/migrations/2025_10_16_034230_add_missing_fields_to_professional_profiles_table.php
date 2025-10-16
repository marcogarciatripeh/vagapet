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
            // Adicionar campo para título profissional
            $table->string('title')->nullable()->after('bio');

            // Adicionar campo para nível de experiência (separado do array de experiências)
            $table->enum('experience_level', ['estagio', 'junior', 'pleno', 'senior'])->nullable()->after('title');

            // Renomear o campo experience para experiences (array de experiências profissionais)
            $table->renameColumn('experience', 'experiences');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('professional_profiles', function (Blueprint $table) {
            $table->dropColumn(['title', 'experience_level']);
            $table->renameColumn('experiences', 'experience');
        });
    }
};
