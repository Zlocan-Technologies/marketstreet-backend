<!DOCTYPE html>
<html lang="en-US">
<head>
    <meta charset="utf-8">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Comforter&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Dancing+Script&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Comfortaa:wght@500&display=swap" rel="stylesheet">
</head>
<body>

<div style="font-family: 'Dancing Script', cursive;">
    Hello {{ $user->firstname." ".$user->lastname }},
    <br>
    Please click on the link below or copy it into the address bar of your browser to reset your password:
    <br>
    <b>{{ $token }}</b>

    <br/>
    <a href="{{env('APP_URL')}}verify/reset/token/?email={{$user->email}}&token={{$token}}">Reset Password</a>
</div>

</body>
</html>
