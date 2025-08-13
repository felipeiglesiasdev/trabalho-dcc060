<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Funcionario extends Model
{
    //============================================================
    // CONFIGURAÇÕES DO MODEL FUNCIONÁRIO
    //============================================================

    // INDICA AO LARAVEL O NOME EXATO DA TABELA NO BANCO.
    protected $table = 'funcionario';

    // AVISA QUE A CHAVE PRIMÁRIA É 'ID_USU'.
    protected $primaryKey = 'id_usuario';

    // INFORMA QUE A CHAVE PRIMÁRIA NÃO É UM NÚMERO QUE SE AUTO-INCREMENTA.
    public $incrementing = false;

    // COMO A CHAVE PRIMÁRIA É UMA STRING (VARCHAR), PRECISAMOS DEFINIR O TIPO DELA.
    protected $keyType = 'string';

    // A TABELA NÃO TEM AS COLUNAS 'CREATED_AT' E 'UPDATED_AT'.
    public $timestamps = false;

    //============================================================
    // ATRIBUTOS PREENCHÍVEIS (MASS ASSIGNMENT)
    //============================================================

    // DEFINE QUAIS COLUNAS PODEM SER PREENCHIDAS EM MASSA.
    protected $fillable = [
        'id_usuario',
        'nome',
        'email',
        'password',
        'especialidade',
        'salario',
        'data_admissao',
    ];

    //============================================================
    // ATRIBUTOS OCULTOS
    //============================================================

    // ESCONDE A SENHA QUANDO O MODEL É CONVERTIDO PARA ARRAY OU JSON.
    protected $hidden = [
        'password',
        'remember_token', // CAMPO PADRÃO DO LARAVEL PARA "LEMBRAR-ME".
    ];

    //============================================================
    // RELACIONAMENTOS
    //============================================================

    // RELAÇÃO 1-1 INVERSA COM USUÁRIO.
    public function usuario()
    {
        // UM FUNCIONÁRIO PERTENCE A UM USUÁRIO.
        return $this->belongsTo(Usuario::class, 'id_usuario', 'id_usuario');
    }

    // RELAÇÃO 1-N COM ORDEM DE SERVIÇO.
    public function ordemServicos()
    {
        // UM FUNCIONÁRIO PODE SER ATRIBUÍDO A VÁRIAS ORDENS DE SERVIÇO.
        return $this->hasMany(OrdemServico::class, 'id_funcionario', 'id_usuario');
    }

    // RELAÇÃO 1-N COM VENDA.
    public function vendas()
    {
        // UM FUNCIONÁRIO PODE REALIZAR VÁRIAS VENDAS.
        return $this->hasMany(Venda::class, 'id_funcionario', 'id_usuario');
    }
}