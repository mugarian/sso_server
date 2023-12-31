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
                <a href="{{ route('klien.create') }}" class="btn btn-primary btn-sm">Tambah Data</a>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered text-center" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Logo</th>
                            <th>Nama</th>
                            <th>Redirect</th>
                            <th>Role</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>No.</th>
                            <th>Logo</th>
                            <th>Nama</th>
                            <th>Redirect</th>
                            <th>Role</th>
                            <th>Action</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach ($clients as $client)
                            <tr>
                                <td class="align-middle">{{ $loop->iteration }}</td>
                                <td style="width:10%" class="align-middle">
                                    @if ($client->logo)
                                        <img src="{{ asset('storage') . '/' . $client->logo }}" alt="dosen-avatar"
                                            class="d-block rounded img-preview" height="100" width="100"
                                            id="uploadedAvatar" />
                                    @else
                                        <img src="{{ asset('img') }}/logo.png" alt="user-avatar"
                                            class="d-block rounded img-preview" height="100" width="100"
                                            id="uploadedAvatar" />
                                    @endif
                                </td>
                                <td class="text-wrap align-middle">{{ $client->name }}</td>
                                <td class="text-wrap align-middle">{{ $client->login }}</td>
                                <td class="text-wrap align-middle">
                                    @if ($client->dosen)
                                        Dosen
                                    @endif
                                    @if ($client->mahasiswa)
                                        Mahasiswa
                                    @endif
                                    @if ($client->staff)
                                        Staff
                                    @endif
                                </td>
                                <td class="align-middle">
                                    <div class="d-flex justify-content-around">
                                        <a class="btn btn-success btn-sm px-2"
                                            href="{{ route('klien.show', ['klien' => $client->id]) }}">
                                            <small>
                                                <i class="fas fa-info"></i>
                                            </small>
                                        </a>
                                        <a class="btn btn-warning btn-sm px-1"
                                            href="{{ route('klien.edit', ['klien' => $client->id]) }}">
                                            <small>
                                                <i class="fas fa-pen"></i>
                                            </small>
                                        </a>
                                        <form action="{{ route('klien.destroy', ['klien' => $client->id]) }}"
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
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
