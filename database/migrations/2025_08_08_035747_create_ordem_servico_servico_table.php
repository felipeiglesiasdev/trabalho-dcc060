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
        // CRIA A TABELA PIVOT 'ORDEMSERVICOSERVICO' NO BANCO DE DADOS.
        Schema::create('ordemServicoServico', function (Blueprint $table) {
            // COLUNA PARA A CHAVE ESTRANGEIRA DA ORDEM DE SERVIÇO.
            $table->string('id_os', 4);

            // COLUNA PARA A CHAVE ESTRANGEIRA DO SERVIÇO.
            $table->string('id_servico', 4);

            // DEFINE A CHAVE PRIMÁRIA COMPOSTA.
            $table->primary(['id_os', 'id_servico']);

            // DEFINE A CHAVE ESTRANGEIRA PARA A ORDEM DE SERVIÇO.
            $table->foreign('id_os')->references('id_os')->on('ordemServico');

            // DEFINE A CHAVE ESTRANGEIRA PARA O SERVIÇO.
            $table->foreign('id_servico')->references('id_servico')->on('servico');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // COMANDO PARA REVERTER A MIGRATION E APAGAR A TABELA.
        Schema::dropIfExists('ordemServicoServico');
    }
};