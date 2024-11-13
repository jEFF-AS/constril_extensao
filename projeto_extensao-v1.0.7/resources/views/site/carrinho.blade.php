@extends('site.layout')
@section('title', 'Carrinho')
@section('conteudo')

    <style>
        /* Estilos para tornar os botões quadrados e responsivos */
        .div a.btn,
        .div button#finalizarPedido {
            width: 100%;
            max-width: 200px; /* Limite máximo de largura para botões em telas maiores */
            justify-content: center; /* Centraliza horizontalmente */
            align-items: center; /* Centraliza verticalmente */
            display: inline-block;
            margin: 5px; /* Espaço entre os botões */
            border-radius: 3px; /* Remove o arredondamento para um efeito quadrado */
        }

        @media (min-width: 600px) {

            /* Estilos para dispositivos maiores */
            .div a.btn,
            .div button#finalizarPedido {
                width: 30%; /* Cada botão ocupa um terço da largura em telas maiores */
            }
        }
    </style>

    <div class="row container">

        @if ($mensagem = Session::get('sucesso'))
            <div class="card green lighten-2">
                <div class="card-content white-text">
                    <span class="card-title">Parabéns!</span>
                    <p>{{ $mensagem }}</p>
                </div>
            </div>
        @endif

        @if ($mensagem = Session::get('aviso'))
            <div class="card light-green darken-3">
                <div class="card-content white-text">
                    <span class="card-title">Tudo certo!</span>
                    <p>{{ $mensagem }}</p>
                </div>
            </div>
        @endif

        @if ($itens->count() == 0)
            <div class="card grey">
                <div class="card-content white-text">
                    <span class="card-title">Seu carrinho está vazio!</span>
                    <p>Aproveite nossas promoções!</p>
                </div>
            </div>
        @else
            <h5>Seu carrinho possui {{ $itens->count() }} produtos.</h5>
            <table class="striped">
                <thead>
                    <tr>
                        <th></th>
                        <th>Nome</th>
                        <th>Preço</th>
                        <th>Quantidade</th>
                        <th></th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($itens as $item)
                        <br>
                        <tr>
                            <td><img src="{{ $item->attributes->image }}" alt="" width="70"
                                    class="responsive-img circle"></td>
                            <td>{{ $item->name }}</td>
                            <td>R$ {{ number_format($item->price, 2, ',', '.') }}</td>

                            {{-- BTN ATUALIZAR --}}
                            <form action="{{ route('site.atualizacarrinho') }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="id" value="{{ $item->id }}">
                                <td><input style="width: 40px; font-weight:900;" class="white center" min="1" type="number" name="quantity" value="{{ $item->quantity }}"></td>
                                <td>
                                    <button class="btn-floating waves-effect waves-light orange"><i class="material-icons">refresh</i></button>
                            </form>

                            {{-- BTN REMOVER --}}
                            <form action="{{ route('site.removecarrinho') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="id" value="{{ $item->id }}">
                                <button class="btn-floating waves-effect waves-light red"><i class="material-icons">delete</i></button>
                            </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <br>
            <h5><strong>Valor total: R$ {{ number_format(\Cart::getTotal(), 2, ',', '.') }} </strong></h5>
        @endif

        <br>
        <div class="div center">
            <a href="{{ route('site.index') }}" class="btn waves-effect waves-light blue"> Comprar Mais</a>
            <a href="{{ route('site.limparcarrinho') }}" class="btn waves-effect waves-light orange"> Limpar carrinho</a>

            @if ($itens->count() > 0)
                <button id="finalizarPedido" class="btn waves-effect waves-light green">Finalizar pedido</button>
            @else
                <button id="finalizarPedido" class="btn waves-effect waves-light green" disabled>Finalizar pedido</button>
            @endif
        </div>
    </div>


    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.getElementById('finalizarPedido').addEventListener('click', function() {
                fetch('/api/carrinho/finalizar', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        }
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.url) {
                            window.location.href = data.url;
                        } else {
                            alert('Erro ao finalizar pedido');
                        }
                    })
                    .catch(error => {
                        console.error('Erro:', error);
                        alert('Erro ao conectar com o servidor');
                    });
            });
        });
    </script>
@endsection