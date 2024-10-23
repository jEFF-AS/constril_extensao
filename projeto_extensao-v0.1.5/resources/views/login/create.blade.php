<!-- Link para o arquivo CSS -->
<link rel="stylesheet" href="{{ asset('css/cadastro.css') }}">

<div class="login-container">
    @if($errors->any())
        <div class="error-message">
            @foreach($errors->all() as $error)
                {{ $error }} <br>
            @endforeach
        </div>
    @endif

    <form action="{{ route('login.store') }}" method="POST" class="login-form">
        <h2 class="login-title">CADASTRO</h2>
        @csrf
        <input type="text" name="firstName" placeholder="Nome">
        <input type="text" name="lastName" placeholder="Sobrenome">
        <input type="email" name="email" placeholder="Email">
        <input type="password" name="password" placeholder="Senha">
        <button type="submit" class="submit-btn">Cadastrar</button>
        <p><a href="{{route('login.form')}}">Fazer login!</a></p>
    </form>
</div>