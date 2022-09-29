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
                        action="{{ url('reset-password') }}">
                        @csrf
                            <h4 class="mb-3">Reset Your Password</h4>
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
                                <input class="form-control" type="hidden" name="token" required value="{{request()->route('token')}}">
                                <input class="form-control" type="hidden" name="email" required value="{{request()->email}}">
                            </div>
                            <div class="form-group">
                                <label>New Password</label>
                                <div class="input-group"><span class="input-group-text"><i class="icon-lock"></i></span>
                                    <input class="form-control" type="password" name="password"  id="password" required placeholder="*********">
                                    <div class="show-hide"><span class="" onclick="togglePassword()"></span></div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Confirm Password</label>
                                <div class="input-group"><span class="input-group-text"><i class="icon-lock"></i></span>
                                    <input class="form-control" type="password" name="password_confirmation" required placeholder="*********">
                                </div>
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