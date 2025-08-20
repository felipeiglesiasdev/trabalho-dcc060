<?php
namespace App\Models;
use Illuminate\Foundation\Auth\User as Authenticatable;


class Usuario extends Authenticatable
{
    //============================================================
    // CONFIGURAÇÕES DO MODEL USUARIO
    //============================================================

    // NOME EXATO DA TABELA NO BANCO.
    protected $table = 'usuario';

    // CHAVE PRIMÁRIA É 'ID_USUARIO'.
    protected $primaryKey = 'id_usuario';

    // INFORMA QUE A CHAVE PRIMÁRIA NÃO É UM NÚMERO QUE SE AUTO-INCREMENTA.
    public $incrementing = false;

    // COMO A CHAVE PRIMÁRIA É UMA STRING (VARCHAR)
    protected $keyType = 'string';

    public $timestamps = false;

    // DEFINE QUAIS COLUNAS PODEM SER PREENCHIDAS EM MASSA.
    protected $fillable = [
        'id_usuario',
        'nome',
        'email',
        'password',
        'tipo',
    ];

    // ESCONDE A SENHA 
    protected $hidden = [
        'password',
        'remember_token', 
    ];

    //============================================================
    // RELACIONAMENTOS
    //============================================================

    // DEFINE A RELAÇÃO DE UM-PARA-UM COM FUNCIONARIO.
    public function funcionario()
    {
        // UM USUÁRIO TEM UM FUNCIONÁRIO ASSOCIADO.
        return $this->hasOne(Funcionario::class, 'id_usuario', 'id_usuario');
    }

    // DEFINE A RELAÇÃO DE UM-PARA-MUITOS COM RELATORIO.
    public function relatorios()
    {
        // UM USUÁRIO PODE GERAR VÁRIOS RELATÓRIOS.
        return $this->hasMany(Relatorio::class, 'id_usuario', 'id_usuario');
    }
}