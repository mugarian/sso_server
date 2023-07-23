@extends('layouts.dashboard')
@section('container')
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Tema Dashboard Sistem</h1>
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
                <h6 class="m-0 font-weight-bold text-primary">Form Kelola Tema Dashboard</h6>
            </div>
        </div>
        <div class="card-body">
            <form action="{{ route('temadashboard.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <div class="mb-2">
                        <label for="bg_sidebar" class="col-form-label">Latar Sidebar:</label>
                        <input type="color" class="form-control @error('bg_sidebar') is-invalid @enderror" id="bg_sidebar"
                            name="bg_sidebar" value="{{ old('bg_sidebar', $tema->bg_sidebar ?? '#4e73df') }}" required
                            placeholder="Background Portal">
                        @error('bg_sidebar')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-2">
                        <label for="color_sidebar" class="col-form-label">Text Sidebar:</label>
                        <input type="color" class="form-control @error('color_sidebar') is-invalid @enderror"
                            id="color_sidebar" name="color_sidebar"
                            value="{{ old('color_sidebar', $tema->color_sidebar ?? '#4e73df') }}" required
                            placeholder="Background Portal">
                        @error('color_sidebar')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-2">
                        <label for="bg_sidebar_active" class="col-form-label">Latar Sidebar Active:</label>
                        <input type="color" class="form-control @error('bg_sidebar_active') is-invalid @enderror"
                            id="bg_sidebar_active" name="bg_sidebar_active"
                            value="{{ old('bg_sidebar_active', $tema->bg_sidebar_active ?? '#4e73df') }}" required
                            placeholder="Background Portal">
                        @error('bg_sidebar_active')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-2">
                        <label for="bg_navbar" class="col-form-label">Latar Navbar:</label>
                        <input type="color" class="form-control @error('bg_navbar') is-invalid @enderror" id="bg_navbar"
                            name="bg_navbar" value="{{ old('bg_navbar', $tema->bg_navbar ?? '#3a3b45') }}" required
                            placeholder="Background Portal">
                        @error('bg_navbar')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-2">
                        <label for="color_navbar" class="col-form-label">Text Navbar:</label>
                        <input type="color" class="form-control @error('color_navbar') is-invalid @enderror"
                            id="color_navbar" name="color_navbar"
                            value="{{ old('color_navbar', $tema->color_navbar ?? '#3a3b45') }}" required
                            placeholder="Background Portal">
                        @error('color_navbar')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-2">
                        <label for="bg_footer" class="col-form-label">Latar Footer:</label>
                        <input type="color" class="form-control @error('bg_footer') is-invalid @enderror" id="bg_footer"
                            name="bg_footer" value="{{ old('bg_footer', $tema->bg_footer ?? '#3a3b45') }}" required
                            placeholder="Background Portal">
                        @error('bg_footer')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-2">
                        <label for="color_footer" class="col-form-label">Text Footer:</label>
                        <input type="color" class="form-control @error('color_footer') is-invalid @enderror"
                            id="color_footer" name="color_footer"
                            value="{{ old('color_footer', $tema->color_footer ?? '#3a3b45') }}" required
                            placeholder="Background Portal">
                        @error('color_footer')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-2">
                        <label for="bg_primary" class="col-form-label">Latar Tombol Primary:</label>
                        <input type="color" class="form-control @error('bg_primary') is-invalid @enderror" id="bg_primary"
                            name="bg_primary" value="{{ old('bg_primary', $tema->bg_primary ?? '#3a3b45') }}" required
                            placeholder="Background Portal">
                        @error('bg_primary')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-2">
                        <label for="color_primary" class="col-form-label">Text Tombol Primary:</label>
                        <input type="color" class="form-control @error('color_primary') is-invalid @enderror"
                            id="color_primary" name="color_primary"
                            value="{{ old('color_primary', $tema->color_primary ?? '#3a3b45') }}" required
                            placeholder="Background Portal">
                        @error('color_primary')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-2">
                        <label for="bg_secondary" class="col-form-label">Latar Tombol Secondary:</label>
                        <input type="color" class="form-control @error('bg_secondary') is-invalid @enderror"
                            id="bg_secondary" name="bg_secondary"
                            value="{{ old('bg_secondary', $tema->bg_secondary ?? '#3a3b45') }}" required
                            placeholder="Background Portal">
                        @error('bg_secondary')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-2">
                        <label for="color_secondary" class="col-form-label">Text Tombol Secondary:</label>
                        <input type="color" class="form-control @error('color_secondary') is-invalid @enderror"
                            id="color_secondary" name="color_secondary"
                            value="{{ old('color_secondary', $tema->color_secondary ?? '#3a3b45') }}" required
                            placeholder="Background Portal">
                        @error('color_secondary')
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
