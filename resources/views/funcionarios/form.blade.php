@extends('layouts.dashboard')

@section('content')
    <h1>{{ isset($funcionario) ? 'Editar Funcionário' : 'Cadastrar Novo Funcionário' }}</h1>

    @if ($errors->any())
        <div class="alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ isset($funcionario) ? route('funcionarios.update', $funcionario) : route('funcionarios.store') }}" method="POST">
        @csrf
        @if(isset($funcionario))
            @method('PUT')
        @endif

        <div class="form-group">
            <label for="nome">Nome</label>
            <input type="text" id="nome" name="nome" value="{{ old('nome', $funcionario->nome ?? '') }}" required>
        </div>

        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" id="email" name="email" value="{{ old('email', $funcionario->email ?? '') }}" required>
        </div>

        {{-- CAMPOS DE SENHA SÓ APARECEM AO CRIAR UM NOVO FUNCIONÁRIO --}}
        @if(!isset($funcionario))
            <div class="form-group">
                <label for="password">Senha</label>
                <input type="password" id="password" name="password" required>
            </div>
            <div class="form-group">
                <label for="password_confirmation">Confirmar Senha</label>
                <input type="password" id="password_confirmation" name="password_confirmation" required>
            </div>
        @endif

        <div class="form-group">
            <label for="especialidade">Especialidade</label>
            <input type="text" id="especialidade" name="especialidade" value="{{ old('especialidade', $funcionario->funcionario->especialidade ?? '') }}" required>
        </div>

        <div class="form-group">
            <label for="salário">Salário</label>
            <input type="number" step="0.01" id="salário" name="salário" value="{{ old('salário', $funcionario->funcionario->salário ?? '') }}" required>
        </div>

        <button type="submit" class="btn-save">{{ isset($funcionario) ? 'Atualizar' : 'Salvar' }}</button>
    </form>
@endsection