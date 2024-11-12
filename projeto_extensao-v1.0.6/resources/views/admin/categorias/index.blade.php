@extends('admin.layout')
@section('titulo', 'Categorias')
@section('conteudo')

<link rel="stylesheet" href="{{ asset('css/admcategoria.css') }}">

<div class="container">
    <!-- Título principal com estilo -->
    <div class="section">
        <h4 class="center-align grey-text text-darken-2">Gerenciamento de Categorias</h4>
        <p class="center-align grey-text">Adicione, edite e gerencie as categorias disponíveis no sistema</p>
    </div>

    <!-- Mensagem de sucesso -->
    @if (session('sucesso'))
        <div class="card green lighten-2">
            <div class="card-content white-text">
                <i class="material-icons left">check_circle</i> {{ session('sucesso') }}
            </div>
        </div>
    @endif

    <div class="fixed-action-btn">
        <a class="btn-floating btn-large bg-gradient-green modal-trigger" href="{{ route('categorias.create') }}">
            <i class="large material-icons">add</i>
        </a>
    </div>

    <div class="table-responsive" style="overflow-x: auto; max-width: 100%;">
        <table class="highlight centered">
            <thead class="blue-grey lighten-4">
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

    <!-- Paginação -->
    <div class="center-align">
        {{ $categorias->links('custom.pagination') }}
    </div>
</div>

@endsection