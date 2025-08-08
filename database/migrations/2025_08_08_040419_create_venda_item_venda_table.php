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
        // CRIA A TABELA PIVOT 'VENDAITEMVENDA' NO BANCO DE DADOS.
        Schema::create('vendaItemVenda', function (Blueprint $table) {
            // COLUNA PARA A CHAVE ESTRANGEIRA DO ITEM DE VENDA.
            $table->string('id_ItVenda', 4);

            // COLUNA PARA A CHAVE ESTRANGEIRA DA VENDA.
            $table->string('id_venda', 4);

            // DEFINE A CHAVE PRIMÁRIA COMPOSTA.
            $table->primary(['id_ItVenda', 'id_venda']);

            // DEFINE A CHAVE ESTRANGEIRA PARA O ITEM DE VENDA.
            $table->foreign('id_ItVenda')->references('id_produto')->on('itemVenda');

            // DEFINE A CHAVE ESTRANGEIRA PARA A VENDA.
            $table->foreign('id_venda')->references('id_venda')->on('venda');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // COMANDO PARA REVERTER A MIGRATION E APAGAR A TABELA.
        Schema::dropIfExists('vendaItemVenda');
    }
};