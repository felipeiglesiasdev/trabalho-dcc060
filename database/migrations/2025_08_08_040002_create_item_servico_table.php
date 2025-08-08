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
        // CRIA A TABELA 'ITEMSERVICO' NO BANCO DE DADOS.
        Schema::create('itemServico', function (Blueprint $table) {
            // COLUNA id_produto, VARCHAR DE 10 E CHAVE PRIMÁRIA.
            $table->string('id_produto', 4)->primary();

            // COLUNA PARA O NOME, VARCHAR DE 30.
            $table->string('nome', 30);

            // DEFINE A CHAVE ESTRANGEIRA (FOREIGN KEY).
            // A COLUNA 'id_produto' DESTA TABELA REFERENCIA A COLUNA 'id_produto' DA TABELA 'PRODUTO'.
            $table->foreign('id_produto')->references('id_produto')->on('produto');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // COMANDO PARA REVERTER A MIGRATION E APAGAR A TABELA.
        Schema::dropIfExists('itemServico');
    }
};