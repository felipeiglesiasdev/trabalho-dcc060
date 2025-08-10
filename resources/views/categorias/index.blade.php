@extends('layouts.dashboard')

@section('content')
    <h1>Gerenciar Categorias</h1>

    <a href="{{ route('categorias.create') }}" class="btn-create">Adicionar Nova Categoria</a>

    {{-- MOSTRA MENSAGEM DE SUCESSO --}}
    @if(session('success'))
        <div class="alert-success">
            {{ session('success') }}
        </div>
    @endif

    {{-- MOSTRA MENSAGEM DE ERRO --}}
    @if(session('error'))
        <div class="alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <table class="data-table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Marca</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($categorias as $categoria)
                <tr>
                    <td>{{ $categoria->id_cat }}</td>
                    <td>{{ $categoria->nome }}</td>
                    <td>{{ $categoria->marca }}</td>
                    <td class="actions">
                        <a href="{{ route('categorias.edit', $categoria) }}" class="btn-edit">Editar</a>
                        <form action="{{ route('categorias.destroy', $categoria) }}" method="POST" onsubmit="return confirm('Tem certeza que deseja excluir esta categoria?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn-delete">Excluir</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4">Nenhuma categoria cadastrada.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
@endsection
