@extends('auth.layout.app')
@section('content')
<div class="container-fluid p-0">
    <div class="row">
        <div class="col-12">
            <div class="login-card">
                <form class="theme-form login-form"
                method="POST" 
                action="{{ route('login') }}">
                @csrf
                    <h4>Login</h4>
                    @if (session('status'))
                        <div class="mb-4 font-medium text-sm text-green-600">
                            {{ session('status') }}
                        </div>
                    @endif
                    <input type="hidden" name="role_id" value="3">
                    <div class="form-group">
                        <label>Email Address</label>
                        <div class="input-group"><span class="input-group-text"><i class="icon-email"></i></span>
                            <input class="form-control" type="email" required name="email" placeholder="Test@gmail.com">
                        </div>
                        @error('email')
                            <span class="error">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Password</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="icon-lock"></i></span>
                            <input class="form-control" type="text" name="password"  id="password" required placeholder="*********">
                            <div class="show-hide"><span class="" onclick="togglePassword()"></span></div>
                        </div>
                        @error('password')
                            <span class="error">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <div class="checkbox">
                            <input id="checkbox1" type="checkbox" name="remember">
                            <label for="checkbox1">Remember password</label>
                        </div>
                        <a class="link" href="{{url('forgot-password')}}">Forgot password?</a>
                    </div>
                    <div class="form-group">
                        <button class="btn btn-primary btn-block" type="submit">Sign in</button>
                    </div>
                    <!--<div class="login-social-title">                
                        <h5>Sign in with</h5>
                    </div>
                    <div class="form-group">
                        <ul class="login-social">
                            <li><a href="https://www.linkedin.com" target="_blank"><i data-feather="linkedin"></i></a></li>
                            <li><a href="https://twitter.com" target="_blank"><i data-feather="twitter"></i></a></li>
                            <li><a href="https://www.facebook.com" target="_blank"><i data-feather="facebook"></i></a></li>
                            <li><a href="https://www.instagram.com" target="_blank"><i data-feather="instagram"></i></a></li>
                        </ul>
                    </div>-->
                    <p>Don't have account?<a class="ms-2" href="{{url('register')}}">Create Account</a></p>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection