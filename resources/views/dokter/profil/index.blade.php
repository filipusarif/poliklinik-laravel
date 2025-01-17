@extends('component.layout.app')
@push('title')
    <title>Profil Dokter - Poliklinik Udinus</title>
@endpush
@push('styles')
    <link rel="stylesheet" href="{{ asset('css/select2/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/select2/select2-bootstrap-5-theme.min.css') }}">
@endpush
@section('content')
    <!-- Profil Dokter -->
    <section id="profil-dokter">
        <div class="container-fluid py-4">
            <div class="row">
                <div class="col-md-4">
                    <div class="card card-profile mb-4">
                        <img src="{{ asset('img/background/background-3.jpg') }}" alt="Image placeholder" class="card-img-top">
                        <div class="row justify-content-center">
                            <div class="col-4 col-lg-4 order-lg-2">
                                <div class="mt-n4 mt-lg-n6 mb-4 mb-lg-0">
                                    <img src="{{ asset('img/user/user.png') }}" class="rounded-circle img-fluid border border-2 border-dark">
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="text-center">
                                <h5>
                                    {{ $dokter->nama }}
                                </h5>
                                <h6>
                                    {{ $dokter->poli->nama_poli ?? 'Spesialis Tidak Diketahui' }}
                                </h6>
                            </div>
                            <div class="text-center mt-4">
                                <h6>Jadwal Praktik</h6>
                                <p>
                                    @foreach ($dokter->jadwalPraktik as $jadwal)
                                        @if ($jadwal->is_active)
                                            <strong>{{ $jadwal->hari }}</strong>: 
                                            {{ \Carbon\Carbon::parse($jadwal->jam_mulai)->format('H:i') }} - 
                                            {{ \Carbon\Carbon::parse($jadwal->jam_selesai)->format('H:i') }}<br>
                                        @endif
                                    @endforeach
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="card mb-4">
                        <div class="card-header pb-0">
                            <div class="d-flex align-items-center">
                                <h4 class="mb-0">Edit Profil</h4>
                            </div>
                        </div>
                        <div class="card-body">
                            <form id="editFormProfil" action="{{ route('dokter.profil.update') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="nama" class="col-form-label">Nama</label>
                                            <input type="text" class="form-control @error('nama') is-invalid @enderror"
                                                name="nama" id="nama" value="{{ old('nama', $dokter->nama) }}"
                                                required>
                                            @error('nama')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="no_hp" class="col-form-label">No HP</label>
                                            <input type="text" class="form-control @error('no_hp') is-invalid @enderror"
                                                name="no_hp" id="no_hp" value="{{ old('no_hp', $dokter->no_hp) }}"
                                                required>
                                            @error('no_hp')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="id_poli" class="col-form-label">Poli</label>
                                            <select class="form-control @error('id_poli') is-invalid @enderror" name="id_poli" id="id_poli">
                                                <option value="" disabled selected>Pilih Poli</option>
                                                @foreach ($polis as $poli)
                                                    <option value="{{ $poli->id }}" {{ $dokter->id_poli == $poli->id ? 'selected' : '' }}>
                                                        {{ $poli->nama_poli }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('id_poli')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="alamat" class="col-form-label">Alamat</label>
                                    <textarea class="form-control @error('alamat') is-invalid @enderror" name="alamat" id="alamat" required>{{ old('alamat', $dokter->alamat) }}</textarea>
                                    @error('alamat')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="d-flex justify-content-end">
                                    <button type="submit" class="btn btn-success">
                                        <i class="fa-solid fa-download me-1"></i> Simpan
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header pb-0">
                            <div class="d-flex align-items-center">
                                <h4 class="mb-0">Edit Password</h4>
                            </div>
                        </div>
                        <div class="card-body">
                            <form id="editFormPassword" action="{{ route('dokter.password.update') }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="current_password" class="col-form-label">Password Sekarang</label>
                                            <div class="col-sm-12">
                                                <div class="input-group">
                                                    <input type="password"
                                                        class="form-control @error('current_password') is-invalid @enderror"
                                                        name="current_password" id="current_password"
                                                        autocomplete="current-password">
                                                    <span class="input-group-text" id="pw-icon"
                                                        onclick="togglePassword(this)" style="cursor: pointer;">
                                                        <i class="fas fa-eye-slash" style="font-size: 1rem"></i>
                                                    </span>
                                                    @error('current_password')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="new_password" class="col-form-label">Password Baru</label>
                                            <div class="col-sm-12">
                                                <div class="input-group">
                                                    <input type="password"
                                                        class="form-control @error('new_password') is-invalid @enderror"
                                                        name="new_password" id="new_password"
                                                        autocomplete="new-password">
                                                    <span class="input-group-text" id="pw-icon"
                                                        onclick="togglePassword(this)" style="cursor: pointer;">
                                                        <i class="fas fa-eye-slash" style="font-size: 1rem"></i>
                                                    </span>
                                                    @error('new_password')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="d-flex justify-content-end">
                                        <button type="submit" class="btn btn-success">
                                            <i class="fa-solid fa-download me-1"></i> Simpan
                                        </button>
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
@push('scripts')
    <script src="{{ asset('js/plugins/select2.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            // format input number
            formatInputNumber('#no_hp');

            // Inisialisasi Select2
            $('#id_poli').select2({
                placeholder: "Pilih Poli", 
                allowClear: true,
                width: '100%', 
                theme: 'bootstrap-5'
            });
        });
    </script>
@endpush
