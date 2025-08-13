@extends('layouts.dashboard')

@section('content')
<div class="content-header">
    <h1 class="content-title">
        <i class="bi bi-truck"></i>
        Gerenciar Fornecedores
    </h1>
    <p class="content-subtitle">
        Visualize, adicione, edite e remova fornecedores do sistema
    </p>
</div>

<div class="content-body">
    {{-- BOTÃO PARA ADICIONAR NOVO FORNECEDOR --}}
    <div class="mb-3">
        <a href="{{ route('fornecedores.create') }}" class="btn btn-create">
            <i class="bi bi-plus-circle"></i>
            Adicionar Novo Fornecedor
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

    {{-- TABELA DE FORNECEDORES --}}
    <div class="table-container">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h3 class="text-gradient mb-0">
                <i class="bi bi-table"></i>
                Lista de Fornecedores
            </h3>
            <span class="badge bg-primary">
                {{ $fornecedores->count() }} {{ $fornecedores->count() === 1 ? 'fornecedor' : 'fornecedores' }}
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
                        <i class="bi bi-card-text"></i>
                        CNPJ
                    </th>
                    <th>
                        <i class="bi bi-envelope"></i>
                        Email
                    </th>
                    <th>
                        <i class="bi bi-gear"></i>
                        Ações
                    </th>
                </tr>
            </thead>
            <tbody>
                @forelse ($fornecedores as $fornecedor)
                    <tr>
                        <td>
                            <span class="badge bg-secondary">{{ $fornecedor->id_forn }}</span>
                        </td>
                        <td>
                            <strong>{{ $fornecedor->nome }}</strong>
                        </td>
                        <td>
                            <span class="text-muted">{{ $fornecedor->cnpj }}</span>
                        </td>
                        <td>
                            <span class="text-muted">{{ $fornecedor->email }}</span>
                        </td>
                        <td class="actions">
                            <a href="{{ route('fornecedores.edit', $fornecedor) }}" class="btn btn-edit" title="Editar">
                                <i class="bi bi-pencil"></i>
                                Editar
                            </a>
                            <form action="{{ route('fornecedores.destroy', $fornecedor) }}" method="POST" 
                                  onsubmit="return confirm('Tem certeza que deseja excluir o fornecedor \'{{ $fornecedor->nome }}\'? Esta ação não pode ser desfeita.');" 
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
                                <p class="mt-2 text-muted">Nenhum fornecedor cadastrado.</p>
                                <a href="{{ route('fornecedores.create') }}" class="btn btn-create mt-2">
                                    <i class="bi bi-plus-circle"></i>
                                    Cadastrar Primeiro Fornecedor
                                </a>
                            </div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        {{-- PAGINAÇÃO (se necessário) --}}
        @if(method_exists($fornecedores, 'links'))
            <div class="mt-3">
                {{ $fornecedores->links() }}
            </div>
        @endif
    </div>

    {{-- ESTATÍSTICAS RÁPIDAS --}}
    <div class="row mt-4">
        <div class="col-md-4">
            <div class="dashboard-card text-center">
                <i class="bi bi-truck" style="font-size: 2rem; color: var(--primary-color);"></i>
                <h4 class="mt-2">{{ $fornecedores->count() }}</h4>
                <p class="text-muted">Total de Fornecedores</p>
            </div>
        </div>
        <div class="col-md-4">
            <div class="dashboard-card text-center">
                <i class="bi bi-building-add" style="font-size: 2rem; color: var(--accent-color);"></i>
                <h4 class="mt-2">0</h4>
                <p class="text-muted">Novos Fornecedores (Mês)</p>
            </div>
        </div>
        <div class="col-md-4">
            <div class="dashboard-card text-center">
                <i class="bi bi-clock-history" style="font-size: 2rem; color: var(--success-color);"></i>
                <h4 class="mt-2">Hoje</h4>
                <p class="text-muted">Última Atualização</p>
            </div>
        </div>
    </div>
</div>
@endsection