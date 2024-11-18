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
                                <option value="{{ $categoria->id }}"
                                    {{ $produto->id_categoria == $categoria->id ? 'selected' : '' }}>
                                    {{ $categoria->nome }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Campo para upload de imagem -->
                    <label for="imagem">Nova Imagem do Produto:</label>
                    <div class="input-field">
                        <div class="file-field input-field">
                            <div class="btn red">
                                <span>Arquivo</span>
                                <input type="file" name="imagem" id="imagem" onchange="validateImageSize(this)">
                            </div>
                            <div class="file-path-wrapper">
                                <input class="file-path validate" type="text" placeholder="Selecione uma imagem">
                            </div>
                        </div>
                    </div>

                    <!-- Modal de aviso -->
                    <div id="modalAviso" class="modal">
                        <div class="modal-content">
                            <h4 class="center-align red-text"><i class="material-icons">error_outline</i> Aviso</h4>
                            <p class="center-align">A imagem selecionada excede o tamanho máximo permitido de 5 MB.</p>
                        </div>
                        <div class="modal-footer">
                            <a href="#!" class="modal-close waves-effect waves-light btn red lighten-1">OK</a>
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

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const modals = document.querySelectorAll('.modal');
            M.Modal.init(modals);
        }); 

        function validateImageSize(input) {
            const file = input.files[0];
            const maxSize = 5 * 1024 * 1024; // 5 MB em bytes
    
            if (file && file.size > maxSize) {
                input.value = ""; // Limpa o campo para forçar o usuário a selecionar outro arquivo
                const modalAviso = document.querySelector('#modalAviso');
                const instance = M.Modal.init(modalAviso);
                instance.open(); // Abre o modal
            }
        }
    </script>

@endsection
