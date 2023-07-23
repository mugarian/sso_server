<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />

    <title>{{ $title ?? 'SSO Polsub' }}</title>

    <!-- Custom fonts for this template-->
    <link href="{{ asset('template') }}/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css" />
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet" />

    <!-- Custom styles for this template-->
    <link href="{{ asset('template') }}/css/sb-admin-2.min.css" rel="stylesheet" />
    <link href="{{ asset('template') }}/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.7/index.global.min.js'></script>
    <link href="https://cdn.jsdelivr.net/npm/ace-builds@1.23.4/css/ace.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/ace-builds@1.23.4/src-min-noconflict/ace.min.js"></script>
    <style>
        .bg_utama {
            background-color: <?=$tema->bg_main ?>;
            background-size: cover;
        }

        .layout_main {
            background-color: <?=$tema->layout_main ?>;
        }

        .color_main {
            color: <?=$tema->color_main ?>;
        }

        .cover_default {
            background: url(../../img/foto.jpg);
            background-position: center;
            background-size: cover
        }

        .cover_main {
            background: url(../../storage/<?= $tema->cover_main ?>);
            background-position: center;
            background-size: cover
        }

        .btn-primary {
            color: <?=$tema->button_color_primary ?>;
            background-color: <?=$tema->button_primary ?>;
            border-color: <?=$tema->button_primary ?>;
        }

        .btn-primary:hover {
            color: <?=$tema->button_color_primary ?>;
            background-color: <?=$tema->button_primary ?>cc;
            border-color: <?=$tema->button_primary ?>;
        }

        .carousel-control-prev,
        .carousel-control-next {
            background-color: rgba(0, 0, 0, 0);
            border: solid 0;
        }

        .carousel-item.active,
        .carousel-item-next,
        .carousel-item-prev {
            display: block;
        }

        #editor {
            position: absolute;
            top: 0;
            right: 0;
            bottom: 0;
            left: 0;
        }
    </style>
</head>

{{-- <body> --}}

{{-- <body class="bg-gradient-primary"> --}}

<body class="bg_utama">

    <div class="container">
        <!-- Outer Row -->
        <div class="row d-flex justify-content-center">
            <div class="col-xl-10 col-lg-12 col-md-9">
                <div class="mt-4">&nbsp;</div>
                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        {{-- Content --}}
                        @yield('container')
                    </div>
                </div>
            </div>

        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="{{ asset('template') }}/vendor/jquery/jquery.min.js"></script>
    <script src="{{ asset('template') }}/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"
        integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js"
        integrity="sha384-+sLIOodYLS7CIrQpBjl+C7nPvqq+FbNUBDunl/OZv93DB7Ln/533i8e/mZXLi/P+" crossorigin="anonymous">
    </script>

    <!-- Core plugin JavaScript-->
    <script src="{{ asset('template') }}/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{ asset('template') }}/js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="{{ asset('template') }}/vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="{{ asset('template') }}/vendor/datatables/dataTables.bootstrap4.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="{{ asset('template') }}/js/demo/datatables-demo.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var calendarEl = document.getElementById('calendar');
            var calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                themeSystem: 'bootstrap',
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

</body>

</html>
