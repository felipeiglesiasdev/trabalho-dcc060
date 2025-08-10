@extends('layouts.dashboard')

@section('content')
    <h1>Gerenciar Fornecedores</h1>

    {{-- BOTÃO PARA ADICIONAR NOVO FORNECEDOR --}}
    <a href="{{ route('fornecedores.create') }}" class="btn-create">Adicionar Novo Fornecedor</a>

    {{-- MOSTRA MENSAGEM DE SUCESSO --}}
    @if(session('success'))
        <div class="alert-success">
            {{ session('success') }}
        </div>
    @endif

    {{-- TABELA PARA LISTAR OS FORNECEDORES --}}
    <table class="data-table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>CNPJ</th>
                <th>Email</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($fornecedores as $fornecedor)
                <tr>
                    <td>{{ $fornecedor->id_forn }}</td>
                    <td>{{ $fornecedor->nome }}</td>
                    <td>{{ $fornecedor->cnpj }}</td>
                    <td>{{ $fornecedor->email }}</td>
                    <td class="actions">
                        <a href="{{ route('fornecedores.edit', $fornecedor) }}" class="btn-edit">Editar</a>
                        <form action="{{ route('fornecedores.destroy', $fornecedor) }}" method="POST" onsubmit="return confirm('Tem certeza que deseja excluir este fornecedor?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn-delete">Excluir</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5">Nenhum fornecedor cadastrado.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
@endsection
