<!-- Link para o arquivo CSS -->
<link rel="stylesheet" href="{{ asset('css/cadastro.css') }}">

<div class="login-container">
    <form action="{{ route('login.store') }}" method="POST" class="login-form">
        <h2 class="login-title">CADASTRO</h2>
        @csrf
        <input type="text" name="firstName" placeholder="Nome">
        <input type="text" name="lastName" placeholder="Sobrenome">
        <input type="email" name="email" placeholder="Email" pattern=".+@gmail\.com" title="Use apenas emails do Gmail">
        <input type="password" name="password" placeholder="Senha">
        @if ($errors->any())
            <div class="error-message">
                @foreach ($errors->all() as $error)
                    <div style="color: red; margin-top: 5px;">{{ $error }}</div> <br>
                @endforeach
            </div>
        @endif
        <button type="submit" class="submit-btn">Cadastrar</button>
        <p><a href="{{ route('login.form') }}">Fazer login!</a></p>
    </form>
</div>

<script>
    document.querySelector('form').addEventListener('submit', function(event) {
        const emailField = event.target.querySelector('input[name="email"]');
        const email = emailField.value;
        if (!email.endsWith('@gmail.com')) {
            alert('Use apenas emails do Gmail.');
            event.preventDefault(); // Evita o envio do formulário
        }
    });
</script>