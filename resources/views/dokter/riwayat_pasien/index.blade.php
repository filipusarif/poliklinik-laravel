@extends('component.layout.app')
@push('title')
    <title>Riwayat Pasien - Poliklinik Udinus</title>
@endpush

@section('content')
    <section id="riwayat-pasien">
        <div class="container-fluid py-4">
            <div class="row">
                <div class="col-12">
                    <div class="card mb-4">
                        <div class="card-header pb-0">
                            <h3>Daftar Riwayat Pasien</h3>
                        </div>
                        <div class="card-body pt-0">
                            @include('component.alert')
                            <div class="table-responsive">
                                <table id="data-table" class="table table-hover table-responsive align-items-center align-middle w-100">
                                    <thead>
                                        <tr>
                                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                No
                                            </th>
                                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                No RM
                                            </th>
                                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                                Nama Pasien
                                            </th>
                                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Total Periksa
                                            </th>
                                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Terakhir Periksa
                                            </th>
                                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Aksi
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ( $pasiens as $item )
                                            <tr>
                                                <td class="align-middle text-center">
                                                    <p class="text-xs font-weight-bold mb-0">{{ $loop->iteration }}</p>
                                                </td>
                                                <td class="align-middle text-center">
                                                    <p class="text-xs font-weight-bold mb-0">
                                                        {{ $item->pasien->no_rm }}
                                                    </p>
                                                </td>
                                                <td>
                                                    <p class="text-xs font-weight-bold mb-0">
                                                        {{ $item->pasien->nama }}
                                                    </p>
                                                </td>
                                                <td class="align-middle text-center">
                                                    <span class="badge bg-dark badge-lg">
                                                        {{ $item->total_periksa }}
                                                    </span>
                                                </td>
                                                <td class="align-middle text-center">
                                                    <p class="text-xs font-weight-bold mb-0">
                                                        {{ \Carbon\Carbon::parse($item->tgl_periksa)->isoFormat('D MMMM YYYY') }}
                                                    </p>
                                                </td>
                                                <td class="align-middle text-center text-sm">
                                                    <a href="{{ route('dokter.riwayat_pasien.pasien', $item->pasien->id) }}" class="btn btn-sm btn-dark">Detail</a>
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