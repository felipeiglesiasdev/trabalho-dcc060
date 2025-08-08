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
        // CRIA A TABELA 'CLIENTE' NO BANCO DE DADOS.
        Schema::create('cliente', function (Blueprint $table) {
            // COLUNA ID, VARCHAR DE 10 E CHAVE PRIMÁRIA.
            $table->string('id_cliente', 4)->primary();

            // COLUNA PARA O NOME DO CLIENTE, VARCHAR DE 30.
            $table->string('nome', 30);

            // COLUNA PARA O CPF, VARCHAR DE 11.
            $table->string('cpf', 11);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // COMANDO PARA REVERTER A MIGRATION E APAGAR A TABELA.
        Schema::dropIfExists('cliente');
    }
};