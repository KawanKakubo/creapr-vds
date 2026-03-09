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
        Schema::table('submissions', function (Blueprint $table) {
            // Novos campos para o fluxo reformulado
            $table->json('setores_economicos')->nullable()->after('habitantes_num');
            $table->string('regional_creapr')->nullable()->after('setores_economicos');
            $table->boolean('faz_parte_mais_engenharia')->default(false)->after('prefeito_mandato');
            
            // Pontuações dos diagnósticos
            $table->integer('pontuacao_estimulo')->default(0)->after('status_observacao');
            $table->integer('pontuacao_educacao')->default(0)->after('pontuacao_estimulo');
            $table->integer('pontuacao_estruturas')->default(0)->after('pontuacao_educacao');
            
            // Controle de diagnósticos
            $table->timestamp('diagnostico_estimulo_iniciado_em')->nullable()->after('pontuacao_estruturas');
            $table->timestamp('diagnostico_educacao_iniciado_em')->nullable()->after('diagnostico_estimulo_iniciado_em');
            $table->timestamp('diagnostico_estruturas_iniciado_em')->nullable()->after('diagnostico_educacao_iniciado_em');
            
            $table->timestamp('diagnostico_estimulo_concluido_em')->nullable()->after('diagnostico_estruturas_iniciado_em');
            $table->timestamp('diagnostico_educacao_concluido_em')->nullable()->after('diagnostico_estimulo_concluido_em');
            $table->timestamp('diagnostico_estruturas_concluido_em')->nullable()->after('diagnostico_educacao_concluido_em');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('submissions', function (Blueprint $table) {
            $table->dropColumn([
                'setores_economicos',
                'regional_creapr',
                'faz_parte_mais_engenharia',
                'pontuacao_estimulo',
                'pontuacao_educacao',
                'pontuacao_estruturas',
                'diagnostico_estimulo_iniciado_em',
                'diagnostico_educacao_iniciado_em',
                'diagnostico_estruturas_iniciado_em',
                'diagnostico_estimulo_concluido_em',
                'diagnostico_educacao_concluido_em',
                'diagnostico_estruturas_concluido_em',
            ]);
        });
    }
};
