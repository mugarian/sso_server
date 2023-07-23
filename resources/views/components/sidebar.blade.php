<ul class="navbar-nav bg_sidebar sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="/dashboard">
        {{-- <div class="sidebar-brand-icon m-0 p-0">
            <i class="fas fa-laugh-wink" style="color: {{$tema->color_sidebar}}"></i>
            <img src="{{ asset('img/logo.png') }}" alt="logo" style="width: 30%">
        </div> --}}
        <div class=" m-0 p-0 color_sidebar">SSO Polsub</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    @if (auth()->user()->role == 'admin')
        <li class="nav-item {{ Request::is('dashboard') ? 'bg_sidebar_active' : '' }}">
            <a class="nav-link color_sidebar" href="/dashboard">
                <i class="fas fa-fw fa-tachometer-alt" style="color: {{ $tema->color_sidebar }}"></i>
                <span class="color_sidebar">Dashboard</span></a>
        </li>
    @endif
    <li class="nav-item {{ Request::is('dashboard/profile') ? 'bg_sidebar_active' : '' }}">
        <a class="nav-link color_sidebar" href="/dashboard/profile">
            <i class="fas fa-fw fa-user-circle" style="color: {{ $tema->color_sidebar }}"></i>
            <span class="color_sidebar">Profil</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        <p class="color_sidebar">
            Kelola
        </p>
    </div>
    @if (auth()->user()->role == 'admin')
        <li class="nav-item {{ Request::is('dashboard/klien*') ? 'bg_sidebar_active' : '' }}">
            <a class="nav-link color_sidebar" href="/dashboard/klien">
                <i class="fas fa-fw fa-cloud" style="color: {{ $tema->color_sidebar }}"></i>
                <span class="color_sidebar">Client</span></a>
        </li>
        <li class="nav-item {{ Request::is('dashboard/user*') ? 'bg_sidebar_active' : '' }}">
            <a class="nav-link color_sidebar" href="/dashboard/user">
                <i class="fas fa-fw fa-users" style="color: {{ $tema->color_sidebar }}"></i>
                <span class="color_sidebar">User</span></a>
        </li>
    @endif
    <li class="nav-item {{ Request::is('dashboard/agenda*') ? 'bg_sidebar_active' : '' }}">
        <a class="nav-link color_sidebar" href="/dashboard/agenda">
            <i class="fas fa-fw fa-calendar" style="color: {{ $tema->color_sidebar }}"></i>
            <span class="color_sidebar">Agenda</span></a>
    </li>
    <li class="nav-item {{ Request::is('dashboard/celebrate*') ? 'bg_sidebar_active' : '' }}">
        <a class="nav-link color_sidebar" href="/dashboard/celebrate">
            <i class="fas fa-fw fa-comment" style="color: {{ $tema->color_sidebar }}"></i>
            <span class="color_sidebar">Ucapan Perayaan</span></a>
    </li>
    <li class="nav-item {{ Request::is('dashboard/news*') ? 'bg_sidebar_active' : '' }}">
        <a class="nav-link color_sidebar" href="/dashboard/news">
            <i class="fas fa-fw fa-newspaper" style="color: {{ $tema->color_sidebar }}"></i>
            <span class="color_sidebar">Berita</span></a>
    </li>
    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        <p class="color_sidebar">
            Pengaturan
        </p>
    </div>

    @if (auth()->user()->role == 'admin')
        <li class="nav-item {{ Request::is('dashboard/temaportal*') ? 'bg_sidebar_active' : '' }}">
            <a class="nav-link color_sidebar" href="/dashboard/temaportal">
                <i class="fas fa-fw fa-brush" style="color: {{ $tema->color_sidebar }}"></i>
                <span class="color_sidebar">Tema Portal</span></a>
        </li>
    @endif
    <li class="nav-item {{ Request::is('dashboard/temadashboard*') ? 'bg_sidebar_active' : '' }}">
        <a class="nav-link color_sidebar" href="/dashboard/temadashboard">
            <i class="fas fa-fw fa-brush" style="color: {{ $tema->color_sidebar }}"></i>
            <span class="color_sidebar">Tema Dashboard</span></a>
    </li>

    <hr class="sidebar-divider">

    <!-- Heading -->
    {{-- <div class="sidebar-heading">
        Pengaturan
    </div>

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link color_sidebar collapsed" href="#" data-toggle="collapse" data-target="#collapsePages"
            aria-expanded="true" aria-controls="collapsePages">
            <i class="fas fa-fw fa-folder" style="color: {{$tema->color_sidebar}}"></i>
            <span class="color_sidebar">Pages</span>
        </a>
        <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Login Screens:</h6>
                <a class="collapse-item" href="login.html">Login</a>
                <a class="collapse-item" href="register.html">Register</a>
                <a class="collapse-item" href="forgot-password.html">Forgot Password</a>
                <div class="collapse-divider"></div>
                <h6 class="collapse-header">Other Pages:</h6>
                <a class="collapse-item" href="404.html">404 Page</a>
                <a class="collapse-item" href="blank.html">Blank Page</a>
            </div>
        </div>
    </li>

    <!-- Nav Item - Charts -->
    <li class="nav-item">
        <a class="nav-link color_sidebar" href="charts.html">
            <i class="fas fa-fw fa-chart-area" style="color: {{$tema->color_sidebar}}"></i>
            <span class="color_sidebar">Charts</span></a>
    </li>

    <!-- Nav Item - Tables -->
    <li class="nav-item">
        <a class="nav-link color_sidebar" href="tables.html">
            <i class="fas fa-fw fa-table" style="color: {{$tema->color_sidebar}}"></i>
            <span class="color_sidebar">Tables</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block"> --}}

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

    {{--
    <!-- Sidebar Message -->
    <div class="sidebar-card d-none d-lg-flex">
        <img class="sidebar-card-illustration mb-2" src="{{asset('template')}}/img/undraw_rocket.svg" alt="...">
        <p class="text-center mb-2"><strong>SB Admin Pro</strong> is packed with premium features, components,
            and more!</p>
        <a class="btn btn-success btn-sm" href="https://startbootstrap.com/theme/sb-admin-pro">Upgrade to
            Pro!</a>
    </div>
    --}}

</ul>
