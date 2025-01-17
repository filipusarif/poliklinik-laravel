@extends('component.layout.app')
@push('title')
    <title>Profil - Poliklinik Udinus</title>
@endpush
@push('styles')
    <style>
        body {
            background: url('/img/frontend/poli/poli-background.jpg') no-repeat center center;
            background-size: cover;
            color: white;
        }

        .profil-section {
            padding-top: 95px;
            position: relative;
            z-index: 1;
        }
    </style>
@endpush
@section('content')

    <section class="profil-section">
        <div class="container">
            @include('component.alert')
            <div class="row">
                <div class="col-xl-8">
                    <div class="card mb-4">
                        <div class="card-header">
                            <h3>Pengaturan Profil</h3>
                        </div>
                        <div class="card-body">
                            <form method="POST" action="{{ route('pasien.profil.update') }}" enctype="multipart/form-data" id="profileForm">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group row border-bottom pb-4 mx-1">
                                            <label for="nama" class="col-form-label">Nama Pasien <span class="text-danger">*</span></label>
                                            <div class="col-sm-12">
                                                <div class="input-group">
                                                    <input type="text" class="form-control @error('nama') is-invalid @enderror" name="nama" id="nama" value="{{ old('nama', $pasien->nama) }}" required>
                                                    <span class="input-group-text">
                                                        <i class="fa-solid fa-user me-1"></i>
                                                    </span>
                                                    @error('nama')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row border-bottom pb-4 mx-1">
                                            <label for="no_hp" class="col-form-label">No HP <span class="text-danger">*</span></label>
                                            <div class="col-sm-12">
                                                <div class="input-group">
                                                    <input type="text" class="form-control @error('no_hp') is-invalid @enderror" name="no_hp" id="no_hp" value="{{ old('no_hp', $pasien->no_hp) }}" required>
                                                    <span class="input-group-text">
                                                        <i class="fa-solid fa-phone me-1"></i>
                                                    </span>
                                                    @error('no_hp')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>  
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group row border-bottom pb-4 mx-1">
                                            <label for="no_ktp" class="col-form-label">No KTP <span class="text-danger">*</span></label>
                                            <div class="col-sm-12">
                                                <div class="input-group">
                                                    <input type="text" class="form-control @error('no_ktp') is-invalid @enderror" name="no_ktp" id="no_ktp" value="{{ old('no_ktp', $pasien->no_ktp) }}" required>
                                                    <span class="input-group-text">
                                                        <i class="fa-solid fa-address-card me-1"></i>
                                                    </span>
                                                    @error('no_ktp')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row border-bottom pb-4 mx-1">
                                            <label for="no_rm" class="col-form-label">No RM <span class="text-danger">*</span></label>
                                            <div class="col-sm-12">
                                                <div class="input-group">
                                                    <input type="text" class="form-control @error('no_rm') is-invalid @enderror" name="no_rm" id="no_rm" value="{{ old('no_rm', $pasien->no_rm) }}" readonly>
                                                    <span class="input-group-text">
                                                        <i class="fa-solid fa-hashtag me-1"></i>
                                                    </span>
                                                    @error('no_rm')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row border-bottom pb-4 mx-1">
                                    <label for="alamat" class="col-form-label">Alamat <span class="text-danger">*</span></label>
                                    <div class="col-sm-12">
                                        <div class="input-group">
                                            <textarea class="form-control @error('alamat') is-invalid @enderror" name="alamat" id="alamat" required>{{ old('alamat', $pasien->alamat) }}</textarea>
                                            <span class="input-group-text">
                                                <i class="fa-solid fa-location-dot me-1"></i>
                                            </span>
                                            @error('alamat')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <p class="text-danger">* Wajib diisi</p>
                                <div class="d-flex justify-content-end">
                                    <button type="submit" class="btn btn-success">
                                        <i class="fa-solid fa-download me-1"></i> Simpan
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- Update Password -->
                <div class="col-xl-4" style="margin-bottom: 50px;">
                    <div class="card">
                        <div class="card-header">
                            <h3>Update Password</h3>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('pasien.profil.update-password') }}" method="POST">
                                @csrf
                                <div class="form-group row border-bottom pb-4 mx-1">
                                    <label for="password_sekarang" class="col-form-label">Password Sekarang<span class="text-danger">*</span></label>
                                    <div class="col-sm-12">
                                        <div class="input-group">
                                            <input type="password" id="password_sekarang" name="password_sekarang" class="form-control @error('password_sekarang') is-invalid @enderror" placeholder="Masukan Password Sekarang" required autocomplete="current-password">
                                            <span class="input-group-text" onclick="togglePassword(this)" style="cursor: pointer;">
                                                <i class="fa-solid fa-eye-slash me-1"></i>
                                            </span>
                                            @error('password_sekarang')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row border-bottom pb-4 mx-1">
                                    <label for="password_baru" class="col-form-label">Password Baru<span class="text-danger">*</span></label>
                                    <div class="col-sm-12">
                                        <div class="input-group">
                                            <input type="password" id="password_baru" name="password_baru" class="form-control @error('password_baru') is-invalid @enderror" placeholder="Masukan Password Baru" required autocomplete="new-password">
                                            <span class="input-group-text" onclick="togglePassword(this)" style="cursor: pointer;">
                                                <i class="fa-solid fa-eye-slash me-1"></i>
                                            </span>
                                            @error('password_baru')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row border-bottom pb-4 mx-1">
                                    <label for="konfirmasi_password" class="col-form-label">Konfirmasi Password<span class="text-danger">*</span></label>
                                    <div class="col-sm-12">
                                        <div class="input-group">
                                            <input type="password" id="konfirmasi_password" name="konfirmasi_password" class="form-control @error('konfirmasi_password') is-invalid @enderror" placeholder="Masukan Konfirmasi Password" required autocomplete="new-password">
                                            <span class="input-group-text" onclick="togglePassword(this)" style="cursor: pointer;">
                                                <i class="fa-solid fa-eye-slash me-1"></i>
                                            </span>
                                            @error('konfirmasi_password')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <p class="text-danger">* Wajib diisi</p>
                                <div class="d-flex justify-content-end">
                                    <button type="submit" class="btn btn-success">
                                        <i class="fa-solid fa-floppy-disk me-1"></i> Perbarui Password
                                    </button>
                                </div>                                
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
