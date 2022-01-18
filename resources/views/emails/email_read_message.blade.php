<!DOCTYPE html>
<html >
<head>
    <meta charset="UTF-8">
</head>
<body>

    <h4>{{config('app.name')}}</h4>
    <p>voce tem uma mensagem para ler em {{config('app.name')}}.</p>
    <p>IMPORTANTE: só vai poder ler a mensagem uma única vez !</p>
    <p><a href="{{route('main_read', ['purl' => $purl_code])}}">Ler mensagem</a></p>
</body>
</html>
