@extends('layouts.app')

@section('content')
    <h1>Cadastro</h1>

    {{-- MOSTRA ERROS DE VALIDAÇÃO, SE TIVER --}}
    @if ($errors->any())
        <div>
            <ul>
                @foreach ($errors->all() as $error)
                    <li class="error">{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ url('/cadastro') }}">
        @csrf {{-- TOKEN DE SEGURANÇA DO LARAVEL --}}

        <div class="form-group">
            <label for="nome">Nome</label>
            <input id="nome" type="text" name="nome" value="{{ old('nome') }}" required autofocus>
        </div>

        <div class="form-group">
            <label for="email">Email</label>
            <input id="email" type="email" name="email" value="{{ old('email') }}" required>
        </div>

        <div class="form-group">
            <label for="password">Senha</label>
            <input id="password" type="password" name="password" required>
        </div>

        <div class="form-group">
            <label for="password_confirmation">Confirmar Senha</label>
            <input id="password_confirmation" type="password" name="password_confirmation" required>
        </div>

        <div class="form-group">
            <label for="tipo">Tipo de Usuário</label>
            <select id="tipo" name="tipo" required>
                <option value="funcionario">Funcionário</option>
                <option value="admin">Admin</option>
            </select>
        </div>

        <div class="form-group">
            <button type="submit">Cadastrar</button>
        </div>

        <div class="link">
            <a href="{{ route('login') }}">Já tem uma conta? Faça o login</a>
        </div>
    </form>
@endsection