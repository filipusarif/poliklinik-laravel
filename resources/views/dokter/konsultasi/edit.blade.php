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
    <section id="tambah-dokter">
        <div class="container-fluid py-7">
            <div class="row">
                <div class="col-12">
                    <div class="card mb-4">
                        <div class="card-header pb-0">
                            <h3>Edit Konsultasi</h3>
                            <a href="{{ route('dokter.konsultasi.index') }}" class="btn btn-success shadow-sm float-right mt-2">
                                <i class="fa fa-arrow-left me-1"></i>
                                Kembali
                            </a>
                        </div>
                        <div class="card-body">
                            @include('component.alert')
                            <form method="POST" action="{{ route('dokter.konsultasi.update', $konsultasi->id) }}" enctype="multipart/form-data" id="edit-form">
                                @csrf
                                @method('PUT')
                                <div class="row">
                                    <div class="col-md-12">
                                        {{-- <div class="form-group row border-bottom pb-4 mx-1">
                                            <label for="id" class="col-form-label">Nama Dokter</label>
                                            <div class="col-sm-12">
                                                <select class="form-select @error('id') is-invalid @enderror" name="id" id="id" required>
                                                        <option value="{{ old('id', $konsultasi->id_dokter) }}" selected >{{ $konsultasi->dokter->nama }}</option>
                                                        @foreach ($dokters as $dokter)
                                                            <option value="{{ $dokter->id }}">{{ $dokter->nama }}</option>
                                                        @endforeach
                                                </select>
                                                @error('id')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group row border-bottom pb-4 mx-1">
                                            <label for="subject" class="col-form-label">Subject</label>
                                            <div class="col-sm-12">
                                                <input type="text" class="form-control @error('subject') is-invalid @enderror"
                                                    name="subject" id="subject" required  value="{{ old('subject', $konsultasi->subject) }}">
                                                @error('subject')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div> --}}
                                        <div class="form-group row border-bottom pb-4 mx-1">
                                            <label for="jawaban" class="col-form-label">Jawaban</label>
                                            <div class="col-sm-12">
                                                <textarea class="form-control @error('jawaban') is-invalid @enderror"
                                                    name="jawaban" id="jawaban" required >{{ old('jawaban', $konsultasi->jawaban) }}</textarea>
                                                @error('jawaban')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="d-flex justify-content-end">
                                            <button type="submit" class="btn btn-success">
                                                <i class="fa-solid fa-download me-1"></i> Simpan
                                            </button>
                                        </div>                                        
                                    </div>
                                </div>
                            </form>
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
