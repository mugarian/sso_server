@extends('layouts.dashboard')
@section('container')
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Data agenda</h1>
    @if (session()->has('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
    @if (session()->has('fail'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('fail') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="d-flex justify-content-between align-items-center">
                <h6 class="m-0 font-weight-bold text-primary">Kalendar agenda</h6>
                @if (auth()->user()->role == 'admin')
                    <a href="{{ route('agenda.create') }}" class="btn btn-primary btn-sm">Tambah Data</a>
                @endif
            </div>
        </div>
        <div class="card-body">
            <div class="d-flex justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Import Data</h6>
                <a href="{{ asset('format/format-agenda.xlsx') }}" download="FormatImportAgenda"
                    class="btn btn-sm btn-outline-primary">Download Format Import File</a>
            </div>
            <hr>
            <form action="{{ route('importAgenda') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <fieldset>
                    <legend><small>Form Import File:</small></legend>
                    <input class="form-control-file my-2 @error('import') is-invalid @enderror" type="file"
                        id="import" accept=".xls, .xlsx" required name="import">
                    @error('import')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                    <button type="submit" class="btn btn-primary">Import</button>
                </fieldset>
            </form>
            <hr>
            <div id='calendar'></div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var calendarEl = document.getElementById('calendar');
            var calendar = new FullCalendar.Calendar(calendarEl, {
                themeSystem: 'bootstrap',
                dateClick: function() {
                    alert('hi');
                },
                events: [
                    @foreach ($agendas as $agenda)
                        {
                            title: '{{ $agenda->title }}',
                            url: 'agenda/{{ $agenda->id }}',
                            backgroundColor: '{{ $agenda->backgroundColor }}',
                            borderColor: '{{ $agenda->borderColor }}',
                            textColor: '{{ $agenda->textColor }}',
                            start: '{{ $agenda->start }}',
                            end: '{{ $agenda->end }}',
                        },
                    @endforeach
                ],
                eventTimeFormat: {
                    hour: 'numeric',
                    minute: '2-digit',
                    second: '2-digit',
                    meridiem: false
                }
            });
            calendar.render();
        });
    </script>
@endsection
