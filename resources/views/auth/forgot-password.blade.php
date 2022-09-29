@extends('auth.layout.app')
@section('content')
<section>         
    <div class="container-fluid p-0"> 
        <div class="row m-0">
            <div class="col-12 p-0">    
                <div class="login-card">              
                    <div class="login-main"> 
                        <form class="theme-form login-form"
                        method="POST" 
                        action="{{ url('forgot-password') }}">
                        @csrf
                            <h4 class="mb-3">Reset Your Password</h4>
                            <div class="form-group">
                                <p>
                                    @if(session('status'))
                                        <span class="error">{{session('status')}}</span>
                                    @endif
                                </p>
                            </div>
                            <div class="form-group">
                                <label>Email Address</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="icon-email"></i></span>
                                    <input class="form-control" type="email" required name="email" placeholder="Test@gmail.com">
                                </div>
                                @error('email')
                                    <span class="error">{{$message}}</span>
                                @enderror   
                            </div>
                            <div class="form-group">
                                <button class="btn btn-primary btn-block" type="submit">Done</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection