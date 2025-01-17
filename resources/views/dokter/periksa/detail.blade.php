@extends('component.layout.app')
@push('title')
    <title>Detail Periksa - Poliklinik Udinus</title>
@endpush
@push('styles')
    <link rel="stylesheet" href="{{ asset('css/select2/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/select2/select2-bootstrap-5-theme.min.css') }}">
@endpush
@section('content')
    <!-- Detail Periksa -->
    <section id="detail-periksa">
        <div class="container-fluid py-4">
            <div class="row">
                <div class="col-12">
                    <div class="card mb-4">
                        <div class="card-header pb-0">
                            <h3>Detail Periksa</h3>
                            <a href="{{ route('dokter.periksa.index') }}" class="btn btn-success shadow-sm float-right">
                                <i class="fa fa-arrow-left me-1"></i>
                                Kembali
                            </a>
                        </div>
                        <div class="card-body">
                            @include('component.alert')
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group row border-bottom pb-4 mx-1">
                                        <label for="nama" class="col-form-label">Nama Pasien</label>
                                        <div class="col-sm-12">
                                            <input type="text" class="form-control @error('nama') is-invalid @enderror"
                                                name="nama" id="nama" value="{{ old('nama', $daftarpoli->pasien->nama) }}" readonly>
                                        </div>
                                    </div>
                                    <div class="form-group row border-bottom pb-4 mx-1">
                                        <label for="tgl_periksa" class="col-form-label">Tanggal Periksa</label>
                                        <div class="col-sm-12">
                                            <input type="date" class="form-control @error('tgl_periksa') is-invalid @enderror"
                                                name="tgl_periksa" id="tgl_periksa" value="{{ old('tgl_periksa', $daftarpoli->tgl_periksa) }}" readonly>
                                        </div>
                                    </div>
                                    <div class="form-group row border-bottom pb-4 mx-1">
                                        <label for="keluhan" class="col-form-label">Keluhan</label>
                                        <div class="col-sm-12">
                                            <textarea class="form-control @error('keluhan') is-invalid @enderror"
                                                name="keluhan" id="keluhan" readonly>{{ old('keluhan', $daftarpoli->keluhan) }}</textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <form action="{{ route('dokter.periksa.store', $daftarpoli->id) }}" method="POST">
                                        @csrf
                                        <div class="form-group row border-bottom pb-4 mx-1">
                                            <label for="catatan" class="col-form-label">Catatan</label>
                                            <div class="col-sm-12">
                                                <textarea class="form-control @error('catatan') is-invalid @enderror"
                                                    name="catatan" id="catatan" required>{{ old('catatan', $periksa ? $periksa->catatan : '') }}</textarea>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group row border-bottom pb-4 mx-1">
                                                    <label for="biaya_periksa" class="col-form-label">Biaya Obat</label>
                                                    <div class="col-sm-12">
                                                        <input type="text" class="form-control @error('biaya_periksa') is-invalid @enderror" 
                                                            name="biaya_periksa" id="biaya_periksa" readonly>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group row border-bottom pb-4 mx-1">
                                                    <label for="total_biaya" class="col-form-label">Total Biaya</label>
                                                    <div class="col-sm-12">
                                                        <input type="text" class="form-control @error('total_biaya') is-invalid @enderror" 
                                                            name="total_biaya" id="total_biaya" readonly>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>                                        
                                        <div class="form-group row border-bottom pb-4 mx-1">
                                            <label for="obat" class="col-form-label">Obat</label>
                                            <div class="col-sm-12">
                                                <select class="form-control select2 @error('obat') is-invalid @enderror" name="obat[]" id="obat" multiple>
                                                    @foreach ($obats as $obat)
                                                        <option value="{{ $obat->id }}" data-harga="{{ $obat->harga }}"
                                                            {{ in_array($obat->id, $daftarObat) ? 'selected' : '' }}>
                                                            {{ $obat->nama_obat }} - Rp. {{ number_format($obat->harga, 0, ',', '.') }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                @error('obat')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>                               
                                        <div class="d-flex justify-content-end">
                                            <button type="submit" class="btn btn-success">
                                                <i class="fa-solid fa-download me-1"></i> Simpan
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@push('scripts')
    <script src="{{ asset('js/plugins/select2.min.js') }}"></script>
    <script>
        $(document).ready(function () {

            $('#obat').select2({
                placeholder: "Pilih Obat", // Placeholder ketika tidak ada pilihan
                // allowClear: true, // Menambahkan tombol untuk menghapus pilihan
                width: '100%', // Agar dropdown menggunakan lebar penuh
                theme: 'bootstrap-5'
            });

            // Fungsi untuk menghitung total harga
            function hitungTotalHarga() {
                let totalHarga = 0;

                // Menghitung total harga berdasarkan obat yang dipilih
                $('#obat').find('option:selected').each(function () {
                    let harga = $(this).data('harga');
                    totalHarga += parseFloat(harga);
                });

                // Format nilai total harga ke dalam format ribuan
                let formattedTotal = formatRibuan(totalHarga);
                
                // Mengubah nilai input dengan total harga yang diformat
                $('#biaya_periksa').val(formattedTotal);

                // Total biaya
                let totalBiaya = totalHarga + 150000;
                $('#total_biaya').val(formatRibuan(totalBiaya));
            }

            // Fungsi untuk memformat angka ke dalam format ribuan
            function formatRibuan(angka) {
                return angka.toString().replace(/\B(?=(\d{3})+(?!\d))/g, '.');
            }

            // Event listener untuk perubahan pilihan pada select
            $('#obat').on('change', function () {
                hitungTotalHarga();
            });

            // Panggil fungsi hitungTotalHarga saat halaman dimuat
            $(document).ready(function () {
                hitungTotalHarga();
            });

        });
    </script>
@endpush