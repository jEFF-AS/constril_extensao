   <!-- Modal Structure -->
   <div id="create" class="modal">
    <div class="modal-content">
      <h4 class="center-align"><i class="material-icons">playlist_add_circle</i> Novo produto</h4>
      <form action="{{route('admin.produto.store')}}" method="POST" enctype="multipart/form-data" class="col s12">
        @csrf
        <input type="hidden" name="id_user" value="{{auth()->user()->id}}">

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
              <option value="{{$c->id}}">{{$c->nome}}</option>
              @endforeach

            </select>
            <label>Categoria</label>
          </div>
          
          <div class="file-field input-field col s12">
            <div class="btn red">
              <span>Imagem</span>
              <input name="imagem" type="file" required>
            </div>
            <div class="file-path-wrapper">
              <input class="file-path validate" type="text">
            </div>
          </div>

        </div> 
        <button class="waves-effect waves-green btn green right">Cadastrar</button><br>
    </div>
    
  </form>
  </div>