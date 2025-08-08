<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    //============================================================
    // CONFIGURAÇÕES DO MODEL CLIENTE
    //============================================================

    // INDICA AO LARAVEL O NOME EXATO DA TABELA NO BANCO.
    protected $table = 'cliente';

    // AVISA QUE A CHAVE PRIMÁRIA É 'ID_CLIENTE'.
    protected $primaryKey = 'id_cliente';

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
        'id_cliente',
        'nome',
        'cpf',
    ];

    //============================================================
    // RELACIONAMENTOS
    //============================================================

    // RELAÇÃO 1-N COM ORDEM DE SERVIÇO.
    public function ordemServicos()
    {
        // UM CLIENTE PODE SOLICITAR VÁRIAS ORDENS DE SERVIÇO.
        return $this->hasMany(OrdemServico::class, 'id_cliente', 'id_cliente');
    }

    // RELAÇÃO 1-N COM VENDA.
    public function vendas()
    {
        // UMA VENDA É FEITA PARA UM CLIENTE.
        return $this->hasMany(Venda::class, 'id_cliente', 'id_cliente');
    }
}