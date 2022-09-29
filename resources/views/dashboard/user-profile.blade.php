@extends('dashboard.layout.app')
@section('content')  
<!-- tap on top starts-->
<div class="tap-top"><i data-feather="chevrons-up"></i></div>
<!-- tap on tap ends-->
<!-- page-wrapper Start-->
<div class="page-wrapper compact-wrapper" id="pageWrapper">
<!-- Page Header Start-->
    @include('dashboard.layout.header')
<!-- Page Header Ends -->
    <!-- Page Body Start-->
    <div class="page-body-wrapper">
    <!-- Page Sidebar Start-->
        @include('dashboard.layout.sidebar')
    <!-- Page Sidebar Ends-->
    <div class="page-body">
        <div class="container-fluid">        
        <div class="page-title">
            <div class="row">
            <div class="col-12 col-sm-6">
                <h3>Default</h3>
            </div>
            <div class="col-12 col-sm-6">
                <ol class="breadcrumb">
                <li class="breadcrumb-item"> <a class="home-item" href="/dashboard"><i data-feather="home"></i></a></li>
                <li class="breadcrumb-item"> Dashboard</li>
                <li class="breadcrumb-item active"> Default</li>
                </ol>
            </div>
            </div>
        </div>
        </div>
        <!-- Container-fluid starts-->
        <div class="container-fluid default-dash">
        <div class="row"> 
            <div class="col-xl-6 col-md-6 dash-xl-50">
                <div class="card profile-greeting">
                    <div class="card-body">
                        <div class="media">
                            <div class="media-body"> 
                                <div class="greeting-user">
                                    <h1>Hello, {{$admin->firstname.' '.$admin->lastname}}</h1>
                                    <p>Welcome back, your dashboard is ready!</p><a class="btn btn-outline-white_color" href="blog-single.html">Get Started<i class="icon-arrow-right">                           </i></a>
                                </div>
                            </div>
                        </div>
                        <div class="cartoon-img"><img class="img-fluid" src="../assets/images/images.svg" alt=""></div>
                    </div>
                </div>
            </div>
            
            

            <div class="col-xl-3 col-md-6 dash-xl-50 crypto-dash pb-4">
                <div class="">
                    <h3>Personal Information</h3>
                    <p>Basic info, like your name and address, that you use on Nio Platform.</p>
                </div>
                <div class="">
                    <h3>Security Settings</h3>
                    <p>These settings are helps you keep your account secure.</p>
                    <div class="">
                        <div class="bg-white row pt-2 pb-2">
                            <div class="">
                                <h4>Save my Activity Logs</h4>
                                <p>You can save your all activity logs including unusual activity detected.</p>
                            </div>
                            <div class="">
                                <label class="switch">
                                    <input type="checkbox"><span class="switch-state"></span>
                                </label>
                            </div>
                        </div>
                        <div class="bg-white row pt-2 pb-2">
                            <div class="">
                                <h4>Change Password</h4>
                                <p>Set a unique password to protect your account.</p>
                            </div>
                            <div class="">
                                <div class="form-group">
                                    <a href="" class="btn btn-primary btn-block">Change Password</a>
                                </div>
                            </div>
                        </div>
                        <div class="bg-white row pt-3 pb-2">
                            <div class="">
                                <h4>2 Factor Auth 
                                    <span class="badge  
                                        <?php 
                                            if(auth()->user()->two_factor_confirmed_at):
                                                echo 'badge-light-primary';
                                            else:
                                                echo 'badge-light-secondary';
                                            endif;
                                        ?>
                                    ">
                                        <?php 
                                        if(auth()->user()->two_factor_confirmed_at):
                                            echo 'Enabled';
                                        else:
                                            echo 'Disabled';
                                        endif;
                                        ?>
                                    </span>
                                </h4>
                                <p>Secure your account with 2FA security. When it is activated you will need to enter not only your password, but also a special code using app. You can receive this code by in mobile app.</p>
                            </div>
                            @if(auth()->user()->two_factor_confirmed_at)
                                <form method="POST" 
                                action="{{ url('user/two-factor-authentication') }}">
                                    @csrf
                                    <div class="form-group">
                                        <button class="btn btn-primary btn-block" type="submit">Disable                        </button>
                                    </div>
                                </form>
                            @elseif(auth()->user()->two_factor_secret)
                                <p>Validate 2FA by scanning the following QRcode and entering the TOTP</p>
                                <div>
                                    {!! auth()->user()->twoFactorQrCodeSvg() !!}
                                </div>
                                <form method="POST" action="{{url('user/confirmed-two-factor-authentication')}}">
                                    @csrf
                                    <div class="form-group">
                                        <div class="input-group"><span class="input-group-text"><i class="icon-user"></i></span>
                                            <input class="form-control" type="text" required name="code" placeholder="Enter your code here">
                                        </div>
                                    </div>
                                    <button class="btn btn-primary btn-block" type="submit">Validate 2FA                        </button>
                                </form>
                            @else
                                <form method="POST" action="{{ url('user/two-factor-authentication') }}">
                                    @csrf
                                    <div class="form-group">
                                        <button class="btn btn-primary btn-block" type="submit">Enable 2FA                       </button>
                                    </div>
                                </form>
                            @endif
                        </div>
                    </div>
                </div> 
            </div>
            
        </div>
        </div>
        <!-- Container-fluid Ends-->
    </div>
    <!-- footer start-->
    <footer class="footer">
        <div class="container-fluid">
        <div class="row">
            <div class="col-md-12 footer-copyright text-center">
            <p class="mb-0">Copyright 2022 © Zeta theme by pixelstrap  </p>
            </div>
        </div>
        </div>
    </footer>
    </div>
</div>
@endsection
