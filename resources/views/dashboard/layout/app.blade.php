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
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/scrollbar.css')}}">
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/animate.css')}}">
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/date-picker.css')}}">
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/photoswipe.css')}}">
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

        @yield('content')
        
        <!-- latest jquery-->
        <script src="{{ asset('assets/js/jquery-3.5.1.min.js')}}"></script>
        <!-- Bootstrap js-->
        <script src="{{ asset('assets/js/bootstrap/bootstrap.bundle.min.js')}}"></script>
        <!-- feather icon js-->
        <script src="{{ asset('assets/js/icons/feather-icon/feather.min.js')}}"></script>
        <script src="{{ asset('assets/js/icons/feather-icon/feather-icon.js')}}"></script>
        <!-- scrollbar js-->
        <script src="{{ asset('assets/js/scrollbar/simplebar.js')}}"></script>
        <script src="{{ asset('assets/js/scrollbar/custom.js')}}"></script>
        <!-- Sidebar jquery-->
        <script src="{{ asset('assets/js/config.js')}}"></script>
        <!-- Plugins JS start-->
        <script src="{{ asset('assets/js/sidebar-menu.js')}}"></script>
        <script src="{{ asset('assets/js/chart/knob/knob.min.js')}}"></script>
        <script src="{{ asset('assets/js/chart/knob/knob-chart.js')}}"></script>
        <script src="{{ asset('assets/js/chart/apex-chart/apex-chart.js')}}"></script>
        <script src="{{ asset('assets/js/chart/apex-chart/stock-prices.js')}}"></script>
        <script src="{{ asset('assets/js/notify/bootstrap-notify.min.js')}}"></script>
        <script src="{{ asset('assets/js/dashboard/default.js')}}"></script>
        <script src="{{ asset('assets/js/notify/index.js')}}"></script>
        <script src="{{ asset('assets/js/datepicker/date-picker/datepicker.js')}}"></script>
        <script src="{{ asset('assets/js/datepicker/date-picker/datepicker.en.js')}}"></script>
        <script src="{{ asset('assets/js/datepicker/date-picker/datepicker.custom.js')}}"></script>
        <script src="{{ asset('assets/js/photoswipe/photoswipe.min.js')}}"></script>
        <script src="{{ asset('assets/js/photoswipe/photoswipe-ui-default.min.js')}}"></script>
        <script src="{{ asset('assets/js/photoswipe/photoswipe.js')}}"></script>
        <script src="{{ asset('assets/js/typeahead/handlebars.js')}}"></script>
        <script src="{{ asset('assets/js/typeahead/typeahead.bundle.js')}}"></script>
        <script src="{{ asset('assets/js/typeahead/typeahead.custom.js')}}"></script>
        <script src="{{ asset('assets/js/typeahead-search/handlebars.js')}}"></script>
        <script src="{{ asset('assets/js/typeahead-search/typeahead-custom.js')}}"></script>
        <script src="{{ asset('assets/js/height-equal.js')}}"></script>
        <!-- Plugins JS Ends-->
        <!-- Theme js-->
        <script src="{{ asset('assets/js/script.js')}}"></script>
        <script src="{{ asset('assets/js/theme-customizer/customizer.js')}}"></script>
        <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
        <script type = "text/javascript">
            document.getElementById('create-admin').addEventListener("submit", (event) => {
                event.preventDefault();
                const form = event.target;
                $('.error').text('');
                let formData = {
                    firstname: document.getElementById('firstname').value,
                    lastname: document.getElementById('lastname').value,
                    email: document.getElementById('email').value,
                    password: document.getElementById('password').value,
                    phone: document.getElementById('phone').value,
                    password_confirmation: document.getElementById('confirmpassword').value,
                    user_type: document.getElementById('user_type').value,
                    _token: document.getElementById('token').value
                };
                const url = form.action;
                const config = {
                    headers: {
                        Accept: 'application/json',
                        responseType: 'json'
                    }
                };
                axios.post(url,
                    formData,
                    config,
                )
                .then(function(response){
                    data = JSON.stringify(response.data);
                    document.getElementById('alertId').classList.remove('d-none');
                })
                .catch(function(error){
                    error = error.response.data;
                    if(error.error.firstname){
                        document.getElementsByClassName('error')[0].innerHTML = error.error.firstname[0];
                    }
                    if(error.error.lastname){
                        document.getElementsByClassName('error')[1].innerHTML = error.error.lastname[0];
                    }
                    if(error.error.email){
                        document.getElementsByClassName('error')[2].innerHTML = error.error.email[0];
                    }
                    if(error.error.password){
                        document.getElementsByClassName('error')[3].innerHTML = error.error.password[0];
                    }
                    if(error.error.password_confirmation){
                        document.getElementsByClassName('error')[4].innerHTML = error.error.password_confirmation[0];
                    }
                    if(error.error.phone){
                        document.getElementsByClassName('error')[5].innerHTML = error.error.phone[0];
                    }
                });
            });
        </script>
        <script>
            document.getElementById('banner-upload-form').addEventListener("submit", (event) => {
                event.preventDefault();
                $('.error').text('');
                let formData = {
                    photo: document.getElementById('photo').value,
                    _token: document.getElementById('token').value
                };
                const url = 'http://127.0.0.1:8000/api/v1/admin/upload-ad-image/';
                const config = {
                    headers: {
                        Accept: 'application/json',
                        responseType: 'json',
                        'Content-Type': 'multipart/form-data'
                    }
                };
                axios.post(url,
                    formData,
                    config,
                )
                .then(function(response){
                    data = JSON.stringify(response.data);
                    document.getElementById('eject').innerHTML = data;
                    document.getElementById('alertId').classList.remove('d-none');
                })
                .catch(function(error){
                    error = error.response.data;
                    document.getElementById('eject').innerHTML = JSON.stringify(error);
                    if(error.error.photo){
                        document.getElementsByClassName('error')[0].innerHTML = error.error.photo[0];
                    }
                });
            });
        </script>
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