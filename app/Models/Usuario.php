<?php

namespace App\Models;

// IMPORTAÇÕES NECESSÁRIAS PARA AUTENTICAÇÃO.
use Illuminate\Foundation\Auth\User as Authenticatable;

// O MODEL PRECISA EXTENDER 'AUTHENTICATABLE' PARA O LOGIN FUNCIONAR.
class Usuario extends Authenticatable
{
    //============================================================
    // CONFIGURAÇÕES DO MODEL USUARIO
    //============================================================

    // INDICA AO LARAVEL O NOME EXATO DA TABELA NO BANCO.
    protected $table = 'usuario';

    // AVISA QUE A CHAVE PRIMÁRIA AGORA É 'ID_USUARIO'.
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
        'tipo',
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

    // DEFINE A RELAÇÃO DE UM-PARA-UM COM FUNCIONARIO.
    public function funcionario()
    {
        // UM USUÁRIO TEM UM FUNCIONÁRIO ASSOCIADO.
        // A CHAVE ESTRANGEIRA EM 'FUNCIONARIO' É 'ID_USU' E A LOCAL É 'ID_USUARIO'.
        return $this->hasOne(Funcionario::class, 'id_usuario', 'id_usuario');
    }

    // DEFINE A RELAÇÃO DE UM-PARA-MUITOS COM RELATORIO.
    public function relatorios()
    {
        // UM USUÁRIO PODE GERAR VÁRIOS RELATÓRIOS.
        return $this->hasMany(Relatorio::class, 'id_usuario', 'id_usuario');
    }
}