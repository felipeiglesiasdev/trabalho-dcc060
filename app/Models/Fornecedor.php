<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Fornecedor extends Model
{
    //============================================================
    // CONFIGURAÇÕES DO MODEL FORNECEDOR
    //============================================================

    // INDICA AO LARAVEL O NOME EXATO DA TABELA NO BANCO.
    protected $table = 'fornecedor';

    // AVISA QUE A CHAVE PRIMÁRIA É 'ID_FORNECEDOR'.
    protected $primaryKey = 'id_forn';

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
        'id_forn',
        'nome',
        'cnpj',
        'email',
    ];

    //============================================================
    // RELACIONAMENTOS
    //============================================================

    // RELAÇÃO N-N COM PRODUTO.
    public function produtos()
    {
        // UM FORNECEDOR PODE FORNECER VÁRIOS PRODUTOS.
        return $this->belongsToMany(Produto::class, 'fornece', 'id_forn', 'id_produto');
    }
}
