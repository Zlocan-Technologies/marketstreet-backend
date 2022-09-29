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
            

            
            <!-- Pending Artisans -->
            <div class="col-xl-12 col-lg-12 col-md-12 dash-35 dash-xl-50">
                <div class="card ongoing-project">
                    <div class="card-header card-no-border">
                        <div class="media media-dashboard">
                            <div class="media-body"> 
                                <h5 class="mb-0">User Details        </h5>
                            </div>
                            <div class="icon-box onhover-dropdown"><i data-feather="more-horizontal"></i>
                                <div class="icon-box-show onhover-show-div">
                                    <ul> 
                                    <li> <a>
                                            Done</a></li>
                                    <li> <a>
                                            Pending</a></li>
                                    <li> <a>
                                            Rejected</a></li>
                                    <li> <a>In Progress</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body pt-0">
                        <div class="table-responsive custom-scrollbar">
                            <table class="table table-bordernone">
                                <tbody> 
                                    <tr> 
                                        <th> <span>Id </span></th>
                                        <td>
                                            <div class="media">
                                                <div class="media-body ps-2">
                                                    <div class="avatar-details">
                                                        <h6>{{$user->id}}</h6>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr> 
                                        <th> <span>Name </span></th>
                                        <td>
                                            <div class="media">
                                                <div class="media-body ps-2">
                                                    <div class="avatar-details">
                                                        <h6>{{$user->firstname.' '.$user->lastname}}</h6>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr> 
                                        <th> <span>Email </span></th>
                                        <td>
                                            <div class="media">
                                                <div class="media-body ps-2">
                                                    <div class="avatar-details">
                                                        <h6>{{$user->email}}</h6>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Skill</th>
                                        <td class="img-content-box">
                                            <h6>{{$user->password}}</h6>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Phone</th>
                                        <td class="img-content-box">
                                            <span>{{$user->phone}}</span>
                                        </td>
                                    </tr>
                                </tbody>
                                
                            </table>
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
