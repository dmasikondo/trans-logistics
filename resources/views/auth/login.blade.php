@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h2>{{ __('Sign In') }}</h2>
                    <div class="feature-wrap justify-content-center d-flex">
                        <i class="fa fa-lock"></i>                          
                    </div>                     
                </div>


                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="form-group input-group">
                            <div class="input-group-prepend">
                               <span class="input-group-text"><i class="fa fa-envelope"></i></span> 
                            </div>                            
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autofocus>
                            <label for="email" class="floating-label">{{ __('E-Mail Address') }}</label>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                        <div class="form-group input-group">
                            <div class="input-group-prepend">
                               <span class="input-group-text"><i class="fa fa-key"></i></span> 
                            </div>                            
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" value="{{ old('email') }}" required autofocus>
                            <label for="password" class="floating-label">{{ __('Password') }}</label>

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                        <div class="form-group row">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <button class="btn btn-lg form-control btn-outline-info" type="submit"> <i class="fa fa-unlock-alt fa-lg"> </i> Login</button>
                        </div>  
                    </form>
                </div>
                <div class="card-footer">
                    @if (Route::has('password.request'))
                        <a class="btn btn-link" href="{{ route('password.request') }}">
                            {{ __('Forgot Your Password?') }}
                        </a>
                    @endif
                    <a href="/register" class="btn btn-link"> Already registered?</a>                            
                </div>                
            </div>
            </div>
        </div>
    </div>
@endsection
