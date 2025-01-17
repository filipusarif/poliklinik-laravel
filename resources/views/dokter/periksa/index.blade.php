@extends('component.layout.app')
@push('title')
    <title>Daftar Periksa - Poliklinik Udinus</title>
@endpush
@section('content')
    <!-- Daftar Periksa -->
    <section id="daftar-periksa">
        <div class="container-fluid py-4">
            <div class="row">
                <div class="col-12">
                    <div class="card mb-4">
                        <div class="card-header pb-0 d-flex justify-content-between align-items-center">
                            <h3>Daftar Periksa</h3>
                            <div>
                                <a href="{{ route('dokter.periksa.index') }}" class="btn {{ request('today') ? 'btn-secondary' : 'btn-primary' }} shadow-sm mt-2">
                                    Semua
                                </a>
                                <a href="{{ route('dokter.periksa.index', ['today' => true]) }}" class="btn {{ request('today') ? 'btn-primary' : 'btn-secondary' }} shadow-sm mt-2">
                                    <i class="fa fa-calendar-day me-1"></i> Hari Ini
                                </a>
                            </div>
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
                                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                                Pasien
                                            </th>
                                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Tanggal Periksa
                                            </th>
                                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Jam Periksa
                                            </th>
                                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Antrian
                                            </th>
                                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Status
                                            </th>
                                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Periksa
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ( $daftarPolis as $daftarPoli )
                                            <tr>
                                                <td class="align-middle text-center text-sm">
                                                    <p class="text-xs font-weight-bold mb-0">{{ $loop->iteration }}</p>
                                                </td>
                                                <td>
                                                    <p class="text-xs font-weight-bold mb-0">{{ $daftarPoli->pasien->nama }}</p>
                                                </td>
                                                <td class="align-middle text-center text-sm">
                                                    <p class="text-xs font-weight-bold mb-0">{{ \Carbon\Carbon::parse($daftarPoli->tgl_periksa)->isoFormat('D MMMM YYYY') }}</p>
                                                </td>
                                                <td class="align-middle text-center text-sm">
                                                    <p class="text-xs font-weight-bold mb-0">
                                                        {{ $daftarPoli->jadwalPraktik->hari }} 
                                                        ({{ \Carbon\Carbon::parse($daftarPoli->jadwalPraktik->jam_mulai)->format('H:i') }} - 
                                                        {{ \Carbon\Carbon::parse($daftarPoli->jadwalPraktik->jam_selesai)->format('H:i') }})
                                                    </span>
                                                </td>
                                                <td class="align-middle text-center text-sm">
                                                    <p class="text-xs font-weight-bold mb-0">{{ $daftarPoli->no_antrian }}</p>
                                                </td>
                                                <td class="align-middle text-center text-sm">
                                                    <p class="text-xs font-weight-bold mb-0">
                                                        @if ($daftarPoli->periksa)
                                                            <span class="badge bg-success">Sudah Diperiksa</span>
                                                        @else
                                                            <span class="badge bg-danger">Belum Diperiksa</span>
                                                        @endif
                                                    </>
                                                </td>
                                                <td class="align-middle text-center text-sm">
                                                    <div class="d-flex justify-content-center align-items-center gap-2">
                                                        <a href="{{ route('dokter.periksa.detail', $daftarPoli->id) }}" class="btn btn-dark btn-sm">
                                                            <i class="fa-solid fa-pen-to-square"></i>
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
    <script>
        // Menangani submit form dengan kelas 'delete-form'
        $(document).on('submit', '.delete-form', function(event) {
            event.preventDefault();
            var form = this;  // Menyimpan form yang sedang disubmit
            confirmDelete(form);  // Memanggil fungsi konfirmasi hapus
        });
    </script>
@endpush