@extends('component.layout.app')
@push('title')
    <title>Dashboard Admin - Poliklinik Udinus</title>
@endpush
@push('styles')
    <style>
        html, body {
            height: 100%; /* Pastikan elemen body memiliki tinggi penuh */
            overflow: hidden; /* Hentikan scroll di body */
        }

        #sidenav-main {
            position: fixed; /* Tetap di tempat saat halaman digulir */
            top: 0;
            bottom: 0;
            overflow-y: auto; /* Aktifkan scroll vertikal hanya di aside */
            overflow-x: hidden; /* Hindari scroll horizontal */
            z-index: 1050; /* Agar tetap di atas elemen lain */
            background-color: #fff; /* Pastikan latar belakang solid */
        }

        .main-content {
            height: 100%; /* Tinggi penuh untuk konten utama */
            overflow-y: auto; /* Konten utama bisa scroll sendiri */
        }

    </style>
@endpush
@section('content')
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                <div class="card">
                    <div class="card-body p-3">
                        <div class="row">
                            <div class="col-8">
                                <div class="numbers">
                                    <p class="text-sm mb-0 text-uppercase font-weight-bold">Jumlah Dokter</p>
                                    <h5 class="font-weight-bolder">
                                        {{ $jumlah_dokter }}
                                    </h5>
                                </div>
                            </div>
                            <div class="col-4 d-flex align-items-center justify-content-center">
                                <div class="icon icon-shape bg-gradient-primary shadow-primary text-center rounded-circle">
                                    <i class="fa-solid fa-user-md text-lg opacity-10" aria-hidden="true"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                <div class="card">
                    <div class="card-body p-3">
                        <div class="row">
                            <div class="col-8">
                                <div class="numbers">
                                    <p class="text-sm mb-0 text-uppercase font-weight-bold">Jumlah Pasien</p>
                                    <h5 class="font-weight-bolder">
                                        {{ $jumlah_pasien }}
                                    </h5>
                                </div>
                            </div>
                            <div class="col-4 d-flex align-items-center justify-content-center">
                                <div class="icon icon-shape bg-gradient-danger shadow-danger text-center rounded-circle">
                                    <i class="fa-solid fa-users text-lg opacity-10" aria-hidden="true"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                <div class="card">
                    <div class="card-body p-3">
                        <div class="row">
                            <div class="col-8">
                                <div class="numbers">
                                    <p class="text-sm mb-0 text-uppercase font-weight-bold">Jumlah Poli</p>
                                    <h5 class="font-weight-bolder">
                                        {{ $jumlah_poli }}
                                    </h5>
                                </div>
                            </div>
                            <div class="col-4 d-flex align-items-center justify-content-center">
                                <div class="icon icon-shape bg-gradient-success shadow-success text-center rounded-circle">
                                    <i class="fa-solid fa-hospital text-lg opacity-10" aria-hidden="true"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-sm-6">
                <div class="card">
                    <div class="card-body p-3">
                        <div class="row">
                            <div class="col-8">
                                <div class="numbers">
                                    <p class="text-sm mb-0 text-uppercase font-weight-bold">Jumlah Obat</p>
                                    <h5 class="font-weight-bolder">
                                        {{ $jumlah_obat }}
                                    </h5>
                                </div>
                            </div>
                            <div class="col-4 d-flex align-items-center justify-content-center">
                                <div class="icon icon-shape bg-gradient-warning shadow-warning text-center rounded-circle">
                                    <i class="fa-solid fa-capsules text-lg opacity-10" aria-hidden="true"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-4">
            <div class="col-lg-7 mb-lg-0 mb-4">
                <div class="card z-index-2 h-100">
                    <div class="card-header pb-0 pt-3 bg-transparent">
                        <h6 class="text-capitalize">Jumlah Pasien Diperiksa Per Bulan</h6>
                    </div>
                    <div class="card-body p-3">
                        <div class="chart">
                            <canvas id="chart-line" class="chart-canvas" height="300"></canvas>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-5">
                <div class="card card-carousel overflow-hidden h-100 p-0">
                    <div id="carouselExampleCaptions" class="carousel slide h-100" data-bs-ride="carousel">
                        <div class="carousel-inner border-radius-lg h-100">
                            <div class="carousel-item h-100 active" style="background-image: url('{{ asset('img/background/background-1.jpg') }}'); background-size: cover;">
                                <div class="carousel-caption d-none d-md-block bottom-0 text-start start-0 ms-5">
                                    <div class="icon icon-shape icon-lg bg-white text-center border-radius-md mb-3">
                                        <i class="fa-solid fa-heart-pulse text-dark opacity-10"></i>
                                    </div>
                                    <h5 class="text-white mb-1">Pelayanan Kesehatan Terbaik</h5>
                                    <p>Kami siap memberikan pelayanan kesehatan yang profesional dan terpercaya untuk Anda dan keluarga.</p>
                                </div>
                            </div>
                            <div class="carousel-item h-100" style="background-image: url('{{ asset('img/background/background-2.jpg') }}'); background-size: cover;">
                                <div class="carousel-caption d-none d-md-block bottom-0 text-start start-0 ms-5">
                                    <div class="icon icon-shape icon-lg bg-white text-center border-radius-md mb-3">
                                        <i class="fa-solid fa-clock text-dark opacity-10"></i>
                                    </div>
                                    <h5 class="text-white mb-1">Layanan Cepat dan Tepat</h5>
                                    <p>Poliklinik kami menyediakan layanan medis yang cepat, tepat, dan ramah untuk setiap pasien.</p>
                                </div>
                            </div>
                            <div class="carousel-item h-100" style="background-image: url('{{ asset('img/background/background-3.jpg') }}'); background-size: cover;">
                                <div class="carousel-caption d-none d-md-block bottom-0 text-start start-0 ms-5">
                                    <div class="icon icon-shape icon-lg bg-white text-center border-radius-md mb-3">
                                        <i class="fa-solid fa-hospital-user text-dark opacity-10"></i>
                                    </div>
                                    <h5 class="text-white mb-1">Kesehatan Anda Prioritas Kami</h5>
                                    <p>Kami berkomitmen untuk menjaga kesehatan Anda dengan layanan medis terbaik dan fasilitas lengkap.</p>
                                </div>
                            </div>
                        </div>                        
                        <button class="carousel-control-prev w-5 me-3" type="button"
                            data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next w-5 me-3" type="button"
                            data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-4">
            <div class="col-lg-7 mb-lg-0 mb-4">
                <div class="card">
                    <div class="card-header pb-0 pt-3 bg-transparent">
                        <h6 class="text-capitalize">Daftar Obat Terbaru</h6>
                    </div>
                    <div class="card-body p-3">
                        <div class="table-responsive">
                            <table id="data-table" class="table table-hover table-responsive align-items-center align-middle w-100">
                                <thead>
                                    <tr>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                            Nama
                                        </th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Kemasan
                                        </th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Harga
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ( $daftarObatTerbaru as $daftarObat )
                                        <tr>
                                            <td>
                                                <p class="text-xs font-weight-bold mb-0">{{ $daftarObat->nama_obat }}</p>
                                            </td>
                                            <td class="align-middle text-center text-sm">
                                                <p class="text-xs font-weight-bold mb-0">
                                                    {{ $daftarObat->kemasan }}
                                            </td>
                                            <td class="align-middle text-center text-sm">
                                                <p class="text-xs font-weight-bold mb-0">
                                                    Rp. {{ number_format($daftarObat->harga, 0, ',', '.') }}
                                                </span>
                                            </td>
                                        </tr>
                                    @empty
                                        <td colspan="5" class="text-center">Tidak ada data</td>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-5">
                <div class="card">
                    <div class="card-header pb-0 pt-3 bg-transparent">
                        <h6 class="text-capitalize">Pasien Terbaru</h6>
                    </div>
                    <div class="card-body p-3">
                        <div class="table-responsive">
                            <table id="data-table" class="table table-hover table-responsive align-items-center align-middle w-100">
                                <thead>
                                    <tr>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                            Nama
                                        </th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            No RM
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ( $daftarPasienTerbaru as $daftarPasien )
                                        <tr>
                                            <td>
                                                <p class="text-xs font-weight-bold mb-0">{{ $daftarPasien->nama }}</p>
                                            </td>
                                            <td class="align-middle text-center text-sm">
                                                <p class="text-xs font-weight-bold mb-0">
                                                    {{ $daftarPasien->no_rm }}
                                                </p>
                                            </td>
                                        </tr>
                                    @empty
                                        <td colspan="2" class="text-center">Tidak ada data</td>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <footer class="footer pt-3">
            <div class="container-fluid">
                <div class="copyright text-center text-sm text-muted text-lg-start">
                    ©
                    2025
                    Kharafi Dwi Andika - Sistem Informasi Manajemen Poliklinik Bengkel Koding
                </div>
            </div>
        </footer>
    </div>
