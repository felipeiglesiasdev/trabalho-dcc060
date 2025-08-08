@extends('layouts.dashboard')

@section('content')
    {{-- O TÍTULO MUDA SE ESTAMOS EDITANDO OU CRIANDO --}}
    <h1>{{ isset($cliente) ? 'Editar Cliente' : 'Cadastrar Novo Cliente' }}</h1>

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
    <form action="{{ isset($cliente) ? route('clientes.update', $cliente) : route('clientes.store') }}" method="POST">
        @csrf
        @if(isset($cliente))
            @method('PUT') {{-- MÉTODO PARA ATUALIZAÇÃO --}}
        @endif

        <div class="form-group">
            <label for="nome">Nome</label>
            <input type="text" id="nome" name="nome" value="{{ old('nome', $cliente->nome ?? '') }}" required>
        </div>

        <div class="form-group">
            <label for="cpf">CPF</label>
            <input type="text" id="cpf" name="cpf" value="{{ old('cpf', $cliente->cpf ?? '') }}" required>
        </div>

        <button type="submit" class="btn-save">{{ isset($cliente) ? 'Atualizar' : 'Salvar' }}</button>
    </form>
@endsection