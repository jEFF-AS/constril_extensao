@extends('admin.layout')
@section('titulo', 'Categorias')

@section('conteudo')
<div class="container">
    <h4 class="center-align">Gerenciamento de Categorias</h4>
    
    <!-- Mensagem de sucesso -->
    @if (session('sucesso'))
        <div class="card green lighten-2">
            <div class="card-content white-text">
                {{ session('sucesso') }}
            </div>
        </div>
    @endif

    <!-- Botão para adicionar categoria -->
    <div class="fixed-action-btn">
        <a  class="btn-floating btn-large bg-gradient-green modal-trigger" href="{{ route('categorias.create') }}"><i class="large material-icons">add</i></a>
      </div>

    <!-- Tabela de categorias -->
    <table class="highlight responsive-table centered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Descrição</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($categorias as $categoria)
                <tr>
                    <td>{{ $categoria->id }}</td>
                    <td>{{ $categoria->nome }}</td>
                    <td>{{ $categoria->descricao }}</td>
                    <td>
                        <a href="{{ route('categorias.edit', $categoria->id) }}" class="btn orange">Editar</a>
                        <form action="{{ route('categorias.destroy', $categoria->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn red">Excluir</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
