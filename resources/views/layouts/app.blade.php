<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="keywords" content="">
    <meta name="author" content="pixelstrap">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" href="{{asset('assets/images/logo/web_log.jpg')}}" type="image/x-icon">
    <link rel="shortcut icon" href="{{asset('assets/images/logo/web_log.jpg')}}" type="image/x-icon">
    <title>MarketStreet</title>


    <!-- Google font-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin="">
    <link href="https://fonts.googleapis.com/css2?family=Rubik:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,300;1,400;1,500;1,600;1,700;1,800;1,900&amp;display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&amp;display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/vendors/font-awesome.css')}}">
    <!-- ico-font-->
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/vendors/icofont.css')}}">
    <!-- Themify icon-->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/themify.css')}}">
    <!-- Flag icon-->
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/vendors/flag-icon.css')}}">
    <!-- Feather icon-->
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/vendors/feather-icon.css')}}">
    <!-- Plugins css start-->
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/vendors/scrollbar.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/vendors/animate.css')}}">
    
    <link rel="stylesheet" type="text/css" href="../assets/css/vendors/daterange-picker.css">

    
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/vendors/photoswipe.css')}}">
    <!-- Plugins css Ends-->
    <link
      rel="stylesheet"
      type="text/css"
      href="{{ asset('assets/css/vendors/sweetalert2.css') }}"
    />
    
    <!-- Bootstrap css-->
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/vendors/bootstrap.css')}}">
    <!-- App css-->
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/style.css')}}">

    <link id="color" rel="stylesheet" href="{{asset('assets/css/color-1.css" media="screen')}}">
    <!-- Responsive css-->
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/responsive.css')}}">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/.0/css/font-awesome.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>  

    <style>
      .page-wrapper.compact-wrapper .page-body-wrapper div.sidebar-wrapper .sidebar-main .simplebar-offset {
        height: calc(100vh - 150px) !important;
    }
    </style>
  </head>


  <body>
    
    <!--loader-->
    <div id="page-loader" class="loader-wrapper" style="opacity: 0.7">
        <div class="loader" style="opacity: 0.7">
          <div class="loader-box">
           <div class="loader-19"style="border-width: 5px;"></div>
          </div>
      </div>
    </div>

        <main id="main">
    <!-- page-wrapper Start-->
          @yield('content')
        </main>
  
  </body>


  <script src="{{ asset('js/main.js') }}"></script>
  <script>

  //if page is loaded remove loader
    let pageLoaded = setInterval(() => {
      if(document.readyState === 'complete'){
          document.getElementById('page-loader').style.display='none';
          clearInterval(pageLoaded);
      }
    }, 200);


    window.onhashchange =  function() {
        changeState(location.href);
    };
      
  </script>
<!-- latest jquery-->

<script src="{{asset('assets/js/jquery-3.5.1.min.js')}}"></script>
<!-- Bootstrap js-->
<script src="{{asset('assets/js/bootstrap/bootstrap.bundle.min.js')}}"></script>
<!-- feather icon js-->
<script src="{{asset('assets/js/icons/feather-icon/feather.min.js')}}"></script>
<script src="{{asset('assets/js/icons/feather-icon/feather-icon.js')}}"></script>
<!-- scrollbar js-->
<script src="{{asset('assets/js/scrollbar/simplebar.js')}}"></script>
<script src="{{asset('assets/js/scrollbar/custom.js')}}"></script>
<!-- Sidebar jquery-->
<script src="{{asset('assets/js/config.js')}}"></script>
<!-- Plugins JS start-->
<script src="{{asset('assets/js/sidebar-menu.js')}}"></script>

<script src="{{asset('assets/js/notify/bootstrap-notify.min.js')}}"></script>



<script src="{{ asset('assets/js/datepicker/daterange-picker/moment.min.js') }}"></script>
<script src="{{ asset('assets/js/datepicker/daterange-picker/daterangepicker.js') }}"></script>
<script src="{{ asset('assets/js/datepicker/daterange-picker/daterange-picker.custom.js') }}"></script>

<script src="{{asset('assets/js/photoswipe/photoswipe.min.js')}}"></script>
<script src="{{asset('assets/js/photoswipe/photoswipe-ui-default.min.js')}}"></script>
<script src="{{asset('assets/js/photoswipe/photoswipe.js')}}"></script>
<script src="{{asset('assets/js/typeahead/handlebars.js')}}"></script>
<script src="{{asset('assets/js/typeahead/typeahead.bundle.js')}}"></script>
<script src="{{asset('assets/js/typeahead/typeahead.custom.js')}}"></script>
<script src="{{asset('assets/js/typeahead-search/handlebars.js')}}"></script>
<script src="{{asset('assets/js/typeahead-search/typeahead-custom.js')}}"></script>
<script src="{{asset('assets/js/height-equal.js')}}"></script>

<script src="{{ asset('js/sweetalert2.js')}}"></script>
<script src="{{ asset('js/axios.js')}}"></script>

<script src= "{{ asset('js/category.js')}}"></script>
<script src= "{{ asset('js/banner.js')}}"></script>
<script src= "{{ asset('js/coupon.js')}}"></script>
<script src= "{{ asset('js/user.js')}}"></script>
<script src= "{{ asset('js/order.js')}}"></script>
<script src= "{{ asset('js/settings.js')}}"></script>

<div id="reloadedScripts">
    <script async src="https://cdn.jsdelivr.net/npm/chart.js@3.9.1/dist/chart.min.js"></script>
    <script async src="{{ asset('js/dashboardchart.js')}}"></script>

    
    <script src="{{ asset('assets/js/editor/ckeditor/adapters/jquery.js') }}"></script>
    <script src="{{ asset('assets/js/editor/ckeditor/ckeditor.js')}}"></script>
    <script src="{{ asset('assets/js/editor/ckeditor/styles.js')}}"></script>
    <script src="{{ asset('assets/js/editor/ckeditor/ckeditor.custom.js')}}"></script>
    <script src="{{ asset('assets/js/email-app.js') }}"></script>
</div>

</body>
</html>
