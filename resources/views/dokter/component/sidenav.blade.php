<aside class="sidenav bg-white navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-4" id="sidenav-main">
    <div class="sidenav-header">
        <i class="fas fa-times p-3 cursor-pointer text-secondary opacity-5 position-absolute end-0 top-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav"></i>
        <a class="navbar-brand m-0" href="{{ url('/') }}">
            <img src="{{ asset('img/logo/logo-ct-dark.png') }}" width="26px" height="26px" class="navbar-brand-img h-100" alt="main_logo">
            <span class="ms-1 font-weight-bold">{{ config('app.name') }}</span>
        </a>
    </div>
    <hr class="horizontal dark mt-0">
    <div class="collapse navbar-collapse  w-auto " id="sidenav-collapse-main">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link {{ Route::is('dokter.dashboard') ? 'active' : '' }}" href="{{ route('dokter.dashboard') }}">
                    <i class="fa-solid fa-house {{ Route::is('dokter.dashboard') ? 'text-white' : 'text-dark' }} text-lg opacity-10 ms-1"></i>    
                    <span class="nav-link-text ms-1">Dashboard</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Route::is('dokter.periksa.*') ? 'active' : '' }}" href="{{ route('dokter.periksa.index') }}">
                    <i class="fa-solid fa-person-circle-check text-lg opacity-10 ms-1"></i>
                    <span class="nav-link-text ms-1">Periksa</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Route::is('dokter.riwayat_pasien.*') ? 'active' : '' }}" href="{{ route('dokter.riwayat_pasien.index') }}">
                    <i class="fa-solid fa-users {{ Route::is('dokter.riwayat_pasien.*') ? 'text-white' : 'text-dark' }} text-lg opacity-10 ms-1"></i>
                    <span class="nav-link-text ms-1">Riwayat Pasien</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Route::is('dokter.konsultasi.*') ? 'active' : '' }}" href="{{ route('dokter.konsultasi.index') }}">
                    <i class="fa-solid fa-users {{ Route::is('dokter.konsultasi.*') ? 'text-white' : 'text-dark' }} text-lg opacity-10 ms-1"></i>
                    <span class="nav-link-text ms-1">Konsultasi Pasien</span>
                </a>
            </li>
        </ul>
    </div>
    <div class="sidenav-footer mt-1">
        <div class="card card-plain shadow-none" id="sidenavCard">
            <ul class="navbar-nav">
                <li class="nav-item mt-3">
                    <h6 class="ps-4 ms-2 text-uppercase text-xs font-weight-bolder opacity-6">Pengaturan Akun</h6>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Route::is('dokter.profil.index') ? 'active' : '' }}" href="{{ route('dokter.profil.index') }}">
                        <i class="fa fa-user {{ Route::is('dokter.profil.index') ? 'text-white' : 'text-dark' }} text-lg opacity-10 ms-1"></i>
                        <span class="nav-link-text ms-1">Profil</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Route::is('dokter.jadwal_praktik.index') ? 'active' : '' }}" href="{{ route('dokter.jadwal_praktik.index') }}">
                        <i class="fa fa-calendar {{ Route::is('dokter.jadwal_praktik.index') ? 'text-white' : 'text-dark' }} text-lg opacity-10 ms-1"></i>
                        <span class="nav-link-text ms-1">Jadwal Praktik</span>
                    </a>
                </li>
            </ul>
        </div>
        <div class="w-100 text-center px-3 mt-3">
            <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                @csrf
                <button type="submit" class="btn btn-danger btn-sm w-100 mb-0">
                    <i class="fa fa-power-off me-2" aria-hidden="true"></i>
                    Keluar
                </button>
            </form>            
        </div>
    </div>
</aside>
