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
</head>
<body>   

    <!-- Dropdown Structure -->
    <ul id='dropdown1' class='dropdown-content'>
      @foreach ($categoriasMenu as $categoriaM)
      <li><a href="{{ route('site.categoria', $categoriaM->id) }}">{{$categoriaM->nome}}</a></li>   
      @endforeach
    </ul>

    <!-- Dropdown Structure -->
    <ul id='dropdown2' class='dropdown-content'>
      <li><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
      <li><a href="{{ route('login.logout') }}">Sair</a></li>   
    </ul>

    <nav class="red">
        <div class="nav-wrapper container">
          <a href="{{ route('site.index') }}" class="brand-logo">Constril</a>
          <a href="#" data-target="mobile-demo" class="sidenav-trigger"><i class="material-icons">menu</i></a>
          <ul class="right hide-on-med-and-down">
            <li><a href="{{ route('site.index') }}" class="right">Home</a></li>
       
            <li><a class="dropdown-trigger" href="#!" data-target="dropdown1">Categorias<i class="material-icons right">arrow_drop_down</i></a></li>
            @auth
            <li><a href="{{ route('site.carrinho') }}">Carrinho <span class="new badge deep-orange accent-4" data-badge-caption="">{{ \Cart::getContent()->count() }}</span></a></li>
            <li><a class="dropdown-trigger" href="#!" data-target="dropdown2">Olá {{auth()->user()->firstName}}<i class="material-icons right">arrow_drop_down</i></a></li>
            @else
            <li><a href="{{ route('login.form') }}">Login <i class="material-icons right">lock</i></a></li>
            @endauth
          </ul>
        </div>
    </nav>

    <ul class="sidenav" id="mobile-demo">
      <li><a href="{{ route('site.index') }}">Home</a></li>
    
      <li class="no-padding">
        <ul class="collapsible collapsible-accordion">
          <li>
            <a class="collapsible-header">Categorias<i class="material-icons">arrow_drop_down</i></a>
            <div class="collapsible-body">
              <ul>
                @foreach ($categoriasMenu as $categoriaM)
                <li><a href="{{ route('site.categoria', $categoriaM->id) }}">{{$categoriaM->nome}}</a></li>   
                @endforeach
              </ul>
            </div>
          </li>
        </ul>
      </li>
      @auth
      <li><a href="{{ route('site.carrinho') }}">Carrinho <span class="new badge deep-orange accent-4" data-badge-caption="">{{ \Cart::getContent()->count() }}</span></a></li>
      <li><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
      <li><a href="{{ route('login.logout') }}">Sair</a></li>
      @else
      <li><a href="{{ route('login.form') }}">Login <i class="material-icons right">lock</i></a></li>
      @endauth
    </ul>

@yield('conteudo')

<!-- Compiled and minified JavaScript -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>

<script>
  var elemDrop = document.querySelectorAll('.dropdown-trigger');
  var instanceDrop = M.Dropdown.init(elemDrop, {
    coverTrigger:false,
    constrainWidth:false
  });
</script>

</body>
</html>