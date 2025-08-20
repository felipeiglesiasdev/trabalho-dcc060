<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Fornecedor; // IMPORTANDO O MODEL DE FORNECEDOR
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class FornecedorController extends Controller
{
    //============================================================
    // LISTAR TODOS OS FORNECEDORES (READ)
    //============================================================
    public function index()
    {
        // BUSCA TODOS OS FORNECEDORES NO BANCO DE DADOS.
        $fornecedores = Fornecedor::all();

        // RETORNA A VIEW 'INDEX' DENTRO DA PASTA 'FORNECEDORES', PASSANDO A LISTA.
        return view('fornecedores.index', compact('fornecedores'));
    }

    //============================================================
    // MOSTRAR FORMULÁRIO DE CRIAÇÃO (CREATE)
    //============================================================
    public function create()
    {
        // RETORNA A VIEW COM O FORMULÁRIO PARA CRIAR UM NOVO FORNECEDOR.
        return view('fornecedores.form');
    }

    //============================================================
    // ARMAZENAR NOVO FORNECEDOR (CREATE)
    //============================================================
    public function store(Request $request)
    {
        // VALIDAÇÃO DOS DADOS DO FORMULÁRIO.
        $request->validate([
            'nome' => 'required|string|max:255',
            'cnpj' => 'required|string|max:15|unique:fornecedor,cnpj',
            'email' => 'required|string|email|max:255|unique:fornecedor,email',
        ]);

        //============================================================
        // LÓGICA PARA GERAR UM ID NUMÉRICO ÚNICO
        //============================================================
        $idForn = null;
        do {
            // GERA UM NÚMERO ALEATÓRIO DE 0 A 9999 E PREENCHE COM ZEROS À ESQUERDA PARA TER 4 DÍGITOS.
            $idForn = str_pad(random_int(0, 9999), 4, '0', STR_PAD_LEFT);
        } while (Fornecedor::find($idForn)); // VERIFICA SE O ID JÁ EXISTE NO BANCO.

        // CRIA O NOVO FORNECEDOR NO BANCO.
        Fornecedor::create([
            'id_forn' => $idForn, // GERA UM ID ALEATÓRIO.
            'nome' => $request->nome,
            'cnpj' => $request->cnpj,
            'email' => $request->email,
        ]);

        // REDIRECIONA DE VOLTA PARA A LISTA COM UMA MENSAGEM DE SUCESSO.
        return redirect()->route('fornecedores.index')->with('success', 'Fornecedor cadastrado com sucesso!');
    }

    //============================================================
    // MOSTRAR FORMULÁRIO DE EDIÇÃO (UPDATE)
    //============================================================
    public function edit(Fornecedor $fornecedor)
    {
        // RETORNA A VIEW DO FORMULÁRIO, PASSANDO O FORNECEDOR QUE SERÁ EDITADO.
        return view('fornecedores.form', compact('fornecedor'));
    }

    //============================================================
    // ATUALIZAR FORNECEDOR (UPDATE)
    //============================================================
    public function update(Request $request, Fornecedor $fornecedor)
    {
        // VALIDAÇÃO DOS DADOS.
        $request->validate([
            'nome' => 'required|string|max:255',
            'cnpj' => ['required', 'string', 'max:15', Rule::unique('fornecedor')->ignore($fornecedor->id_forn, 'id_forn')],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('fornecedor')->ignore($fornecedor->id_forn, 'id_forn')],
        ]);

        // ATUALIZA OS DADOS DO FORNECEDOR NO BANCO.
        $fornecedor->update($request->all());

        // REDIRECIONA DE VOLTA PARA A LISTA COM MENSAGEM DE SUCESSO.
        return redirect()->route('fornecedores.index')->with('success', 'Fornecedor atualizado com sucesso!');
    }

    //============================================================
    // EXCLUIR FORNECEDOR (DELETE)
    //============================================================
    public function destroy($id)
    {
        $fornecedor = Fornecedor::findOrFail($id);

        // Verifica se o fornecedor está na tabela "fornece"
        if ($fornecedor->produtos()->exists()) {
            return redirect()->back()->with('error', 'Não é possível excluir este fornecedor, pois ele fornece produtos.');
        }

        $fornecedor->delete();

        return redirect()->route('fornecedores.index')->with('success', 'Fornecedor excluído com sucesso.');
    }
}