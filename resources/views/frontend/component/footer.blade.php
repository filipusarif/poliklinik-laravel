<footer class="bg-light mt-auto">
    <!-- Bagian Atas Footer -->
    <div class="container py-4">
        <div class="row">
            <!-- Tentang Kami -->
            <div class="col-lg-3 col-md-6 mb-4">
                <div class="footer-logo mb-3">
                    <img src="{{ asset('img/logo/logo-ct-dark.png') }}" alt="logo" class="img-fluid" style="height: 50px;">
                    <span class="ms-1 font-weight-bold text-lg">{{ config('app.name') }}</span>
                </div>
                <p>Kami memudahkan Anda dalam menjadwalkan janji medis. Terhubung dengan tenaga medis profesional, kelola jadwal konsultasi, dan prioritaskan kesehatan Anda bersama kami.</p>
                <div class="social-icon">
                    <ul class="list-inline">
                        <li class="list-inline-item">
                            <a href="javascript:void(0);" class="text-decoration-none"><i class="fab fa-facebook"></i></a>
                        </li>
                        <li class="list-inline-item">
                            <a href="javascript:void(0);" class="text-decoration-none"><i class="fab fa-twitter"></i></a>
                        </li>
                        <li class="list-inline-item">
                            <a href="javascript:void(0);" class="text-decoration-none"><i class="fab fa-linkedin-in"></i></a>
                        </li>
                        <li class="list-inline-item">
                            <a href="javascript:void(0);" class="text-decoration-none"><i class="fab fa-instagram"></i></a>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- Untuk Pasien -->
            <div class="col-lg-3 col-md-6 mb-4">
                <h5>Untuk Pasien</h5>
                <ul class="list-unstyled">
                    <li><a href="{{ route('poli') }}" class="text-decoration-none">Cari Dokter</a></li>
                    <li><a href="{{ route('login') }}" class="text-decoration-none">Login</a></li>
                    <li><a href="{{ route('registrasi') }}" class="text-decoration-none">Registrasi</a></li>
                    <li><a href="{{ route('pasien.riwayat.index') }}" class="text-decoration-none">Dashboard Pasien</a></li>
                </ul>
            </div>

            <!-- Untuk Dokter -->
            <div class="col-lg-3 col-md-6 mb-4">
                <h5>Untuk Dokter</h5>
                <ul class="list-unstyled">
                    <li><a href="{{ route('login') }}" class="text-decoration-none">Login</a></li>
                    <li><a href="{{ route('dokter.dashboard') }}" class="text-decoration-none">Dashboard Dokter</a></li>
                </ul>
            </div>

            <!-- Kontak Kami -->
            <div class="col-lg-3 col-md-6 mb-4">
                <h5>Kontak Kami</h5>
                <p><i class="fas fa-map-marker-alt"></i> Jl. Imam Bonjol No.207, Semarang, Jawa Tengah</p>
                <p><i class="fas fa-phone-alt"></i> +62 24 765 4321</p>
                <p><i class="fas fa-envelope"></i> kontak@poliklinik.com</p>
            </div>
        </div>
    </div>
    <!-- Bagian Bawah Footer -->
    <div class="bg-dark text-white py-3">
        <div class="container">
            <div class="row justify-content-between">
                <div class="col-md-6">
                    <p class="mb-0">Hak Cipta © 2024 {{ config('app.name') }}. Semua Hak Dilindungi.</p>
                </div>
                <div class="col-md-6 text-md-end">
                    <ul class="list-inline mb-0">
                        <li class="list-inline-item"><a href="terms-condition.html" class="text-decoration-none text-white">Syarat dan Ketentuan</a></li>
                        <li class="list-inline-item"><a href="privacy-policy.html" class="text-decoration-none text-white">Kebijakan Privasi</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</footer>
