@extends('layouts.app')

@section('content')
<div class="auth-container">
    <div class="auth-card">
        <h1><i class="bi bi-person-plus"></i> Cadastro</h1>

        {{-- MOSTRA ERROS DE VALIDAÇÃO, SE TIVER --}}
        @if ($errors->any())
            <div class="error-container">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li class="error">{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ url('/cadastro') }}" class="auth-form">
            @csrf {{-- TOKEN DE SEGURANÇA DO LARAVEL --}}

            <div class="form-group auth-input-group">
                <label for="nome">
                    <i class="bi bi-person"></i>
                    Nome
                </label>
                <div class="input-group">
                    <i class="bi bi-person"></i>
                    <input id="nome" type="text" name="nome" value="{{ old('nome') }}" placeholder="Digite seu nome completo" required autofocus>
                </div>
            </div>

            <div class="form-group auth-input-group">
                <label for="email">
                    <i class="bi bi-envelope"></i>
                    Email
                </label>
                <div class="input-group">
                    <i class="bi bi-envelope"></i>
                    <input id="email" type="email" name="email" value="{{ old('email') }}" placeholder="Digite seu email" required>
                </div>
            </div>

            <div class="form-group auth-input-group">
                <label for="password">
                    <i class="bi bi-lock"></i>
                    Senha
                </label>
                <div class="input-group">
                    <i class="bi bi-lock"></i>
                    <input id="password" type="password" name="password" placeholder="Digite sua senha" required>
                </div>
            </div>

            <div class="form-group auth-input-group">
                <label for="password_confirmation">
                    <i class="bi bi-lock-fill"></i>
                    Confirmar Senha
                </label>
                <div class="input-group">
                    <i class="bi bi-lock-fill"></i>
                    <input id="password_confirmation" type="password" name="password_confirmation" placeholder="Confirme sua senha" required>
                </div>
            </div>

            <div class="form-group auth-input-group">
                <label for="tipo">
                    <i class="bi bi-shield-check"></i>
                    Tipo de Usuário
                </label>
                <select id="tipo" name="tipo" required>
                    <option value="">Selecione o tipo de usuário</option>
                    <option value="funcionario">Funcionário</option>
                    <option value="admin">Admin</option>
                </select>
            </div>

            <div class="form-group">
                <button type="submit" class="auth-submit-btn">
                    <i class="bi bi-person-plus"></i>
                    Cadastrar
                </button>
            </div>

            <div class="link auth-link-container">
                <a href="{{ route('login') }}">
                    <i class="bi bi-box-arrow-in-right"></i>
                    Já tem uma conta? Faça o login
                </a>
            </div>
        </form>
    </div>
</div>
@endsection