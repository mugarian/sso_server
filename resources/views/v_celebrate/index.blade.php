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

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="d-flex justify-content-between align-items-center">
                <h6 class="m-0 font-weight-bold text-primary">Perayaan Ulang Tahun</h6>
            </div>
        </div>
        <div class="card-body">
            <div id="carouselExampleCaptions" class="carousel slide" data-ride="carousel">
                <ol class="carousel-indicators">
                    @forelse ($users as $user)
                        <li data-target="#carouselExampleCaptions" data-slide-to="{{ $loop->index }}"
                            class="{{ $loop->index == 0 ? 'active' : '' }}">
                        </li>
                    @empty
                        <li data-target="#carouselExampleCaptions" data-slide-to="0" class="active">
                        </li>
                    @endforelse
                </ol>
                <div class="carousel-inner">
                    @forelse ($users as $user)
                        <div class="carousel-item {{ $loop->index == 0 ? 'active' : '' }}">
                            <img src="{{ asset('img/event.jpg') }}" class="d-block w-100"
                                alt="Perayaan Ulang Tahun {{ $user->name }}">
                            <div class="carousel-caption d-none d-md-block">
                                @if ($user->avatar)
                                    <img src="{{ asset('storage/' . $user->avatar) }}" alt="photo profile"
                                        class="w-25 mb-5 rounded-circle">
                                @else
                                    <img src="{{ asset('img/unknown.png') }}" alt="photo profile"
                                        class="w-25 mb-5 rounded-circle">
                                @endif
                                <h5>{{ $user->name }}</h5>
                                <span>{{ $user->role }} - {{ $user->major }}</span>
                                <p>Selamat Ulang Tahun ke
                                    {{ \Carbon\Carbon::parse($user->birthdate)->age }}</p>
                                <a href="{{ route('celebrate.create', ['user' => $user->id]) }}"
                                    class="btn btn-primary mb-5">Ucapakan
                                    Selamat</a>
                            </div>
                        </div>
                    @empty
                        <div class="carousel-item active">
                            <img src="{{ asset('img/event.jpg') }}" class="d-block w-100" alt="Tidak Ada Perayaan">
                            <div class="carousel-caption d-none d-md-block">
                                <h5>Tidak Ada Perayaan</h5>
                                <span>-</span>
                                <p>-</p>
                            </div>
                        </div>
                    @endforelse
                </div>
                <button class="carousel-control-prev" type="button" data-target="#carouselExampleCaptions"
                    data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-target="#carouselExampleCaptions"
                    data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </button>
            </div>
        </div>
    </div>

    <hr class="my-5">

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
                        @forelse ($celebrates as $celebrate)
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
                        @empty
                            <tr>
                                <td colspan="100%">
                                    <h4 class="text-gray-500 text-center my-5">
                                        Data Ucapan Perayaan Tidak ada
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
