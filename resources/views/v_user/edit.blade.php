@extends('layouts.dashboard')
@section('container')
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Data User</h1>
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
                <h6 class="m-0 font-weight-bold text-primary">Form Ubah Data User</h6>
            </div>
        </div>
        <div class="card-body">
            <form action="{{ route('user.update', ['user' => $user->id]) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('put')
                <div class="form-group">
                    <div class="mb-2">
                        <label for="avatar">Foto Profil:</label>
                        <input type="hidden" name="oldImage" value="{{ $user->avatar }}">
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
                        <label for="exampleFormControlSelect1">Status:</label>
                        <select class="form-control" id="exampleFormControlSelect1" name="status">
                            <option value="">Pilih status User</option>
                            <option value="0" @selected(old('status', $user->status) == 0)>Tidak Aktif</option>
                            <option value="1" @selected(old('status', $user->status) == 1)>Aktif</option>
                        </select>
                        @error('role')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-2">
                        <label for="exampleFormControlSelect1">Terverifikasi:</label>
                        <select class="form-control" id="exampleFormControlSelect1" name="isVerified">
                            <option value="1" @selected(old('isVerified', $user->isVerified) == 1)>Ya</option>
                            <option value="0" @selected(old('isVerified', $user->isVerified) == 0)>Tidak</option>
                        </select>
                        @error('isVerified')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-2">
                        <label for="exampleFormControlSelect1">Telah Registrasi:</label>
                        <select class="form-control" id="exampleFormControlSelect1" name="isRegistered">
                            <option value="1" @selected(old('isRegistered', $user->isRegistered) == 1)>Ya</option>
                            <option value="0" @selected(old('isRegistered', $user->isRegistered) == 0)>Tidak</option>
                        </select>
                        @error('isRegistered')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-2">
                        <label for="exampleFormControlSelect1">Akun Microsoft:</label>
                        <select class="form-control" id="exampleFormControlSelect1" name="isMicrosoftAccount">
                            <option value="1" @selected(old('isMicrosoftAccount', $user->isMicrosoftAccount) == 1)>Ya</option>
                            <option value="0" @selected(old('isMicrosoftAccount', $user->isMicrosoftAccount) == 0)>Tidak</option>
                        </select>
                        @error('isMicrosoftAccount')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-2">
                        <label for="role">Role User:</label>
                        <select class="form-control" id="role" name="role">
                            <option value="">Pilih Role</option>
                            <option value="dosen" @selected(old('role', $user->role) == 'dosen')>Dosen</option>
                            <option value="mahasiswa" @selected(old('role', $user->role) == 'mahasiswa')>Mahasiswa</option>
                            <option value="staff" @selected(old('role', $user->role) == 'staf')>Staf</option>
                        </select>
                        @error('role')
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
                        <input type="date" class="form-control @error('birthdate') is-invalid @enderror"
                            id="birthdate" name="birthdate" value="{{ old('birthdate', $user->birthdate) }}" required>
                        @error('birthdate')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-2">
                        <label for="no_hp" class="col-form-label">Nomor Handphone:</label>
                        <input type="text" class="form-control @error('no_hp') is-invalid @enderror" id="no_hp"
                            name="no_hp" value="{{ old('no_hp', $user->no_hp) }}" required
                            placeholder="Nomor Handphone">
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
                    <div class="mb-2 form-group">
                        <label for="major">Pilih Jurusan</label>
                        <select class="form-control @error('major') is-invalid @enderror" id="major" name="major">
                            <option value="">Pilih Jurusan</option>
                            <option value="mi" @selected(old('major', $user->major) == 'mi')>Manajemen Informatika</option>
                            <option value="ai" @selected(old('major', $user->major) == 'ai')>Agroindustri</option>
                            <option value="tppm" @selected(old('major', $user->major) == 'tppm')>TPPM</option>
                            <option value="kesehatan" @selected(old('major', $user->major) == 'kesehatan')>Kesehatan</option>
                            <option value="kepegawaian" @selected(old('major', $user->major) == 'kepegawaian')>Kepegawaian</option>
                        </select>
                        @error('major')
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
                            name="email" value="{{ old('email', $user->email) }}" required placeholder="Email">
                        @error('email')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-2">
                        <label for="password" class="col-form-label">Password Lama:</label>
                        <small>(Kosongkan kolom password jika tidak ingin mengubah password)</small>
                        <input type="password" class="form-control @if (session()->has('password')) is-invalid @endif"
                            id="password" name="password" placeholder="Password Lama">
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
                    <div class="my-3">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                        <button type="reset" class="btn btn-secondary">Reset</button>
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
    </script>
@endsection
