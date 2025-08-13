@extends('layouts.app')

@section('content')
<div class="auth-container">
    <div class="auth-card">
        <h1><i class="bi bi-box-arrow-in-right"></i> Login</h1>

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

        <form method="POST" action="{{ url('/login') }}" class="auth-form">
            @csrf  {{-- TOKEN DE SEGURANÇA DO LARAVEL, ESSENCIAL --}}

            <div class="form-group auth-input-group">
                <label for="email">
                    <i class="bi bi-envelope"></i>
                    Email
                </label>
                <div class="input-group">
                    <i class="bi bi-envelope"></i>
                    <input id="email" type="email" name="email" value="{{ old('email') }}" placeholder="Digite seu email" required autofocus>
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

            <div class="form-group">
                <button type="submit" class="auth-submit-btn">
                    <i class="bi bi-box-arrow-in-right"></i>
                    Entrar
                </button>
            </div>

            <div class="link auth-link-container">
                <a href="{{ route('cadastro') }}">
                    <i class="bi bi-person-plus"></i>
                    Não tem uma conta? Cadastre-se
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
