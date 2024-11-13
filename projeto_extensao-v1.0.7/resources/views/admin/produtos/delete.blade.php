   <!-- Modal Structure -->
   <div id="delete-{{$produto->id}}" class="modal">
    <div class="modal-content">
      <h4><i class="material-icons">delete</i> Tem certeza?</h4>
        <div class="row">
         <p>Tem certeza que deseja excluir {{$produto->nome}} ?</p>
        </div> 
        <a class="modal-close waves-effect waves-green btn grey right">Cancelar</a>

        <form action="{{route('admin.produto.delete', $produto->id)}}" method="POST" style="display: inline;">
            @method('DELETE')
            @csrf
        <button type="submit" class="waves-effect waves-green btn red right" style="margin-right: 10px;">Excluir</button><br>
        </form>
    </div>
  </div>