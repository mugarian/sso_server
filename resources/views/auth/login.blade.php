{{-- @extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Login') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('login') }}">
                            @csrf

                            <div class="row mb-3">
                                <label for="email"
                                    class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                                <div class="col-md-6">
                                    <input id="email" type="email"
                                        class="form-control @error('email') is-invalid @enderror" name="email"
                                        value="{{ old('email') }}" required autocomplete="email" autofocus>

                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="password"
                                    class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                                <div class="col-md-6">
                                    <input id="password" type="password"
                                        class="form-control @error('password') is-invalid @enderror" name="password"
                                        required autocomplete="current-password">

                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-6 offset-md-4">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="remember" id="remember"
                                            {{ old('remember') ? 'checked' : '' }}>

                                        <label class="form-check-label" for="remember">
                                            {{ __('Remember Me') }}
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="row mb-0">
                                <div class="col-md-8 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Login') }}
                                    </button>

                                    @if (Route::has('password.request'))
                                        <a class="btn btn-link" href="{{ route('password.request') }}">
                                            {{ __('Forgot Your Password?') }}
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection --}}

@extends('layouts.portal')
@section('container')
    <!-- Nested Row within Card Body -->
    <div class="row">
        <div class="col-lg-6 col-sm-12 {{ $tema->cover_main ? 'cover_main' : 'cover_default' }}">
        </div>
        <div class="col-lg-6 col-sm-12 layout_main">
            <div class="p-5">
                <div class="text-center">
                    <h1 class="h4 color_main mb-4">
                        Selamat Datang di Portal <br> Politeknik Negeri Subang!
                    </h1>
                    @if (session()->has('fail'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            {{ session('fail') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif
                </div>
                <div class="my-4">
                    @if (session()->has('admin'))
                        <div class="text-center">
                            <h2 class="h6 color_main mb-4">
                                Form Login Untuk Admin
                            </h2>
                        </div>
                        <form class="user" action="{{ route('login') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <input type="email"
                                    class="form-control form-control-user @error('email') is-invalid @enderror"
                                    id="email" name="email" placeholder="Enter Email Address..."
                                    value="{{ old('email') }}" required />
                                @error('record')
                                    <div class="invalid-feedback text-center">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <input type="password" class="form-control form-control-user" id="password" name="password"
                                    placeholder="Password" required />
                            </div>
                            <div class="mt-4">
                                <button class="btn btn-primary btn-user btn-block">
                                    Login
                                </button>
                            </div>
                        </form>
                    @endif
                    <div class="my-5">
                        <a href="{{ route('connect') }}" class="btn btn-outline-primary btn-user btn-block">
                            Login with Microsoft Account
                        </a>
                    </div>
                </div>
                <hr />
                <div class="text-center">
                    <a class="small" href="/faq">FAQ!</a>
                </div>
            </div>
        </div>
    </div>
@endsection
