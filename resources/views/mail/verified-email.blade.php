<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h2>Welcome to our Website ,{{$name}}</h2>
    <p>
    please click <a href="{{ url('/signal-verify/'.$token) }}">click</a> the below link to verify account
    </p>

</body>
</html>