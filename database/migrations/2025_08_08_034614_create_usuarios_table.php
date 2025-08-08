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
        //============================================================
        // CRIA A TABELA 'USUARIO' COMPLETA NO BANCO DE DADOS
        //============================================================
        Schema::create('usuario', function (Blueprint $table) {
            // COLUNA ID, VARCHAR DE 10 E CHAVE PRIMÁRIA.
            $table->string('id_usuario', 4)->primary();

            // COLUNA PARA O NOME, VARCHAR DE 10.
            $table->string('nome', 255);

            // COLUNA DE EMAIL, PRECISA SER ÚNICA PARA O LOGIN.
            $table->string('email')->unique();

            // COLUNA DE SENHA, O LARAVEL VAI CRIPTOGRAFAR (HASH).
            $table->string('password');

            // COLUNA PARA O TIPO DE USUÁRIO, AGORA COMO ENUM.
            $table->enum('tipo', ['admin', 'funcionario']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // COMANDO PARA REVERTER A MIGRATION E APAGAR A TABELA.
        Schema::dropIfExists('usuario');
    }
};