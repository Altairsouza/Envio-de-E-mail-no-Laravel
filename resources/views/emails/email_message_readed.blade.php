<!DOCTYPE html>
<html >
<head>
    <meta charset="UTF-8">
</head>
<body>

    <h4>{{config('app.name')}}</h4>
    <p>O destinatário da messagem (<strong>{{$recipient_email}}) leu a mensagem.</strong>)</p>
   <p>A mensagem foi lida em :<strong>{{$datetime_readed}}</strong></p>
</body>
</html>
