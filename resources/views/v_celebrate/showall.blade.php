@extends('layouts.portal')
@section('container')
    <!-- Page Heading -->
    <h1 class="h3 text-gray-800 text-center my-4">Ucapan Perayaan {{ $user->name }}</h1>
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
                <a href="/portal" class="m-0 text-primary">&lt; Kembali </a>
            </div>
        </div>
        <div class="card-body">
            <div id="carouselExampleCaptions" class="carousel slide" data-ride="carousel">
                <ol class="carousel-indicators">
                    <li data-target="#carouselExampleCaptions" data-slide-to="1" class="active">
                    </li>
                </ol>
                <div class="carousel-inner">
                    <div class="carousel-item active">
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
                            <button type="button" class="btn btn-primary" data-toggle="modal"
                                data-target="#createCelebrate">
                                Ucapkan Selamat
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="createCelebrate" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Kirim Ucapan</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="{{ route('celebrate.store') }}" method="POST">
                        @csrf
                        <div class="modal-body">
                            <div class="form-group">
                                <div class="mb-2">
                                    <label for="receiver_id" class="col-form-label">Penerima:</label>
                                    <input type="hidden" name="receiver_id" value="{{ $user->id }}">
                                    <input type="hidden" name="celebrate" value="1">
                                    <input type="text" class="form-control @error('receiver_id') is-invalid @enderror"
                                        id="penerima" name="penerima" value="{{ old('penerima', $user->name) }}"
                                        placeholder="Penerima" readonly>
                                    @error('receiver_id')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="mb-2">
                                    <label for="sender_id" class="col-form-label">Pengirim:</label>
                                    <input type="hidden" name="sender_id" value="{{ auth()->user()->id }}">
                                    <input type="text" class="form-control @error('sender_id') is-invalid @enderror"
                                        id="pengirim" name="pengirim" value="{{ old('pengirim', auth()->user()->name) }}"
                                        placeholder="Pengirim" readonly>
                                    @error('sender_id')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="mb-2">
                                    <label for="message">Pesan:</label>
                                    <textarea class="form-control @error('message') is-invalid @enderror" id="message" name="message" rows="3">{{ old('message') }}</textarea>
                                    @error('message')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>

    <hr class="my-5">

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Pesan</th>
                            <th>Balasan</th>
                            <th>Pengirim</th>
                            <th style="width: 0">Action</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>No.</th>
                            <th>Pesan</th>
                            <th>Balasan</th>
                            <th>Pengirim</th>
                            <th style="width: 0">Action</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @forelse ($celebrates as $celebrate)
                            <tr class="text-center">
                                <td>{{ $loop->iteration }}</td>
                                <td class="text-wrap text-left">{{ $celebrate->message }}</td>
                                <td class="text-wrap text-left">{{ $celebrate->reply }}</td>
                                <td class="text-wrap">
                                    <b>{{ $celebrate->sender->name }}</b> <br>
                                    {{ $celebrate->updated_at->diffForHumans() }}
                                </td>
                                <td>
                                    <div class="d-flex justify-content-around">
                                        <a class="btn btn-success"
                                            href="{{ route('celebrate.show', ['celebrate' => $celebrate->id]) }}">
                                            <small>
                                                <i class="fas fa-info"></i>
                                            </small>
                                        </a>
                                        @if ($celebrate->receiver_id == auth()->user()->id && !$celebrate->reply)
                                            <button type="button" class="btn btn-primary" data-toggle="modal"
                                                data-target="#editCelebrate{{ $celebrate->id }}">
                                                <small>
                                                    <i class="fas fa-paper-plane"></i>
                                                </small>
                                            </button>
                                        @else
                                            <button type="button" class="btn btn-primary" data-toggle="modal"
                                                data-target="#editCelebrate{{ $celebrate->id }}">
                                                <small>
                                                    <i class="fas fa-pen"></i>
                                                </small>
                                            </button>
                                        @endif
                                        <div class="modal fade" id="editCelebrate{{ $celebrate->id }}" tabindex="-1"
                                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Kirim Ucapan</h5>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <form
                                                        action="{{ route('celebrate.update', ['celebrate' => $celebrate->id]) }}"
                                                        method="POST">
                                                        @csrf
                                                        @method('PUT')
                                                        <div class="modal-body text-left">
                                                            <div class="form-group">
                                                                <div class="mb-2">
                                                                    <label for="receiver_id"
                                                                        class="col-form-label">Penerima:</label>
                                                                    <input type="hidden" name="receiver_id"
                                                                        value="{{ $celebrate->receiver->id }}">
                                                                    <input type="hidden" name="celebrate"
                                                                        value="1">
                                                                    <input type="text"
                                                                        class="form-control @error('receiver_id') is-invalid @enderror"
                                                                        id="penerima" name="penerima"
                                                                        value="{{ old('penerima', $celebrate->receiver->name) }}"
                                                                        placeholder="Penerima" readonly>
                                                                    @error('receiver_id')
                                                                        <div class="invalid-feedback">
                                                                            {{ $message }}
                                                                        </div>
                                                                    @enderror
                                                                </div>
                                                                <div class="mb-2">
                                                                    <label for="sender_id"
                                                                        class="col-form-label">Pengirim:</label>
                                                                    <input type="hidden" name="sender_id"
                                                                        value="{{ $celebrate->sender->id }}">
                                                                    <input type="text"
                                                                        class="form-control @error('sender_id') is-invalid @enderror"
                                                                        id="pengirim" name="pengirim"
                                                                        value="{{ old('pengirim', $celebrate->sender->name) }}"
                                                                        placeholder="Pengirim" readonly>
                                                                    @error('sender_id')
                                                                        <div class="invalid-feedback">
                                                                            {{ $message }}
                                                                        </div>
                                                                    @enderror
                                                                </div>
                                                                <div class="mb-2">
                                                                    <label for="message">Pesan:</label>
                                                                    <textarea class="form-control @error('message') is-invalid @enderror" id="message" name="message" rows="2"
                                                                        @readonly(auth()->user()->id != $celebrate->sender->id)>{{ old('message', $celebrate->message) }}</textarea>
                                                                    @error('message')
                                                                        <div class="invalid-feedback">
                                                                            {{ $message }}
                                                                        </div>
                                                                    @enderror
                                                                </div>
                                                                <div class="mb-2">
                                                                    <label for="reply">Balasan:</label>
                                                                    <textarea class="form-control @error('reply') is-invalid @enderror" id="reply" name="reply" rows="2"
                                                                        @readonly(auth()->user()->id != $celebrate->receiver->id)>{{ old('reply', $celebrate->reply) }}</textarea>
                                                                    @error('reply')
                                                                        <div class="invalid-feedback">
                                                                            {{ $message }}
                                                                        </div>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-dismiss="modal">Close</button>
                                                            <button type="submit" class="btn btn-primary">Simpan</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                        @if ($celebrate->role != 'admin')
                                            <form
                                                action="{{ route('celebrate.destroy', ['celebrate' => $celebrate->id]) }}"
                                                method="post">
                                                @method('delete')
                                                @csrf
                                                <button type="submit" class="btn btn-danger"
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
