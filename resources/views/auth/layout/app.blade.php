<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="Zeta admin is super flexible, powerful, clean &amp; modern responsive bootstrap 5 admin template with unlimited possibilities.">
        <meta name="keywords" content="admin template, Zeta admin template, dashboard template, flat admin template, responsive admin template, web app">
        <meta name="author" content="pixelstrap">
        
        <title>Workpro admin dashboard </title>
        <link rel="icon" href="{{ asset('assets/images/logo/favicon-icon.png')}}" type="image/x-icon">
        <link rel="shortcut icon" href="{{ asset('assets/images/logo/favicon-icon.png')}}" type="image/x-icon">
        <!-- Google font-->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin="">
        <link href="https://fonts.googleapis.com/css2?family=Rubik:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,300;1,400;1,500;1,600;1,700;1,800;1,900&amp;display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&amp;display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Jost:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

        <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/font-awesome.css')}}">
        <!-- ico-font-->
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/icofont.css')}}">
        <!-- Themify icon-->
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/themify.css')}}">
        <!-- Flag icon-->
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/flag-icon.css')}}">
        <!-- Feather icon-->
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/feather-icon.css')}}">
        <!-- Plugins css start-->
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/sweetalert2.css')}}">
        <!-- Plugins css Ends-->
        <!-- Bootstrap css-->
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/bootstrap.css')}}">
        <!-- App css-->
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/style.css')}}">
        <link id="color" rel="stylesheet" href="{{ asset('assets/css/color-1.css')}}" media="screen">
        <!-- Responsive css-->
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/responsive.css')}}">
    </head>
    <body>
        <!-- Loader starts-->
        <!--<div class="loader-wrapper">
            <div class="loader">
                <div class="loader-bar"></div>
                <div class="loader-bar"></div>
                <div class="loader-bar"></div>
                <div class="loader-bar"></div>
                <div class="loader-bar"></div>
                <div class="loader-ball"></div>
            </div>
        </div>-->
        <!-- Loader ends-->

        @yield('content')
        
        <!-- latest jquery-->
        <script src="{{ asset('assets/js/jquery-3.5.1.min.js')}}"></script>
        <!-- Bootstrap js-->
        <script src="{{ asset('assets/js/bootstrap/bootstrap.bundle.min.js')}}"></script>
        <!-- feather icon js-->
        <script src="{{ asset('assets/js/icons/feather-icon/feather.min.js')}}"></script>
        <script src="{{ asset('assets/js/icons/feather-icon/feather-icon.js')}}"></script>
        <!-- scrollbar js-->
        <!-- Sidebar jquery-->
        <script src="{{ asset('assets/js/config.js')}}"></script>
        <!-- Plugins JS start-->
        <script src="{{ asset('assets/js/sweet-alert/sweetalert.min.js')}}"></script>
        <!-- Plugins JS Ends-->
        <!-- Theme js-->
        <script src="{{ asset('assets/js/script.js')}}"></script>
        <script>
            function togglePassword() {
                var toggle = document.getElementById("password");
                switch (true) {
                    case toggle.type === "password":
                        toggle.type = "text";
                        break;
                    default:
                        toggle.type = "password";
                }
            }
        </script>
        <!-- login js-->
        <!-- Plugin used-->
    </body>
</html>