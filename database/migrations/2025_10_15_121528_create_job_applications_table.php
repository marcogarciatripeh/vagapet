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
        Schema::create('job_applications', function (Blueprint $table) {
            $table->id();
            $table->foreignId('job_id')->constrained()->onDelete('cascade');
            $table->foreignId('professional_profile_id')->constrained()->onDelete('cascade');

            // Status da candidatura
            $table->enum('status', ['pending', 'viewed', 'approved', 'rejected', 'withdrawn'])->default('pending');

            // Informações da candidatura
            $table->text('cover_letter')->nullable();
            $table->string('resume_file')->nullable(); // currículo específico para esta vaga

            // Timestamps de ações
            $table->timestamp('viewed_at')->nullable();
            $table->timestamp('responded_at')->nullable();
            $table->text('response_message')->nullable();

            $table->timestamps();
            $table->softDeletes();

            // Evitar candidaturas duplicadas
            $table->unique(['job_id', 'professional_profile_id']);
            $table->index(['status', 'created_at']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('job_applications');
    }
};
