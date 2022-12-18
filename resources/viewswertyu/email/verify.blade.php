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
    Hi {{ $user->firstname." ".$user->lastname }} ,
    <br>
    Thank you for creating an account with us at Workpro. Verify your account to complete the registration!
    <br>
    Please click on the link below or copy it into the address bar of your browser to confirm your email address:
    <br>
    <b>{{ $code }}</b>

    <br/>
</div>

</body>
</html>
