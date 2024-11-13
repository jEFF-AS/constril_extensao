@extends('site.layout') 
@section('title', 'Categoria: ' . $categoria->nome)
@section('conteudo')

<!-- Adicionando o arquivo CSS -->
<link rel="stylesheet" href="{{ asset('css/categoria.css') }}">

<div class="container">
    <h5 class="center-align black-text" style="margin-bottom: 20px;">Categoria: {{ $categoria->nome }}</h5>
    
    <div class="row">
        @foreach ($produtos as $produto)
            <div class="col s12 m6 l4 xl3">
                <a href="{{ route('site.details', $produto->slug) }}" style="color: inherit; text-decoration: none;">
                    <div class="card hoverable">
                        <div class="card-image">
                            <img src="{{ url("storage/{$produto->imagem}") }}" style="width: 100%; height: 200px; object-fit: cover; border-top-left-radius: 10px; border-top-right-radius: 10px;">
                        </div>
                        <div class="card-content">
                            <span class="card-title black-text">{{ $produto->nome }}</span>
                            <p class="grey-text">{{ Str::limit($produto->descricao, 20) }}</p>
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