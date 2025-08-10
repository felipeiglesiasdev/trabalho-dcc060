<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categoria; // IMPORTANDO O MODEL DE CATEGORIA
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class CategoriaController extends Controller
{
    //============================================================
    // LISTAR TODAS AS CATEGORIAS (READ)
    //============================================================
    public function index()
    {
        $categorias = Categoria::all();
        return view('categorias.index', compact('categorias'));
    }

    //============================================================
    // MOSTRAR FORMULÁRIO DE CRIAÇÃO (CREATE)
    //============================================================
    public function create()
    {
        return view('categorias.form');
    }

    //============================================================
    // ARMAZENAR NOVA CATEGORIA (CREATE)
    //============================================================
    public function store(Request $request)
    {
        $request->validate([
            'nome' => 'required|string|max:255',
            'marca' => 'required|string|max:255',
        ]);

        // GERA UM ID NUMÉRICO ÚNICO DE 4 DÍGITOS.
        $idCategoria = null;
        do {
            $idCategoria = str_pad(random_int(0, 9999), 4, '0', STR_PAD_LEFT);
        } while (Categoria::find($idCategoria));

        Categoria::create([
            'id_cat' => $idCategoria,
            'nome' => $request->nome,
            'marca' => $request->marca,
        ]);

        return redirect()->route('categorias.index')->with('success', 'Categoria cadastrada com sucesso!');
    }

    //============================================================
    // MOSTRAR FORMULÁRIO DE EDIÇÃO (UPDATE)
    //============================================================
    public function edit(Categoria $categoria)
    {
        return view('categorias.form', compact('categoria'));
    }

    //============================================================
    // ATUALIZAR CATEGORIA (UPDATE)
    //============================================================
    public function update(Request $request, Categoria $categoria)
    {
        $request->validate([
            'nome' => 'required|string|max:255',
            'marca' => 'required|string|max:255',
        ]);

        $categoria->update($request->all());

        return redirect()->route('categorias.index')->with('success', 'Categoria atualizada com sucesso!');
    }

    //============================================================
    // EXCLUIR CATEGORIA (DELETE)
    //============================================================
    public function destroy(Categoria $categoria)
    {
        // VERIFICA SE A CATEGORIA TEM PRODUTOS ASSOCIADOS.
        if ($categoria->produtos()->count() > 0) {
            // SE TIVER, RETORNA COM UMA MENSAGEM DE ERRO.
            return redirect()->route('categorias.index')->with('error', 'Não é possível excluir esta categoria, pois ela está associada a produtos.');
        }

        // SE NÃO TIVER, PODE EXCLUIR.
        $categoria->delete();

        return redirect()->route('categorias.index')->with('success', 'Categoria excluída com sucesso!');
    }
}