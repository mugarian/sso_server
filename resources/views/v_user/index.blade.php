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
    @if (session()->has('fail'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('fail') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="d-flex justify-content-between align-items-center">
                <h6 class="m-0 font-weight-bold text-primary">Kelola Data</h6>
                <a href="{{ route('user.create') }}" class="btn btn-primary btn-sm">Tambah Data</a>
            </div>
        </div>
        <div class="card-body">
            <div class="d-flex justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Import Data</h6>
                <a href="{{ asset('format/format-user.xlsx') }}" download="FormatImportUser"
                    class="btn btn-sm btn-outline-primary">Download Format Import File</a>
            </div>
            <hr>
            <form action="{{ route('importUser') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <fieldset>
                    <legend><small>Form Import File:</small></legend>
                    <input class="form-control-file my-2 @error('import') is-invalid @enderror" type="file"
                        id="import" accept=".xls, .xlsx" required name="import">
                    @error('import')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                    <button type="submit" class="btn btn-primary">Import</button>
                </fieldset>
            </form>
            <hr>
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Foto</th>
                            <th>Nomor Induk</th>
                            <th>Nama</th>
                            <th>Role</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>No.</th>
                            <th>Foto</th>
                            <th>Nomor Induk</th>
                            <th>Nama</th>
                            <th>Role</th>
                            <th>Action</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @forelse ($users as $user)
                            <tr class="text-center">
                                <td>{{ $loop->iteration }}</td>
                                <td style="width:10%" class="align-middle">
                                    @if ($client->logo)
                                        <img src="{{ asset('storage') . '/' . $client->logo }}" alt="dosen-avatar"
                                            class="d-block rounded img-preview" height="100" width="100"
                                            id="uploadedAvatar" />
                                    @else
                                        <img src="{{ asset('img') }}/unknown.png" alt="user-avatar"
                                            class="d-block rounded img-preview" height="100" width="100"
                                            id="uploadedAvatar" />
                                    @endif
                                </td>
                                <td>{{ $user->no_induk }}</td>
                                <td class="text-wrap">{{ $user->name }}</td>
                                <td>{{ $user->role }}</td>
                                <td>
                                    <div class="d-flex justify-content-around">
                                        <a class="btn btn-success btn-sm px-2"
                                            href="{{ route('user.show', ['user' => $user->id]) }}">
                                            <small>
                                                <i class="fas fa-info"></i>
                                            </small>
                                        </a>
                                        <a class="btn btn-warning btn-sm px-1"
                                            href="{{ route('user.edit', ['user' => $user->id]) }}">
                                            <small>
                                                <i class="fas fa-pen"></i>
                                            </small>
                                        </a>
                                        @if ($user->role != 'admin')
                                            <form action="{{ route('user.destroy', ['user' => $user->id]) }}"
                                                method="post">
                                                @method('delete')
                                                @csrf
                                                <button type="submit" class="btn btn-danger btn-sm px-1"
                                                    onclick="if (confirm('Hapus Data')) return true; return false">
                                                    <small>
                                                        <i class="fas fa-trash"></i>
                                                    </small>
                                                </button>
                                            </form>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="100%">
                                    <h4 class="text-gray-500 text-center my-5">
                                        Data user Tidak ada
                                    </h4>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
