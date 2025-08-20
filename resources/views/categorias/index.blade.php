@extends('layouts.dashboard')

@section('content')
<div class="content-header">
    <h1 class="content-title">
        <i class="bi bi-grid-3x3-gap"></i>
        Gerenciar Categorias
    </h1>
    <p class="content-subtitle">
        Visualize, adicione, edite e remova categorias do sistema
    </p>
</div>

<div class="content-body">
    {{-- BOTÃO PARA ADICIONAR NOVA CATEGORIA --}}
    <div class="mb-3">
        <a href="{{ route('categorias.create') }}" class="btn btn-create">
            <i class="bi bi-plus-circle"></i>
            Adicionar Nova Categoria
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

    {{-- TABELA DE CATEGORIAS --}}
    <div class="table-container">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h3 class="text-gradient mb-0">
                <i class="bi bi-table"></i>
                Lista de Categorias
            </h3>
            <span class="badge bg-primary">
                {{ $categorias->count() }} {{ $categorias->count() === 1 ? 'categoria' : 'categorias' }}
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
                        <i class="bi bi-tag"></i>
                        Nome
                    </th>
                    <th>
                        <i class="bi bi-building"></i>
                        Marca
                    </th>
                    <th>
                        <i class="bi bi-gear"></i>
                        Ações
                    </th>
                </tr>
            </thead>
            <tbody>
                @forelse ($categorias as $categoria)
                    <tr>
                        <td>
                            <span class="badge bg-secondary">{{ $categoria->id_cat }}</span>
                        </td>
                        <td>
                            <strong>{{ $categoria->nome }}</strong>
                        </td>
                        <td>
                            <span class="text-muted">{{ $categoria->marca }}</span>
                        </td>
                        <td class="actions">
                            <a href="{{ route('categorias.edit', $categoria) }}" class="btn btn-edit" title="Editar">
                                <i class="bi bi-pencil"></i>
                                Editar
                            </a>
                            <form action="{{ route('categorias.destroy', $categoria) }}" method="POST" 
                                  onsubmit="return confirm('Tem certeza que deseja excluir a categoria \'{{ $categoria->nome }}\'? Esta ação não pode ser desfeita.');" 
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
                                <p class="mt-2 text-muted">Nenhuma categoria cadastrada.</p>
                                <a href="{{ route('categorias.create') }}" class="btn btn-create mt-2">
                                    <i class="bi bi-plus-circle"></i>
                                    Cadastrar Primeira Categoria
                                </a>
                            </div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        {{-- PAGINAÇÃO (se necessário) --}}
        @if(method_exists($categorias, 'links'))
            <div class="mt-3">
                {{ $categorias->links() }}
            </div>
        @endif
    </div>

    
</div>
@endsection