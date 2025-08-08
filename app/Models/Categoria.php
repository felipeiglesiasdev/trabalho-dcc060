<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    //============================================================
    // CONFIGURAÇÕES DO MODEL CATEGORIA
    //============================================================

    // INDICA AO LARAVEL O NOME EXATO DA TABELA NO BANCO.
    protected $table = 'categoria';

    // AVISA QUE A CHAVE PRIMÁRIA É 'id_cat'.
    protected $primaryKey = 'id_cat';

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
        'id_cat',
        'nome',
        'marca',
    ];

    //============================================================
    // RELACIONAMENTOS
    //============================================================

    // RELAÇÃO 1-N COM PRODUTO.
    public function produtos()
    {
        // UMA CATEGORIA PODE CONTER VÁRIOS PRODUTOS.
        return $this->hasMany(Produto::class, 'id_cat', 'id_cat');
    }
}