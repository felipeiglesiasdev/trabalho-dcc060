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
        // CRIA A TABELA 'VENDA' NO BANCO DE DADOS.
        Schema::create('venda', function (Blueprint $table) {
            // COLUNA id_venda, VARCHAR DE 10 E CHAVE PRIMÁRIA.
            $table->string('id_venda', 4)->primary();

            // COLUNA PARA O NOME DA VENDA, VARCHAR DE 30.
            $table->string('nome', 30);

            // COLUNA PARA O VALOR, DO TIPO FLOAT.
            $table->float('valor');

            // COLUNA PARA A CHAVE ESTRANGEIRA DO CLIENTE.
            $table->string('id_cliente', 4);

            // COLUNA PARA A CHAVE ESTRANGEIRA DO FUNCIONÁRIO.
            $table->string('id_funcionario', 4);

            // DEFINE A CHAVE ESTRANGEIRA PARA O CLIENTE.
            $table->foreign('id_cliente')->references('id_cliente')->on('cliente');

            // DEFINE A CHAVE ESTRANGEIRA PARA O FUNCIONÁRIO.
            $table->foreign('id_funcionario')->references('id_usuario')->on('funcionario');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // COMANDO PARA REVERTER A MIGRATION E APAGAR A TABELA.
        Schema::dropIfExists('venda');
    }
};