@endsection
@push('scripts')
<script>
    var ctx1 = document.getElementById("chart-line").getContext("2d");

    var gradientStroke1 = ctx1.createLinearGradient(0, 230, 0, 50);

    gradientStroke1.addColorStop(1, 'rgba(94, 114, 228, 0.2)');
    gradientStroke1.addColorStop(0.2, 'rgba(94, 114, 228, 0.0)');
    gradientStroke1.addColorStop(0, 'rgba(94, 114, 228, 0)');

    new Chart(ctx1, {
        type: "bar",
        data: {
            labels: ["Jan", "Feb", "Mar", "Apr", "Mei", "Jun", "Jul", "Aug", "Sep", "Okt", "Nov", "Des"],
            datasets: [{
                label: "Jumlah Pasien",
                tension: 0.4,
                borderWidth: 0,
                pointRadius: 4, // Tambahkan titik pada setiap data
                pointBackgroundColor: "#5e72e4", // Warna titik
                borderColor: "#5e72e4",
                backgroundColor: gradientStroke1,
                borderWidth: 3,
                fill: true,
                data: @json($data_pasien), // Data pasien per bulan
                maxBarThickness: 6
            }],
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    display: true, // Menampilkan legenda
                    labels: {
                        font: {
                            family: "Open Sans",
                            size: 12,
                            color: "#34495e",
                        }
                    }
                }
            },
            interaction: {
                intersect: false,
                mode: 'index',
            },
            scales: {
                y: {
                    grid: {
                        drawBorder: false,
                        display: true,
                        drawOnChartArea: true,
                        drawTicks: false,
                        borderDash: [5, 5]
                    },
                    ticks: {
                        display: true,
                        padding: 10,
                        color: '#34495e',
                        font: {
                            size: 12,
                            family: "Open Sans",
                            style: 'normal',
                            lineHeight: 2
                        },
                    },
                    title: { // Tambahkan label pada sumbu y
                        display: true,
                        text: 'Jumlah Pasien',
                        color: '#34495e',
                        font: {
                            size: 14,
                            family: "Open Sans",
                            weight: 'bold',
                        },
                    },
                },
                x: {
                    grid: {
                        drawBorder: false,
                        display: false,
                        drawOnChartArea: false,
                        drawTicks: false,
                        borderDash: [5, 5]
                    },
                    ticks: {
                        display: true,
                        color: '#34495e',
                        padding: 20,
                        font: {
                            size: 12,
                            family: "Open Sans",
                            style: 'normal',
                            lineHeight: 2
                        },
                    },
                },
            },
        },
    });
</script>
@endpush