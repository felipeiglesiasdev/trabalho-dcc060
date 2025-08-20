@extends('layouts.dashboard')

@section('content')
<div class="content-header">
    <h1 class="content-title">
        <i class="bi {{ isset($cliente) ? 'bi-pencil' : 'bi-plus-circle' }}"></i>
        {{ isset($fornecedor) ? 'Editar Fornecedor' : 'Cadastrar Novo Fornecedor' }}
    </h1>
    <p class="content-subtitle">
        {{ isset($fornecedor) ? 'Atualize as informações do fornecedor' : 'Preencha os dados para cadastrar um novo fornecedor' }}
    </p>
</div>

    {{-- MOSTRA ERROS DE VALIDAÇÃO --}}
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
    {{-- O FORMULÁRIO APONTA PARA A ROTA DE UPDATE OU STORE --}}
    <form action="{{ isset($fornecedor) ? route('fornecedores.update', $fornecedor) : route('fornecedores.store') }}" method="POST">
        @csrf
        @if(isset($fornecedor))
            @method('PUT') {{-- MÉTODO PARA ATUALIZAÇÃO --}}
        @endif

        <div class="form-group">
            <label for="nome"><i class="bi bi-person"></i>Nome</label>
            <div class="input-group">
                    <i class="bi bi-file-earmark-fill"></i>
                    <input type="text" id="nome" name="nome" value="{{ old('nome', $fornecedor->nome ?? '') }}" required placeholder="Digite o nome completo">
            </div>
        </div>

        <div class="form-group">
            <label for="cnpj"><i class="bi bi-file-earmark-fill"></i>CNPJ</label>
            <div class="input-group">
                    <i class="bi bi-person"></i>
                    <input type="text" id="cnpj" name="cnpj" value="{{ old('cnpj', $fornecedor->cnpj ?? '') }}" required placeholder="99.999.999/9999-99">
            </div>
        </div>

        <div class="form-group">
            <label for="email"><i class="bi bi-envelope"></i>Email</label>
            <div class="input-group">
                    <i class="bi bi-envelope"></i>
                    <input type="email" id="email" name="email" value="{{ old('email', $fornecedor->email ?? '') }}" required placeholder="email@email.com">
            </div>
        </div>


        <button type="submit" class="btn btn-success">
                    <i class="bi {{ isset($fornecedor) ? 'bi-check-circle' : 'bi-save' }}"></i>
                    {{ isset($fornecedor) ? 'Atualizar' : 'Salvar' }}
        </button>
        <a href="{{ route('fornecedores.index') }}" class="btn btn-secondary">
                    <i class="bi bi-arrow-left"></i>
                    Voltar à Lista
                </a>
    </form>
</dvi></dvi>
@endsection
