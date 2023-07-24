<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="{{ asset('img/logo.png') }}">

    <title>{{ $title }} - SSO Polsub</title>

    <!-- Custom fonts for this template-->
    <link href="{{ asset('template') }}/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="{{ asset('template') }}/css/sb-admin-2.min.css" rel="stylesheet">

    <link href="{{ asset('template') }}/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.7/index.global.min.js'></script>
    <script src="https://cdn.ckeditor.com/ckeditor5/38.1.1/classic/ckeditor.js"></script>

    <style>
        .bg_sidebar {
            background-color: <?=$tema->bg_sidebar ?>;
        }

        .color_sidebar {
            color: <?=$tema->color_sidebar ?>;
        }

        .bg_sidebar_active {
            background-color: <?=$tema->bg_sidebar_active ?>;
        }

        .bg_navbar {
            background-color: <?=$tema->bg_navbar ?>;
        }

        .color_navbar {
            color: <?=$tema->color_navbar ?>;
        }

        .bg_footer {
            background-color: <?=$tema->bg_footer ?>;
        }

        .color_footer {
            color: <?=$tema->color_footer ?>;
        }

        .bg_primary {
            background-color: <?=$tema->bg_primary ?>;
            color: <?=$tema->color_primary ?>;
        }

        .bg_secondary {
            background-color: <?=$tema->bg_secondary ?>;
            color: <?=$tema->color_secondary ?>;
        }

        .sidebar-dark #sidebarToggle {
            background-color: <?=$tema->bg_sidebar_active ?>;
        }

        .sidebar-dark #sidebarToggle::after {
            color: <?=$tema->color_sidebar ?>;
        }

        .sidebar-dark #sidebarToggle:hover {
            background-color: <?=$tema->bg_sidebar_active ?>;
        }

        .sidebar-dark.toggled #sidebarToggle::after {
            color: <?=$tema->color_sidebar ?>;
        }

        .text-primary {
            color: black !important;
        }

        .btn-primary {
            color: <?=$tema->color_primary ?>;
            background-color: <?=$tema->bg_primary ?>;
            border-color: <?=$tema->bg_primary ?>;
        }

        .btn-primary:hover {
            color: <?=$tema->color_primary ?>;
            background-color: <?=$tema->bg_primary ?>cc;
            border-color: <?=$tema->bg_primary ?>;
        }

        .btn-secondary {
            color: <?=$tema->color_secondary ?>;
            background-color: <?=$tema->bg_secondary ?>;
            border-color: <?=$tema->bg_secondary ?>;
        }

        .btn-secondary:hover {
            color: <?=$tema->color_secondary ?>;
            background-color: <?=$tema->bg_secondary ?>cc;
            border-color: <?=$tema->bg_secondary ?>;
        }

        .carousel-control-prev,
        .carousel-control-next {
            background-color: rgba(0, 0, 0, 0);
            border: solid 0;
        }

        .ck-editor__editable[role="textbox"] {
            /* editing area */
            min-height: 200px;
        }

        .ck-content .image {
            /* block images */
            max-width: 80%;
            margin: 20px auto;
        }
    </style>


</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        @include('components.sidebar')

        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                @include('components.navbar')
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">
                    @yield('container')
                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->
            <div>
                <!-- Footer -->
                @include('components.footer')
                <!-- End of Footer -->
            </div>


        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Konfirmas Logout</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Pilih Tombol berikut untuk melakukan proses logout</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <form action="/logout" method="post">
                        @csrf
                        <button type="submit" class="btn btn-primary">
                            Logout SSO
                        </button>
                    </form>
                    @if (auth()->user()->isMicrosoftAccount)
                        <a href="{{ route('mslogout') }}" class="btn btn-primary">Logout Microsoft</a>
                    @endif
                    {{-- <a class="btn btn-primary" href="login.html">Logout</a> --}}
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="{{ asset('template') }}/vendor/jquery/jquery.min.js"></script>
    <script src="{{ asset('template') }}/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="{{ asset('template') }}/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{ asset('template') }}/js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    {{-- <script src="{{ asset('template') }}/vendor/chart.js/Chart.min.js"></script> --}}

    <!-- Page level custom scripts -->
    {{-- <script src="{{ asset('template') }}/js/demo/chart-area-demo.js"></script>
    <script src="{{ asset('template') }}/js/demo/chart-pie-demo.js"></script> --}}

    <!-- Page level plugins -->
    <script src="{{ asset('template') }}/vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="{{ asset('template') }}/vendor/datatables/dataTables.bootstrap4.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="{{ asset('template') }}/js/demo/datatables-demo.js"></script>

</body>

</html>
