<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cliente; // IMPORTANDO O MODEL DE CLIENTE
use Illuminate\Support\Str;

class ClienteController extends Controller
{
    //============================================================
    // LISTAR TODOS OS CLIENTES (READ)
    //============================================================
    public function index()
    {
        // BUSCA TODOS OS CLIENTES NO BANCO DE DADOS.
        $clientes = Cliente::all();

        // RETORNA A VIEW 'INDEX' DENTRO DA PASTA 'CLIENTES', PASSANDO A LISTA DE CLIENTES.
        return view('clientes.index', compact('clientes'));
    }

    //============================================================
    // MOSTRAR FORMULÁRIO DE CRIAÇÃO (CREATE)
    //============================================================
    public function create()
    {
        // RETORNA A VIEW COM O FORMULÁRIO PARA CRIAR UM NOVO CLIENTE.
        return view('clientes.form');
    }

    //============================================================
    // ARMAZENAR NOVO CLIENTE (CREATE)
    //============================================================
    public function store(Request $request)
    {
        // VALIDAÇÃO DOS DADOS DO FORMULÁRIO.
        $request->validate([
            'nome' => 'required|string|max:30',
            'cpf' => 'required|string|max:11|unique:cliente,cpf',
        ]);

        //============================================================
            // LÓGICA PARA GERAR UM ID NUMÉRICO ÚNICO
            //============================================================
            $idCliente = null;
            do {
                // GERA UM NÚMERO ALEATÓRIO DE 0 A 9999 E PREENCHE COM ZEROS À ESQUERDA PARA TER 4 DÍGITOS.
                $idCliente = str_pad(random_int(0, 9999), 4, '0', STR_PAD_LEFT);
            } while (Cliente::find($idCliente)); // VERIFICA SE O ID JÁ EXISTE NO BANCO.

        // CRIA O NOVO CLIENTE NO BANCO.
        Cliente::create([
            'id_cliente' => $idCliente, // GERA UM ID ALEATÓRIO.
            'nome' => $request->nome,
            'cpf' => $request->cpf,
        ]);

        // REDIRECIONA DE VOLTA PARA A LISTA DE CLIENTES COM UMA MENSAGEM DE SUCESSO.
        return redirect()->route('clientes.index')->with('success', 'Cliente cadastrado com sucesso!');
    }

    //============================================================
    // MOSTRAR FORMULÁRIO DE EDIÇÃO (UPDATE)
    //============================================================
    public function edit(Cliente $cliente)
    {
        // O LARAVEL JÁ ENCONTRA O CLIENTE PELO ID NA ROTA (ROUTE MODEL BINDING).
        // RETORNA A VIEW DO FORMULÁRIO, PASSANDO O CLIENTE QUE SERÁ EDITADO.
        return view('clientes.form', compact('cliente'));
    }

    //============================================================
    // ATUALIZAR CLIENTE (UPDATE)
    //============================================================
    public function update(Request $request, Cliente $cliente)
    {
        // VALIDAÇÃO DOS DADOS. O CPF SÓ PRECISA SER ÚNICO SE FOR DIFERENTE DO ATUAL.
        $request->validate([
            'nome' => 'required|string|max:30',
            'cpf' => 'required|string|max:11|unique:cliente,cpf,' . $cliente->id_cliente . ',id_cliente',
        ]);

        // ATUALIZA OS DADOS DO CLIENTE NO BANCO.
        $cliente->update($request->all());

        // REDIRECIONA DE VOLTA PARA A LISTA COM MENSAGEM DE SUCESSO.
        return redirect()->route('clientes.index')->with('success', 'Cliente atualizado com sucesso!');
    }

    //============================================================
    // EXCLUIR CLIENTE (DELETE)
    //============================================================
    public function destroy(Cliente $cliente)
    {
        // EXCLUI O CLIENTE DO BANCO DE DADOS.
        $cliente->delete();

        // REDIRECIONA DE VOLTA PARA A LISTA COM MENSAGEM DE SUCESSO.
        return redirect()->route('clientes.index')->with('success', 'Cliente excluído com sucesso!');
    }
}