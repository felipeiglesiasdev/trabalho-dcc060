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
        // CRIA A TABELA 'FUNCIONARIO' NO BANCO DE DADOS.
        Schema::create('funcionario', function (Blueprint $table) {
            // COLUNA id_usuario, VARCHAR DE 10 E CHAVE PRIMÁRIA.
            $table->string('id_usuario', 4)->primary();

             // COLUNA PARA O NOME, VARCHAR DE 10.
            $table->string('nome', 255);

            // COLUNA DE EMAIL, PRECISA SER ÚNICA PARA O LOGIN.
            $table->string('email')->unique();

            // COLUNA DE SENHA, O LARAVEL VAI CRIPTOGRAFAR (HASH).
            $table->string('password');

            // COLUNA PARA A ESPECIALIDADE, VARCHAR DE 30.
            $table->string('especialidade', 30);

            // COLUNA PARA O SALÁRIO, DO TIPO FLOAT.
            $table->float('salario');

            // COLUNA PARA A DATA DE ADMISSÃO, DO TIPO TIMESTAMP.
            $table->timestamp('data_admissao')->nullable();

            // DEFINE A CHAVE ESTRANGEIRA (FOREIGN KEY).
            // A COLUNA 'id_usuario' DESTA TABELA REFERENCIA A COLUNA 'id_usuario' DA TABELA 'USUARIO'.
            $table->foreign('id_usuario')->references('id_usuario')->on('usuario');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // COMANDO PARA REVERTER A MIGRATION E APAGAR A TABELA.
        Schema::dropIfExists('funcionario');
    }
};