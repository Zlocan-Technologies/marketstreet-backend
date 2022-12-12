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

<div>
    <div class="logo"><a href="/"><img src="https://thepeddleapp.com/assets/landing/images/logo-23.png" alt="" title=""></a></div>
    <br>
    <h3>Hi {{ $user->firstname." ".$user->lastname }}</h3>,
    <br>
    Thank you for creating an account with us at Peddle Limited. Verify your account to complete the registration!
    <br>
    Please click on the link below or copy it into the address bar of your browser to confirm your email address:
    <br>
    <h1><b>{{ $code }}</b></h1>

    <br/>
</div>

</body>
</html>
