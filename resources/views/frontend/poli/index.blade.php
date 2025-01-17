@extends('component.layout.app')
@push('title')
    <title>Daftar Poli - Poliklinik Udinus</title>
@endpush
@push('styles')
    <link rel="stylesheet" href="{{ asset('css/select2/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/select2/select2-bootstrap-5-theme.min.css') }}">
    <style>
        body {
            background: url('/img/frontend/poli/poli-background.jpg') no-repeat center center;
            background-size: cover;
            color: white;
        }

        .poli-section {
            padding-top: 95px;
            position: relative;
            z-index: 1;
        }

        .poli-section:before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            z-index: -1;
        }

        .card {
            border-radius: 15px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .schedule-item {
            background-color: rgba(255, 255, 255, 0.8);
            border-radius: 5px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .btn-sm {
            padding: 0.375rem 0.75rem;
        }

        @media (max-width: 768px) {
            .card-body {
                padding: 15px;
            }

            .card-title {
                font-size: 1.2rem;
            }

            .text-end {
                text-align: center;
            }

            .schedule-item {
                margin-bottom: 5px;
            }
        }
    </style>
@endpush
@section('content')
    <section class="poli-section">
        <div class="container-fluid">
            <div class="row">
                <h1 class="display-4 fw-bold">Poliklinik</h1>
                <div class="col-md-3">
                    <!-- Filter Poli -->
                    <div class="mb-4">
                        <div class="card shadow-sm border-light">
                            <div class="card-header bg-dark text-white">
                                <h4 class="mb-0 text-white"><i class="fa-solid fa-filter fa-lg me-2"></i>Filter Poli</h4>
                            </div>
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <i class="fa-solid fa-hospital fa-lg me-2"></i> <!-- Icon poli -->
                                    <select id="poliFilter" class="form-select form-select-lg">
                                        <option value="">Semua Poli</option>
                                        @foreach ($polis as $poli)
                                            <option value="{{ $poli->id }}">{{ $poli->nama_poli }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-9">
                    <div class="row">
                        @foreach ($dokters as $dokter)
                            <div class="mb-4 dokter-item" data-poli-id="{{ $dokter->poli->id }}">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="d-flex align-items-center mb-4">
                                            <img src="{{ asset('img/user/user.png') }}" class="rounded-circle"
                                                style="max-width: 80px; height: 80px; object-fit: cover; object-position: top;">
                                            <div class="ms-3">
                                                <h4 class="card-title mb-1">{{ $dokter->nama }}</h4>
                                                <p class="text-muted mb-2">{{ $dokter->poli->nama_poli ?? 'Spesialis Tidak Diketahui' }}</p>
                                            </div>
                                        </div>

                                        @if ($dokter->groupedJadwal->isNotEmpty())
                                            <div class="row">
                                                @foreach ($dokter->groupedJadwal as $hari => $jadwals)
                                                    <div class="col-12 col-lg-3">
                                                        <div class="text-center p-1">
                                                            <p><strong>{{ $hari }}</strong></p>
                                                            @foreach($jadwals as $jadwal)
                                                                <p>{{ \Carbon\Carbon::parse($jadwal->jam_mulai)->format('H:i') }} - {{ \Carbon\Carbon::parse($jadwal->jam_selesai)->format('H:i') }}</p>
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        @else
                                            <div class="row">
                                                <div class="col-12 col-lg-3">
                                                    <div class="text-center p-1">
                                                        <p><strong>Tidak ada jadwal</strong></p>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif

                                        {{-- <div class="text-end">
                                            <a href="#">
                                                <button class="btn btn-dark align-items-center">
                                                    <span class="me-2">Jadwalkan Pemeriksaan</span>
                                                    <i class="fas fa-arrow-right"></i>
                                                </button>
                                            </a>
                                        </div> --}}
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@push('scripts')
    <script src="{{ asset('js/plugins/select2.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('#poliFilter').on('change', function() {
                var selectedPoli = $(this).val(); // Ambil poli_id yang dipilih

                // Tampilkan semua dokter jika tidak ada poli yang dipilih
                if (selectedPoli === '') {
                    $('.dokter-item').show();
                } else {
                    // Sembunyikan dokter yang tidak sesuai dengan poli yang dipilih
                    $('.dokter-item').each(function() {
                        var poliId = $(this).data('poli-id');
                        if (poliId == selectedPoli) {
                            $(this).show(); // Tampilkan dokter yang cocok dengan poli
                        } else {
                            $(this).hide(); // Sembunyikan dokter yang tidak cocok
                        }
                    });
                }
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            // Inisialisasi Select2
            $('#poliFilter').select2({
                placeholder: "Pilih Poli", 
                allowClear: true,
                width: '100%', 
                theme: 'bootstrap-5'
            });
        })
    </script>
@endpush
