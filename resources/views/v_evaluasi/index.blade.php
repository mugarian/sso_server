@extends('layouts.dashboard')
@section('container')
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Data Evaluasi</h1>
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
                <h6 class="m-0 font-weight-bold text-primary">Kelola Data Evaluasi</h6>
                <a href="{{ route('news.create') }}" class="btn btn-primary btn-sm">Tambah Data</a>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Sampul</th>
                            <th>Judul</th>
                            <th>Deskripsi</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>No.</th>
                            <th>Sampul</th>
                            <th>Judul</th>
                            <th>Deskripsi</th>
                            <th>Action</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach ($beritas as $berita)
                            <tr class="text-center">
                                <td>{{ $loop->iteration }}</td>
                                <td style="width:10%" class="align-middle">
                                    @if ($berita->cover)
                                        <img src="{{ asset('storage') . '/' . $berita->cover }}" alt="dosen-avatar"
                                            class="img-fluid rounded img-preview" id="uploadedAvatar" />
                                    @else
                                        <img src="{{ asset('img') }}/logo.png" alt="user-avatar"
                                            class="img-fluid rounded img-preview" id="uploadedAvatar" />
                                    @endif
                                </td>
                                <td class="text-wrap">{{ $berita->title }}</td>
                                <td class="text-wrap text-left">{!! Str::of($berita->description)->words(10, '...') !!}</td>
                                <td>
                                    <div class="d-flex justify-content-around">
                                        <a class="btn btn-success btn-sm px-2"
                                            href="{{ route('news.show', ['news' => $berita->id]) }}">
                                            <small>
                                                <i class="fas fa-info"></i>
                                            </small>
                                        </a>
                                        <a class="btn btn-warning btn-sm px-1"
                                            href="{{ route('news.edit', ['news' => $berita->id]) }}">
                                            <small>
                                                <i class="fas fa-pen"></i>
                                            </small>
                                        </a>
                                        @if ($berita->role != 'admin')
                                            <form action="{{ route('news.destroy', ['news' => $berita->id]) }}"
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
                            {{-- @empty
                            <tr>
                                <td colspan="100%">
                                    <h4 class="text-gray-500 text-center my-5">
                                        Data berita Tidak ada
                                    </h4>
                                </td>
                            </tr> --}}
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
