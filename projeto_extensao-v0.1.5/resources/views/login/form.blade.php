<!-- Link para o arquivo CSS -->
<link rel="stylesheet" href="{{ asset('css/login.css') }}">

<div class="login-container">
    @if($mensagem = Session::get('erro'))
        {{ $mensagem }}
    @endif
    @if($errors->any())
        @foreach($errors->all() as $error)
            {{ $error }}
        @endforeach
    @endif

    <form action="{{ route('login.auth') }}" method="POST" class="login-form">
        <h2 class="login-title">LOGIN</h2>
        @csrf
        <label for="email">Email:</label>
        <input type="email" name="email" id="email">
        <label for="password">Senha:</label>
        <input type="password" name="password" id="password">
        <label>
            <input type="checkbox" name="remember"> Lembrar-me
        </label>
        <button type="submit" class="submit-btn">Entrar</button>
        <p><a href="{{route('login.create')}}">Fazer cadastro!</a></p>
    </form>
</div>