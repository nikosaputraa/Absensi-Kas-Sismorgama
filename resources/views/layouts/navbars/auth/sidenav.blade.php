<aside class="sidenav bg-white navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-4 "
    id="sidenav-main">
    <div class="sidenav-header">
        <i class="fas fa-times p-3 cursor-pointer text-secondary opacity-5 position-absolute end-0 top-0 d-none d-xl-none"
            aria-hidden="true" id="iconSidenav"></i>
        <a class="navbar-brand m-0 text-center" href="{{ route('home') }}" target="_blank">
            <img src="{!! asset('img/logo-ct-dark.png') !!}" class="navbar-brand-img h-100" alt="main_logo">
            <span class="font-weight-bold">SISMORGAMA</span>
        </a>
    </div>
    <hr class="horizontal dark mt-0">
    <div class="collapse navbar-collapse  w-auto h-auto" id="sidenav-collapse-main">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link {{ Route::currentRouteName() == 'home' ? 'active' : '' }}"
                    href="{{ route('home') }}">
                    <div
                        class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="ni ni-tv-2 text-primary text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Dashboard</span>
                </a>
            </li>
            <li class="nav-item mt-3">
                <h6 class="ps-4 ms-2 text-uppercase text-xs font-weight-bolder opacity-6">Menu pages</h6>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Route::currentRouteName() == 'profile' ? 'active' : '' }}"
                    href="{{ route('profile') }}">
                    <div
                        class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="ni ni-single-02 text-danger text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Profile</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->is('anggota*') ? 'active' : '' }}" href="{{ route('anggota') }}">
                    <div
                        class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="ni ni-bullet-list-67 text-dark text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Daftar Anggota</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->is('absensi*') ? 'active' : '' }}" href="{{ route('absensi') }}">
                    <div
                        class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="fa-solid fa-users text-info text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1 mt-2">Absensi</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->is('scan*') ? 'active' : '' }}" href="{{ route('scan') }}">
                    <div
                        class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="fa-solid fa-qrcode text-dark text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1 mt-2">Scan Absensi</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->is('manajemen_kas*') ? 'active' : '' }}"
                    href="{{ route('manajemen_kas') }}">
                    <div
                        class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="fa-solid fa-money-check-dollar text-success text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1 mt-2">Manajemen KAS</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->is('events.index*') ? 'active' : '' }}" href="{{ route('events.index') }}">
                    <div
                        class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="fa fa-calendar-days text-primary text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1 mt-2">Events</span>
                </a>
            </li>

            <li class="nav-item mt-3">
                <h6 class="ps-4 ms-2 text-uppercase text-xs font-weight-bolder opacity-6">Account pages</h6>
            </li>
            <li class="nav-item">
                <form role="form" method="post" action="{{ route('logout') }}" id="logout-form">
                    @csrf
                    <a class="nav-link" href="{{ route('logout') }}"
                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <div
                            class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="fa-solid fa-right-from-bracket text-dark text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1 mt-1">Log Out</span>
                    </a>
                    </form>
                    
            </li>
        </ul>
    </div>
</aside>