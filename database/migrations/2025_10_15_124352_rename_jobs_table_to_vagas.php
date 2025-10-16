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
        // Renomear tabela jobs (filas) para job_queue
        Schema::rename('jobs', 'job_queue');

        // Criar nova tabela vagas
        Schema::create('vagas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('company_profile_id')->constrained()->onDelete('cascade');

            // Informações básicas
            $table->string('title');
            $table->string('slug')->unique();
            $table->text('description');
            $table->text('requirements')->nullable();
            $table->text('benefits')->nullable();

            // Detalhes da vaga
            $table->enum('contract_type', ['clt', 'pj', 'freelance', 'internship', 'temporary'])->default('clt');
            $table->string('area')->nullable(); // área de atuação
            $table->enum('experience_level', ['junior', 'pleno', 'senior', 'lead', 'any'])->default('any');
            $table->integer('work_hours')->nullable(); // carga horária semanal

            // Salário
            $table->enum('salary_type', ['fixed', 'range', 'negotiable'])->default('negotiable');
            $table->decimal('salary_min', 10, 2)->nullable();
            $table->decimal('salary_max', 10, 2)->nullable();
            $table->string('currency', 3)->default('BRL');

            // Localização
            $table->string('work_location')->nullable();
            $table->string('city')->nullable();
            $table->string('state')->nullable();
            $table->boolean('is_remote')->default(false);
            $table->boolean('is_hybrid')->default(false);

            // Status e prazos
            $table->enum('status', ['active', 'paused', 'closed', 'draft'])->default('draft');
            $table->boolean('is_featured')->default(false);
            $table->boolean('is_urgent')->default(false);
            $table->date('deadline')->nullable();
            $table->timestamp('published_at')->nullable();

            // Contadores
            $table->integer('views_count')->default(0);
            $table->integer('applications_count')->default(0);

            $table->timestamps();
            $table->softDeletes();

            $table->index(['status', 'published_at']);
            $table->index(['city', 'state']);
            $table->index(['contract_type', 'experience_level']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vagas');
        Schema::rename('job_queue', 'jobs');
    }
};
