<!DOCTYPE html>
<html>
<head>
    <title>Nouveau Message de Contact</title>
</head>
<body>
    <h1>Nouveau Message de Contact via MaliActes</h1>
    <p><strong>De:</strong> {{ $name }} ({{ $email }})</p>
    <p><strong>Sujet:</strong> {{ $subject }}</p>
    <hr>
    <p><strong>Message:</strong></p>
    <p>{{ $messageText }}</p>
    <hr>
    <p>Ceci est un message automatique, veuillez ne pas y répondre directement.</p>
</body>
</html>