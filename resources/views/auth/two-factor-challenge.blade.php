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
                        action="{{ url('two-factor-challenge') }}">
                        @csrf
                            <h4 class="mb-3">Two Factor Authentication</h4>
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
                                <label>Code</label>
                                <div class="input-group"><span class="input-group-text"><i class="icon-lock"></i></span>
                                    <input class="form-control" type="text" name="code"  id="code" required>
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