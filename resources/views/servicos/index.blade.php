@extends("layouts.dashboard")

@section("content")
<div class="content-header">
    <h1 class="content-title">
        <i class="bi bi-tools"></i>
        Gerenciar Serviços
    </h1>
    <p class="content-subtitle">
        Visualize, adicione, edite e remova serviços do sistema
    </p>
</div>

<div class="content-body">
    {{-- BOTÃO PARA ADICIONAR NOVO SERVIÇO --}}
    <div class="mb-3">
        <a href="{{ route("servicos.create") }}" class="btn btn-create">
            <i class="bi bi-plus-circle"></i>
            Adicionar Novo Serviço
        </a>
    </div>

    {{-- MOSTRA MENSAGEM DE SUCESSO --}}
    @if(session("success"))
        <div class="alert alert-success">
            <i class="bi bi-check-circle"></i>
            {{ session("success") }}
        </div>
    @endif

    {{-- MOSTRA MENSAGEM DE ERRO --}}
    @if(session("error"))
        <div class="alert alert-danger">
            <i class="bi bi-exclamation-triangle"></i>
            {{ session("error") }}
        </div>
    @endif

    {{-- TABELA DE SERVIÇOS --}}
    <div class="table-container">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h3 class="text-gradient mb-0">
                <i class="bi bi-table"></i>
                Lista de Serviços
            </h3>
            <span class="badge bg-primary">
                {{ $servicos->count() }} {{ $servicos->count() === 1 ? "serviço" : "serviços" }}
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
                        Tipo
                    </th>
                    <th>
                        <i class="bi bi-card-text"></i>
                        Nome
                    </th>
                    <th>
                        <i class="bi bi-currency-dollar"></i>
                        Valor
                    </th>
                    <th>
                        <i class="bi bi-gear"></i>
                        Ações
                    </th>
                </tr>
            </thead>
            <tbody>
                @forelse ($servicos as $servico)
                    <tr>
                        <td>
                            <span class="badge bg-secondary">{{ $servico->id_servico }}</span>
                        </td>
                        <td>
                            <strong>{{ $servico->tipo }}</strong>
                        </td>
                        <td>
                            <span class="text-muted">{{ $servico->nome }}</span>
                        </td>
                        <td>
                            <span class="text-muted">R$ {{ number_format($servico->valor, 2, ",", ".") }}</span>
                        </td>
                        <td class="actions">
                            <a href="{{ route("servicos.edit", $servico) }}" class="btn btn-edit" title="Editar">
                                <i class="bi bi-pencil"></i>
                                Editar
                            </a>
                            <form action="{{ route("servicos.destroy", $servico) }}" method="POST" 
                                  onsubmit="return confirm("Tem certeza que deseja excluir o serviço \'{{ $servico->nome }}\'? Esta ação não pode ser desfeita.");" 
                                  style="display: inline;">
                                @csrf
                                @method("DELETE")
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
                                <p class="mt-2 text-muted">Nenhum serviço cadastrado.</p>
                                <a href="{{ route("servicos.create") }}" class="btn btn-create mt-2">
                                    <i class="bi bi-plus-circle"></i>
                                    Cadastrar Primeiro Serviço
                                </a>
                            </div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        {{-- PAGINAÇÃO (se necessário) --}}
        @if(method_exists($servicos, "links"))
            <div class="mt-3">
                {{ $servicos->links() }}
            </div>
        @endif
    </div>

  
</div>
@endsection