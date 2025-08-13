<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Chaveiro System</title>

    {{-- IMPORTANDO A FONTE POPPINS --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    {{-- IMPORTANDO FONT AWESOME PARA OS ÍCONES --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    {{-- CHAMANDO O CSS ÚNICO DO DASHBOARD --}}
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
        {{-- CHAMANDO O CSS DO MENU --}}
    <link rel="stylesheet" href="{{ asset('css/menu.css') }}">
</head>
<body>
    <aside class="sidebar">
        <div class="sidebar-header">
            <h2 class="sidebar-logo"><i class="fas fa-key"></i> ChaveiroSys</h2>
            <p class="sidebar-subtitle">Sistema de Gerenciamento</p>
        </div>
        
        <nav>
            <ul>
                {{-- A ESTRUTURA HTML CONTINUA A MESMA, OS ÍCONES SÃO ADICIONADOS VIA CSS --}}
                <li><a href="{{ route('clientes.index') }}"><i class="fas fa-users"></i> Gerenciar Clientes</a></li>
                <li><a href="{{ route('fornecedores.index') }}"><i class="fas fa-truck"></i> Gerenciar Fornecedores</a></li>
                <li><a href="{{ route('servicos.index') }}"><i class="fas fa-wrench"></i> Gerenciar Serviços</a></li>
                <li><a href="{{ route('categorias.index') }}"><i class="fas fa-tags"></i> Gerenciar Categorias</a></li>

                @if(Auth::user()->tipo == 'admin')
                    <li><a href="{{ route('funcionarios.index') }}"><i class="fas fa-user-tie"></i> Gerenciar Funcionários</a></li>
                @endif
            </ul>
        </nav>

        <div class="user-info">
            <p><strong>Nome:</strong> {{ Auth::user()->nome }}</p>
            <p><strong>ID:</strong> {{ Auth::user()->id_usuario }}</p>
            <p><strong>Email:</strong> {{ Auth::user()->email }}</p>

            <form class="logout-form" method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit"><i class="fas fa-sign-out-alt"></i> Sair</button>
            </form>
        </div>
    </aside>

    <main class="main-content">
        @yield('content')
    </main>

    <script src="{{ asset('js/masks.js') }}"></script>
    <script>
        // PEQUENO SCRIPT PARA ADICIONAR A CLASSE 'ACTIVE' AO LINK DO MENU ATUAL
        document.addEventListener('DOMContentLoaded', function() {
            const links = document.querySelectorAll('.sidebar nav a');
            // USA a URL sem parâmetros para evitar problemas
            const currentPath = window.location.pathname;

            links.forEach(link => {
                const linkPath = new URL(link.href).pathname;
                // Verifica se o início do path é o mesmo
                if (currentPath.startsWith(linkPath)) {
                    link.classList.add('active');
                }
            });
        });
    </script>
</body>
</html>