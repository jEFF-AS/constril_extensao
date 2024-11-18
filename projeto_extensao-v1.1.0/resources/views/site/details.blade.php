@extends('site.layout')
@section('title', 'Detalhes')
@section('conteudo')

<!-- Link para o arquivo CSS -->
<link rel="stylesheet" href="{{ asset('css/details.css') }}">

<div class="container">
    <div class="row center" style="margin-top: 20px;">
        <div class="col s12 m6">
            <img src="{{ url("storage/{$produto->imagem}") }}" class="responsive-img" alt="{{ $produto->nome }}" style="border-radius: 10px;">
        </div>

        <div class="col s12 m6">
            <h4 class="black-text" style="font-weight: bold;">{{ $produto->nome }}</h4>
            <h5 class="orange-text" style="font-weight: bold;">R$ {{ number_format($produto->preco, 2, ',', '.') }}</h5>
            <p>{{ $produto->descricao }}</p>
            <p class="grey-text">Postado por: <strong>{{ $produto->user->firstName }}</strong><br>
                Categoria: <strong>{{ $produto->categoria->nome }}</strong>
            </p>

            <form action="{{ route('site.addcarrinho') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="id" value="{{ $produto->id }}">
                <input type="hidden" name="name" value="{{ $produto->nome }}">
                <input type="hidden" name="price" value="{{ $produto->preco }}">
                <input type="hidden" name="img" value="{{ $produto->imagem }}">

                <div class="input-field col s3" style="margin-top: 20px;"></div> <!--Ajuste técnico-->

                <div class="input-field col s3" style="margin-top: 20px;"> 
                    <input type="number" min="1" name="qnt" value="1" required class="validate">
                    <label for="qnt">Quantidade</label>
                </div>
                
                <!-- Usando col s12 para o botão ocupar a linha toda -->
                <div class="col s12" style="margin-top: 20px;">
                    <button type="submit" class="btn orange btn-large comprar-btn">Comprar</button>
                </div>                
            </form>
        </div>
    </div>
</div>

@endsection
