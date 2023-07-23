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
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="d-flex justify-content-between align-items-center">
                <h6 class="m-0 font-weight-bold text-primary">Form Ubah Data Client</h6>
            </div>
        </div>
        <div class="card-body">
            <form action="{{ route('passport.clients.update', ['client_id' => $client->id]) }}" method="POST"
                enctype="multipart/form-data">
                @csrf
                @method('put')
                <div class="form-group">
                    <div class="mb-3">
                        <div class="d-flex align-items-start align-items-sm-center gap-4">
                            @if ($client->logo)
                                <input type="hidden" name="oldLogo" value="{{ $client->logo }}">
                                <img src="{{ asset('storage') . '/' . $client->logo }}" alt="user-avatar"
                                    class="d-block rounded img-preview mb-2" height="100" width="100"
                                    id="uploadedAvatar" />
                            @else
                                <img src="{{ asset('img') }}/logo.png" alt="user-avatar"
                                    class="d-block rounded img-preview mb-2" height="100" width="100"
                                    id="uploadedAvatar" />
                            @endif
                        </div>
                        <label for="exampleFormControlFile1">Logo:</label>
                        <input type="file" id="logo" name="logo"
                            class="form-control-file @error('logo') is-invalid @enderror" name="logo"
                            accept="image/png, image/jpg" onchange="previewImage()">
                        @error('logo')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="name" class="col-form-label">Nama:</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                            name="name" value="{{ old('name', $client->name) }}" required placeholder="Nama">
                        @error('name')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="login" class="col-form-label">Login Link:</label>
                        <input type="text" class="form-control @error('login') is-invalid @enderror" id="login"
                            name="login" value="{{ old('login', $client->login) }}" required
                            placeholder="http://example.com/sso/login">
                        @error('login')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="redirect" class="col-form-label">Redirect Callback Link:</label>
                        <input type="text" class="form-control @error('redirect') is-invalid @enderror" id="redirect"
                            name="redirect" value="{{ old('redirect', $client->redirect) }}" required
                            placeholder="http://example.com/callback">
                        @error('redirect')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="role" class="col-form-label">Role:</label>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="dosen" id="dosen" name="role[]"
                                @checked(in_array('dosen', $client->role))>
                            <label class="form-check-label" for="dosen">
                                Dosen
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="mahasiswa" id="mahasiswa" name="role[]"
                                @checked(in_array('mahasiswa', $client->role))>
                            <label class="form-check-label" for="mahasiswa">
                                Mahasiswa
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="staff" id="staff" name="role[]"
                                @checked(in_array('staff', $client->role))>
                            <label class="form-check-label" for="staff">
                                Staff
                            </label>
                        </div>
                    </div>
                </div>
                <div class="my-3">
                    <button type="submit" class="btn btn-primary">Ubah</button>
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
