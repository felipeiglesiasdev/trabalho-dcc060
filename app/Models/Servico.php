<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Servico extends Model
{
    //============================================================
    // CONFIGURAÇÕES DO MODEL SERVICO
    //============================================================

    // INDICA AO LARAVEL O NOME EXATO DA TABELA NO BANCO.
    protected $table = 'servico';

    // AVISA QUE A CHAVE PRIMÁRIA É 'ID_SERVICO'.
    protected $primaryKey = 'id_servico';

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
        'id_servico',
        'tipo',
        'nome',
        'valor',
    ];

    //============================================================
    // RELACIONAMENTOS
    //============================================================

    // RELAÇÃO N-N COM ORDEM DE SERVIÇO.
    public function ordemServicos()
    {
        // UM SERVIÇO PODE ESTAR EM VÁRIAS ORDENS DE SERVIÇO.
        return $this->belongsToMany(OrdemServico::class, 'ordemServicoServico', 'id_servico', 'id_os');
    }

    // RELAÇÃO N-N COM ITEM DE SERVIÇO.
    public function itemServicos()
    {
        // UM SERVIÇO PODE CONTER VÁRIOS ITENS DE SERVIÇO.
        return $this->belongsToMany(ItemServico::class, 'servicoItemServico', 'id_servico', 'id_ItServ');
    }
}