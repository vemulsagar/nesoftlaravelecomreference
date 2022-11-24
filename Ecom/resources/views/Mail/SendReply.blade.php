<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <div class="container">
        Dear {{ $name }}

        <p>We have received your email.</p>
        <p>{{ $msg }}</p>

        <span>Regards</span>
    </div>

</body>

</html>
