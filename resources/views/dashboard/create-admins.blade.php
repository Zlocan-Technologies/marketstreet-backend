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
                <div id="alertId" class="d-none">
                    <div class="alert alert-primary dark" role="alert">
                        <p>A new sub admin has been created!!!</p>
                    </div>
                </div>
                <div class="">
                    <form method="post" id="create-admin" action="{{url('/api/v1/auth/create-admin/')}}">
                        <input type="hidden" name="_token" id="token" value="{{csrf_token()}}">
                        <h4>Create Admins</h4>
                        <h6>Enter the personal details to create account</h6>
                        <div class="form-group">
                            <label>First Name</label>
                            <div class="input-group"><span class="input-group-text"><i class="icon-user"></i></span>
                                <input class="form-control" type="text" id="firstname" placeholder="First Name">
                            </div>
                            <span class="error"></span>
                        </div>
                        <div class="form-group">
                            <label>Last Name</label>
                            <div class="input-group"><span class="input-group-text"><i class="icon-user"></i></span>
                                <input class="form-control" type="text" id="lastname" placeholder="Last Name">
                            </div>
                            <span class="error"></span>
                        </div>
                        <div class="form-group">
                            <label>Email Address</label>
                            <div class="input-group"><span class="input-group-text"><i class="icon-email"></i></span>
                                <input class="form-control" type="email" id="email" placeholder="Test@gmail.com">
                            </div>
                            <span class="error"></span>
                        </div>
                        <div class="form-group">
                            <label>Password</label>
                            <div class="input-group"><span class="input-group-text"><i class="icon-lock"></i></span>
                                <input class="form-control" type="password" id="password" placeholder="*********">
                                <div class="show-hide"><span class="" onclick="togglePassword()">                         </span></div>
                            </div>
                            <span class="error"></span>
                        </div>
                        <div class="form-group">
                            <label>Confirm Password</label>
                            <div class="input-group"><span class="input-group-text"><i class="icon-lock"></i></span>
                                <input class="form-control" type="password" id="confirmpassword" placeholder="*********">
                                <div class="show-hide"><span class="show">                         </span></div>
                            </div>
                            <span class="error"></span>
                        </div>
                        <div class="form-group">
                            <label>Phone</label>
                            <div class="input-group"><span class="input-group-text">+234</span>
                                <input class="form-control" type="text" id="phone" placeholder="*********" maxlength="10">
                            </div>
                            <span class="error"></span>
                        </div>
                        <div class="form-group">
                            <div class="input-group">
                                <input class="form-control" type="hidden" id="user_type" value="admin">
                            </div>
                        </div>
                        
                        <div class="form-group pt-4">
                            <button class="btn btn-primary btn-block" type="submit">Create Account</button>
                        </div>
                    </form>
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
