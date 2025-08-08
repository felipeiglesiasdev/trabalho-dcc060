@extends('layouts.app')

@section('content')
    <h1>Login</h1>

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

    <form method="POST" action="{{ url('/login') }}">
        @csrf  {{-- TOKEN DE SEGURANÇA DO LARAVEL, ESSENCIAL --}}

        <div class="form-group">
            <label for="email">Email</label>
            <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus>
        </div>

        <div class="form-group">
            <label for="password">Senha</label>
            <input id="password" type="password" name="password" required>
        </div>

        <div class="form-group">
            <button type="submit">Entrar</button>
        </div>

        <div class="link">
            <a href="{{ route('cadastro') }}">Não tem uma conta? Cadastre-se</a>
        </div>
    </form>
@endsection
