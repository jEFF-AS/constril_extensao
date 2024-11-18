@extends('admin.layout')
@section('titulo', 'Editar Categoria')

@section('conteudo')
<div class="container">
    <h4 class="center-align">Editar Categoria</h4>
    <form action="{{ route('categorias.update', $categoria->id) }}" method="POST">
        @csrf
        @method('PATCH')
        <div class="input-field">
            <input type="text" name="nome" value="{{ $categoria->nome }}" required>
            <label class="active">Nome</label>
        </div>
        <div class="input-field">
            <textarea name="descricao" class="materialize-textarea">{{ $categoria->descricao }}</textarea>
            <label class="active">Descrição</label>
        </div>
        <button type="submit" class="btn green">Atualizar</button>
    </form>
</div>
@endsection
