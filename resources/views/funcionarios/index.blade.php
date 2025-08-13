@extends('layouts.dashboard')

@section('content')
    <h1>Gerenciar Funcionários</h1>

    <a href="{{ route('funcionarios.create') }}" class="btn-create">Adicionar Novo Funcionário</a>

    {{-- MOSTRA MENSAGEM DE SUCESSO --}}
    @if(session('success'))
        <div class="alert-success">
            {{ session('success') }}
        </div>
    @endif

    {{-- ============================================================ --}}
    {{-- CÓDIGO ADICIONADO PARA MOSTRAR A MENSAGEM DE ERRO          --}}
    {{-- ============================================================ --}}
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
                <th>Email</th>
                <th>Especialidade</th>
                <th>Salário</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($funcionarios as $funcionario)
                <tr>
                    <td>{{ $funcionario->id_usuario }}</td>
                    <td>{{ $funcionario->nome }}</td>
                    <td>{{ $funcionario->email }}</td>
                    {{-- USAMOS O '?' PARA EVITAR ERRO SE O FUNCIONÁRIO AINDA NÃO TIVER DADOS --}}
                    <td>{{ $funcionario->funcionario->especialidade ?? 'N/A' }}</td>
                    <td>R$ {{ number_format($funcionario->funcionario->salario ?? 0, 2, ',', '.') }}</td>
                    <td class="actions">
                        <a href="{{ route('funcionarios.edit', $funcionario) }}" class="btn-edit">Editar</a>
                        <form action="{{ route('funcionarios.destroy', $funcionario) }}" method="POST" onsubmit="return confirm('Tem certeza que deseja excluir este funcionário?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn-delete">Excluir</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6">Nenhum funcionário cadastrado.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
@endsection
