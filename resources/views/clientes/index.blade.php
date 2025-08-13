@extends('layouts.dashboard')

@section('content')
<div class="content-header">
    <h1 class="content-title">
        <i class="bi bi-people-fill"></i>
        Gerenciar Clientes
    </h1>
    <p class="content-subtitle">
        Visualize, adicione, edite e remova clientes do sistema
    </p>
</div>

<div class="content-body">
    {{-- BOTÃO PARA ADICIONAR NOVO CLIENTE --}}
    <div class="mb-3">
        <a href="{{ route('clientes.create') }}" class="btn btn-create">
            <i class="bi bi-plus-circle"></i>
            Adicionar Novo Cliente
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

    {{-- TABELA DE CLIENTES --}}
    <div class="table-container">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h3 class="text-gradient mb-0">
                <i class="bi bi-table"></i>
                Lista de Clientes
            </h3>
            <span class="badge bg-primary">
                {{ $clientes->count() }} {{ $clientes->count() === 1 ? 'cliente' : 'clientes' }}
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
                        <i class="bi bi-person"></i>
                        Nome
                    </th>
                    <th>
                        <i class="bi bi-person-vcard"></i>
                        CPF
                    </th>
                    <th>
                        <i class="bi bi-gear"></i>
                        Ações
                    </th>
                </tr>
            </thead>
            <tbody>
                @forelse ($clientes as $cliente)
                    <tr>
                        <td>
                            <span class="badge bg-secondary">{{ $cliente->id_cliente }}</span>
                        </td>
                        <td>
                            <strong>{{ $cliente->nome }}</strong>
                        </td>
                        <td>
                            <span class="text-muted">{{ $cliente->cpf }}</span>
                        </td>
                        <td class="actions">
                            <a href="{{ route('clientes.edit', $cliente) }}" class="btn btn-edit" title="Editar">
                                <i class="bi bi-pencil"></i>
                                Editar
                            </a>
                            <form action="{{ route('clientes.destroy', $cliente) }}" method="POST" 
                                  onsubmit="return confirm('Tem certeza que deseja excluir o cliente \'{{ $cliente->nome }}\'? Esta ação não pode ser desfeita.');" 
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
                        <td colspan="4" class="text-center">
                            <div class="py-4">
                                <i class="bi bi-inbox" style="font-size: 3rem; color: var(--text-muted);"></i>
                                <p class="mt-2 text-muted">Nenhum cliente cadastrado.</p>
                                <a href="{{ route('clientes.create') }}" class="btn btn-create mt-2">
                                    <i class="bi bi-plus-circle"></i>
                                    Cadastrar Primeiro Cliente
                                </a>
                            </div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        {{-- PAGINAÇÃO (se necessário) --}}
        @if(method_exists($clientes, 'links'))
            <div class="mt-3">
                {{ $clientes->links() }}
            </div>
        @endif
    </div>

    {{-- ESTATÍSTICAS RÁPIDAS --}}
    <div class="row mt-4">
        <div class="col-md-4">
            <div class="dashboard-card text-center">
                <i class="bi bi-people-fill" style="font-size: 2rem; color: var(--primary-color);"></i>
                <h4 class="mt-2">{{ $clientes->count() }}</h4>
                <p class="text-muted">Total de Clientes</p>
            </div>
        </div>
        <div class="col-md-4">
            <div class="dashboard-card text-center">
                <i class="bi bi-person-plus" style="font-size: 2rem; color: var(--accent-color);"></i>
                <h4 class="mt-2">0</h4>
                <p class="text-muted">Novos Clientes (Mês)</p>
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
