@extends('layouts.dashboard')
@section('container')
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Data Berita</h1>
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
                <h6 class="m-0 font-weight-bold text-primary">Detail Data Berita</h6>
            </div>
        </div>
        <div class="card-body">
            {{-- <form action="{{ route('user.update', ['user' => $berita->id]) }}" method="POST">
                @csrf
                @method('put') --}}
            <div class="form-group">
                <div class="mb-2">
                    <label for="avatar">Foto Berita:</label>
                    <img @if ($berita->cover) src="{{ asset('/storage/' . $berita->cover) }}"
                    @else src="{{ asset('img') }}/unknown.png" @endif
                        alt="user-avatar" class="d-block rounded" width="200" id="uploadedAvatar" />
                </div>
                <div class="mb-2">
                    <label for="title">Judul Berita:</label>
                    <h3>{{ $berita->title }}</h3>
                </div>
                <div class="mb-2">
                    <label for="deskripsi" class="col-form-label">Deskripsi:</label>
                    <div>{!! $berita->description !!}</div>
                </div>
                @if ($berita->attachment)
                    <div class="mb-5">
                        <label for="name" class="col-form-label">Lampiran:</label> <br>
                        <a href="{{ asset('/storage/' . $berita->attachment) }}" class="btn btn-primary" download>
                            Download
                        </a>
                    </div>
                @endif

                <div class="my-3 d-flex">
                    <a href="{{ route('news.edit', ['news' => $berita->id]) }}" class="btn btn-warning mr-3">Ubah</a>
                    <form action="{{ route('news.destroy', ['news' => $berita->id]) }}" method="post">
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
        </div>
    </div>
@endsection
