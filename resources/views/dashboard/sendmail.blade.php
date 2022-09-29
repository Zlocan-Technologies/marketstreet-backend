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
                
                

                <div class="col-xl-3 col-md-6 dash-xl-50 crypto-dash">
                    <div class="">
                        <form class="" method="post" action="" enctype="multipart/form-data">
                            @csrf
                            <h4>Send Mails</h4>
                            <div class="form-group">
                                <label>Subject</label>
                                <div class="input-group">
                                    <textarea class="form-control" type="subject" id="subject" name="subject"></textarea>
                                </div>
                                @error('subject')
                                    <span class="error">{{$message}}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Body</label>
                                    <input class="form-control" type="text" id="body" name="body">
                                </div>
                                @error('body')
                                    <span class="error">{{$message}}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Email Address</label>
                                <div class="input-group"><span class="input-group-text"><i class="icon-email"></i></span>
                                    <input class="form-control" type="email" id="email" name="email" placeholder="Test@gmail.com" value="{{old('email');}}">
                                </div>
                                @error('email')
                                    <span class="error">{{$message}}</span>
                                @enderror
                            </div>
                            <div class="mb-3 pt-3">
                                <input class="btn btn-primary" type="submit" value="Submit">
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
