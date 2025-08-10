@extends('layouts.dashboard')

@section('content')
    <h1>Gerenciar Serviços</h1>

    <a href="{{ route('servicos.create') }}" class="btn-create">Adicionar Novo Serviço</a>

    @if(session('success'))
        <div class="alert-success">
            {{ session('success') }}
        </div>
    @endif

    <table class="data-table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Tipo</th>
                <th>Nome</th>
                <th>Valor</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($servicos as $servico)
                <tr>
                    <td>{{ $servico->id_servico }}</td>
                    <td>{{ $servico->tipo }}</td>
                    <td>{{ $servico->nome }}</td>
                    <td>R$ {{ number_format($servico->valor, 2, ',', '.') }}</td>
                    <td class="actions">
                        <a href="{{ route('servicos.edit', $servico) }}" class="btn-edit">Editar</a>
                        <form action="{{ route('servicos.destroy', $servico) }}" method="POST" onsubmit="return confirm('Tem certeza que deseja excluir este serviço?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn-delete">Excluir</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5">Nenhum serviço cadastrado.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
@endsection