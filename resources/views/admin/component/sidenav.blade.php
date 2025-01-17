<aside class="sidenav bg-white navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-4 " id="sidenav-main">
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
                <a class="nav-link {{ Route::is('admin.dashboard') ? 'active' : '' }}" href="{{ route('admin.dashboard') }}">
                    <i class="fa-solid fa-house {{ Route::is('admin.dashboard') ? 'text-white' : 'text-dark' }} text-lg opacity-10 ms-1"></i>    
                    <span class="nav-link-text ms-1">Dashboard</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Route::is('admin.dokter.*') ? 'active' : '' }}" href="{{ route('admin.dokter.index') }}">
                    <i class="fa-solid fa-user-doctor {{ Route::is('admin.dokter.*') ? 'text-white' : 'text-dark' }} text-lg opacity-10 ms-1"></i>
                    <span class="nav-link-text ms-1">Dokter</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Route::is('admin.pasien.*') ? 'active' : '' }}" href="{{ route('admin.pasien.index') }}">
                    <i class="fa-solid fa-bed-pulse {{ Route::is('admin.pasien.*') ? 'text-white' : 'text-dark' }} text-lg opacity-10 ms-1"></i>
                    <span class="nav-link-text ms-1">Pasien</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Route::is('admin.poli.*') ? 'active' : '' }}" href="{{ route('admin.poli.index') }}">
                    <i class="fa-solid fa-hospital-user {{ Route::is('admin.poli.*') ? 'text-white' : 'text-dark' }} text-lg opacity-10 ms-1"></i>
                    <span class="nav-link-text ms-1">Poli</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Route::is('admin.obat.*') ? 'active' : '' }}" href="{{ route('admin.obat.index') }}">
                    <i class="fa-solid fa-pills {{ Route::is('admin.obat.*') ? 'text-white' : 'text-dark' }} text-lg opacity-10 ms-1"></i>
                    <span class="nav-link-text ms-1">Obat</span>
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
                    <a class="nav-link {{ Route::is('admin.profil.index') ? 'active' : '' }}" href="{{ route('admin.profil.index') }}">
                        <i class="fa fa-user {{ Route::is('admin.profil.index') ? 'text-white' : 'text-dark' }} text-lg opacity-10 ms-1"></i>
                        <span class="nav-link-text ms-1">Profil</span>
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
