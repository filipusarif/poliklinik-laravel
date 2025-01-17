<nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl " id="navbarBlur"
    data-scroll="false">
    <div class="container-fluid py-1 px-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
                <li class="breadcrumb-item text-sm"><a class="opacity-5 text-white" href="{{ route('dokter.dashboard') }}">Dokter</a></li>
                <li class="breadcrumb-item text-sm text-white active" aria-current="page">
                    @if(Request::is('dokter/periksa') || Request::is('dokter/periksa/*'))
                        Periksa
                    @elseif(Request::is('dokter/profil') || Request::is('dokter/profil/*'))
                        Profil
                    @elseif(Request::is('dokter/jadwal') || Request::is('dokter/jadwal/*'))
                        Jadwal Praktik
                    @elseif(Request::is('dokter/riwayat_pasien') || Request::is('dokter/riwayat_pasien/*'))
                        Riwayat Pasien
                    @else
                        Dashboard
                    @endif
                </li>
            </ol>
            <h6 class="font-weight-bolder text-white mb-0">
                @if(Request::is('dokter/periksa') || Request::is('dokter/periksa/*'))
                    Periksa
                @elseif(Request::is('dokter/profil') || Request::is('dokter/profil/*'))
                    Profil
                @elseif(Request::is('dokter/jadwal') || Request::is('dokter/jadwal/*'))
                    Jadwal Praktik
                @elseif(Request::is('dokter/riwayat_pasien') || Request::is('dokter/riwayat_pasien/*'))
                    Riwayat Pasien
                @else
                    Dashboard
                @endif
            </h6>
        </nav>
        <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4 pe-md-3 d-flex align-items-center justify-content-end" id="navbar">
            <ul class="navbar-nav  justify-content-end">
                <li class="nav-item dropdown pe-2 d-flex align-items-center">
                    <a href="javascript:;" class="nav-link text-body font-weight-bold px-0"
                        id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fa fa-user me-sm-1 text-lg text-white"></i>
                        <span class="d-sm-inline d-none text-white">
                            @if (Auth::user()) {{ Auth::user()->nama }} @endif
                        </span>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end px-2 py-3 me-sm-n4"
                        aria-labelledby="dropdownMenuButton">
                        <li class="mb-2">
                            <a href="{{ route('dokter.profil.index') }}" class="dropdown-item border-radius-md">Profil Saya</a>
                        </li>
                        <li class="mb-2">
                            <a href="{{ route('logout') }}" class="dropdown-item border-radius-md"
                                onclick="event.preventDefault(); document.getElementById('logout-form-1').submit();">
                                Keluar
                            </a>
                            <form id="logout-form-1" action="{{ route('logout') }}" method="POST"
                                style="display: none;">
                                @csrf
                            </form>
                        </li>
                    </ul>
                </li>
                <li class="nav-item d-xl-none ps-3 d-flex align-items-center">
                    <a href="javascript:;" class="nav-link text-white p-0" id="iconNavbarSidenav">
                        <div class="sidenav-toggler-inner">
                            <i class="sidenav-toggler-line bg-white"></i>
                            <i class="sidenav-toggler-line bg-white"></i>
                            <i class="sidenav-toggler-line bg-white"></i>
                        </div>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>
