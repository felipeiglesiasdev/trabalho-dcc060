@extends('layouts.dashboard')

@section('content')
    {{-- O TÍTULO MUDA SE ESTAMOS EDITANDO OU CRIANDO --}}
    <h1>{{ isset($fornecedor) ? 'Editar Fornecedor' : 'Cadastrar Novo Fornecedor' }}</h1>

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

    {{-- O FORMULÁRIO APONTA PARA A ROTA DE UPDATE OU STORE --}}
    <form action="{{ isset($fornecedor) ? route('fornecedores.update', $fornecedor) : route('fornecedores.store') }}" method="POST">
        @csrf
        @if(isset($fornecedor))
            @method('PUT') {{-- MÉTODO PARA ATUALIZAÇÃO --}}
        @endif

        <div class="form-group">
            <label for="nome">Nome</label>
            <input type="text" id="nome" name="nome" value="{{ old('nome', $fornecedor->nome ?? '') }}" required>
        </div>

        <div class="form-group">
            <label for="cnpj">CNPJ</label>
            <input type="text" id="cnpj" name="cnpj" value="{{ old('cnpj', $fornecedor->cnpj ?? '') }}" required>
        </div>

        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" id="email" name="email" value="{{ old('email', $fornecedor->email ?? '') }}" required>
        </div>

        <button type="submit" class="btn-save">{{ isset($fornecedor) ? 'Atualizar' : 'Salvar' }}</button>
    </form>
@endsection
