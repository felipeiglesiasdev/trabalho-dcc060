<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Venda extends Model
{
    //============================================================
    // CONFIGURAÇÕES DO MODEL VENDA
    //============================================================

    // INDICA AO LARAVEL O NOME EXATO DA TABELA NO BANCO.
    protected $table = 'venda';

    // AVISA QUE A CHAVE PRIMÁRIA É 'ID_VENDA'.
    protected $primaryKey = 'id_venda';

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
        'id_venda',
        'nome',
        'valor',
        'id_cliente',
        'id_funcionario',
    ];

    //============================================================
    // RELACIONAMENTOS
    //============================================================

    // RELAÇÃO N-1 INVERSA COM CLIENTE.
    public function cliente()
    {
        // UMA VENDA PERTENCE A UM CLIENTE.
        return $this->belongsTo(Cliente::class, 'id_cliente', 'id_cliente');
    }

    // RELAÇÃO N-1 INVERSA COM FUNCIONÁRIO.
    public function funcionario()
    {
        // UMA VENDA É REALIZADA POR UM FUNCIONÁRIO.
        return $this->belongsTo(Funcionario::class, 'id_funcionario', 'id_usuario');
    }

    // RELAÇÃO N-N COM ITEMVENDA.
    public function itensVenda()
    {
        // UMA VENDA PODE CONTER VÁRIOS ITENS DE VENDA.
        return $this->belongsToMany(ItemVenda::class, 'vendaItemVenda', 'id_venda', 'id_ItVenda');
    }
}