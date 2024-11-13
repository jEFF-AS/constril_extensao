<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>
    <!-- Compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/layout.css') }}">
    <link rel="stylesheet" href="{{ asset('css/hlayout.css') }}">
</head>

<body>
    <!-- Estrutura do Sidenav para Mobile -->
    <ul class="sidenav grey lighten-2" id="mobile-menu">
        <li><a class="btn grey lighten-3 waves-effect" href="{{ route('site.index') }}">Home</a></li>
        <li><a class="btn grey lighten-3 waves-effect dropdown-trigger" href="#!" data-target="mobile-dropdown1">Categorias</a></li>

        <li><a class="btn grey lighten-3 waves-effect" href="{{ route('site.carrinho') }}">Carrinho</a></li>

        @auth
            @can('access-vendor')
                <li><a class="btn grey lighten-3 waves-effect" href="{{ route('admin.dashboard') }}">Dashboard</a></li>
            @endcan
            <li><a class="btn grey lighten-3 waves-effect" href="{{ route('profile') }}">Perfil</a></li>
            <li class="sair-botao"><a class="btn grey lighten-3 waves-effect" href="{{ route('login.logout') }}">Sair</a></li>
        @else
            <li><a class="btn grey lighten-3 waves-effect" href="{{ route('login.form') }}">Login</a></li>
        @endauth
    </ul>

    <!-- Dropdown para Categorias no Sidenav Mobile -->
    <ul id="mobile-dropdown1" class="dropdown-content">
        @foreach ($categoriasMenu as $categoriaM)
            <li><a class="grey lighten-3 waves-effect" href="{{ route('site.categoria', $categoriaM->id) }}">{{ $categoriaM->nome }}</a></li>
        @endforeach
    </ul>

    <!-- Dropdown para Categorias no Sidenav Mobile -->
    <ul id="mobile-dropdown1" class="dropdown-content">
        @foreach ($categoriasMenu as $categoriaM)
            <li><a class="grey lighten-3 waves-effect" href="{{ route('site.categoria', $categoriaM->id) }}">{{ $categoriaM->nome }}</a></li>
        @endforeach
    </ul>
    
    <!-- Navegação -->
    <nav class="red">
        <div class="nav-wrapper container">
            <a href="{{ route('site.index') }}" class="brand-logo">Constril</a>
            <a href="#" data-target="mobile-menu" class="sidenav-trigger"><i class="material-icons">menu</i></a>
            <ul class="right hide-on-med-and-down">
                <li><a href="{{ route('site.index') }}">Home</a></li>
                <li><a class="dropdown-trigger" href="#!" data-target="dropdown1">Categorias<i class="material-icons right">arrow_drop_down</i></a></li>
                <li><a href="{{ route('site.carrinho') }}">Carrinho <span class="new badge deep-orange accent-4" data-badge-caption="">{{ \Cart::getContent()->count() }}</span></a></li>
                @auth
                    <li><a class="dropdown-trigger" href="#!" data-target="dropdown2">Olá {{ ucfirst(auth()->user()->firstName) }}<i class="material-icons right">arrow_drop_down</i></a></li>
                @else
                    <li><a href="{{ route('login.form') }}">Login <i class="material-icons right">lock</i></a></li>
                @endauth
            </ul>
        </div>
    </nav>

    <!-- Dropdown para Categorias na Navegação Desktop -->
    <ul id="dropdown1" class="dropdown-content">
        @foreach ($categoriasMenu as $categoriaM)
            <li><a href="{{ route('site.categoria', $categoriaM->id) }}">{{ $categoriaM->nome }}</a></li>
        @endforeach
    </ul>

    <!-- Dropdown para Opções do Usuário na Navegação Desktop -->
    <ul id="dropdown2" class="dropdown-content">
        <li><a href="{{ route('profile') }}">Perfil</a></li>
        @can('access-vendor')
            <li><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
        @endcan
        <li><a href="{{ route('login.logout') }}">Sair</a></li>
    </ul>

    <!-- Conteúdo principal -->
    <main>
        @yield('conteudo')
    </main>

    <!-- Rodapé fixo -->
    <footer class="page-footer grey">
        <div class="container">
            <span>&copy; {{ date('Y') }} Constril. Todos os direitos reservados.</span>
        </div>
    </footer>

    <!-- JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Inicializa o sidenav para mobile
            var sidenav = document.querySelectorAll('.sidenav');
            M.Sidenav.init(sidenav);

            // Inicializa os dropdowns para desktop e mobile
            var dropdowns = document.querySelectorAll('.dropdown-trigger');
            M.Dropdown.init(dropdowns, {
                coverTrigger: false,
                constrainWidth: false
            });
        });
    </script>

</body>

</html>
