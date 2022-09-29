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
                    <form class="" method="post" action="{{url('upload-ad-image')}}" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label><b>Upload Image</b></label>
                            <input class="form-control" name="photo" type="file" placeholder="">
                        </div>
                        @error('photo')
                            <span class="error">{{$message}}</span>
                        @enderror
                        <div class="mb-3">
                            <input class="btn btn-primary" type="submit" value="Submit">
                        </div>
                    </form>
                </div> 
            </div>
    

            <div class="col-xl-3 col-md-6 dash-xl-50">
                <div class="card yearly-chart">
                    <div class="card-header card-no-border pb-0">
                        <h5 class="pb-2">$3,500,000</h5>
                        <h6 class="font-theme-light f-14 m-0">November 2021</h6>
                    </div>
                    <div class="card-body pt-0">
                        <div> 
                            <div id="yearly-chart"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6 dash-xl-50">
            <div class="card bg-primary premium-access">
                <div class="card-body">                  
                <h6 class="f-22">Premium Access!</h6>
                <p>We add 20+ new features and update community in your project We add 20+ new features</p><a class="btn btn-outline-white_color" href="blog-single.html"> Try now for free</a>
                </div>
                <!-- Root element of PhotoSwipe. Must have class pswp.-->
                <div class="pswp" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="pswp__bg"></div>
                <div class="pswp__scroll-wrap">
                    <div class="pswp__container">
                    <div class="pswp__item"></div>
                    <div class="pswp__item"></div>
                    <div class="pswp__item"></div>
                    </div>
                    <div class="pswp__ui pswp__ui--hidden">
                    <div class="pswp__top-bar">
                        <div class="pswp__counter"></div>
                        <button class="pswp__button pswp__button--close" title="Close (Esc)"></button>
                        <button class="pswp__button pswp__button--share" title="Share"></button>
                        <button class="pswp__button pswp__button--fs" title="Toggle fullscreen"></button>
                        <button class="pswp__button pswp__button--zoom" title="Zoom in/out"></button>
                        <div class="pswp__preloader">
                        <div class="pswp__preloader__icn">
                            <div class="pswp__preloader__cut">
                            <div class="pswp__preloader__donut"></div>
                            </div>
                        </div>
                        </div>
                    </div>
                    <div class="pswp__share-modal pswp__share-modal--hidden pswp__single-tap">
                        <div class="pswp__share-tooltip"></div>
                    </div>
                    <button class="pswp__button pswp__button--arrow--left" title="Previous (arrow left)"></button>
                    <button class="pswp__button pswp__button--arrow--right" title="Next (arrow right)"></button>
                    <div class="pswp__caption">
                        <div class="pswp__caption__center"></div>
                    </div>
                    </div>
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
