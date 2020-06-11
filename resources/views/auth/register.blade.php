@extends('layouts.app')

@section('content')

    <main class="register-box">
{{--        <div class="register-logo">--}}
{{--            <a href="#"><b>Admin</b>LTE</a>--}}
{{--        </div>--}}

        <div class="card">
            <div class="card-body register-card-body">
                <h5 class="login-box-msg">Register a new membership</h5>

                <form action="{{ route('register') }}" method="post">
                    @csrf
                    <div class="input-group mb-3">
                        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus placeholder="Full name">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-user"></span>
                            </div>
                        </div>
                        @error('name')
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror
                    </div>
                    <div class="input-group mb-3">
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="Email">
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
                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password"   placeholder="Password">
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
                    <div class="input-group mb-3">
                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password" placeholder="Retype password">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                         <!-- /.col -->
                        <div class="col-4">
                            <button type="submit" style="margin-left: 270%" class="btn btn-primary btn-block">Register</button>
                        </div>
                        <!-- /.col -->
                    </div>
                </form>

                <div class="social-auth-links text-center">
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

                <a href="{{route('login')}}" class="text-center">I already have a membership</a>
            </div>
            <!-- /.form-box -->
        </div><!-- /.card -->
    </main>

@endsection
