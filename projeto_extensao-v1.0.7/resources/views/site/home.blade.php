@extends('site.layout')
@section('title', 'Home')
@section('conteudo')

    <!-- Adicionando o arquivo CSS -->
    <link rel="stylesheet" href="{{ asset('css/home.css') }}">

    <!-- Cabeçalho visível apenas para usuários não logados -->
    @guest
        <header class="header">
            <div class="container">
                <h1 class="center-align">Bem-vindo à Nossa Loja!</h1>
                <p class="center-align">Encontre os melhores produtos com os melhores preços!</p>
            </div>
        </header>
    @endguest

    <!-- Seção de produtos -->
    <div class="container">
        <div class="row">
            @foreach ($produtos as $produto)
                <div class="col s12 m6 l4 xl3">
                    <a href="{{ route('site.details', $produto->slug) }}" style="color: inherit; text-decoration: none;">
                        <div class="card hoverable" style="border-radius: 10px;"> <!-- Adicionando bordas arredondadas -->
                            <div class="card-image">
                                <img src="{{ url("storage/{$produto->imagem}") }}"
                                    style="width: 100%; height: 200px; object-fit: cover; border-top-left-radius: 10px; border-top-right-radius: 10px;">
                                <!-- Bordas arredondadas na imagem -->
                            </div>
                            <div class="card-content">
                                <span class="card-title">{{ $produto->nome }}</span>
                                <p>{{ Str::limit($produto->descricao, 20) }}</p>
                                <span class="card-price">R$ {{ number_format($produto->preco, 2, ',', '.') }}</span>
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>

        <div class="row center">
            {{ $produtos->links('custom.pagination') }}
        </div>
    </div>

@endsection
