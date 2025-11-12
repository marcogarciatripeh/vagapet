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
        // Tentar remover a constraint errada se existir
        try {
            Schema::table('job_applications', function (Blueprint $table) {
                $table->dropForeign('job_applications_job_id_foreign');
            });
        } catch (\Exception $e) {
            // Constraint já foi removida ou não existe
        }

        // Verificar se a constraint correta já existe
        $constraintExists = DB::select("
            SELECT CONSTRAINT_NAME 
            FROM INFORMATION_SCHEMA.KEY_COLUMN_USAGE 
            WHERE TABLE_SCHEMA = DATABASE()
            AND TABLE_NAME = 'job_applications'
            AND COLUMN_NAME = 'job_id'
            AND REFERENCED_TABLE_NAME = 'vagas'
        ");

        // Adicionar a constraint correta apontando para a tabela 'vagas' se não existir
        if (empty($constraintExists)) {
            Schema::table('job_applications', function (Blueprint $table) {
                $table->foreign('job_id')->references('id')->on('vagas')->onDelete('cascade');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Reverter para o estado original (com o erro)
        Schema::table('job_applications', function (Blueprint $table) {
            $table->dropForeign(['job_id']);
        });

        Schema::table('job_applications', function (Blueprint $table) {
            $table->foreign('job_id')->references('id')->on('job_queue')->onDelete('cascade');
        });
    }
};
