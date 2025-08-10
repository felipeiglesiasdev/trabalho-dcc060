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
        // CRIA A TABELA 'CATEGORIA' NO BANCO DE DADOS.
        Schema::create('categoria', function (Blueprint $table) {
            // COLUNA ID, VARCHAR DE 10 E CHAVE PRIMÁRIA.
            $table->string('id_cat', 4)->primary();

            // COLUNA PARA O NOME DA CATEGORIA, VARCHAR DE 30.
            $table->string('nome', 255);

            // COLUNA PARA A MARCA, VARCHAR DE 10.
            $table->string('marca', 255);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // COMANDO PARA REVERTER A MIGRATION E APAGAR A TABELA.
        Schema::dropIfExists('categoria');
    }
};