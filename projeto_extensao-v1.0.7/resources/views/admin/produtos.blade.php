@extends('admin.layout')
@section('titulo', 'Produtos')
@section('conteudo')

<style>
    /* Remove o arredondamento para botões quadrados */
    .btn-floating.square {
        border-radius: 10px;
        margin-bottom: 10px;
    }
</style>

<div class="fixed-action-btn">
  <a class="btn-floating btn-large bg-gradient-green modal-trigger" href="#create"><i class="large material-icons">add</i></a>
</div>
@include('admin.produtos.create')

<div class="row container crud">
    <div class="row titulo">              
        <h1 class="left">Produtos</h1>
        <span class="right chip">{{$produtos->count()}} produtos exibidos nessa página</span>  
    </div>

    <nav class="bg-gradient-blue">
        <div class="nav-wrapper">
            <form>
                <div class="input-field">
                    <input placeholder="Pesquisar..." id="search" type="search" required>
                    <label class="label-icon" for="search"><i class="material-icons">search</i></label>
                    <i class="material-icons">close</i>
                </div>
            </form>
        </div>
    </nav>     

    <div class="card z-depth-4 registros">
        @include('admin.includes.mensagens')
        
        <!-- Contêiner com rolagem lateral para a tabela -->
        <div style="overflow-x: auto;">
            <table class="striped">
                <thead>
                    <tr>
                        <th></th>
                        <th>ID</th>
                        @can('access')
                            <th>Fornecedor</th> 
                        @endcan 
                        <th>Produto</th>
                        <th>Preço</th>
                        <th>Categoria</th>
                        <th></th>
                    </tr>
                </thead>
        
                <tbody>
                    @foreach ($produtos as $produto)
                        @can('ver-produto', $produto)
                            <tr>
                                <td><img src="{{url("storage/{$produto->imagem}")}}" class="circle"></td>
                                <td>#{{$produto->id}}</td>
                                @can('access')
                                    <td>{{ $produto->user->firstName }}</td>
                                @endcan
                                <td>{{$produto->nome}}</td>                    
                                <td>R$ {{number_format($produto->preco, 2, ',', '.')}}</td>
                                <td>{{$produto->categoria->nome}}</td>
                
                                <!-- Botões de Editar e Deletar -->
                                <td> 
                                  <a href="{{ route('admin.produtos.edit', $produto->id) }}" class="btn-floating waves-effect waves-light orange square"><i class="material-icons">mode_edit</i></a>
                                  <a href="#delete-{{$produto->id}}" class="btn-floating modal-trigger waves-effect waves-light red square"><i class="material-icons">delete</i></a>
                                </td>
                              
                
                                <!-- Modal para confirmação de exclusão -->
                                @include('admin.produtos.delete')
                            </tr>
                        @endcan 
                    @endforeach
                </tbody>
            </table>
        </div> <!-- Fim do contêiner de rolagem lateral -->

        <p>@if (session('erro'))
            <div style="color: red; font-weight: bold;">
                {{ session('erro') }}
            </div>
        @endif</p>
    </div> 

    <div class="row center">
        {{ $produtos->links('custom.pagination') }}
    </div>            
</div>

@endsection
