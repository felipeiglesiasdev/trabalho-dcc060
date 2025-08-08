<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Trabalho DCC060</title>

    {{-- IMPORTANDO A FONTE POPPINS --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;700&display=swap" rel="stylesheet">

    {{-- CHAMANDO O CSS DO DASHBOARD --}}
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
    <link rel="stylesheet" href="{{ asset('css/cliente.css') }}">
</head>
<body>
    <aside class="sidebar">
        <h2>Menu</h2>
        <nav>
            <ul>
                <li><a href="{{ route('clientes.index') }}">Gerenciar Clientes</a></li>

                {{-- VERIFICA SE O USUÁRIO É ADMIN ANTES DE MOSTRAR O LINK --}}
                @if(Auth::user()->tipo == 'admin')
                    <li><a href="{{ route('funcionarios.index') }}">Gerenciar Funcionários</a></li>
                @endif
            </ul>
        </nav>

        <div class="user-info">
            {{-- EXIBE AS INFORMAÇÕES DO USUÁRIO LOGADO --}}
            <p><strong>Nome:</strong> {{ Auth::user()->nome }}</p>
            <p><strong>ID:</strong> {{ Auth::user()->id_usuario }}</p>
            <p><strong>Email:</strong> {{ Auth::user()->email }}</p>

            <form class="logout-form" method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit">Sair</button>
            </form>
        </div>
    </aside>

    <main class="main-content">
        @yield('content')
    </main>
    <script src="{{ asset('js/masks.js') }}"></script>
</body>
</html>
