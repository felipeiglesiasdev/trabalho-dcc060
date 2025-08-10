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
        // CRIA A TABELA PIVOT 'SERVICOITEMSERVICO' NO BANCO DE DADOS.
        Schema::create('servicoItemServico', function (Blueprint $table) {
            // COLUNA PARA A CHAVE ESTRANGEIRA DO SERVIÇO.
            $table->string('id_servico', 4);

            // COLUNA PARA A CHAVE ESTRANGEIRA DO ITEM DE SERVIÇO.
            $table->string('id_ItServ', 4);

            // DEFINE A CHAVE PRIMÁRIA COMPOSTA.
            $table->primary(['id_servico', 'id_ItServ']);

            // DEFINE A CHAVE ESTRANGEIRA PARA O SERVIÇO.
            $table->foreign('id_servico')->references('id_servico')->on('servico');

            // DEFINE A CHAVE ESTRANGEIRA PARA O ITEM DE SERVIÇO.
            $table->foreign('id_ItServ')->references('id_produto')->on('itemServico');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // COMANDO PARA REVERTER A MIGRATION E APAGAR A TABELA.
        Schema::dropIfExists('servicoItemServico');
    }
};