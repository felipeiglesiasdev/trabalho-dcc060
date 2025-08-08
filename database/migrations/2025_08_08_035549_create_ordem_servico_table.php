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
        // CRIA A TABELA 'ORDEMSERVICO' NO BANCO DE DADOS.
        Schema::create('ordemServico', function (Blueprint $table) {
            // COLUNA id_os, VARCHAR DE 10 E CHAVE PRIMÁRIA.
            $table->string('id_os', 4)->primary();

            // COLUNA PARA O NOME, VARCHAR DE 30.
            $table->string('nome', 30);

            // COLUNA PARA O TIPO DE SERVIÇO, VARCHAR DE 30.
            $table->string('tipo_serviço', 30);

            // COLUNA PARA A DATA DO SERVIÇO, DO TIPO TIMESTAMP.
            $table->timestamp('data_serviço')->nullable();

            // COLUNA PARA O STATUS, VARCHAR DE 10.
            $table->string('status', 10);

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
        Schema::dropIfExists('ordemServico');
    }
};