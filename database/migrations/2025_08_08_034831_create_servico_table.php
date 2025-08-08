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
        // CRIA A TABELA 'SERVICO' NO BANCO DE DADOS.
        Schema::create('servico', function (Blueprint $table) {
            // COLUNA ID, VARCHAR DE 10 E CHAVE PRIMÁRIA.
            $table->string('id_servico', 4)->primary();

            // COLUNA PARA O TIPO DE SERVIÇO, VARCHAR DE 30.
            $table->string('tipo', 30);

            // COLUNA PARA O NOME DO SERVIÇO, VARCHAR DE 30.
            $table->string('nome', 30);

            // COLUNA PARA O VALOR, DO TIPO FLOAT.
            $table->float('valor');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // COMANDO PARA REVERTER A MIGRATION E APAGAR A TABELA.
        Schema::dropIfExists('servico');
    }
};