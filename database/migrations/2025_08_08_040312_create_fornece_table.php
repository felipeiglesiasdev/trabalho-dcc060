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
        // CRIA A TABELA PIVOT 'FORNECE' NO BANCO DE DADOS.
        Schema::create('fornece', function (Blueprint $table) {
            // COLUNA PARA A CHAVE ESTRANGEIRA DO FORNECEDOR.
            $table->string('id_forn', 4);

            // COLUNA PARA A CHAVE ESTRANGEIRA DO PRODUTO.
            $table->string('id_produto', 4);

            // DEFINE A CHAVE PRIMÁRIA COMPOSTA.
            $table->primary(['id_forn', 'id_produto']);

            // DEFINE A CHAVE ESTRANGEIRA PARA O FORNECEDOR.
            $table->foreign('id_forn')->references('id_forn')->on('fornecedor');

            // DEFINE A CHAVE ESTRANGEIRA PARA O PRODUTO.
            $table->foreign('id_produto')->references('id_produto')->on('produto');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // COMANDO PARA REVERTER A MIGRATION E APAGAR A TABELA.
        Schema::dropIfExists('fornece');
    }
};