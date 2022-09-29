@extends('auth.layout.app')
@section('content')
<section>         
    <div class="container-fluid p-0"> 
        <div class="row m-0">
            <div class="col-12 p-0">    
                <div class="login-card">              
                    <div class="login-main"> 
                        Dashboard
                    <form class=""
                    method="POST" 
                    action="{{ route('logout') }}">
                    @csrf
                        <button type="submit" class="btn btn-primary">Logout</button>
                    </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection