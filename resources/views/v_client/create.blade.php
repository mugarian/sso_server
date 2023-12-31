@extends('layouts.dashboard')
@section('container')
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Data Client</h1>
    @if (session()->has('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
    @if (session()->has('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="d-flex justify-content-between align-items-center">
                <h6 class="m-0 font-weight-bold text-primary">Form Tambah Data Client</h6>
            </div>
        </div>
        <div class="card-body">
            <form action="{{ route('passport.clients.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <div class="mb-3">
                        <label for="logo">Logo:</label>
                        <div class="d-flex align-items-start align-items-sm-center gap-4">
                            <img src="{{ asset('img') }}/unknown.png" alt="user-avatar"
                                class="d-block rounded img-preview mb-3" height="100" width="100"
                                id="uploadedAvatar" />
                        </div>
                        <input type="file" id="logo" name="logo"
                            class="form-control-file @error('logo') is-invalid @enderror" name="logo"
                            accept="image/png, image/jpeg" onchange="previewImage()" required>
                        @error('logo')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="name" class="col-form-label">Nama:</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                            name="name" value="{{ old('name') }}" required placeholder="Nama">
                        @error('name')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="login" class="col-form-label">Login Link:</label>
                        <input type="text" class="form-control @error('login') is-invalid @enderror" id="login"
                            name="login" value="{{ old('login') }}" required placeholder="http://example.com/sso/login">
                        @error('login')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="redirect" class="col-form-label">Redirect Callback Link:</label>
                        <input type="text" class="form-control @error('redirect') is-invalid @enderror" id="redirect"
                            name="redirect" value="{{ old('redirect') }}" required
                            placeholder="http://example.com/callback">
                        @error('redirect')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="dosen" class="col-form-label">Bisa Diakses Dosen:</label><br>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="dosen" id="0" value="0"
                                @checked(old('dosen') == 0)>
                            <label class="form-check-label" for="0">Tidak</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="dosen" id="1" value="1"
                                @checked(old('dosen') == 1)>
                            <label class="form-check-label" for="1">Ya</label>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="mahasiswa" class="col-form-label">Bisa Diakses Mahasiswa:</label><br>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="mahasiswa" id="0" value="0"
                                @checked(old('mahasiswa') == 0)>
                            <label class="form-check-label" for="0">Tidak</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="mahasiswa" id="1"
                                value="1" @checked(old('mahasiswa') == 1)>
                            <label class="form-check-label" for="1">Ya</label>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="staff" class="col-form-label">Bisa Diakses Staff:</label><br>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="staff" id="0" value="0"
                                @checked(old('staff') == 0)>
                            <label class="form-check-label" for="0">Tidak</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="staff" id="1" value="1"
                                @checked(old('staff') == 1)>
                            <label class="form-check-label" for="1">Ya</label>
                        </div>
                    </div>
                </div>
                <div class="my-3">
                    <button type="submit" class="btn btn-primary">Tambah</button>
                    <button type="reset" class="btn btn-secondary">Reset</button>
                </div>
            </form>
        </div>
    </div>
    <script>
        function previewImage() {
            const logo = document.querySelector('#logo');
            const imgPreview = document.querySelector('.img-preview');

            imgPreview.style.display = 'block';

            const oFReader = new FileReader();
            oFReader.readAsDataURL(logo.files[0]);

            oFReader.onload = function(oFREvent) {
                imgPreview.src = oFREvent.target.result;
            }
        }
    </script>
@endsection
