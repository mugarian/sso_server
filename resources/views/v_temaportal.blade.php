@extends('layouts.dashboard')
@section('container')
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Tema Portal Sistem</h1>
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
                <h6 class="m-0 font-weight-bold text-primary">Form Kelola Tema Portal</h6>
            </div>
        </div>
        <div class="card-body">
            <form action="{{ route('temaportal.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <div class="mb-2">
                        @if ($temaPortal->cover_main)
                            <input type="hidden" name="oldImage" value="{{ $temaPortal->cover_main }}">
                            <img src="{{ asset('storage') . '/' . $temaPortal->cover_main }}" class="img-preview"
                                width="30%" id="uploadedCover" />
                        @else
                            <img src="{{ asset('img') }}/foto.jpg" class="img-preview" width="30%" id="uploadedCover" />
                        @endif
                        <br>
                        <label for="cover_main" class="col-form-label">Foto Sampul Portal:</label>
                        <br>
                        <input type="file" id="cover_main" name="cover_main"
                            class="form-control-fiole @error('cover_main') is-invalid @enderror"
                            accept="image/png, image/jpeg" onchange="previewImage()" />
                        @error('cover_main')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-2">
                        <label for="bg_main" class="col-form-label">Warna Latar Portal:</label>
                        <input type="color" class="form-control @error('bg_main') is-invalid @enderror" id="bg_main"
                            name="bg_main" value="{{ old('bg_main', $temaPortal->bg_main ?? '#4e73df') }}" required
                            placeholder="Background Portal">
                        @error('bg_main')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-2">
                        <label for="layout_main" class="col-form-label">Warna Layout Portal:</label>
                        <input type="color" class="form-control @error('layout_main') is-invalid @enderror"
                            id="layout_main" name="layout_main"
                            value="{{ old('layout_main', $temaPortal->layout_main ?? '#ffffff') }}" required
                            placeholder="Background Portal">
                        @error('layout_main')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-2">
                        <label for="color_main" class="col-form-label">Warna Teks Portal:</label>
                        <input type="color" class="form-control @error('color_main') is-invalid @enderror" id="color_main"
                            name="color_main" value="{{ old('color_main', $temaPortal->color_main ?? '#3a3b45') }}"
                            required placeholder="Background Portal">
                        @error('color_main')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-2">
                        <label for="button_primary" class="col-form-label">Warna Tombol Portal:</label>
                        <input type="color" class="form-control @error('button_primary') is-invalid @enderror"
                            id="button_primary" name="button_primary"
                            value="{{ old('button_primary', $temaPortal->button_primary ?? '#3a3b45') }}" required
                            placeholder="Background Portal">
                        @error('button_primary')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-2">
                        <label for="button_color_primary" class="col-form-label">Warna Text Tombol Portal:</label>
                        <input type="color" class="form-control @error('button_color_primary') is-invalid @enderror"
                            id="button_color_primary" name="button_color_primary"
                            value="{{ old('button_color_primary', $temaPortal->button_color_primary ?? '#3a3b45') }}"
                            required placeholder="Background Portal">
                        @error('button_color_primary')
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
    <script>
        function previewImage() {
            const cover_main = document.querySelector('#cover_main');
            const imgPreview = document.querySelector('.img-preview');

            imgPreview.style.display = 'block';

            const oFReader = new FileReader();
            oFReader.readAsDataURL(cover_main.files[0]);

            oFReader.onload = function(oFREvent) {
                imgPreview.src = oFREvent.target.result;
            }
        }
    </script>
@endsection
