@extends('layouts.app')

@section('content')
<!-- login page start-->
<section>         </section>
<div class="container-fluid p-0">
  <div class="row">
    <div class="col-12">
      <div class="login-card">
        <form class="theme-form login-form" method="POST" action="{{ route('adminLoginPost') }}">
          @csrf
          <h4>Login</h4>
          <h6>Welcome back! Log in to your account.</h6>

          
          
          @if(\Session::get('error'))
              <h5 style="text-align: center; color:red">{{ \Session::get('error') }}</h5>
          @endif    

          {{--  email input  --}}
          <div class="form-group">
            <label for="email">Email Address</label>
            <div class="input-group"><span class="input-group-text"><i class="icon-email"></i></span>

              <input class="form-control @error('email') is-invalid @enderror"
              type="email" name="email" placeholder="Email"  value="{{ old('email') }}"
              required
               required autocomplete="email">

              @error('email')
              <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
              </span>
             @enderror

            </div>
          </div>
          {{--  email input ends  --}}


          <div class="form-group">
            <label for="password">Password</label>
            <div class="input-group"><span class="input-group-text"><i class="icon-lock"></i></span>
              <input type="password" name="password" placeholder="*********"
              class="form-control @error('password')
              is-invalid @enderror" name="password" required autocomplete="current-password">
              <div class="show-hide"><span class="show"></span></div>

                    @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                    @enderror
            </div>
          </div>



          <div class="form-group">
            <div class="checkbox">
              <input id="checkbox1" type="checkbox">
              <label for="checkbox1">Remember password</label>
            </div><a class="link" href=""></a>
          </div>
          <div class="form-group">
            <button class="btn btn-primary btn-block" type="submit">Sign in</button>
          </div>

          <div class="form-group">
          </div>

        </form>
      </div>
    </div>
  </div>
</div>

@endsection
