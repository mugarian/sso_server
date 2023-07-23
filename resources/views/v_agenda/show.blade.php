@extends('layouts.dashboard')
@section('container')
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Data Agenda</h1>
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
                <h6 class="m-0 font-weight-bold text-primary">Detail Agenda</h6>
            </div>
        </div>
        <div class="card-body">
            {{-- <form action="{{ route('agenda.store') }}" method="POST">
                @csrf --}}
            <div class="form-group">
                <div class="mb-2">
                    <label for="title" class="col-form-label">Nama agenda:</label>
                    <p class="font-weight-bold">{{ $agenda->title }}</p>
                </div>
                <div class="mb-2">
                    <label for="start" class="col-form-label">Tanggal Mulai:</label>
                    <p class="font-weight-bold">{{ $agenda->start }}</p>
                </div>
                <div class="mb-2">
                    <label for="end" class="col-form-label">Tanggal Akhir:</label>
                    <p class="font-weight-bold">{{ $agenda->end }}</p>
                </div>
                <div class="mb-2">
                    <label for="end" class="col-form-label">Tanggal Akhir:</label>
                    <p class="font-weight-bold">{{ $agenda->end }}</p>
                </div>
                <div class="mb-2">
                    <label for="location" class="col-form-label">Lokasi:</label>
                    <p class="font-weight-bold">{{ $agenda->location }}</p>
                </div>
                <div class="mb-2">
                    <label for="description" class="col-form-label">Deskripsi:</label>
                    <p class="font-weight-bold">{{ $agenda->description }}</p>
                </div>
                @if (auth()->user()->role == 'admin')
                    <div class="my-3">
                        <div class="d-flex justify-content-start">
                            <a href="{{ $agenda->id }}/edit" class="btn btn-warning mr-3">Ubah</a>
                            <form action="{{ route('agenda.destroy', ['agenda' => $agenda->id]) }}" method="post">
                                @csrf
                                @method('delete')
                                <button type="submit" class="btn btn-danger">Hapus</button>
                            </form>
                        </div>
                    </div>
                @endif
            </div>
            {{-- </form> --}}
        </div>
    </div>
@endsection
