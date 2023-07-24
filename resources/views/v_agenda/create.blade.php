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
                <h6 class="m-0 font-weight-bold text-primary">Form Tambah Data Agenda</h6>
            </div>
        </div>
        <div class="card-body">
            <form action="{{ route('agenda.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <div class="mb-2">
                        <label for="title" class="col-form-label">Nama Agenda:</label>
                        <input type="text" class="form-control @error('title') is-invalid @enderror" id="title"
                            name="title" value="{{ old('title') }}" required placeholder="Nama">
                        @error('title')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-2">
                        <label for="start" class="col-form-label">Tanggal Mulai:</label>
                        <input type="datetime-local" class="form-control @error('start') is-invalid @enderror"
                            id="start" name="start" value="{{ old('start') }}" required onchange="tanggal()">
                        @error('start')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-2">
                        <label for="end" class="col-form-label">Tanggal Selesai:</label>
                        <input type="datetime-local" class="form-control @error('end') is-invalid @enderror" id="end"
                            name="end" value="{{ old('end') }}" required>
                        @error('end')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-2">
                        <label for="location" class="col-form-label">Lokasi:</label>
                        <input type="text" class="form-control @error('location') is-invalid @enderror" id="location"
                            name="location" value="{{ old('location') }}" required placeholder="Lokasi">
                        @error('location')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Deskripsi:</label>
                        <textarea class="form-control @error('description') is-invalid @enderror" id="description" rows="3"
                            name="description" placeholder="Deskripsi">{{ old('description') }}</textarea>
                        @error('description')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-2">
                        <label for="backgroundColor" class="col-form-label">Background Color:</label>
                        <input type="color" class="form-control @error('backgroundColor') is-invalid @enderror"
                            id="backgroundColor" name="backgroundColor" value="{{ old('backgroundColor', '#ff0000') }}"
                            required placeholder="#ff0000">
                        @error('backgroundColor')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-2">
                        <label for="borderColor" class="col-form-label">Border Color:</label>
                        <input type="color" class="form-control @error('borderColor') is-invalid @enderror"
                            id="borderColor" name="borderColor" value="{{ old('borderColor', '#ffffff') }}" required
                            placeholder="#ffffff">
                        @error('borderColor')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-2">
                        <label for="textColor" class="col-form-label">Text Color:</label>
                        <input type="color" class="form-control @error('textColor') is-invalid @enderror" id="textColor"
                            name="textColor" value="{{ old('textColor', '#000000') }}" required placeholder="#000000">
                        @error('textColor')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="my-3">
                        <button type="submit" class="btn btn-primary">Tambah</button>
                        <button type="reset" class="btn btn-secondary">Reset</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <script>
        const start = document.getElementById('start');
        const end = document.getElementById('end');

        function tanggal() {
            end.min = start.value;
        }
    </script>
@endsection
