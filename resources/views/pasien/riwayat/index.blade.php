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
    <section id="riwayat-pasien">
        <div class="container-fluid py-4">
            @include('component.alert')
            <div class="row">
                <!-- Daftar Poli -->
                <div class="col-md-3 mb-4">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Daftar Poli</h3>
                        </div>
                        <form action="{{ route('pasien.daftar_poli') }}" method="POST">
                            @csrf
                            <div class="form-group row border-bottom pb-4 mx-1">
                                <label for="poli" class="col-form-label">Poli <span class="text-danger">*</span></label>
                                <div class="col-sm-12">
                                    <div class="input-group">
                                        <select class="form-select @error('poli') is-invalid @enderror" name="poli" id="poli" required>
                                            <option value="" disabled selected>Pilih Poli</option>
                                            @foreach ($polis as $poli)
                                                <option value="{{ $poli->id }}">{{ $poli->nama_poli }}</option>
                                            @endforeach
                                        </select>
                                        @error('poli')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row border-bottom pb-4 mx-1">
                                <label for="tgl_periksa" class="col-form-label">Tanggal Periksa <span class="text-danger">*</span></label>
                                <div class="col-sm-12">
                                    <input type="date" 
                                        class="form-control @error('tgl_periksa') is-invalid @enderror" 
                                        name="tgl_periksa" 
                                        id="tgl_periksa" 
                                        min="{{ now()->addDays(1)->format('Y-m-d') }}" 
                                        max="{{ now()->addDays(30)->format('Y-m-d') }}" 
                                        required>
                                    @error('tgl_periksa')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row border-bottom pb-4 mx-1">
                                <label for="jadwal" class="col-form-label">Jadwal <span class="text-danger">*</span></label>
                                <div class="col-sm-12">
                                    <div class="input-group">
                                        <select class="form-select @error('jadwal') is-invalid @enderror" name="jadwal" id="jadwal" required>
                                            <option value="" disabled selected>Pilih Jadwal</option>
                                        </select>
                                        @error('jadwal')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>                            
                            <div class="form-group row border-bottom pb-4 mx-1">
                                <label for="keluhan" class="col-form-label">Keluhan <span class="text-danger">*</span></label>
                                <div class="col-sm-12">
                                    <textarea class="form-control @error('keluhan') is-invalid @enderror" name="keluhan" id="keluhan" rows="3" required></textarea>
                                    @error('keluhan')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row mx-1">
                                <div class="col-sm-12">
                                    <button type="submit" class="btn btn-dark w-100">Daftar Poli</button>
                                </div>
                            </div>                            
                        </form>                        
                    </div>
                </div>
                <!-- Riwayat Pasien -->
                <div class="col-md-9 mb-4">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Riwayat Pasien</h3>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="data-table" class="table table-hover table-responsive align-items-center align-middle w-100">
                                    <thead>
                                        <tr>
                                            <th scope="col">No</th>
                                            <th scope="col">Poli</th>
                                            <th scope="col">Antrian</th>
                                            <th scope="col">Tanggal Periksa</th>
                                            <th scope="col">Jadwal</th>
                                            <th scope="col">Dokter</th>
                                            <th scope="col">Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($riwayats as $riwayat)
                                            <tr>
                                                <td class="align-middle text-center">
                                                    {{ $loop->iteration }}
                                                </td>
                                                <td class="align-middle text-center">
                                                    {{ $riwayat->jadwalPraktik->dokter->poli->nama_poli }}
                                                </td>
                                                <td class="align-middle text-center">
                                                    <span class="badge bg-dark badge-lg">{{ $riwayat->no_antrian }}</span>
                                                </td>
                                                <td class="align-middle text-center">
                                                    {{ \Carbon\Carbon::parse($riwayat->tgl_periksa)->translatedFormat('d F Y') }}
                                                </td>
                                                <td class="align-middle text-center">
                                                    {{ $riwayat->jadwalPraktik->hari }} 
                                                    ({{ \Carbon\Carbon::parse($riwayat->jadwalPraktik->jam_mulai)->format('H:i') }} - 
                                                    {{ \Carbon\Carbon::parse($riwayat->jadwalPraktik->jam_selesai)->format('H:i') }})
                                                </td>
                                                <td class="align-middle text-center">
                                                    {{ $riwayat->jadwalPraktik->dokter->nama }}
                                                </td>
                                                <td class="align-middle text-center">
                                                    <div class="d-flex justify-content-center align-items-center gap-2">
                                                        @if ($riwayat->periksa)
                                                            <span class="badge bg-success">Sudah Diperiksa</span>
                                                        @else
                                                            <span class="badge bg-danger">Belum Diperiksa</span>
                                                        @endif
                                                        <a href="{{ route('pasien.riwayat.detail', $riwayat->id) }}" class="btn btn-dark btn-sm">
                                                            <i class="fa fa-eye"></i>
                                                        </a>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
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
            const tglPeriksaInput = $('#tgl_periksa');
            jadwalSelect.html('<option value="" disabled selected>Loading...</option>');
            tglPeriksaInput.val('');  // Mengosongkan input tanggal saat poli diubah
            tglPeriksaInput.flatpickr().clear(); // Reset kalender flatpickr jika ada
    
            if (poliId) {
                // Mengambil jadwal poli berdasarkan pilihan poli
                $.get(`/pasien/get-jadwal/${poliId}`)
                    .done(function (data) {
                        jadwalSelect.html('<option value="" disabled selected>Pilih Jadwal</option>');
    
                        // Menyusun array untuk hari yang tersedia berdasarkan jadwal
                        const availableDays = data.map(jadwal => jadwal.hari);
                        let minDate = new Date();
                        minDate.setDate(minDate.getDate() + 1); // Tanggal minimum 1 hari ke depan
                        let availableDates = [];
    
                        // Membatasi pilihan tanggal pada hari yang ada jadwalnya
                        for (let i = 0; i <= 30; i++) {
                            let date = new Date(minDate);
                            date.setDate(date.getDate() + i);
    
                            const dayName = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'][date.getDay()-1];
                            if (availableDays.includes(dayName)) {
                                availableDates.push(date.toISOString().split('T')[0]);
                            }
                        }
    
                        // Mengupdate tanggal yang bisa dipilih
                        flatpickr('#tgl_periksa', {
                            dateFormat: "Y-m-d",
                            minDate: minDate,
                            maxDate: availableDates[availableDates.length - 1],
                            disable: [
                                (date) => !availableDates.includes(date.toISOString().split('T')[0]) // Menonaktifkan tanggal yang tidak tersedia
                            ],
                            locale: "id",
                            disableMobile: true,
                        });
    
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
        $('#tgl_periksa').on('change', function () {
            const selectedDate = new Date($(this).val()); // Tanggal yang dipilih oleh pengguna
            const selectedDay = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'][selectedDate.getDay()];
            const poliId = $('#poli').val(); // ID Poli yang dipilih
            const jadwalSelect = $('#jadwal');
            jadwalSelect.html('<option value="" disabled selected>Loading...</option>');
    
            if (poliId && selectedDay) {
                // Mengambil jadwal poli berdasarkan pilihan poli
                $.get(`/pasien/get-jadwal/${poliId}`)
                    .done(function (data) {
                        jadwalSelect.html('<option value="" disabled selected>Pilih Jadwal</option>');
    
                        // Menyaring jadwal hanya untuk hari yang sesuai dengan tanggal yang dipilih
                        const filteredJadwal = data.filter(jadwal => jadwal.hari.toLowerCase() === selectedDay.toLowerCase());
    
                        // Memasukkan data jadwal yang sesuai dengan hari yang dipilih
                        if (filteredJadwal.length > 0) {
                            filteredJadwal.forEach(function (jadwal) {
                                const option = $('<option></option>')
                                    .val(jadwal.id)
                                    .text(`${jadwal.hari} (${jadwal.jam_mulai} - ${jadwal.jam_selesai}) - ${jadwal.dokter.nama}`);
                                jadwalSelect.append(option);
                            });
                        } else {
                            jadwalSelect.html('<option value="" disabled selected>Tidak ada jadwal untuk hari ini</option>');
                        }
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
    <script>
        // Inisialisasi flatpickr
        flatpickr('#tgl_periksa', {
            dateFormat: "Y-m-d",
            minDate: new Date().fp_incr(1),
            maxDate: new Date().fp_incr(30),
            locale: "id",
            disable: ['today'],
        });
    </script>
@endpush
