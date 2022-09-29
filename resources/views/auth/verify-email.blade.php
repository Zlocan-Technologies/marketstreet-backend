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
                        action="{{ url('email/verification-notification') }}">
                        @csrf
                            <div class="form-group">
                            <h4 class="mb-3 text-center">Email verification</h4>   
                            </div>
                            <div class="form-group">
                                <p>
                                    @if(session('status') == 'verification-link-sent')
                                        <span class="error">A new email verification link has been sent</span>
                                    @else
                                        <span class="error">An email verification link has been sent, please click on the link to verify your email address</span>
                                    @endif
                                </p>
                            </div>
                            <button type="submit" class="btn btn-primary">Resend</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection