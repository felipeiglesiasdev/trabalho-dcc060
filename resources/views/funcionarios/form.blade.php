@extends('layouts.dashboard')

@section('content')
<div class="content-header">
    <h1 class="content-title">
        <i class="bi bi-person-gear"></i>
        {{ isset($funcionario) ? 'Editar Funcionário' : 'Cadastrar Novo Funcionário' }}
    </h1>
    <p class="content-subtitle">
        {{ isset($funcionario) ? 'Atualize as informações do funcionário' : 'Preencha os dados para cadastrar um novo funcionário' }}
    </p>
</div>

<div class="content-body">
    {{-- MOSTRA ERROS DE VALIDAÇÃO, SE TIVER --}}
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="form-container">


        <form action="{{ isset($funcionario) ? route('funcionarios.update', $funcionario) : route('funcionarios.store') }}" method="POST">
            @csrf
            @if(isset($funcionario))
                @method('PUT')
            @endif

            <div class="form-row">
                <div class="form-group">
                    <label for="nome">
                        <i class="bi bi-person"></i>
                        Nome Completo
                    </label>
                    <div class="input-group">
                        <i class="bi bi-person"></i>
                        <input type="text" id="nome" name="nome" value="{{ old('nome', $funcionario->nome ?? '') }}" placeholder="Digite o nome completo" required>
                    </div>
                </div>

                <div class="form-group">
                    <label for="email">
                        <i class="bi bi-envelope"></i>
                        Email
                    </label>
                    <div class="input-group">
                        <i class="bi bi-envelope"></i>
                        <input type="email" id="email" name="email" value="{{ old('email', $funcionario->email ?? '') }}" placeholder="Digite o email" required>
                    </div>
                </div>
            </div>

            {{-- CAMPOS DE SENHA SÓ APARECEM AO CRIAR UM NOVO FUNCIONÁRIO --}}
            @if(!isset($funcionario))
                <div class="form-row">
                    <div class="form-group">
                        <label for="password">
                            <i class="bi bi-lock"></i>
                            Senha
                        </label>
                        <div class="input-group">
                            <i class="bi bi-lock"></i>
                            <input type="password" id="password" name="password" placeholder="Digite a senha" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="password_confirmation">
                            <i class="bi bi-lock-fill"></i>
                            Confirmar Senha
                        </label>
                        <div class="input-group">
                            <i class="bi bi-lock-fill"></i>
                            <input type="password" id="password_confirmation" name="password_confirmation" placeholder="Confirme a senha" required>
                        </div>
                    </div>
                </div>
            @endif

            <div class="form-row">
                <div class="form-group">
                    <label for="especialidade">
                        <i class="bi bi-award"></i>
                        Especialidade
                    </label>
                    <div class="input-group">
                        <i class="bi bi-award"></i>
                        <input type="text" id="especialidade" name="especialidade" value="{{ old('especialidade', $funcionario->funcionario->especialidade ?? '') }}" placeholder="Digite a especialidade" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="salario">
                        <i class="bi bi-currency-dollar"></i>
                        Salário
                    </label>
                    <div class="input-group">
                        <i class="bi bi-currency-dollar"></i>
                        <input type="number" step="0.01" id="salario" name="salario" value="{{ old('salario', $funcionario->funcionario->salario ?? '') }}" placeholder="0.00" required>
                    </div>
                </div>
            </div>
            <div class="form-group mt-3 form-actions">
                <button type="submit" class="btn btn-save btn-success">
                    <i class="bi bi-{{ isset($funcionario) ? 'arrow-repeat' : 'check-circle' }}"></i>
                    {{ isset($funcionario) ? 'Atualizar Funcionário' : 'Salvar Funcionário' }}
                </button>
                
                <a href="{{ route('funcionarios.index') }}" class="btn btn-secondary">
                    <i class="bi bi-arrow-left"></i>
                    Voltar à Lista
                </a>
            </div>
        </form>
    </div>
</div>
@endsection