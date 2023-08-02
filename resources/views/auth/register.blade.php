{{-- @extends('layouts.app') --}}
@extends('layouts.portal')

{{-- @section('content') --}}
@section('container')
    {{-- <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Register') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('register') }}">
                            @csrf

                            <div class="row mb-3">
                                <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Name') }}</label>

                                <div class="col-md-6">
                                    <input id="name" type="text"
                                        class="form-control @error('name') is-invalid @enderror" name="name"
                                        value="{{ old('name') }}" required autocomplete="name" autofocus>

                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                            </div>
                            <div class="row mb-3">
                                <label for="username"
                                    class="col-md-4 col-form-label text-md-end">{{ __('Username') }}</label>

                                <div class="col-md-6">
                                    <input id="username" type="text"
                                        class="form-control @error('username') is-invalid @enderror" name="username"
                                        value="{{ old('username') }}" required autocomplete="username" autofocus>

                                    @error('username')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="email"
                                    class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                                <div class="col-md-6">
                                    <input id="email" type="email"
                                        class="form-control @error('email') is-invalid @enderror" name="email"
                                        value="{{ old('email') }}" required autocomplete="email">

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
                                        required autocomplete="new-password">

                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="password-confirm"
                                    class="col-md-4 col-form-label text-md-end">{{ __('Confirm Password') }}</label>

                                <div class="col-md-6">
                                    <input id="password-confirm" type="password" class="form-control"
                                        name="password_confirmation" required autocomplete="new-password">
                                </div>
                            </div>

                            <div class="row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Register') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}

    <div class="card o-hidden border-0 shadow-lg my-5">
        <div class="card-body p-0">
            <div class="card-title">
                <h1 class="h4 color_main mt-4 mx-4 mb-2 text-center">
                    Registrasi Akun SSO Polsub
                </h1>
                <p class="text-wrap text-center my-0 mx-4">Silahkan Lengkapi Data Berikut untuk Persyaratan
                    Mendaftarkan Akun SSO Polsub. <br> Akun akan terdaftar sebagai tamu, hingga terverifikasi oleh admin UPT
                    TIK
                </p>
                <hr>
                @if (session()->has('fail'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        {{ session('fail') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif
            </div>
            <!-- Nested Row within Card Body -->
            <form class="user" action="{{ route('register') }}" method="POST" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-lg-6 col-sm-12 layout_main">
                        <div class="px-4 py-2">
                            <div class="mb-2">
                                @csrf
                                <div class="mb-2">
                                    <label for="exampleFormControlSelect1">Role User:</label>
                                    <select class="form-control" id="exampleFormControlSelect1" name="role">
                                        <option value="dosen" @selected(old('role') == 'dosen')>Dosen</option>
                                        <option value="mahasiswa" @selected(old('role') == 'mahasiswa')>Mahasiswa</option>
                                        <option value="staff" @selected(old('role') == 'staf')>Staf</option>
                                    </select>
                                    @error('role')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="mb-2">
                                    <label for="major">Pilih Jurusan</label>
                                    <select class="form-control @error('major') is-invalid @enderror" id="major"
                                        name="major">
                                        <option value="mi" @selected(old('major') == 'mi')>Manajemen Informatika</option>
                                        <option value="ai" @selected(old('major') == 'ai')>Agroindustri</option>
                                        <option value="tppm" @selected(old('major') == 'tppm')>TPPM</option>
                                        <option value="kesehatan" @selected(old('major') == 'kesehatan')>Kesehatan</option>
                                        <option value="kepegawaian" @selected(old('major') == 'kepegawaian')>Kepegawaian</option>
                                    </select>
                                    @error('major')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="mb-2">
                                    <label for="name" class="col-form-label">Nama:</label>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror"
                                        id="name" name="name" value="{{ old('name') }}" required
                                        placeholder="Nama Depan">
                                    @error('name')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="mb-2">
                                    <label for="no_induk" class="col-form-label">Nomor Induk
                                        <small>(NIM/NIP/NIK)</small>:</label>
                                    <input type="number" class="form-control @error('no_induk') is-invalid @enderror"
                                        id="no_induk" name="no_induk" value="{{ old('no_induk') }}" required
                                        placeholder="Nama Induk">
                                    @error('no_induk')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="mb-2">
                                    <label for="no_hp" class="col-form-label">Nomor Handphone:</label><br>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon1">+62</span>
                                        </div>
                                        <input type="number" class="form-control @error('no_induk') is-invalid @enderror"
                                            placeholder="823456789" value="{{ old('no_induk') }}" required id="no_hp"
                                            name="no_hp">
                                    </div>
                                    @error('no_hp')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="mb-2">
                                    <label for="birthdate" class="col-form-label">Tanggal Lahir:</label>
                                    <input type="date" class="form-control @error('birthdate') is-invalid @enderror"
                                        id="birthdate" name="birthdate" value="{{ old('birthdate') }}" required>
                                    @error('birthdate')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="mb-2">
                                    <label for="address" class="col-form-label">Alamat:</label>
                                    <textarea id="address" class="form-control @error('address') is-invalid @enderror" placeholder="alamat" name="address"
                                        required>{{ old('address') }}</textarea>
                                    @error('address')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-sm-12 layout_main">
                        {{-- <div class="my-4"> --}}
                        <div class="px-4 py-2">
                            <div class="mb-2">
                                <label for="username" class="col-form-label">Username:</label>
                                <input type="text" class="form-control @error('username') is-invalid @enderror"
                                    id="username" name="username" value="{{ old('username') }}" required
                                    placeholder="Nama">
                                @error('username')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="mb-2">
                                <label for="email" class="col-form-label">Email:</label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror"
                                    id="email" name="email" value="{{ old('email') }}" required
                                    placeholder="email@example.com">
                                @error('email')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="mb-2">
                                <label for="password" class="col-form-label">Password:</label>
                                <input type="password" class="form-control @error('password') is-invalid @enderror"
                                    id="password" name="password" required placeholder="Password">
                                <small>Min. 8 Huruf (Kombinasi Huruf Besar, Kecil, Angka, dan Simbol)</small>
                                @error('password')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="mb-2">
                                <label for="password_confirmation" class="col-form-label">Konfirmasi Password:</label>
                                <input type="password"
                                    class="form-control @error('password_confirmation') is-invalid @enderror"
                                    id="password_confirmation" name="password_confirmation" required
                                    placeholder="Konfirmasi Password">
                                @error('password_confirmation')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="my-4">
                                <div class="mb-2">
                                    <label for="avatar">Foto Profil <small>(Opsional)</small>:</label>
                                    <img src="{{ asset('img') }}/unknown.png" alt="user-avatar"
                                        class="d-block rounded img-preview" height="100" width="100"
                                        id="avatar" />
                                    <br>
                                    <input type="file" accept="image/png, image/jpeg"
                                        class="form-control-file avatar @error('avatar') is-invalid @enderror"
                                        id="avatar" onchange="previewImage()" name="avatar">
                                    @error('avatar')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="mb-2">
                                <div class="mb-2">
                                    <label for="attachment">Foto Kartu Mahasiswa/Pegawai
                                        <small>(Opsional)</small>:</label>
                                    <img src="{{ asset('img') }}/unknown.png" alt="user-attachment"
                                        class="d-block rounded attachment-preview" height="100" width="100"
                                        id="attachment" />
                                    <br>
                                    <input type="file" accept="image/png, image/jpeg"
                                        class="form-control-file attachment @error('attachment') is-invalid @enderror"
                                        id="attachment" onchange="previewAttachment()" name="attachment">
                                    @error('attachment')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="mt-4">
                                {!! NoCaptcha::display() !!}
                                {!! NoCaptcha::renderJs() !!}
                                @error('g-recaptcha-response')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        {{-- </div> --}}
                    </div>
                </div>
                <div class="px-5 py-2 my-5">
                    <button class="btn btn-primary btn-block">
                        Registrasi
                    </button>
                    <hr />
                    <div class="text-center">
                        <a class="small" href="/login">Sudah Punya Akun? Login!</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <script>
        function previewImage() {
            const image = document.querySelector('.avatar');
            const imgPreview = document.querySelector('.img-preview');

            imgPreview.style.display = 'block';

            const oFReader = new FileReader();
            oFReader.readAsDataURL(image.files[0]);

            oFReader.onload = function(oFREvent) {
                imgPreview.src = oFREvent.target.result;
            }
        }

        function previewAttachment() {
            const image = document.querySelector('.attachment');
            const imgPreview = document.querySelector('.attachment-preview');

            imgPreview.style.display = 'block';

            const oFReader = new FileReader();
            oFReader.readAsDataURL(image.files[0]);

            oFReader.onload = function(oFREvent) {
                imgPreview.src = oFREvent.target.result;
            }
        }
    </script>
@endsection
