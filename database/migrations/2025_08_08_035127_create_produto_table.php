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
        // CRIA A TABELA 'PRODUTO' NO BANCO DE DADOS.
        Schema::create('produto', function (Blueprint $table) {
            // COLUNA id_produto, VARCHAR DE 10 E CHAVE PRIMÁRIA.
            $table->string('id_produto', 4)->primary();

            // COLUNA PARA O NOME DO PRODUTO, VARCHAR DE 30.
            $table->string('nome', 30);

            // COLUNA PARA A CHAVE ESTRANGEIRA DA CATEGORIA.
            $table->string('id_cat', 4);

            // DEFINE A CHAVE ESTRANGEIRA (FOREIGN KEY).
            // A COLUNA 'id_cat' DESTA TABELA REFERENCIA A COLUNA 'id_cat' DA TABELA 'CATEGORIA'.
            $table->foreign('id_cat')->references('id_cat')->on('categoria');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // COMANDO PARA REVERTER A MIGRATION E APAGAR A TABELA.
        Schema::dropIfExists('produto');
    }
};