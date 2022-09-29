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
                        action="{{ route('password.update') }}">
                        @csrf
                            <h4 class="mb-3">Change Password</h4>
                            <div>
                                @if($errors->any())
                                    <div class="alert alert-danger">
                                        <ul>
                                            @foreach($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                            </div>
                            <div class="form-group">
                                <input class="form-control" type="text" name="email" value="{{auth()->user()->email}}">
                            </div>
                            <div class="form-group">
                                <label>Old Password</label>
                                <div class="input-group"><span class="input-group-text"><i class="icon-lock"></i></span>
                                    <input class="form-control" type="password" name="current_password" placeholder="*********">
                                </div>
                                @error('current_password')
                                    <span class="error">{{$message}}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>New Password</label>
                                <div class="input-group"><span class="input-group-text"><i class="icon-lock"></i></span>
                                    <input class="form-control" type="password" name="password" id="password" placeholder="*********">
                                    <div class="show-hide"><span class="" onclick="togglePassword()">                         </span></div>
                                </div>
                                @error('password')
                                    <span class="error">{{$message}}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Confirm New Password</label>
                                <div class="input-group"><span class="input-group-text"><i class="icon-lock"></i></span>
                                    <input class="form-control" type="password" name="confirm_password" placeholder="*********">
                                </div>
                                @error('confirm_password')
                                    <span class="error">{{$message}}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <button class="btn btn-primary btn-block" type="submit">Done                          </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection