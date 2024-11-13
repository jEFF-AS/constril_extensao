@extends('admin.layout') 
@section('titulo', 'Editar Produto') 
@section('conteudo')

<div class="container">
    <h4>Editar Produto</h4>

    @if ($errors->any())
        <div class="card red lighten-2">
            <div class="card-content white-text">
                <ul class="m-0 p-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    @endif

    <form action="{{ route('admin.produtos.update', $produto->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="row">
            <div class="col s12 m6">
                <div class="input-field">
                    <label for="nome">Nome:</label>
                    <input type="text" name="nome" id="nome" value="{{ $produto->nome }}">
                </div>

                <div class="input-field">
                    <label for="descricao">Descrição:</label>
                    <textarea name="descricao" id="descricao" class="materialize-textarea">{{ $produto->descricao }}</textarea>
                </div>

                <div class="input-field">
                    <label for="preco">Preço:</label>
                    <input type="number" step="0.01" name="preco" id="preco" value="{{ $produto->preco }}">
                </div>

                <div class="input-field">
                    <label for="id_categoria">Categoria:</label>
                    <select name="id_categoria" id="id_categoria">
                        @foreach ($categorias as $categoria)
                            <option value="{{ $categoria->id }}" {{ $produto->id_categoria == $categoria->id ? 'selected' : '' }}>
                                {{ $categoria->nome }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <label for="imagem">Nova Imagem do Produto:</label>
                <div class="input-field">
                    <div class="file-field input-field">
                        <div class="btn red">
                            <span>Arquivo</span>
                            <input type="file" name="imagem" id="imagem">
                        </div>
                        <div class="file-path-wrapper">
                            <input class="file-path validate" type="text" placeholder="Selecione uma imagem">
                        </div>
                    </div>
                </div>

                <button type="submit" class="btn waves-effect waves-light green">Salvar</button>
            </div>

            <div class="col s12 m6">
                @if ($produto->imagem)
                    <img src="{{ url("storage/{$produto->imagem}") }}" alt="Imagem do Produto" class="responsive-img" style="border-radius: 10px;">
                @else
                    <p>Nenhuma imagem disponível</p>
                @endif
            </div>
        </div>
    </form>
</div>

@endsection
