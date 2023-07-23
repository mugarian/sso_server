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
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="d-flex justify-content-between align-items-center">
                <h6 class="m-0 font-weight-bold text-primary">Form Kelola Ucapan Perayaan {{ $celebrate->receiver->name }}
                </h6>
            </div>
        </div>
        <div class="card-body">
            <form action="{{ route('celebrate.update', ['celebrate' => $celebrate->id]) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <div class="mb-2">
                        <label for="receiver_id" class="col-form-label">Penerima:</label>
                        <input type="hidden" name="receiver_id" value="{{ $celebrate->receiver_id }}">
                        <input type="text" class="form-control @error('receiver_id') is-invalid @enderror"
                            id="receiver_id" name="" value="{{ old('receiver_id', $celebrate->receiver->name) }}"
                            required placeholder="Penerima" readonly>
                        @error('receiver_id')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-2">
                        <label for="sender_id" class="col-form-label">Pengirim:</label>
                        <input type="hidden" name="sender_id" value="{{ $celebrate->sender_id }}">
                        <input type="text" class="form-control @error('sender_id') is-invalid @enderror" id="sender_id"
                            name="" value="{{ old('sender_id', $celebrate->sender->name) }}" required
                            placeholder="Pengirim" readonly>
                        @error('sender_id')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="message" class="form-label">Pesan:</label>
                        <textarea class="form-control @error('message') is-invalid @enderror" id="message" rows="3" name="message"
                            {{ auth()->user()->id == $celebrate->sender->id ? '' : 'readonly' }}>{{ old('message', $celebrate->message) }}</textarea>
                        @error('message')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="reply" class="form-label">Balasan:</label>
                        <textarea class="form-control @error('reply') is-invalid @enderror" id="reply" rows="3" name="reply"
                            {{ auth()->user()->id == $celebrate->receiver->id ? '' : 'readonly' }}> {{ old('reply', $celebrate->reply) }}</textarea>
                        @error('reply')
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
@endsection
