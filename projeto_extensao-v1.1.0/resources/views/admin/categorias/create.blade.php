@extends('admin.layout')
@section('titulo', 'Adicionar Categoria')

@section('conteudo')
<div class="container">
    <h4 class="center-align">Adicionar Categoria</h4>
    <form action="{{ route('categorias.store') }}" method="POST">
        @csrf
        <div class="input-field">
            <input type="text" name="nome" required>
            <label>Nome</label>
        </div>
        <div class="input-field">
            <textarea name="descricao" class="materialize-textarea"></textarea>
            <label>Descrição</label>
        </div>
        <button type="submit" class="btn green">Salvar</button>
    </form>
</div>
@endsection
