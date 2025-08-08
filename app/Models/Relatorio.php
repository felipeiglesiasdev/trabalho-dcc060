<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Relatorio extends Model
{
    //============================================================
    // CONFIGURAÇÕES DO MODEL RELATÓRIO
    //============================================================

    // INDICA AO LARAVEL O NOME EXATO DA TABELA NO BANCO.
    protected $table = 'relatorio';

    // AVISA QUE A CHAVE PRIMÁRIA É 'ID_RELATORIO'.
    protected $primaryKey = 'id_relatorio';

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
        'id_relatorio',
        'descrição',
        'id_os',
        'id_usuario',
    ];

    //============================================================
    // RELACIONAMENTOS
    //============================================================

    // RELAÇÃO N-1 INVERSA COM ORDEM DE SERVIÇO.
    public function ordemServico()
    {
        // UM RELATÓRIO REFERE-SE A UMA ORDEM DE SERVIÇO.
        return $this->belongsTo(OrdemServico::class, 'id_os', 'id_os');
    }

    // RELAÇÃO N-1 INVERSA COM USUÁRIO.
    public function usuario()
    {
        // UM RELATÓRIO É GERADO POR UM USUÁRIO.
        return $this->belongsTo(Usuario::class, 'id_usuario', 'id_usuario');
    }
}