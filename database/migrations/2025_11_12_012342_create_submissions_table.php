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
        Schema::create('submissions', function (Blueprint $table) {
            $table->id();
            $table->string('protocolo')->unique(); // Ex: CREA-2024-0001
            
            // Informações do Município
            $table->string('municipio_nome');
            $table->string('prefeito_nome');
            $table->string('prefeito_mandato'); // (1º Mandato, 2º Mandato)
            $table->integer('habitantes_num');
            
            // Bloco 1: Lei, Fundo, Conselho
            $table->boolean('possui_lei_inovacao');
            $table->string('link_lei_inovacao')->nullable();
            $table->boolean('possui_fundo_inovacao');
            $table->string('cnpj_fundo_inovacao')->nullable();
            $table->boolean('possui_conselho_cti');
            $table->string('link_portaria_conselho')->nullable();
            
            // Bloco 2: Governança e Estrutura
            $table->boolean('possui_normativa_governanca');
            $table->string('link_normativa_governanca')->nullable();
            $table->boolean('possui_secretaria_cti');
            $table->string('orgao_responsavel_cti')->nullable(); // (Caso não tenha secretaria)
            
            // Bloco 3: Contratos e Políticas Públicas
            $table->boolean('rodou_contrato_solucao_inovadora');
            $table->string('link_evidencia_contrato')->nullable();
            $table->boolean('possui_politica_sandbox');
            $table->string('link_evidencia_sandbox')->nullable();
            $table->boolean('possui_politica_living_lab');
            $table->string('link_evidencia_living_lab')->nullable();
            $table->boolean('possui_estrategia_transformacao_digital');
            $table->string('link_evidencia_estrategia')->nullable();
            
            // Bloco 4: Ecossistema de Inovação
            $table->integer('startups_num')->default(0);
            $table->json('ambientes_inovacao')->nullable(); // (Armazena array de checkboxes)
            $table->json('hackathons_realizados')->nullable(); // (Armazena array de checkboxes)
            
            // Bloco 5: Planejamento e Relevância
            $table->boolean('possui_planejamento_estrategico');
            $table->string('link_evidencia_planejamento')->nullable();
            $table->string('relevancia_engenharias');
            $table->text('relevancia_engenharias_descricao');
            
            // Bloco 6: Prêmios
            $table->boolean('ganhou_premio_inovacao');
            $table->text('descricao_premio_relevante')->nullable();
            
            // Bloco 7: Ponto Focal (Contato)
            $table->string('ponto_focal_nome');
            $table->string('ponto_focal_cargo');
            $table->string('ponto_focal_email');
            $table->string('ponto_focal_telefone');
            $table->string('ponto_focal_celular');
            
            // Final
            $table->boolean('declaracao_interesse');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('submissions');
    }
};
