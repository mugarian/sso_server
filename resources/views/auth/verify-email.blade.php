@extends('layouts.portal')

@section('container')
    <div class="card o-hidden border-0 shadow-lg my-5">
        <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            {{-- <div class="row"> --}}
            <div class="p-5 text-center">
                <h1 class="h4 color_main mb-4">
                    Verifikasi Email Akun
                </h1>
                <hr>
                @if (session()->has('message'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('message') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif
                <h5 class="color_main my-4">
                    Selamat Datang, {{ auth()->user()->name }}!
                </h5>
                <p>Link Verifikasi telah dikirim melalui email yang didaftarkan. Jika email yang dimaksud tidak ada,<br>
                    Klik tombol di bawah ini untuk mengirim ulang Email Link Verifikasi. </p>
                <form class="d-inline" method="POST" action="{{ route('verification.send') }}">
                    @csrf
                    <button type="submit"
                        class="btn btn-info align-baseline">{{ __('Kirim Ulang Email Link Verifikasi') }}</button>.
                </form>
                <div class="mt-5">
                    <form action="/logout" method="post">
                        @csrf
                        <button type="submit" class="btn btn-sm btn-link">
                            Logout SSO
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    {{-- <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Verify Your Email Address') }}</div>

                    <div class="card-body">
                        @if (session('resent'))
                            <div class="alert alert-success" role="alert">
                                {{ __('A fresh verification link has been sent to your email address.') }}
                            </div>
                        @endif

                        {{ __('Before proceeding, please check your email for a verification link.') }}
                        {{ __('If you did not receive the email') }},
                        <form class="d-inline" method="POST" action="{{ route('verification.send') }}">
                            @csrf
                            <button type="submit"
                                class="btn btn-link p-0 m-0 align-baseline">{{ __('click here to request another') }}</button>.
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}
@endsection
