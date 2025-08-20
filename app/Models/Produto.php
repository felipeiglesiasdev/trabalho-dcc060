<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Produto extends Model
{
    //============================================================
    // CONFIGURAÇÕES DO MODEL PRODUTO
    //============================================================

    // INDICA AO LARAVEL O NOME EXATO DA TABELA NO BANCO.
    protected $table = 'produto';

    // AVISA QUE A CHAVE PRIMÁRIA É 'ID_PRODUTO'.
    protected $primaryKey = 'id_produto';

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
        'id_produto',
        'nome',
        'id_cat',
    ];

    //============================================================
    // RELACIONAMENTOS
    //============================================================

    // RELAÇÃO N-1 INVERSA COM CATEGORIA.
    public function categoria()
    {
        // UM PRODUTO PERTENCE A UMA CATEGORIA.
        return $this->belongsTo(Categoria::class, 'id_cat', 'id_cat');
    }

    // RELAÇÃO N-N COM FORNECEDOR.
    public function fornecedores()
    {
        // UM PRODUTO PODE SER FORNECIDO POR VÁRIOS FORNECEDORES.
        return $this->belongsToMany(Fornecedor::class, 'fornece', 'id_produto', 'id_fornecedor');
    }

    // RELAÇÃO 1-1 COM ITEMVENDA.
    public function itemVenda()
    {
        // UM PRODUTO PODE SER UM ITEM DE VENDA.
        return $this->hasOne(ItemVenda::class, 'id_produto', 'id_produto');
    }

    // RELAÇÃO 1-1 COM ITEMSERVICO.
    public function itemServico()
    {
        // UM PRODUTO PODE SER UM ITEM DE SERVIÇO.
        return $this->hasOne(ItemServico::class, 'id_produto', 'id_produto');
    }
}