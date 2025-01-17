@extends('component.layout.app')

@push('title')
    <title>Detail Periksa - Poliklinik Udinus</title>
@endpush
@push('styles')
    <style>
        body {
            background: url('/img/frontend/poli/poli-background.jpg') no-repeat center center;
            background-size: cover;
            color: white;
        }

        #detail-periksa {
            padding-top: 95px;
            position: relative;
            z-index: 1;
        }
    </style>
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
                            <a href="{{ route('pasien.riwayat.index') }}" class="btn btn-success shadow-sm float-right mt-2">
                                <i class="fa fa-arrow-left me-1"></i>
                                Kembali
                            </a>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <!-- Data Pasien -->
                                <div class="col-md-6">
                                    <div class="form-group row border-bottom pb-4 mx-1">
                                        <div class="col-sm-4">
                                            <strong>Nama Pasien</strong>
                                        </div>
                                        <div class="col-sm-8">
                                            <span>{{ $daftarpoli->pasien->nama }}</span>
                                        </div>
                                    </div>
                                    <div class="form-group row border-bottom pb-4 mx-1">
                                        <div class="col-sm-4">
                                            <strong>Tanggal Periksa</strong>
                                        </div>
                                        <div class="col-sm-8">
                                            <span>{{ \Carbon\Carbon::parse($daftarpoli->tgl_periksa)->isoFormat('D MMMM YYYY') }}</span>
                                        </div>
                                    </div>
                                    <div class="form-group row border-bottom pb-4 mx-1">
                                        <div class="col-sm-4">
                                            <strong>Keluhan</strong>
                                        </div>
                                        <div class="col-sm-8">
                                            <span>{{ $daftarpoli->keluhan }}</span>
                                        </div>
                                    </div>
                                    <div class="form-group row border-bottom pb-4 mx-1">
                                        <div class="col-sm-4">
                                            <strong>Dokter</strong>
                                        </div>
                                        <div class="col-sm-8">
                                            <span>{{ $daftarpoli->jadwalPraktik->dokter->nama }}</span>
                                        </div>
                                    </div>
                                    <div class="form-group row border-bottom pb-4 mx-1">
                                        <div class="col-sm-4">
                                            <strong>Poli</strong>
                                        </div>
                                        <div class="col-sm-8">
                                            <span>{{ $daftarpoli->jadwalPraktik->dokter->poli->nama_poli }}</span>
                                        </div>
                                    </div>
                                </div>
                                <!-- Data Periksa -->
                                <div class="col-md-6">
                                    @if ($periksa)
                                        <div class="form-group row border-bottom pb-4 mx-1">
                                            <div class="col-sm-4">
                                                <strong>Catatan</strong>
                                            </div>
                                            <div class="col-sm-8">
                                                <span>{{ $periksa->catatan }}</span>
                                            </div>
                                        </div>
                                        <div class="form-group row border-bottom pb-4 mx-1">
                                            <div class="col-sm-4">
                                                <strong>Biaya Periksa</strong>
                                            </div>
                                            <div class="col-sm-8">
                                                <span class="badge badge-info badge-pill badge-lg" id="biaya_periksa">
                                                    <h5>Rp {{ number_format($periksa->biaya_periksa, 0, ',', '.') }}</h5>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="form-group row border-bottom pb-4 mx-1">
                                            <div class="col-sm-4">
                                                <strong>Obat</strong>
                                            </div>
                                            <div class="col-sm-8">
                                                <table class="table">
                                                    <thead>
                                                        <tr>
                                                            <th>Nama Obat</th>
                                                            <th>Harga</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @php
                                                            $total = 0;
                                                        @endphp
                                                        @foreach ($obats as $obat)
                                                            @if (in_array($obat->id, $daftarObat))
                                                                @php
                                                                    $total += $obat->harga;
                                                                @endphp
                                                                <tr>
                                                                    <td>{{ $obat->nama_obat }}</td>
                                                                    <td>Rp {{ number_format($obat->harga, 0, ',', '.') }}</td>
                                                                </tr>
                                                            @endif
                                                        @endforeach
                                                        <tr>
                                                            <td><strong>Total</strong></td>
                                                            <td><strong>Rp {{ number_format($total, 0, ',', '.') }}</strong></td>
                                                        </tr>
                                                    </tbody>                                                    
                                                </table>
                                            </div>
                                        </div>
                                    @else
                                        <!-- Jika belum dilakukan pemeriksaan -->
                                        <div class="alert alert-warning text-center" role="alert">
                                            <strong>Belum ada pemeriksaan yang dilakukan untuk pasien ini.</strong>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </section>
@endsection
