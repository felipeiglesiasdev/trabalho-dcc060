<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ItemServico extends Model
{
    //============================================================
    // CONFIGURAÇÕES DO MODEL
    //============================================================

    // INDICA AO LARAVEL O NOME EXATO DA TABELA NO BANCO.
    protected $table = 'itemServico';

    // AVISA QUE A CHAVE PRIMÁRIA É 'ID_P'.
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
    ];

    //============================================================
    // RELACIONAMENTOS
    //============================================================

    // RELAÇÃO 1-1 INVERSA COM PRODUTO.
    public function produto()
    {
        // UM ITEM DE SERVIÇO É UM PRODUTO.
        return $this->belongsTo(Produto::class, 'id_produto', 'id_produto');
    }

    // RELAÇÃO N-N COM SERVIÇO.
    public function servicos()
    {
        // UM ITEM DE SERVIÇO PODE ESTAR EM VÁRIOS SERVIÇOS.
        return $this->belongsToMany(Servico::class, 'servicoItemServico', 'id_ItServ', 'id_Serv');
    }
}