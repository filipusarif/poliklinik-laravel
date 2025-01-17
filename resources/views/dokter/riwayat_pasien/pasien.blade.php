@extends('component.layout.app')
@push('title')
    <title>Detail Pasien - Poliklinik Udinus</title>
@endpush
@section('content')
    <section id="detail-pasien">
        <div class="container-fluid py-4">
            <div class="row">
                <div class="col-12">
                    <div class="card mb-4">
                        <div class="card-header pb-0">
                            <h3>Detail Pasien</h3>
                            <a href="{{ route('dokter.riwayat_pasien.index') }}" class="btn btn-success shadow-sm float-right">
                                <i class="fa fa-arrow-left me-1"></i>
                                Kembali
                            </a>
                        </div>
                        <div class="card-body">
                            @include('component.alert')
                            <div class="card mb-4">
                                <div class="card-body">
                                    <h4 class="card-title text-center mb-4">Informasi Pasien</h4>
                                    <div class="row mb-3">
                                        <div class="col-5">
                                            <strong>No RM</strong>
                                        </div>
                                        <div class="col-7">
                                            <span>{{ $pasien->no_rm }}</span>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-5">
                                            <strong>Nama Pasien</strong>
                                        </div>
                                        <div class="col-7">
                                            <span>{{ $pasien->nama }}</span>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-5">
                                            <strong>Alamat</strong>
                                        </div>
                                        <div class="col-7">
                                            <span>{{ $pasien->alamat }}</span>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-5">
                                            <strong>No Telepon</strong>
                                        </div>
                                        <div class="col-7">
                                            <span>{{ $pasien->no_hp }}</span>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-5">
                                            <strong>No KTP</strong>
                                        </div>
                                        <div class="col-7">
                                            <span>{{ $pasien->no_ktp }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title text-center mb-4">Riwayat Periksa</h4>
                                    <div class="table-responsive">
                                        <table id="data-table" class="table table-hover table-responsive align-items-center align-middle w-100">
                                            <thead>
                                                <tr>
                                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                        No
                                                    </th>
                                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                        Tanggal Periksa
                                                    </th>
                                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                        Keluhan
                                                    </th>
                                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                        Catatan
                                                    </th>
                                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                        Obat
                                                    </th>
                                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                        Biaya
                                                    </th>
                                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                        Status
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($riwayatPasien as $riwayatPasien)
                                                    <tr>
                                                        <td class="align-middle text-center">
                                                            <p class="text-xs font-weight-bold mb-0">{{ $loop->iteration }}</p>
                                                        </td>
                                                        <td class="align-middle text-center">
                                                            <p class="text-xs font-weight-bold mb-0">
                                                                {{ $riwayatPasien->tgl_periksa }}
                                                            </p>
                                                        </td>
                                                        <td>
                                                            <p class="text-xs font-weight-bold mb-0">
                                                                {{ $riwayatPasien->keluhan }}
                                                            </p>
                                                        </td>
                                                        <td>
                                                            <p class="text-xs font-weight-bold mb-0">
                                                                {{ $riwayatPasien->periksa->catatan ?? '-' }}
                                                            </p>
                                                        </td>
                                                        <td>
                                                            @if($riwayatPasien->periksa && $riwayatPasien->periksa->detailPeriksa->isNotEmpty())
                                                                @foreach($riwayatPasien->periksa->detailPeriksa as $detail)
                                                                <p class="text-xs font-weight-bold mb-0">
                                                                    {{ $detail->obat->nama_obat ?? '-' }}
                                                                </p>
                                                                @endforeach
                                                            @else
                                                                <p class="text-xs font-weight-bold mb-0">
                                                                    -
                                                                </p>
                                                            @endif
                                                        </td>
                                                        <td>
                                                            @if($riwayatPasien->periksa && isset($riwayatPasien->periksa->biaya_periksa))
                                                                @php
                                                                    $biayaobat = 0;
                                                                    foreach ($riwayatPasien->periksa->detailPeriksa as $detail) {
                                                                        $biayaobat += $detail->obat->harga;
                                                                    }
                                                                @endphp
                                                                <p class="text-xs font-weight-bold mb-0">
                                                                    Biaya Obat : <br>
                                                                    Rp. {{ number_format($biayaobat, 0, ',', '.') }} <br><br>
                                                                    Total Biaya : <br>
                                                                    Rp. {{ number_format($riwayatPasien->periksa->biaya_periksa, 0, ',', '.') }}
                                                                </p>
                                                            @else
                                                                <p class="text-xs font-weight-bold mb-0">
                                                                    -
                                                                </p>
                                                            @endif
                                                        </td>
                                                        <td class="text-center">
                                                            <p class="font-weight-bold mb-0">
                                                                @if ($riwayatPasien->periksa)
                                                                    <i class="fa-solid fa-check-circle text-success"></i>
                                                                @else
                                                                    <i class="fa-solid fa-xmark-circle text-danger"></i>
                                                                @endif
                                                            </>
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
            </div>
        </div>
    </section>
@endsection
@include('component.datatable')