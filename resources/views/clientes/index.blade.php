@extends('layouts.dashboard')

@section('content')
    <h1>Gerenciar Clientes</h1>

    {{-- BOTÃO PARA ADICIONAR NOVO CLIENTE --}}
    <a href="{{ route('clientes.create') }}" class="btn-create">Adicionar Novo Cliente</a>

    {{-- MOSTRA MENSAGEM DE SUCESSO --}}
    @if(session('success'))
        <div class="alert-success">
            {{ session('success') }}
        </div>
    @endif

    {{-- TABELA PARA LISTAR OS CLIENTES --}}
    <table class="data-table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>CPF</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($clientes as $cliente)
                <tr>
                    <td>{{ $cliente->id_cliente }}</td>
                    <td>{{ $cliente->nome }}</td>
                    <td>{{ $cliente->cpf }}</td>
                    <td class="actions">
                        <a href="{{ route('clientes.edit', $cliente) }}" class="btn-edit">Editar</a>
                        <form action="{{ route('clientes.destroy', $cliente) }}" method="POST" onsubmit="return confirm('Tem certeza que deseja excluir este cliente?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn-delete">Excluir</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4">Nenhum cliente cadastrado.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
@endsection
