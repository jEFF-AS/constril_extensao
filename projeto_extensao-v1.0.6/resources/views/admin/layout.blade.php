<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('titulo')</title>
    <!-- Compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="stylesheet" href="{{ asset('css/layout.css') }}">
    <link rel="stylesheet" href="{{ asset('css/dlayout.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <style>
       
    </style>
</head>

<body>
    <!-- Dropdown Structure -->
    <ul id='dropdown2' class='dropdown-content'>
        <li><a href="{{ route('profile') }}">Perfil</a></li>
    </ul>

    <nav class="red">
        <div class="nav-wrapper container">
            <a href="#" class="center brand-logo"><h5>Constril</h5></a>
            <ul class="right">
                <li class="hide-on-med-and-down"><a href="#" onclick="fullScreen()"><i class="material-icons">settings_overscan</i></a></li>
                <li class="hide-on-med-and-down"><a href="#" class="dropdown-trigger" data-target='dropdown2'>Olá {{ ucfirst(auth()->user()->firstName) }}<i class="material-icons right">arrow_drop_down</i></a></li>
            </ul>
            <a href="#" data-target="slide-out" class="sidenav-trigger left show-on-large"><i class="material-icons">menu</i></a>
        </div>
    </nav>

    <ul id="slide-out" class="sidenav grey lighten-2">
        <li>
            <div class="user-view">
                <div class="background red">
                    <img src={{ asset('img/office.jpg') }} style="opacity: 0.5">
                </div>
                <a href="#user"><img class="circle" src={{ asset('img/user.jpg') }}></a>
                <a href="#name"><span class="white-text name">{{ auth()->user()->firstName }}</span></a>
                <a href="#email"><span class="white-text email">{{ auth()->user()->email }}</span></a>
            </div>
        </li>
    
        <li><a class="btn grey lighten-3 waves-effect sidenav-menu-btn" href="{{ route('site.index') }}"><i class="material-icons left">home</i>Home</a></li> 
        <li><a class="btn grey lighten-3 waves-effect sidenav-menu-btn" href="{{ route('admin.dashboard') }}"><i class="material-icons left">dashboard</i>Dashboard</a></li>
        <li><a class="btn grey lighten-3 waves-effect sidenav-menu-btn" href="{{ route('admin.produtos') }}"><i class="material-icons left">playlist_add_circle</i>Produtos</a></li>
        <li><a class="btn grey lighten-3 waves-effect sidenav-menu-btn" href="{{ route('site.carrinho') }}"><i class="material-icons left">shopping_cart</i>Pedidos</a></li>
        @can('access')
            <li><a class="btn grey lighten-3 waves-effect sidenav-menu-btn" href="{{ route('categorias.index') }}"><i class="material-icons left">category</i>Categorias</a></li>
        @endcan
        @can('access')
            <li><a class="btn grey lighten-3 waves-effect sidenav-menu-btn" href="{{ route('admin.usuarios') }}"><i class="material-icons left">people</i>Usuários</a></li>
        @endcan
        <li><a class="btn grey lighten-3 waves-effect sidenav-menu-btn" href="{{ route('profile') }}"><i class="material-icons left">person</i>Perfil</a></li>
        <li class="sair-botao"><a class="btn grey lighten-3 waves-effect sidenav-menu-btn" href="{{ route('login.logout') }}"><i class="material-icons left">logout</i>Sair</a></li>
    </ul>
    

    <main>
        @yield('conteudo')
    </main>

    <!-- Rodapé fixo -->
    <footer class="page-footer grey">
        <div class="container">
            <span>&copy; {{ date('Y') }} Constril. Todos os direitos reservados.</span>
        </div>
    </footer>

    <!-- Compiled and minified JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
    <script src="{{ asset('js/chart.js') }}"></script>
    <script src="{{ asset('js/main.js') }}"></script>
    <script>
        // Inicialização de dropdown e sidenav
        document.addEventListener('DOMContentLoaded', function() {
            var elemsDropdown = document.querySelectorAll('.dropdown-trigger');
            M.Dropdown.init(elemsDropdown, { coverTrigger: false, constrainWidth: false});
            var elemsSidenav = document.querySelectorAll('.sidenav');
            M.Sidenav.init(elemsSidenav);
        });
    </script>
    @stack('graficos')
</body>

</html>
