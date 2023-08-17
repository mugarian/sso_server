@extends('layouts.dashboard')
@section('container')
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Data Ucapan Perayaan</h1>
    @if (session()->has('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    <div class="card shadow">
        <div class="card-header py-3">
            <div class="d-flex justify-content-between align-items-center">
                <h6 class="m-0 font-weight-bold text-primary">Perayaan Ulang Tahun</h6>
            </div>
        </div>
        <div class="card-body">
            <div class="row row-cols-1 row-cols-md-4 row-cols-md-4 justify-content-center">
                @forelse ($users as $user)
                    <div class="card-deck mr-1 my-3">
                        <div class="card">
                            <a href="/celebrate/{{ $user->id }}" class="text-decoration-none text-dark text-center">
                                @if ($user->avatar)
                                    <img src="{{ asset('storage/' . $user->avatar) }}" class="card-img-top"
                                        alt="{{ $user->name }}">
                                @else
                                    <img src="{{ asset('img/unknown.png') }}" class="card-img-top"
                                        alt="{{ $user->name }}">
                                @endif
                                <div class="card-body">
                                    <h5 class="card-title mb-0">{{ $user->name }}</h5>
                                    <p class="mb-3 fs-1">
                                        <small>
                                            {{ $user->role }} - {{ $user->major }}
                                        </small>
                                    </p>
                                    <p class="card-text">
                                        Selamat Ulang Tahun ke
                                        {{ \Carbon\Carbon::parse($user->birthdate)->age }}
                                    </p>
                                </div>
                            </a>
                            <div class="card-footer">
                                <small class="text-muted">Last updated 3 mins ago</small>
                            </div>
                        </div>
                    </div>
                @empty
                    <center>
                        <h3 class="text-muted">Tidak Ada Perayaan</h3>
                    </center>
                @endforelse
            </div>
        </div>
    </div>

    <hr class="my-4">

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="d-flex justify-content-between align-items-center">
                <h6 class="m-0 font-weight-bold text-primary">Kelola Ucapan Perayaan</h6>
                {{-- <a href="{{ route('user.create') }}" class="btn btn-primary btn-sm">Tambah Data</a> --}}
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Penerima</th>
                            <th>Pengirim</th>
                            <th>Keterangan</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>No.</th>
                            <th>Penerima</th>
                            <th>Pengirim</th>
                            <th>Keterangan</th>
                            <th>Action</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach ($celebrates as $celebrate)
                            <tr class="text-center">
                                <td>{{ $loop->iteration }}</td>
                                <td class="text-wrap text-left">{{ $celebrate->receiver->name }}</td>
                                <td class="text-wrap">{{ $celebrate->sender->name }}</td>
                                <td class="text-wrap">{{ $celebrate->updated_at->diffForHumans() }}</td>
                                <td>
                                    <div class="d-flex justify-content-around">
                                        <a class="btn btn-success btn-sm px-2"
                                            href="{{ route('celebrate.show', ['celebrate' => $celebrate->id]) }}">
                                            <small>
                                                <i class="fas fa-info"></i>
                                            </small>
                                        </a>
                                        @if ($celebrate->receiver_id == auth()->user()->id && !$celebrate->reply)
                                            <a class="btn btn-primary btn-sm px-1"
                                                href="{{ route('celebrate.edit', ['celebrate' => $celebrate->id]) }}">
                                                <small>
                                                    <i class="fas fa-paper-plane"></i>
                                                </small>
                                            </a>
                                        @else
                                            <a class="btn btn-warning btn-sm px-1"
                                                href="{{ route('celebrate.edit', ['celebrate' => $celebrate->id]) }}">
                                                <small>
                                                    <i class="fas fa-pen"></i>
                                                </small>
                                            </a>
                                        @endif
                                        @if ($celebrate->role != 'admin')
                                            <form
                                                action="{{ route('celebrate.destroy', ['celebrate' => $celebrate->id]) }}"
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
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
