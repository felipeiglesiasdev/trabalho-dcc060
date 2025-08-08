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
        // CRIA A TABELA 'RELATORIO' NO BANCO DE DADOS.
        Schema::create('relatorio', function (Blueprint $table) {
            // COLUNA id_relatorio, VARCHAR DE 10 E CHAVE PRIMÁRIA.
            $table->string('id_relatorio', 4)->primary();

            // COLUNA PARA A DESCRIÇÃO, VARCHAR DE 30.
            $table->string('descrição', 30);

            // COLUNA PARA A CHAVE ESTRANGEIRA DA ORDEM DE SERVIÇO.
            $table->string('id_os', 4);

            // COLUNA PARA A CHAVE ESTRANGEIRA DO USUÁRIO.
            $table->string('id_usuario', 4);

            // DEFINE A CHAVE ESTRANGEIRA PARA A ORDEM DE SERVIÇO.
            $table->foreign('id_os')->references('id_os')->on('ordemServico');

            // DEFINE A CHAVE ESTRANGEIRA PARA O USUÁRIO.
            $table->foreign('id_usuario')->references('id_usuario')->on('usuario');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // COMANDO PARA REVERTER A MIGRATION E APAGAR A TABELA.
        Schema::dropIfExists('relatorio');
    }
};