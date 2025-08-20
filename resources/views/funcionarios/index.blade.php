@extends('layouts.dashboard')

@section('content')
<div class="content-header">
    <h1 class="content-title">
        <i class="bi bi-truck"></i>
        Gerenciar Funcionário
    </h1>
    <p class="content-subtitle">
        Visualize, adicione, edite e remova Funcionário do sistema
    </p>
</div>

<div class="content-body">
    {{-- BOTÃO PARA ADICIONAR NOVO Funcionário --}}
    <div class="mb-3">
        <a href="{{ route('funcionarios.create') }}" class="btn btn-create">
            <i class="bi bi-plus-circle"></i>
            Adicionar Novo Funcionário
        </a>
    </div>

    {{-- MOSTRA MENSAGEM DE SUCESSO --}}
    @if(session('success'))
        <div class="alert alert-success">
            <i class="bi bi-check-circle"></i>
            {{ session('success') }}
        </div>
    @endif

    {{-- MOSTRA MENSAGEM DE ERRO --}}
    @if(session('error'))
        <div class="alert alert-danger">
            <i class="bi bi-exclamation-triangle"></i>
            {{ session('error') }}
        </div>
    @endif

    {{-- TABELA DE Funcionário --}}
    <div class="table-container">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h3 class="text-gradient mb-0">
                <i class="bi bi-table"></i>
                Lista de Funcionários
            </h3>
            <span class="badge bg-primary">
                {{ $funcionarios->count() }} {{ $funcionarios->count() === 1 ? 'funcionario' : 'funcionarios' }}
            </span>
        </div>

        <table class="data-table">
            <thead>
                <tr>
                    <th>
                        <i class="bi bi-hash"></i>
                        ID
                    </th>
                    <th>
                        <i class="bi bi-building"></i>
                        Nome
                    </th>
                    <th>
                        <i class="bi bi-envelope"></i>
                        Email
                    </th>
                    <th>
                        Especialidade
                    </th>
                    <th>
                        Salário
                    </th>
                    <th>
                        <i class="bi bi-gear"></i>
                        Ações
                    </th>
                </tr>
            </thead>
            <tbody>
                @forelse ($funcionarios as $funcionario)
                    <tr>
                        <td>
                            <span class="badge bg-secondary">{{ $funcionario->id_usuario }}</span>
                        </td>
                        <td>
                            <strong>{{ $funcionario->nome }}</strong>
                        </td>
                        <td>
                            <span class="text-muted">{{ $funcionario->email }}</span>
                        </td>
                        <td>
                            <span class="text-muted">{{ $funcionario->funcionario->especialidade ?? 'N/A' }}</span>
                        </td>
                        <td>
                            <span class="text-muted">{{ number_format($funcionario->funcionario->salario ?? 0, 2, ',', '.') }}</span>
                        </td>
                        <td class="actions">
                            <a href="{{ route('funcionarios.edit', $funcionario) }}" class="btn btn-edit" title="Editar">
                                <i class="bi bi-pencil"></i>
                                Editar
                            </a>
                            <form action="{{ route('funcionarios.destroy', $funcionario) }}" method="POST" 
                                  onsubmit="return confirm('Tem certeza que deseja excluir o funcionario \'{{ $funcionario->nome }}\'? Esta ação não pode ser desfeita.');" 
                                  style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-delete" title="Excluir">
                                    <i class="bi bi-trash"></i>
                                    Excluir
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center">
                            <div class="py-4">
                                <i class="bi bi-inbox" style="font-size: 3rem; color: var(--text-muted);"></i>
                                <p class="mt-2 text-muted">Nenhum funcionario cadastrado.</p>
                                <a href="{{ route('funcionario.create') }}" class="btn btn-create mt-2">
                                    <i class="bi bi-plus-circle"></i>
                                    Cadastrar Primeiro Funcionario
                                </a>
                            </div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>

    </div>

</div>
@endsection