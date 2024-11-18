   <!-- Modal Structure -->
   <div id="create" class="modal">
       <div class="modal-content">
           <h4 class="center-align"><i class="material-icons">playlist_add_circle</i> Novo produto</h4>
           <form action="{{ route('admin.produto.store') }}" method="POST" enctype="multipart/form-data" class="col s12">
               @csrf
               <input type="hidden" name="id_user" value="{{ auth()->user()->id }}">

               <div class="row">
                   <div class="input-field col s12 m6">
                       <input name="nome" id="nome" type="text" class="validate" required>
                       <label for="nome">Nome do Produto</label>
                   </div>

                   <div class="input-field col s12 m6">
                       <input name="preco" id="preco" type="number" class="validate" step="0.01" min="0" required>
                       <label for="preco">Preço (R$)</label>
                   </div>

                   <div class="input-field col s12">
                       <textarea name="descricao" id="descricao" class="materialize-textarea validate" required></textarea>
                       <label for="descricao">Descrição do Produto</label>
                   </div>

                   <div class="input-field col s12">
                       <select name="id_categoria">
                           <option value="" disabled selected>Escolha uma opção</option>
                           @foreach ($categorias as $c)
                               <option value="{{ $c->id }}">{{ $c->nome }}</option>
                           @endforeach

                       </select>
                       <label>Categoria</label>
                   </div>

                   <div class="file-field input-field col s12">
                       <div class="btn red">
                           <span>Imagem</span>
                           <input name="imagem" type="file" required accept="image/*" onchange="validateImageSize(this)">
                       </div>
                       <div class="file-path-wrapper">
                           <input class="file-path validate" type="text">
                       </div>
                   </div>
               </div>
               <button class="waves-effect waves-green btn green right">Cadastrar</button><br>
       </div>
       </form>

       <!-- Modal de Aviso -->
       <div id="modalAviso" class="modal">
           <div class="modal-content">
               <h4 class="center-align red-text"><i class="material-icons">error_outline</i> Aviso</h4>
               <p class="center-align">A imagem selecionada excede o tamanho máximo permitido de 5 MB.</p>
           </div>
           <div class="modal-footer">
               <a href="#!" class="modal-close waves-effect waves-light btn red lighten-1">OK</a>
           </div>
       </div>

   </div>

   <script>
       document.addEventListener('DOMContentLoaded', function() {
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
