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
                <h6 class="m-0 font-weight-bold text-primary">Kelola Data Berita</h6>
            </div>
        </div>
        <div class="card-body">
            <form action="{{ route('news.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <div class="mb-2">
                        <label for="query" class="col-form-label">Kata Kunci:</label>
                        <small>(Boleh Dikosongkan)</small>
                        <input type="text" class="form-control @error('query') is-invalid @enderror" id="query"
                            name="query" value="{{ old('query', $news->q) }}" placeholder="Kata Kunci" min="1">
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
                                <option value="{{ $country[1] }}" @selected(old('country', $news->country) == $country[1])>
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
                                <option value="{{ $category }}" @selected(old('category', $news->category))>
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
                        <label for="page_size" class="col-form-label">Jumlah news:</label> <small>(Maks. 100)</small>
                        <input type="number" min="1" max="100"
                            class="form-control @error('page_size') is-invalid @enderror" id="page_size" name="page_size"
                            value="{{ old('page_size', $news->page_size) }}" required
                            placeholder="Jumlah news yang ditampilkan" min="1" max="100">
                        @error('page_size')
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
    <hr class="mt-5 mb-4">
    <h3 class="text-gray-800">news</h3>

    <div class="row">
        @foreach ($all_news as $news)
            <div class="col-lg-4 my-3">
                <div class="card">
                    <a href="{{ $news->url }}">
                        <img src="{{ $news->urlToImage ?? asset('img/news.jpg') }}" width="300" height="200"
                            class="card-img-top" alt="{{ $news->title }}">
                    </a>
                    <div class="card-body">
                        <h5 class="card-title" style="color:black"><b>{{ $news->title }}</b></h5>
                        <p class="card-text" style="color:black">{{ $news->description }}</p>
                        <p class="card-text">
                            <small class="text-muted">
                                By {{ $news->author == '' ? $news->source->name : $news->author }} -
                                {{ \Carbon\Carbon::parse($news->publishedAt)->diffForHumans() }}
                            </small>
                        </p>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection
