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
        Schema::create('company_profiles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');

            // Dados da empresa
            $table->string('company_name');
            $table->string('cnpj')->nullable();
            $table->string('phone')->nullable();
            $table->string('website')->nullable();
            $table->text('description')->nullable();

            // Localização
            $table->string('address')->nullable();
            $table->string('city')->nullable();
            $table->string('state')->nullable();
            $table->string('zip_code')->nullable();
            $table->decimal('latitude', 10, 8)->nullable();
            $table->decimal('longitude', 11, 8)->nullable();

            // Serviços e informações
            $table->json('services')->nullable(); // serviços oferecidos
            $table->json('specialties')->nullable(); // especialidades
            $table->integer('employees_count')->nullable();
            $table->enum('company_size', ['micro', 'small', 'medium', 'large'])->nullable();

            // Arquivos
            $table->string('logo')->nullable();
            $table->json('photos')->nullable(); // fotos do espaço (máximo 5)

            // Redes sociais
            $table->string('linkedin')->nullable();
            $table->string('instagram')->nullable();
            $table->string('facebook')->nullable();
            $table->string('youtube')->nullable();

            // Estatísticas
            $table->integer('views_count')->default(0);
            $table->integer('jobs_posted_count')->default(0);
            $table->integer('applications_received_count')->default(0);

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('company_profiles');
    }
};
