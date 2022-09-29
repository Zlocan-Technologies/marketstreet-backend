@extends('auth.layout.app')
@section('content')
<section>         
    <div class="container-fluid p-0"> 
        <div class="row m-0">
            <div class="col-12 p-0">    
                <div class="login-card">
                    <form class="theme-form login-form" 
                    method="POST" 
                    action="{{ route('register') }}">
                    @csrf
                        <h4>Create your account</h4>
                        <h6>Enter your personal details to create account</h6>
                        <div class="form-group">
                            <label>First Name</label>
                            <div class="input-group"><span class="input-group-text"><i class="icon-user"></i></span>
                                <input class="form-control" type="text" require name="firstname" placeholder="First Name" value="{{old('firstname');}}">
                            </div>
                            @error('firstname')
                                <span class="error">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Last Name</label>
                            <div class="input-group"><span class="input-group-text"><i class="icon-user"></i></span>
                                <input class="form-control" type="text" require name="lastname" placeholder="Last Name" value="{{old('lastname');}}">
                            </div>
                            @error('lastname')
                                <span class="error">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Email Address</label>
                            <div class="input-group"><span class="input-group-text"><i class="icon-email"></i></span>
                                <input class="form-control" type="email" require name="email" placeholder="Test@gmail.com" value="{{old('email');}}">
                            </div>
                            @error('email')
                                <span class="error">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Phone</label>
                            <div class="input-group"><span class="input-group-text">+234</span>
                                <input class="form-control" type="text" name="phone" placeholder="*********" maxlength="10">
                            </div>
                            @error('phone')
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
                            <label>Confirm Password</label>
                            <div class="input-group"><span class="input-group-text"><i class="icon-lock"></i></span>
                                <input class="form-control" type="password" name="password_confirmation" require placeholder="*********">
                            </div>
                            @error('password_confirmation')
                                <span class="error">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <div class="input-group">
                                <input class="form-control" type="hidden" name="user_type" value="admin">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="checkbox">
                                <input id="checkbox1" type="checkbox" name="terms">
                                <label class="text-muted" for="checkbox1">Agree with <span>Privacy Policy                   </span></label>
                            </div>
                        </div>
                        <div class="form-group">
                            <button class="btn btn-primary btn-block" type="submit">Create Account</button>
                        </div>
                        
                        <p>Already have an account?<a class="ms-2" href="{{url('login')}}">Sign in</a></p>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection