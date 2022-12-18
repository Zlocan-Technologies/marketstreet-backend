@extends('layouts.app')


@section('content')

<div class="page-wrapper compact-wrapper" id="pageWrapper">

            <!-- Page Header Start-->
            @include('inc.header')
            <!-- Page Header Ends-->


            <!-- Page Body Start-->
            <div class="page-body-wrapper">


              <!-- Page Sidebar Start-->
              @include('inc.sidebar')
              <!-- Page Sidebar Ends-->



              <div id="page-body" class="page-body">
              
                <!-- Container-fluid starts-->
                @include('dashboard.ajaxpages.categories')

                <!-- Container-fluid Ends-->
              </div>
              <!-- footer start-->
              @include('inc.footer')
            </div>
          </div>
        
<style>
  .list-group .active {
    background-color: rgb(229 238 239) !important;
    border-left: 2px solid rgb(25, 164, 199) !important;
    color: black !important;
    transition: all 2s linear forwards;
  }
</style>
@endsection
