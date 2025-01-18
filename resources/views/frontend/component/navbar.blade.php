<nav class="navbar navbar-expand-lg bg-white p-0 fixed-top">
    <div class="container-fluid">
        <!-- Logo -->
        <div class="p-2 me-2">
            <a href="{{ url('/') }}" class="navbar-brand">
                <img class="img-fluid" src="{{ asset('img/logo/logo-ct-dark.png') }}" alt="Icon" style="height: 50px;">
                <span class="ms-1 font-weight-bold text-lg">{{ config('app.name') }}</span>
            </a>
        </div>

        <!-- Offcanvas Toggler -->
        <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar"
            aria-controls="offcanvasNavbar">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Offcanvas -->
        <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
            <div class="offcanvas-header">
                <h5 class="offcanvas-title" id="offcanvasNavbarLabel">Menu</h5>
                <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <div class="offcanvas-body">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <li class="nav-item me-5">
                        <a class="nav-link {{ Request::is('/') ? 'active' : '' }}" aria-current="page"
                            href="{{ url('/') }}">Beranda</a>
                    </li>
                    <li class="nav-item me-5">
                        <a class="nav-link" href="{{ route('poli') }}">Poli</a>
                    </li>
                    <li class="nav-item me-5">
                        <a class="nav-link" href="{{ route('pasien.konsultasi.index') }}">Konsultasi</a>
                    </li>
                    
                    @php
                        $authUser = getAuthenticatedUser();
                    @endphp

                    @if ($authUser)
                        <li class="nav-item dropdown me-5">
                            <a class="nav-link {{ Request::is('profile', 'history') ? 'active' : '' }} dropdown-toggle"
                                href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                @if ($authUser)
                                    {{ $authUser->nama }}
                                @else
                                    Pengguna tidak ditemukan
                                @endif
                            </a>                            
                            <ul class="dropdown-menu dropdown-menu-end">
                                @if (Auth::guard('pasien')->check()) 
                                    <li><a class="dropdown-item" href="{{ route('pasien.profil.index') }}">Profil</a></li>
                                    <li><a class="dropdown-item" href="{{ route('pasien.riwayat.index') }}">Riwayat Periksa</a></li>
                                @elseif (Auth::guard('dokter')->check())
                                    <li><a class="dropdown-item" href="{{ route('dokter.dashboard') }}">Dashboard</a></li>
                                @elseif (Auth::guard('admin')->check())
                                    <li><a class="dropdown-item" href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                                @endif
                                <li><a class="dropdown-item" href="{{ route('logout') }}"
                                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Keluar</a>
                                </li>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                    style="display: none;">
                                    @csrf
                                </form>
                            </ul>
                        </li>
                    @else
                        <li class="nav-item mx-3">
                            <a href="{{ route('registrasi') }}" class="btn btn-warning shadow-sm d-block mb-2">Daftar Sebagai Pasien</a>
                        </li>
                        <li class="nav-item mx-3">
                            <a href="{{ route('login') }}" class="btn btn-dark shadow-sm d-block">Login</a>
                        </li>
                    @endif
                </ul>
            </div>
        </div>
    </div>
</nav>
