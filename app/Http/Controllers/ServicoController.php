<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Servico; // IMPORTANDO O MODEL DE SERVICO
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;

class ServicoController extends Controller
{
    //============================================================
    // LISTAR TODOS OS SERVIÇOS (READ)
    //============================================================
    public function index()
    {
        // BUSCA TODOS OS SERVIÇOS NO BANCO DE DADOS.
        $servicos = Servico::all();

        // RETORNA A VIEW 'INDEX' DENTRO DA PASTA 'SERVICOS', PASSANDO A LISTA.
        return view('servicos.index', compact('servicos'));
    }

    //============================================================
    // MOSTRAR FORMULÁRIO DE CRIAÇÃO (CREATE)
    //============================================================
    public function create()
    {
        // RETORNA A VIEW COM O FORMULÁRIO PARA CRIAR UM NOVO SERVIÇO.
        return view('servicos.form');
    }

    //============================================================
    // ARMAZENAR NOVO SERVIÇO (CREATE)
    //============================================================
    public function store(Request $request)
    {
        // VALIDAÇÃO DOS DADOS DO FORMULÁRIO.
        $request->validate([
            'tipo' => 'required|string|max:255',
            'nome' => 'required|string|max:255',
            'valor' => 'required|numeric|min:0',
        ]);

        // GERA UM ID NUMÉRICO ÚNICO DE 4 DÍGITOS.
        $idServico = null;
        do {
            $idServico = str_pad(random_int(0, 9999), 4, '0', STR_PAD_LEFT);
        } while (Servico::find($idServico));

        // CRIA O NOVO SERVIÇO NO BANCO.
        Servico::create([
            'id_servico' => $idServico,
            'tipo' => $request->tipo,
            'nome' => $request->nome,
            'valor' => $request->valor,
        ]);

        // REDIRECIONA DE VOLTA PARA A LISTA COM UMA MENSAGEM DE SUCESSO.
        return redirect()->route('servicos.index')->with('success', 'Serviço cadastrado com sucesso!');
    }

    //============================================================
    // MOSTRAR FORMULÁRIO DE EDIÇÃO (UPDATE)
    //============================================================
    public function edit(Servico $servico)
    {
        // O LARAVEL JÁ ENCONTRA O SERVIÇO PELO ID NA ROTA.
        return view('servicos.form', compact('servico'));
    }

    //============================================================
    // ATUALIZAR SERVIÇO (UPDATE)
    //============================================================
    public function update(Request $request, Servico $servico)
    {
        // VALIDAÇÃO DOS DADOS.
        $request->validate([
            'tipo' => 'required|string|max:255',
            'nome' => 'required|string|max:255',
            'valor' => 'required|numeric|min:0',
        ]);

        // ATUALIZA OS DADOS DO SERVIÇO NO BANCO.
        $servico->update($request->all());

        // REDIRECIONA DE VOLTA PARA A LISTA COM MENSAGEM DE SUCESSO.
        return redirect()->route('servicos.index')->with('success', 'Serviço atualizado com sucesso!');
    }

    //============================================================
    // EXCLUIR SERVIÇO (DELETE)
    //============================================================
    public function destroy(Servico $servico)
    {
        // USA UMA TRANSAÇÃO PARA GARANTIR A INTEGRIDADE.
        DB::transaction(function () use ($servico) {
            // REMOVE AS LIGAÇÕES COM ORDEM DE SERVIÇO E ITEM DE SERVIÇO.
            $servico->ordemServicos()->detach();
            $servico->itemServicos()->detach();

            // AGORA PODE EXCLUIR O SERVIÇO COM SEGURANÇA.
            $servico->delete();
        });

        // REDIRECIONA DE VOLTA PARA A LISTA COM MENSAGEM DE SUCESSO.
        return redirect()->route('servicos.index')->with('success', 'Serviço excluído com sucesso!');
    }
}