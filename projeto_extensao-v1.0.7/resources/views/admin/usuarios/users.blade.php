@extends('admin.layout')
@section('titulo', 'Usuários Cadastrados')
@section('conteudo')

<link rel="stylesheet" href="{{ asset('css/admusers.css') }}">

    <div class="container">
    <!-- Título principal com estilo -->
    <div class="section">
        <h4 class="center-align grey-text text-darken-2">Gerenciamento de Usuários</h4>
        <p class="center-align grey-text">Controle e edite o nível de acesso dos usuários cadastrados no sistema</p>
    </div>

    <!-- Mensagem de sucesso -->
    @if (session('sucesso'))
        <div class="card green lighten-2">
            <div class="card-content white-text">
                <i class="material-icons left">check_circle</i> {{ session('sucesso') }}
            </div>
        </div>
    @endif

    <div class="table-responsive" style="overflow-x: auto; max-width: 100%;">
        <table class="highlight centered">
            <thead class="blue-grey lighten-4">
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Email</th>
                    <th>Nível de Acesso</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                    <tr>
                        <td>{{ $user->id }}</td>
                        <td>{{ $user->firstName }} {{ $user->lastName }}</td>
                        <td>{{ $user->email }}</td>
                        <td class="access-level-column">
                            <form action="{{ route('admin.users.updateAccessLevel', $user->id) }}" method="POST" class="access-level-form">
                                @csrf
                                @method('PATCH')
                                <div class="input-field">
                                    <select name="access_level" onchange="this.form.submit()" class="browser-default"
                                        style="padding: 5px; border-radius: 4px; border: 1px solid #ccc;">
                                        <option value="user" {{ $user->access_level === 'user' ? 'selected' : '' }}>Usuário</option>
                                        <option value="vendor" {{ $user->access_level === 'vendor' ? 'selected' : '' }}>Fornecedor</option>
                                        <option value="admin" {{ $user->access_level === 'admin' ? 'selected' : '' }}>Administrador</option>
                                    </select>
                                </div>
                            </form>
                        </td>
                        
                        <td>
                            <!-- Botão de exclusão com modal de confirmação -->
                            <button data-target="confirmModal{{ $user->id }}" class="btn red modal-trigger">Remover</button>

                            <!-- Modal de confirmação -->
                            <div id="confirmModal{{ $user->id }}" class="modal">
                                <div class="modal-content">
                                    <h4><i class="material-icons">delete</i> Tem certeza?</h4>
                                    <p>Tem certeza de que deseja remover o usuário <strong>{{ $user->firstName }} {{ $user->lastName }}</strong>?</p>
                                </div>
                                <div class="modal-footer">
                                    <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="waves-effect waves-red btn red">Excluir</button>
                                    </form>
                                    <a href="#!" class="modal-close waves-effect waves-green btn grey">Cancelar</a>
                                </div>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Paginação -->
    <div class="center-align">
        {{ $users->links('custom.pagination') }}
    </div>
</div>

<!-- Scripts adicionais -->
@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Inicializar modais
            var modals = document.querySelectorAll('.modal');
            M.Modal.init(modals);
        });
    </script>
@endpush

@endsection