<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrdemServico extends Model
{
    //============================================================
    // CONFIGURAÇÕES DO MODEL OS
    //============================================================

    // INDICA AO LARAVEL O NOME EXATO DA TABELA NO BANCO.
    protected $table = 'ordemServico';

    // AVISA QUE A CHAVE PRIMÁRIA É 'ID_OS'.
    protected $primaryKey = 'id_os';

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
        'id_os',
        'nome',
        'tipo_serviço',
        'data_serviço',
        'status',
        'id_cliente',
        'id_funcionario',
    ];

    //============================================================
    // RELACIONAMENTOS
    //============================================================

    // RELAÇÃO N-1 INVERSA COM CLIENTE.
    public function cliente()
    {
        // UMA ORDEM DE SERVIÇO É SOLICITADA POR UM CLIENTE.
        return $this->belongsTo(Cliente::class, 'id_cliente', 'id_cliente');
    }

    // RELAÇÃO N-1 INVERSA COM FUNCIONÁRIO.
    public function funcionario()
    {
        // UMA ORDEM DE SERVIÇO É ATRIBUÍDA A UM FUNCIONÁRIO.
        return $this->belongsTo(Funcionario::class, 'id_funcionario', 'id_usuario');
    }

    // RELAÇÃO 1-N COM RELATORIO.
    public function relatorios()
    {
        // UMA ORDEM DE SERVIÇO PODE TER VÁRIOS RELATÓRIOS.
        return $this->hasMany(Relatorio::class, 'id_os', 'id_os');
    }

    // RELAÇÃO N-N COM SERVICO.
    public function servicos()
    {
        // UMA ORDEM DE SERVIÇO PODE INCLUIR VÁRIOS SERVIÇOS.
        return $this->belongsToMany(Servico::class, 'ordemServicoServico', 'id_os', 'id_servico');
    }
}