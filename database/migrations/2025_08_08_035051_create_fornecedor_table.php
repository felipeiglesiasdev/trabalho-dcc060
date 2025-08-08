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
        // CRIA A TABELA 'FORNECEDOR' NO BANCO DE DADOS.
        Schema::create('fornecedor', function (Blueprint $table) {
            // COLUNA ID, VARCHAR DE 10 E CHAVE PRIMÁRIA.
            $table->string('id_forn', 4)->primary();

            // COLUNA PARA O NOME DO FORNECEDOR, VARCHAR DE 30.
            $table->string('nome', 30);

            // COLUNA PARA O CNPJ, VARCHAR DE 15.
            $table->string('cnpj', 15);

            // COLUNA PARA O EMAIL, VARCHAR DE 30.
            $table->string('email', 30);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // COMANDO PARA REVERTER A MIGRATION E APAGAR A TABELA.
        Schema::dropIfExists('fornecedor');
    }
};