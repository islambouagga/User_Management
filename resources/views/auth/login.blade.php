@extends('layouts.app')

@section('content')
    <main class="login-box">
{{--    <div class="login-logo">--}}
{{--        <a href="#"><b>Admin</b>LTE</a>--}}
{{--    </div>--}}
    <!-- /.login-logo -->
    <div class="card">
        <div class="card-body login-card-body">
            <h5 class="login-box-msg">Sign in to start your session</h5>

            <form action="{{ route('login') }}" method="post">
                @csrf
                <div class="input-group mb-3">
                    <input id="email"  placeholder="Email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>


                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-envelope"></span>
                        </div>
                    </div>
                    @error('email')
                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                    @enderror
                </div>
                <div class="input-group mb-3">
                    <input id="password" placeholder="Password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">


                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                        </div>
                    </div>
                    @error('password')
                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                    @enderror
                </div>
                <div class="row">
                    <div class="col-8">
                        <div class="icheck-primary">
{{--                            <input type="checkbox" id="remember">--}}
                            <input  type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                            <label for="remember">
                                Remember Me
                            </label>
                        </div>
                    </div>
                    <!-- /.col -->
                    <div class="col-4">
                        <button type="submit" class="btn btn-primary btn-block">Sign In</button>
                    </div>
                    <!-- /.col -->
                </div>
            </form>

            <div class="social-auth-links text-center mb-3">
                <p>- OR -</p>
                <a href="#" class="btn btn-block btn-primary" style="background-color: #0e76a8 ">
                    <i class="fab fa-linkedin mr-2"></i> Sign in using Linkedin
                </a>
                <a href="#" class="btn btn-block btn-secondary" style="background-color: black">
                    <i class="fab fa-github mr-2"></i> Sign in using Github
                </a>
                <a href="#" class="btn btn-block btn-danger" >
                    <i class="fab fa-google mr-2"></i> Sign in using Google
                </a>
                <a href="#" class="btn btn-block btn-primary" style="background-color: #1da1f2">
                    <i class="fab fa-twitter mr-2"></i> Sign in using Twitter
                </a>
                <a href="#" class="btn btn-block btn-primary" style="background-color: #3b5998">
                    <i class="fab fa-facebook mr-2"></i> Sign in using Facebook
                </a>



            </div>
            <!-- /.social-auth-links -->

            <p class="mb-1">
                @if (Route::has('password.request'))
                <a href="{{ route('password.request') }}">I forgot my password</a>
                @endif
            </p>
            <p class="mb-0">
                @if (Route::has('register'))
                <a href="{{ route('register') }}" class="text-center">Register a new membership</a>
                @endif
            </p>
        </div>
        <!-- /.login-card-body -->
    </div>
    </main>
@endsection
