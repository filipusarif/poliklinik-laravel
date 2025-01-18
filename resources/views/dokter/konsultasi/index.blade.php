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
                                                Nama Pasien
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
                                                    <p class="text-xs font-weight-bold mb-0">{{ $konsultasi->pasien->nama }}</p>
                                                </td>
                                                <td>
                                                    <p class="text-xs font-weight-bold mb-0">{{ $konsultasi->subject }}</p>
                                                </td>
                                                <td class="align-middle text-center">
                                                    <p class="text-xs font-weight-bold mb-0">{{ $konsultasi->pertanyaan }}</p>
                                                </td>
                                                <td>
                                                    
                                                        @if ($konsultasi->jawaban === " ")
                                                        <a href="{{ route('dokter.konsultasi.edit', $konsultasi->id)  }}" class="btn btn-success shadow-sm float-right mt-2">
                                                            <i class="fa fa-plus me-1"></i> 
                                                            Tanggapi
                                                        </a>
                                                        @else
                                                        <p class="text-xs font-weight-bold mb-0">{{ $konsultasi->jawaban }}</p>
                                                        @endif
                                                        
                                                </td>
                                                <td class="align-middle text-center">
                                                    <div class="d-flex justify-content-center align-items-center gap-2">
                                                        <a href="{{ route('dokter.konsultasi.edit', $konsultasi->id) }}" class="btn btn-dark btn-sm">
                                                            <i class="fa-solid fa-edit"></i>
                                                        </a>
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
            // tglPeriksaInput.val('');  // Mengosongkan input tanggal saat poli diubah
            // tglPeriksaInput.flatpickr().clear(); // Reset kalender flatpickr jika ada
    
            if (poliId) {
                // Mengambil jadwal poli berdasarkan pilihan poli
                $.get(`/pasien/get-jadwal/${poliId}`)
                    .done(function (data) {
                        jadwalSelect.html('<option value="" disabled selected>Pilih Jadwal</option>');
    
                        // Menyusun array untuk hari yang tersedia berdasarkan jadwal
                        // const availableDays = data.map(jadwal => jadwal.hari);
                        // let minDate = new Date();
                        // minDate.setDate(minDate.getDate() + 1); // Tanggal minimum 1 hari ke depan
                        // let availableDates = [];
    
                        // Membatasi pilihan tanggal pada hari yang ada jadwalnya
                        // for (let i = 0; i <= 30; i++) {
                        //     let date = new Date(minDate);
                        //     date.setDate(date.getDate() + i);
    
                        //     const dayName = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'][date.getDay()-1];
                        //     if (availableDays.includes(dayName)) {
                        //         availableDates.push(date.toISOString().split('T')[0]);
                        //     }
                        // }
    
                        // Mengupdate tanggal yang bisa dipilih
                        // flatpickr('#tgl_periksa', {
                        //     dateFormat: "Y-m-d",
                        //     minDate: minDate,
                        //     maxDate: availableDates[availableDates.length - 1],
                        //     disable: [
                        //         (date) => !availableDates.includes(date.toISOString().split('T')[0]) // Menonaktifkan tanggal yang tidak tersedia
                        //     ],
                        //     locale: "id",
                        //     disableMobile: true,
                        // });
    
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
    
        // Menampilkan pilihan jadwal berdasarkan tanggal yang dipilih
        // $('#tgl_periksa').on('change', function () {
        //     const selectedDate = new Date($(this).val()); // Tanggal yang dipilih oleh pengguna
        //     const selectedDay = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'][selectedDate.getDay()];
        //     const poliId = $('#poli').val(); // ID Poli yang dipilih
        //     const jadwalSelect = $('#jadwal');
        //     jadwalSelect.html('<option value="" disabled selected>Loading...</option>');
    
        //     if (poliId && selectedDay) {
        //         // Mengambil jadwal poli berdasarkan pilihan poli
        //         $.get(`/pasien/get-jadwal/${poliId}`)
        //             .done(function (data) {
        //                 jadwalSelect.html('<option value="" disabled selected>Pilih Jadwal</option>');
    
        //                 // Menyaring jadwal hanya untuk hari yang sesuai dengan tanggal yang dipilih
        //                 const filteredJadwal = data.filter(jadwal => jadwal.hari.toLowerCase() === selectedDay.toLowerCase());
    
        //                 // Memasukkan data jadwal yang sesuai dengan hari yang dipilih
        //                 if (filteredJadwal.length > 0) {
        //                     filteredJadwal.forEach(function (jadwal) {
        //                         const option = $('<option></option>')
        //                             .val(jadwal.id)
        //                             .text(`${jadwal.hari} (${jadwal.jam_mulai} - ${jadwal.jam_selesai}) - ${jadwal.dokter.nama}`);
        //                         jadwalSelect.append(option);
        //                     });
        //                 } else {
        //                     jadwalSelect.html('<option value="" disabled selected>Tidak ada jadwal untuk hari ini</option>');
        //                 }
        //             })
        //             .fail(function (error) {
        //                 console.error('Error fetching jadwal:', error);
        //                 jadwalSelect.html('<option value="" disabled selected>Error loading data</option>');
        //             });
        //     }
        // });
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
    <script>
        // Inisialisasi flatpickr
        // flatpickr('#tgl_periksa', {
        //     dateFormat: "Y-m-d",
        //     minDate: new Date().fp_incr(1),
        //     maxDate: new Date().fp_incr(30),
        //     locale: "id",
        //     disable: ['today'],
        // });
    </script>
@endpush
