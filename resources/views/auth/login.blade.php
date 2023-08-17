@extends('layouts.portal')
@section('container')
    <div class="card o-hidden border-0 shadow-lg my-5">
        <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row">
                <div class="col-lg-6 col-sm-12 {{ $tema->cover_main ? 'cover_main' : 'cover_default' }}">
                </div>
                <div class="col-lg-6 col-sm-12 layout_main">
                    <div class="px-5 py-4">
                        <div class="text-center">
                            <h1 class="h4 color_main mb-4">
                                Selamat Datang di Portal <br> Politeknik Negeri Subang!
                            </h1>
                            @if (session()->has('status'))
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    {{ session('status') }}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif
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
                            <form class="user" action="{{ route('login') }}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <input type="email"
                                        class="form-control form-control-user @error('email') is-invalid @enderror"
                                        id="email" name="email" placeholder="Enter Email Address..."
                                        value="{{ old('email') }}" required />
                                    @error('email')
                                        <div class="invalid-feedback text-center">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <input type="password" class="form-control form-control-user" id="password"
                                        name="password" placeholder="Password" required />
                                </div>
                                <div class="my-2">
                                    <center>
                                        <small>
                                            {!! NoCaptcha::display() !!}
                                        </small>
                                    </center>
                                    {!! NoCaptcha::renderJs() !!}
                                    @error('g-recaptcha-response')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="mt-2">
                                    <button class="btn btn-primary btn-user btn-block">
                                        Login
                                    </button>
                                    <a href="{{ route('connect') }}" class="btn btn-outline-primary btn-user btn-block">
                                        Login with Microsoft Account
                                    </a>
                                </div>
                            </form>
                        </div>
                        <hr />
                        <div class="text-center">
                            <a class="small" href="/register">Registrasi</a>
                            {{-- <a class="small" href="/password/reset">Lupa Password</a> --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="card o-hidden border-0 shadow-lg my-3">
        <div class="card-body p-3">
            <!-- Nested Row within Card Body -->
            <h1 class="h4 color_main text-center">
                Help Desk SSO Polsub!
            </h1>
            <hr>
            <div class="row">
                <div class="col-lg-6 col-sm-12">
                    <ol class="text-justify">
                        <li class="font-weight-bold">Layanan SSO Polsub</li>
                        <p>Sistem SSO Polsub merupakan website sentraliasasi login sistem-sistem Polsub
                            yang dibangun
                            untuk memudahkan <i>Civitas Akademica</i> Polsub dalam mengakses semua Sistem Polsub hanya
                            dengan satu kali login menggunakan satu akun. Sistem ini diperuntukkan bagi tenaga pendidik dan
                            kependidikan seperti staf, dosen dan mahasiswa yang berstatus aktif atau masih menjalankan
                            perkuliahan di Polsub.</p>
                        <li class="font-weight-bold">Daftar Akun</li>
                        <p>
                            Untuk Melakukan Login SSO Polsub, Anda harus terdaftar sebagai tenaga pendidik atau tenaga
                            kependidikan yang sudah terdata di Politeknik Negeri Subang. Atau bisa melakukan dengan
                            mendaftarkan diri pada link berikut:
                        </p>
                        <li class="font-weight-bold">Aktivasi Akun</li>
                        <p>
                            Setelah melakukan pendaftaran, akun masih berstatus tamu atau belum bisa mengakses sistem
                            Polsub. Diperlukannya verifikasi kembali akun oleh bagian UPT TIK. Lengkapi data yang diperlukan
                            dan Hubungi bagian UPT TIK untuk aktivasi akun.
                        </p>
                    </ol>
                </div>
                <div class="col-lg-6 col-sm-12 layout_main text-center">
                    <div class="font-weight-bold mb-3">Kontak UPT TIK</div>
                    <i class="fas fa-map-marker-alt"></i>
                    <b>Kampus 1:</b>
                    <p>
                        Jl. Brigjen Katamso No. 37 (Belakang RSUD Subang), Dangdeur, Kec. Subang, Kabupaten Subang, Jawa
                        Barat 41211
                    </p>
                    <i class="fas fa-map-marker-alt"></i>
                    <b>Kampus 2:</b>
                    <p>
                        Blok Kaleng Banteng Desa Cibogo, Subang
                    </p>
                    <i class="fas fa-phone"></i>
                    <b>Telephone:</b>
                    <p>
                        (0260) 417648
                    </p>
                    <i class="fas fa-envelope"></i>
                    <b>Email:</b>
                    <p>
                        info@polsub.ac.id
                    </p>
                    <i class="fas fa-mobile-alt"></i>
                    <b>Handphone:</b>
                    <p>
                        +62 852-7311-4129
                    </p>

                </div>
            </div>
        </div>
    </div>
@endsection
