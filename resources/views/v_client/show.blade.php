@extends('layouts.dashboard')
@section('container')
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Data Client</h1>
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
                <h6 class="m-0 font-weight-bold text-primary">Form Tambah Data Client</h6>
            </div>
        </div>
        <div class="card-body">
            {{-- <form action="{{ route('passport.clients.store') }}" method="POST" enctype="multipart/form-data">
                @csrf --}}
            <div class="form-group">
                <div class="mb-3">
                    <label for="exampleFormControlFile1">Logo:</label>
                    @if ($client->logo)
                        <img src="{{ asset('storage') . '/' . $client->logo }}" alt="user-avatar"
                            class="d-block rounded img-preview" height="100" width="100" id="uploadedAvatar" />
                    @else
                        <img src="{{ asset('img') }}/logo.png" alt="user-avatar" class="d-block rounded img-preview"
                            height="100" width="100" id="uploadedAvatar" />
                    @endif
                </div>
                <div class="mb-3">
                    <label for="name" class="col-form-label">Nama:</label><br>
                    <b>{{ $client->name }}</b>
                </div>
                <div class="mb-3">
                    <label for="name" class="col-form-label">Role:</label><br>
                    <b>{{ implode(', ', $client->role) }}</b>
                </div>
                <div class="mb-3">
                    <label for="redirect" class="col-form-label">Login Link:</label><br>
                    <b>{{ $client->login }}</b>
                </div>
                <div class="mb-3">
                    <label for="redirect" class="col-form-label">Redirect Callback Link:</label><br>
                    <b>{{ $client->redirect }}</b>
                </div>
                <div class="mb-3">
                    <label for="id" class="col-form-label">Client ID:</label><br>
                    <b>{{ $client->id }}</b>
                </div>
                <div class="mb-3">
                    <label for="secret" class="col-form-label">Client Secret Code:</label><br>
                    <b>{{ $client->secret }}</b>
                </div>
                <div class="my-3 d-flex">
                    <a href="{{ route('klien.edit', ['klien' => $client->id]) }}" class="btn btn-warning mr-3">Ubah</a>
                    <form action="{{ route('klien.destroy', ['klien' => $client->id]) }}" method="post">
                        @method('delete')
                        @csrf
                        <button type="submit" class="btn btn-danger"
                            onclick="if (confirm('Hapus Data')) return true; return false">
                            Hapus
                        </button>
                    </form>
                </div>
            </div>
            </form>
        </div>
    </div>
    <script>
        function previewImage() {
            const logo = document.querySelector('#logo');
            const imgPreview = document.querySelector('.img-preview');

            imgPreview.style.display = 'block';

            const oFReader = new FileReader();
            oFReader.readAsDataURL(logo.files[0]);

            oFReader.onload = function(oFREvent) {
                imgPreview.src = oFREvent.target.result;
            }
        }
    </script>
@endsection
