@extends('site.layout')
@section('title', 'profile')
@section('conteudo')

<style>
    /* Deixar os botões quadrados */
    .btn-square {
        border-radius: 3px;
    }

    /* Adicionar espaçamento entre os botões */
    .button-group {
        display: flex;
        flex-wrap: wrap;
        gap: 10px; /* Espaço entre os botões */
    }
</style>

<div class="container">
    <h2>Perfil do Usuário</h2>

    @if($mensagem = session('success'))
        <div class="card green lighten-2">
            <div class="card-content white-text">
                <span class="card-title">Parabéns!</span>
                <p>{{ $mensagem }}</p>
            </div>
        </div>
    @endif

    <form action="{{ route('profile.update') }}" method="POST">
        @csrf
        @method('PUT')

        <div class="input-field">
            <label for="firstName">Nome</label>
            <input type="text" name="firstName" id="firstName" value="{{ $user->firstName }}" required>
        </div>

        <div class="input-field">
            <label for="lastName">Sobrenome</label>
            <input type="text" name="lastName" id="lastName" value="{{ $user->lastName }}" required>
        </div>

        <div class="input-field">
            <label for="email">Email</label>
            <input type="email" name="email" id="email" value="{{ $user->email }}" required>
        </div>

        <div class="input-field">
            <label for="password">Nova Senha (opcional)</label>
            <input type="password" name="password" id="password">
        </div>

        <!-- Agrupamento de botões com classes para estilo -->
        <div class="button-group">
            <button type="submit" class="btn green btn-square">Atualizar Perfil</button>
            <button type="button" class="btn red btn-square modal-trigger" data-target="confirmDeleteModal">Excluir Conta</button>
        </div>
    </form><br>

    <!-- Modal de confirmação de exclusão -->
    <div id="confirmDeleteModal" class="modal">
        <div class="modal-content">
            <h4>Confirmação de Exclusão</h4>
            <p>Tem certeza de que deseja excluir sua conta? Esta ação não pode ser desfeita.</p>
        </div>
        <div class="modal-footer">
            <form action="{{ route('profile.delete') }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn red btn-square">Sim, excluir</button>
                <a href="#!" class="modal-close btn blue btn-square">Cancelar</a>
            </form>
        </div>
    </div>
</div>

<!-- Scripts do Materialize para ativar o modal -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var elems = document.querySelectorAll('.modal');
        M.Modal.init(elems);
    });
</script>

@endsection
