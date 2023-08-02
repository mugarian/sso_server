@extends('layouts.portal')
@section('container')
    <!-- Page Heading -->
    <div class="card shadow my-4">
        <div class="card-header py-3">
            <h1 class="h3 text-gray-800 text-center my-4">Profil</h1>
            @if (session()->has('success'))
                <div class="alert alert-success alert-dismissible fade show mx-3" role="alert">
                    {{ session('success') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif
            @if (session()->has('fail'))
                <div class="alert alert-danger alert-dismissible fade show mx-3" role="alert">
                    {{ session('fail') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif
            <div class="d-flex justify-content-between align-items-center">
                <h6 class="m-0 font-weight-bold text-primary">Form Kelola Profil</h6>
                <a href="/portal" class="m-0 text-primary">&lt; Kembali</a>
            </div>
        </div>
        <div class="card-body">
            <form action="{{ route('update.profile', ['user' => $user->id]) }}" method="POST"
                enctype="multipart/form-data">
                @csrf
                @method('put')
                <div class="form-group">
                    <div class="mb-2">
                        <label for="avatar">Foto Profil:</label>
                        <input type="hidden" name="oldImage" value="{{ $user->avatar }}">
                        <input type="hidden" name="isRegistered" value="{{ $user->isRegistered }}">
                        <input type="hidden" name="profil" value="1">
                        @if ($user->avatar)
                            <img src="{{ asset('/storage/' . $user->avatar) }}" alt="user-avatar"
                                class="d-block rounded img-preview" height="100" width="100" id="avatar" />
                        @else
                            <img src="{{ asset('img') }}/unknown.png" alt="user-avatar" class="d-block rounded img-preview"
                                height="100" width="100" id="avatar" />
                        @endif
                        <br>
                        <input type="file" accept="image/png, image/jpeg"
                            class="form-control-file avatar @error('avatar') is-invalid @enderror" id="avatar"
                            onchange="previewImage()" name="avatar">
                        @error('avatar')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-2">
                        <label for="no_induk" class="col-form-label">Nomor Induk:</label>
                        <input type="number" class="form-control @error('no_induk') is-invalid @enderror" id="no_induk"
                            name="no_induk" value="{{ old('no_induk', $user->no_induk) }}" required
                            placeholder="Nomor Induk" min="1">
                        @error('no_induk')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-2">
                        <label for="name" class="col-form-label">Nama:</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                            name="name" value="{{ old('name', $user->name) }}" required placeholder="Nama">
                        @error('name')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-2">
                        <label for="birthdate" class="col-form-label">Tanggal Lahir:</label>
                        <input type="date" class="form-control @error('birthdate') is-invalid @enderror" id="birthdate"
                            name="birthdate" value="{{ old('birthdate', $user->birthdate) }}" required>
                        @error('birthdate')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-2">
                        <label for="no_hp" class="col-form-label">Nomor Handphone:</label>
                        <input type="text" class="form-control @error('no_hp') is-invalid @enderror" id="no_hp"
                            name="no_hp" value="{{ old('no_hp', $user->no_hp) }}" required placeholder="Nomor Handphone">
                        @error('no_hp')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-2">
                        <label for="address" class="col-form-label">Alamat:</label>
                        <textarea id="address" class="form-control @error('address') is-invalid @enderror" placeholder="alamat"
                            name="address" required>{{ old('address', $user->address) }}</textarea>
                        @error('address')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-2">
                        <label for="username" class="col-form-label">Username:</label>
                        <input type="text" class="form-control @error('username') is-invalid @enderror" id="username"
                            name="username" value="{{ old('username', $user->username) }}" required
                            placeholder="Username">
                        @error('username')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-2">
                        <label for="email" class="col-form-label">Email:</label>
                        <input type="email" class="form-control @error('email') is-invalid @enderror" id="email"
                            name="email" value="{{ old('email', $user->email) }}" required placeholder="Email"
                            @readonly($user->isMicrosoftAccount)>
                        @error('email')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    @if (!auth()->user()->isMicrosoftAccount)
                        <div class="mb-2">
                            <label for="password" class="col-form-label">Password Lama:</label>
                            <small>(Kosongkan kolom password jika tidak ingin mengubah password)</small>
                            <input type="password"
                                class="form-control @if (session()->has('password')) is-invalid @endif" id="password"
                                name="password" placeholder="Password Lama">
                            @if (session()->has('password'))
                                <div class="invalid-feedback">
                                    {{ session('password') }}
                                </div>
                            @endif
                        </div>
                        <div class="mb-2">
                            <label for="newpassword" class="col-form-label">Password Baru:</label>
                            <input type="password" class="form-control @error('newpassword') is-invalid @enderror"
                                id="newpassword" name="newpassword" placeholder="Konfirmasi Password">
                            @error('newpassword')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mb-2">
                            <label for="newpassword_confirmation" class="col-form-label">Konfirmasi Password Baru:</label>
                            <input type="password"
                                class="form-control @error('newpassword_confirmation') is-invalid @enderror"
                                id="newpassword_confirmation" name="newpassword_confirmation"
                                placeholder="Konfirmasi Password">
                            @error('newpassword_confirmation')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    @endif
                    <div class="my-3">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                        <button type="reset" class="btn btn-secondary">Reset</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!-- DataTales Example -->
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
    </script>
@endsection
