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
                            <button class="btn red modal-trigger" data-target="modalConfirmDelete" 
                                    onclick="setDeleteFormAction('{{ route('categorias.destroy', $categoria->id) }}')">Excluir</button>
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

<!-- Modal de confirmação -->
<div id="modalConfirmDelete" class="modal">
    <div class="modal-content">
        <h4 class="center-align"><i class="material-icons">warning</i> Tem certeza?</h4>
        <p class="center-align">Tem certeza de que deseja excluir esta categoria? Esta ação não pode ser desfeita.</p>
    </div>
    <div class="modal-footer">
        <form id="deleteForm" method="POST" style="display:inline;">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn red">Confirmar</button>
        </form>
        <a href="#!" class="modal-close waves-effect waves-light btn grey">Cancelar</a>
    </div>
</div>

<script>
    // Inicializa os modais
    document.addEventListener('DOMContentLoaded', function () {
        const modals = document.querySelectorAll('.modal');
        M.Modal.init(modals);
    });

    // Define a ação do formulário de exclusão
    function setDeleteFormAction(action) {
        const deleteForm = document.getElementById('deleteForm');
        deleteForm.action = action;
    }
</script>

@endsection
