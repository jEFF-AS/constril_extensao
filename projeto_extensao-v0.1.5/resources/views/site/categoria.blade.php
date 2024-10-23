@extends('site.layout')
@section('title', 'Home')
@section('conteudo')

<div class="row conteiner">
    
    <h5>Categoria: {{ $categoria->nome }} </h5>
   
    @foreach ($produtos as $produto)
        <div class="col s12 m2">
            <div class="card">
                <div class="card-image">
                <img src="{{url("storage/{$produto->imagem}")}}">
                <a href="{{ route('site.details', $produto->slug ) }}" class="btn-floating halfway-fab waves-effect waves-light red"><i class="material-icons">visibility</i></a>
                </div>
                <div class="card-content">
                    <span class="card-title">{{ $produto->nome }}</span>
                    <p>{{ Str::limit($produto->descricao, 20) }}</p>
                </div>
            </div>
        </div>
    @endforeach

</div>

<div class="row center">
    {{ $produtos->links('custom.pagination') }}
</div>

@endsection