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
                <h6 class="m-0 font-weight-bold text-primary">Detail Data User</h6>
            </div>
        </div>
        <div class="card-body">
            {{-- <form action="{{ route('user.update', ['user' => $user->id]) }}" method="POST">
                @csrf
                @method('put') --}}
            <div class="form-group">
                <div class="mb-2">
                    <label for="avatar">Foto Profil:</label>
                    <img @if ($user->avatar) src="{{ asset('/storage/' . $user->avatar) }}"
                    @else
                                    src="{{ asset('img') }}/unknown.png" @endif
                        alt="user-avatar" class="d-block rounded" height="100" width="100" id="uploadedAvatar" />
                </div>
                <div class="mb-2">
                    <label for="attachment">Foto Kartu Mahasiswa/Pegawai:</label>
                    <img @if ($user->attachment) src="{{ asset('/storage/' . $user->attachment) }}"
                    @else
                                    src="{{ asset('img') }}/unknown.png" @endif
                        alt="user-attachment" class="d-block rounded" height="100" width="100"
                        id="uploadedAttachment" />
                </div>
                <div class="mb-2">
                    <label for="role">Role User:</label>
                    <b>{{ $user->role }}</b>
                </div>
                <div class="mb-2">
                    <label for="no_induk" class="col-form-label">Nomor Induk:</label>
                    <b>{{ $user->no_induk }}</b>
                </div>
                <div class="mb-2">
                    <label for="name" class="col-form-label">Nama:</label>
                    <b>{{ $user->name }}</b>
                </div>
                <div class="mb-2">
                    <label for="birthdate" class="col-form-label">Tanggal Lahir:</label>
                    <b>{{ $user->birthdate }}</b>
                </div>
                <div class="mb-2">
                    <label for="no_hp" class="col-form-label">Nomor Hanphone:</label>
                    <b>{{ $user->no_hp }}</b>
                </div>
                <div class="mb-2">
                    <label for="address" class="col-form-label">Alamat:</label>
                    <b>{{ $user->address }}</b>
                </div>
                <div class="mb-2">
                    <label for="major" class="col-form-label">Jurusan:</label>
                    <b>{{ $user->major }}</b>
                </div>
                <div class="mb-2">
                    <label for="username" class="col-form-label">Username:</label>
                    <b>{{ $user->username }}</b>
                </div>
                <div class="mb-2">
                    <label for="email" class="col-form-label">Email:</label>
                    <b>{{ $user->email }}</b>
                </div>
                <div class="my-3 d-flex">
                    <a href="{{ route('user.edit', ['user' => $user->id]) }}" class="btn btn-warning mr-3">Ubah</a>
                    <form action="{{ route('user.destroy', ['user' => $user->id]) }}" method="post">
                        @method('delete')
                        @csrf
                        <button type="submit" class="btn btn-danger"
                            onclick="if (confirm('Hapus Data')) return true; return false">
                            Hapus
                        </button>
                    </form>
                </div>
            </div>
            {{-- </form> --}}
            <hr>
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable2" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>User</th>
                            <th>Modul</th>
                            <th>Instruksi</th>
                            <th>Riwayat</th>
                            <th>Keterangan</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>No.</th>
                            <th>User</th>
                            <th>Modul</th>
                            <th>Instruksi</th>
                            <th>Riwayat</th>
                            <th>Keterangan</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach ($activities as $activity)
                            <tr class="text-center">
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $activity->name }}</td>
                                <td class="text-wrap">{{ $activity->log_name }}</td>
                                <td>{{ $activity->description }}</td>
                                <td>{{ $activity->created_at }}</td>
                                <td class="text-wrap text-left">{{ $activity->properties }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
