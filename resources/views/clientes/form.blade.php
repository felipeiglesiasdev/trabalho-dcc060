@extends('layouts.dashboard')

@section('content')
    <div class="form-header">
        {{-- O TÍTULO E ÍCONE MUDAM SE ESTAMOS EDITANDO OU CRIANDO --}}
        <h1>
            <i class="bi {{ isset($cliente) ? 'bi-pencil' : 'bi-plus-circle' }}"></i>
            {{ isset($cliente) ? 'Editar Cliente' : 'Cadastrar Novo Cliente' }}
        </h1>
    </div>

    {{-- MOSTRA ERROS DE VALIDAÇÃO --}}
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="form-container">
        {{-- O FORMULÁRIO APONTA PARA A ROTA DE UPDATE OU STORE --}}
        <form action="{{ isset($cliente) ? route('clientes.update', $cliente) : route('clientes.store') }}" method="POST">
            @csrf
            @if(isset($cliente))
                @method('PUT') {{-- MÉTODO PARA ATUALIZAÇÃO --}}
            @endif

            {{-- CAMPO NOME --}}
            <div class="form-group">
                <label for="nome">
                    <i class="bi bi-person"></i>
                    Nome do Cliente
                </label>
                <div class="input-group">
                    <i class="bi bi-person"></i>
                    <input type="text" id="nome" name="nome" value="{{ old('nome', $cliente->nome ?? '') }}" required placeholder="Digite o nome completo">
                </div>
            </div>

            {{-- CAMPO CPF --}}
            <div class="form-group">
                <label for="cpf">
                    <i class="bi bi-person-vcard"></i>
                    CPF
                </label>
                <div class="input-group">
                    <i class="bi bi-person-vcard"></i>
                    <input type="text" id="cpf" name="cpf" value="{{ old('cpf', $cliente->cpf ?? '') }}" required placeholder="Digite o CPF">
                </div>
            </div>

            <div class="form-actions">
                <button type="submit" class="btn btn-success">
                    <i class="bi {{ isset($cliente) ? 'bi-check-circle' : 'bi-save' }}"></i>
                    {{ isset($cliente) ? 'Atualizar' : 'Salvar' }}
                </button>
            </div>
        </form>

        {{-- FORMULÁRIO DE EXCLUSÃO (APARECE APENAS NA EDIÇÃO) --}}
        @if(isset($cliente))
            <form action="{{ route('clientes.destroy', $cliente) }}" method="POST" onsubmit="return confirm('Tem certeza que deseja excluir este cliente? Esta ação não pode ser desfeita.');" class="delete-form">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">
                    <i class="bi bi-trash"></i>
                    Excluir Cliente
                </button>
            </form>
        @endif
    </div>
@endsection