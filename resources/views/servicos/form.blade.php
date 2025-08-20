@extends('layouts.dashboard')

@section('content')
<div class="content-header">
    <h1 class="content-title">
        <i class="bi bi-person-gear"></i>
        {{ isset($servico) ? 'Editar Serviço' : 'Cadastrar Novo Serviço' }}
    </h1>
    <p class="content-subtitle">
        {{ isset($servico) ? 'Atualize as informações do serviço' : 'Preencha os dados para cadastrar um novo serviço' }}
    </p>
</div>

    @if ($errors->any())
        <div class="alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
<div class="content-body">
<div class="form-container">
    <form action="{{ isset($servico) ? route('servicos.update', $servico) : route('servicos.store') }}" method="POST">
        @csrf
        @if(isset($servico))
            @method('PUT')
        @endif

            <div class="form-group">
                <label for="tipo"><i class="bi bi-card-text"></i>Tipo</label>
                <div class="input-group">
                    <i class="bi bi-card-text"></i>
                    <input type="text" id="tipo" name="tipo" value="{{ old('tipo', $servico->tipo ?? '') }}" required placeholder="Digite o tipo">
                </div>
            </div>

            <div class="form-group">
                <label for="nome"><i class="bi bi-bookmark"></i></i>Nome do Serviço</label>
                <div class="input-group">
                    <i class="bi bi-bookmark"></i>
                    <input type="text" id="nome" name="nome" value="{{ old('nome', $servico->nome ?? '') }}" required placeholder="Digite o nome do serviço">
                </div>
            </div>

            <div class="form-group">
                <label for="valor"><i class="bi bi-cash"></i></i>Valor</label>
                <div class="input-group">
                    <i class="bi bi-cash"></i>
                    <input type="number" step="0.01" id="valor" name="valor" value="{{ old('valor', $servico->valor ?? '') }}" required placeholder="Digite o preço">
                </div>
            </div>

        <div class="form-actions">
                <button type="submit" class="btn btn-success">
                    <i class="bi {{ isset($servico) ? 'bi-check-circle' : 'bi-save' }}"></i>
                    {{ isset($servico) ? 'Atualizar' : 'Salvar' }}
                </button>
                <a href="{{ route('servicos.index') }}" class="btn btn-secondary">
                    <i class="bi bi-arrow-left"></i>
                    Voltar à Lista
                </a>
            </div>
        </form>
    </form>
</div></div>
@endsection
