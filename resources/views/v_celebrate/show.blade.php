@extends('layouts.dashboard')
@section('container')
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Ucapan Perayaan</h1>
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
                <h6 class="m-0 font-weight-bold text-primary">Detail Ucapan Perayaan</h6>
            </div>
        </div>
        <div class="card-body">
            <div class="form-group">
                <div class="mb-2">
                    <label for="receiver">Penerima:</label>
                    <b>{{ $celebrate->receiver->name }}</b>
                </div>
                <div class="mb-2">
                    <label for="sender" class="col-form-label">Pengirim:</label>
                    <b>{{ $celebrate->sender->name }}</b>
                </div>
                <div class="mb-2">
                    <label for="message" class="col-form-label">Pesan:</label><br>
                    <b>{{ $celebrate->message }}</b>
                </div>
                <div class="mb-2">
                    <label for="reply" class="col-form-label">reply:</label><br>
                    <b>{{ $celebrate->reply ?? 'Belum ada Balasan' }}</b>
                </div>
                <div class="my-3 d-flex">
                    <a href="{{ route('celebrate.edit', ['celebrate' => $celebrate->id]) }}"
                        class="btn btn-warning mr-3">Ubah</a>
                    <form action="{{ route('celebrate.destroy', ['celebrate' => $celebrate->id]) }}" method="post">
                        @method('delete')
                        @csrf
                        <button type="submit" class="btn btn-danger "
                            onclick="if (confirm('Hapus Data')) return true; return false">
                            Hapus
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
