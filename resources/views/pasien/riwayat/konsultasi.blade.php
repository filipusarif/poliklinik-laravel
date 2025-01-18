@extends('component.layout.app')
@push('title')
    <title>Riwayat Pasien - Poliklinik Udinus</title>
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

        #riwayat-pasien {
            padding-top: 95px;
            position: relative;
            z-index: 1;
        }
    </style>
@endpush

@section('content')
    <!-- Riwayat Pasien -->
    <section id="index-dokter">
        <div class="container-fluid py-7">
            <div class="row">
                <div class="col-12">
                    <div class="card mb-4">
                        <div class="card-header pb-0">
                            <h3>Daftar Konsultasi Medis Pasien</h3>
                            <a href="{{ route('pasien.konsultasi.create') }}" class="btn btn-success shadow-sm float-right mt-2">
                                <i class="fa fa-plus me-1"></i> 
                                Tambah 
                            </a>
                        </div>
                        <div class="card-body">
                            @include('component.alert')
                            <div class="table-responsive">
                                <table id="data-table" class="table table-hover table-responsive align-items-center align-middle w-100">
                                    <thead>
                                        <tr>
                                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Tanggal Konsultasi
                                            </th>
                                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                                Nama Dokter
                                            </th>
                                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Subject
                                            </th>
                                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Pertanyaan
                                            </th>
                                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Tanggapan
                                            </th>
                                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Aksi
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ( $konsultasis as $konsultasi )
                                            <tr>
                                                <td>
                                                    <p class="text-xs font-weight-bold mb-0">{{ $konsultasi->tgl_konsultasi }}</p>
                                                </td>
                                                <td>
                                                    <p class="text-xs font-weight-bold mb-0">{{ $konsultasi->dokter->nama }}</p>
                                                </td>
                                                <td>
                                                    <p class="text-xs font-weight-bold mb-0">{{ $konsultasi->subject }}</p>
                                                </td>
                                                <td class="align-middle text-center">
                                                    <p class="text-xs font-weight-bold mb-0">{{ $konsultasi->pertanyaan }}</p>
                                                </td>
                                                <td>
                                                    <p class="text-xs font-weight-bold mb-0">{{ $konsultasi->jawaban }}</p>
                                                </td>
                                                <td class="align-middle text-center">
                                                    <div class="d-flex justify-content-center align-items-center gap-2">
                                                        <a href="{{ route('pasien.konsultasi.edit', $konsultasi->id) }}" class="btn btn-dark btn-sm">
                                                            <i class="fa-solid fa-edit"></i>
                                                        </a>
                                                        <form action="{{ route('pasien.konsultasi.destroy', $konsultasi->id) }}" method="POST" class="delete-form">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button class="btn btn-danger btn-sm" type="submit">
                                                                <i class="fa fa-trash"></i>
                                                            </button>
                                                        </form>
                                                    </div>
                                                </td>
                                            </tr>
                                        @empty
            
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@include('component.datatable')
@push('scripts')
    <script src="{{ asset('js/plugins/select2.min.js') }}"></script>
    <script src="{{ asset('js/plugins/flatpickr.js') }}"></script>
    <script src="{{ asset('js/plugins/flatpickr-id.js') }}"></script>
    <script>
        // Menampilkan pilihan poli dan jadwal berdasarkan poli yang dipilih
        $('#poli').on('change', function () {
            const poliId = $(this).val(); // ID Poli yang dipilih
            const jadwalSelect = $('#jadwal');
            // const tglPeriksaInput = $('#tgl_periksa');
            jadwalSelect.html('<option value="" disabled selected>Loading...</option>');
    
            if (poliId) {
                // Mengambil jadwal poli berdasarkan pilihan poli
                $.get(`/pasien/get-jadwal/${poliId}`)
                    .done(function (data) {
                        jadwalSelect.html('<option value="" disabled selected>Pilih Jadwal</option>');
    
                        
                        // Memasukkan data jadwal ke dropdown
                        data.forEach(function (jadwal) {
                            const option = $('<option></option>')
                                .val(jadwal.id)
                                .text(`${jadwal.hari} (${jadwal.jam_mulai} - ${jadwal.jam_selesai}) - ${jadwal.dokter.nama}`);
                            jadwalSelect.append(option);
                        });
                    })
                    .fail(function (error) {
                        console.error('Error fetching jadwal:', error);
                        jadwalSelect.html('<option value="" disabled selected>Error loading data</option>');
                    });
            }
        });
    
        
    </script>    
    <script>
        // Inisialisasi Select2
        $('#jadwal').select2({
            placeholder: "Pilih Jadwal", 
            allowClear: true,
            width: '100%', 
            theme: 'bootstrap-5'
        });

        $('#poli').select2({
            placeholder: "Pilih Poli", 
            allowClear: true,
            width: '100%', 
            theme: 'bootstrap-5'
        });
    </script>
@endpush
