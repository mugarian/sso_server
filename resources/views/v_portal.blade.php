@extends('layouts.portal')
@section('container')
    {{-- Content --}}
    <!-- Nested Row within Card Body -->
    <div class="row">
        <div class="col-lg layout_main">
            <div class="p-5">
                {{-- HEADER --}}
                <div class="text-center">
                    <h1 class="h4 color_main mb-2">
                        Selamat Datang di Portal Politeknik Negeri Subang!
                    </h1>
                    <p class="text-wrap color_main">Halo <b>{{ auth()->user()->name }}</b>, Silahkan
                        Pilih Sistem yang akan
                        diakses</p>
                </div>
                @if (session()->has('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif

                <hr />

                {{-- DAFTAR CLIENT --}}
                <div class="row justify-content-center mb-4">
                    @foreach ($clients as $client)
                        @if (in_array(auth()->user()->role, $client->role) || auth()->user()->role == 'admin')
                            <div class="col-lg-3 col-md-6 col-sm-12 border text-center pt-3 bg-light">
                                <a href="{{ $client->login }}" class="text-decoration-none" target="_blank">
                                    @if ($client->logo)
                                        <img src="{{ asset('storage/' . $client->logo) }}" alt="client-logo" height="100"
                                            width="100" />
                                    @else
                                        <img src="{{ asset('img') }}/unknonw.png" alt="client-logo" height="100"
                                            width="100" />
                                    @endif
                                    <p class="text-wrap my-2 text-dark">{{ $client->name }}</p>
                                </a>
                            </div>
                        @endif
                    @endforeach
                    @if (auth()->user()->isMicrosoftAccount)
                        <div class="col-lg-3 col-md-6 col-sm-12 border rounded text-center pt-3 bg-light">
                            <a href="https://www.microsoft365.com/" target="_blank" class="text-decoration-none">
                                <img src="{{ asset('img') }}/office365.png" alt="client-avatar" height="100"
                                    width="100" />
                                <p class="text-wrap my-2 text-dark">Office 365</p>
                            </a>
                        </div>
                    @endif
                </div>

                {{-- MENU SISTEM --}}
                <div class="row justify-content-center">
                    @if (auth()->user()->role == 'admin')
                        <div class="col-lg-3 col-md-6 col-sm-12 border rounded text-center pt-3 bg-light">
                            <a href="/dashboard" class="text-decoration-none">
                                <img src="{{ asset('img') }}/dashboard.png" alt="client-avatar" height="100"
                                    width="100" />
                                <p class="text-wrap my-2 text-dark">Dashboard</p>
                            </a>
                        </div>
                    @endif
                    <div class="col-lg-3 col-md-6 col-sm-12 border rounded text-center pt-3 bg-light">
                        <a href="/profile" class="text-decoration-none">
                            <img src="{{ asset('img') }}/profile.png" alt="client-avatar" height="100" width="100" />
                        </a>
                        <p class="text-wrap my-2 text-dark">Profil</p>
                    </div>

                    {{-- KONFIRMASI LOGOUT --}}
                    <div class="col-lg-3 col-md-6 col-sm-12 border rounded text-center p-0 bg-light">
                        <button type="button" class="btn btn-light pt-3" data-toggle="modal" data-target="#exampleModal">
                            <img src="{{ asset('img') }}/logout.png" alt="client-avatar" height="100" width="100" />
                            <p class="text-wrap my-2">Logout</p>
                        </button>
                        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title text-dark" id="exampleModalLabel">Konfirmasi Logout?</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body text-dark">
                                        Pilih Tombol berikut untuk melakukan proses logout
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-dismiss="modal">Kembali</button>
                                        <form action="/logout" method="post">
                                            @csrf
                                            <button type="submit" class="btn btn-primary">
                                                Logout SSO
                                            </button>
                                        </form>
                                        @if (auth()->user()->isMicrosoftAccount)
                                            <a href="{{ route('mslogout') }}" class="btn btn-primary">Logout Microsoft</a>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- KALENDAR AGENDA --}}
                <div>
                    <hr>
                    <h5 class="color_main text-center">Agenda</h5>
                    <hr>
                    <div class="row">
                        <div class="col-lg">
                            <div id='calendar'></div>
                        </div>
                    </div>
                </div>

                {{-- UCAPAN PERAYAAN --}}
                <div>
                    <hr>
                    <h5 class="color_main text-center">Perayaan</h5>
                    <hr>
                    <div class="row justify-content-center">
                        @foreach ($events as $event)
                            <div class="col-lg-3 my-3">
                                <div class="card">
                                    <a href="/celebrate/{{ $event->id }}">
                                        @if ($event->avatar)
                                            <img src="{{ asset('storage/' . $event->avatar) }}" class="card-img-top"
                                                alt="{{ $event->name }}">
                                        @else
                                            <img src="{{ asset('img/unknown.png') }}" class="card-img-top"
                                                alt="{{ $event->name }}">
                                        @endif
                                    </a>
                                    <div class="card-body">
                                        <h6 class="card-title">
                                            <b>
                                                {{ $event->name }}
                                            </b>
                                        </h6>
                                        <small class="text-muted">
                                            {{ $event->role }} - {{ $event->major }}
                                        </small>
                                        <p class="card-text fs-6">
                                            Selamat Ulang Tahun ke
                                            {{ \Carbon\Carbon::parse($event->birthdate)->age }}
                                        </p>
                                        <p class="card-text">
                                        </p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                {{-- BERITA --}}
                <div>
                    <hr>
                    <div class="d-flex justify-content-between">
                        <span>&nbsp;</span>
                        <h5 class="color_main text-center">Berita</h5>
                        <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#berita"
                            title="Kelola Berita">
                            <i class="fas fa-fw fa-cog"></i>
                        </button>
                        <div class="modal fade" id="berita" tabindex="-1" aria-labelledby="exampleModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Pengaturan Rekomendasi Berita</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="{{ route('news.storeapi') }}" method="POST">
                                            @csrf
                                            <div class="form-group">
                                                <div class="mb-2">
                                                    <label for="query" class="col-form-label">Kata Kunci:</label>
                                                    <small>(Boleh Dikosongkan)</small>
                                                    <input type="text"
                                                        class="form-control @error('query') is-invalid @enderror"
                                                        id="query" name="query"
                                                        value="{{ old('query', $news->query) }}" placeholder="Kata Kunci"
                                                        min="1">
                                                    @error('query')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                                <div class="mb-2">
                                                    <label for="exampleFormControlSelect1">Negara:</label>
                                                    <select class="form-control" id="negara" name="country">
                                                        <option value="">Pilih Negara</option>
                                                        @foreach ($countries as $country)
                                                            <option value="{{ $country[1] }}"
                                                                @selected(old('country', $news->country) == $country[1])>
                                                                {{ $country[0] }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                    @error('country')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                                <div class="mb-2">
                                                    <label for="exampleFormControlSelect1">Kategori:</label>
                                                    <select class="form-control" id="kategori" name="category">
                                                        <option value="">Pilih Kategori</option>
                                                        @foreach ($categories as $category)
                                                            <option value="{{ $category }}"
                                                                @selected(old('category', $news->category))>
                                                                {{ ucfirst($category) }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                    @error('category')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                                <div class="mb-2">
                                                    <label for="page_size" class="col-form-label">Jumlah news:</label>
                                                    <small>(Maks. 100)</small>
                                                    <input type="number" min="1" max="100"
                                                        class="form-control @error('page_size') is-invalid @enderror"
                                                        id="page_size" name="page_size"
                                                        value="{{ old('page_size', $news->page_size) }}" required
                                                        placeholder="Jumlah news yang ditampilkan" min="1"
                                                        max="100">
                                                    @error('page_size')
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
                    </div>
                    <hr>
                    <h6><b>Berita Polsub</b></h6>
                    <div class="row">
                        @forelse ($beritas as $berita)
                            <div class="col-lg-4 mb-5">
                                <div class="card">
                                    <a href="/news/{{ $berita->id }}">
                                        <img src="{{ asset('storage/' . $berita->cover) }}" class="card-img-top"
                                            alt="{{ $berita->title }}">
                                    </a>
                                    <div class="card-body">
                                        <h6 class="card-title">
                                            <b>
                                                {{ $berita->title }}
                                            </b>
                                        </h6>
                                        <p class="card-text">{!! Str::of($berita->description)->words(10, '...') !!}</p>
                                        <p class="card-text">
                                            <small class="text-muted">
                                                {{ \Carbon\Carbon::parse($berita->created_at)->diffForHumans() }}
                                            </small>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="text-center">
                                <p class="mb-5 text-center">Tidak Ada Berita Polsub</p>
                            </div>
                        @endforelse
                    </div>
                    <h6><b>Rekomendasi Berita</b></h6>
                    <div class="row">
                        @foreach ($all_news as $news)
                            <div class="col-lg-4 mb-3">
                                <div class="card">
                                    <a href="{{ $news->url ?? '' }}">
                                        <img src="{{ $news->urlToImage ?? asset('img/news.jpg') }}" class="card-img-top"
                                            alt="{{ $news->title }}">
                                    </a>
                                    <div class="card-body">
                                        <h6 class="card-title">
                                            <b>
                                                {{ $news->title }}
                                            </b>
                                        </h6>
                                        <p class="card-text">{{ $news->description }}</p>
                                        <p class="card-text">
                                            <small class="text-muted">
                                                By {{ $news->author ?? 'Unknown' }} -
                                                {{ \Carbon\Carbon::parse($news->publishedAt)->diffForHumans() }}
                                            </small>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
