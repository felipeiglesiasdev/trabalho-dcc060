@extends('layouts.dashboard')

@section('content')
<div class="content-header">
    <h1 class="content-title">
        <i class="bi bi-{{ isset($categoria) ? 'pencil' : 'plus-circle' }}"></i>
        {{ isset($categoria) ? 'Editar Categoria' : 'Cadastrar Nova Categoria' }}
    </h1>
    <p class="content-subtitle">
        {{ isset($categoria) ? 'Atualize as informações da categoria' : 'Adicione uma nova categoria ao sistema' }}
    </p>
</div>

<div class="content-body">
    @if ($errors->any())
        <div class="alert alert-danger">
            <i class="bi bi-exclamation-triangle"></i>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="form-container">
        <form action="{{ isset($categoria) ? route('categorias.update', $categoria) : route('categorias.store') }}" method="POST">
            @csrf
            @if(isset($categoria))
                @method('PUT')
            @endif

            <div class="form-row">
                    <div class="form-group">
                        <label for="nome">
                            <i class="bi bi-tag"></i>
                            Nome da Categoria
                        </label>
                        <div class="input-group">
                            <i class="bi bi-tag"></i>
                            <input type="text" id="nome" name="nome" value="{{ old('nome', $categoria->nome ?? '') }}" required placeholder="Digite o nome da categoria">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="marca">
                            <i class="bi bi-building"></i>
                            Marca
                        </label>
                        <div class="input-group">
                            <i class="bi bi-building"></i>
                            <input type="text" id="marca" name="marca" value="{{ old('marca', $categoria->marca ?? '') }}" required placeholder="Digite a marca">
                        </div>
                    </div>

                    <div class="form-actions">
                        <button type="submit" class="btn btn-success">
                            <i class="bi {{ isset($categoria) ? 'bi-check-circle' : 'bi-save' }}"></i>
                            {{ isset($categoria) ? 'Atualizar' : 'Salvar' }}
                        </button>
                        <a href="{{ route('categorias.index') }}" class="btn btn-secondary">
                            <i class="bi bi-arrow-left"></i>
                            Voltar à Lista
                        </a>
                    </div>
            </div>
    </div>



    
</div>
@endsection