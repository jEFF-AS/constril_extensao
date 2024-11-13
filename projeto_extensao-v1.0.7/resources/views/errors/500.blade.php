<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Erro Interno do Servidor - 500</title>
    <link rel="stylesheet" href="{{ asset('css/error500.css') }}">
</head>
<body>
    <div class="container">
        <h1>Erro Interno do Servidor</h1>
        <p>Desculpe, ocorreu um erro inesperado em nosso servidor.</p>
        <p>Nossa equipe técnica foi notificada e está trabalhando para resolver o problema o mais rápido possível.</p>
        <p>Por favor, tente novamente mais tarde ou entre em contato com nosso suporte se o problema persistir.</p>
        <a href="{{ url('/') }}" class="btn">Voltar à Página Inicial</a>
    </div>
</body>
</html>