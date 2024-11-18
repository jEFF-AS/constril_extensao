<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página não encontrada - Erro 404</title>
    <link rel="stylesheet" href="{{ asset('css/error404.css') }}">
</head>
<body>
    <div class="container">
        <h1>Oops! Página não encontrada</h1>
        <p>Desculpe, a página que você está procurando não existe ou foi movida.</p>
        <p>Verifique se o endereço foi digitado corretamente ou retorne à <a href="{{ url('/') }}">página inicial</a>.</p>
    </div>
</body>
</html>