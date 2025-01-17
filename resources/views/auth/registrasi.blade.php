@extends('component.layout.app')
@push('title')
    <title>Registrasi Pasien - Poliklinik Udinus</title>
@endpush
@section('content')
    <section class="py-5">
        <div class="container py-5">
            <div class="card card-plain" style="background-color: rgb(255, 255, 255);">
                <div class="card-header pb-0 text-start">
                    <h4 class="font-weight-bolder">Registrasi Pasien</h4>
                </div>
                @include('component.alert')
                <div class="card-body">
                    <form id="registrasiForm" class="text-start" action="{{ route('registrasi.store')}}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group row border-bottom pb-4 mx-1">
                                    <label for="nama" class="col-form-label">Nama Pasien <span class="text-danger">*</span></label>
                                    <div class="col-sm-12">
                                        <div class="input-group">
                                            <input type="text" class="form-control @error('nama') is-invalid @enderror"
                                            name="nama" id="nama" required>
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
                                            <input type="text" class="form-control @error('no_hp') is-invalid @enderror"
                                            name="no_hp" id="no_hp" required>
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
                                <div class="form-group row border-bottom pb-4 mx-1">
                                    <label for="no_ktp" class="col-form-label">No KTP <span class="text-danger">*</span></label>
                                    <div class="col-sm-12">
                                        <div class="input-group">
                                            <input type="text" class="form-control @error('no_ktp') is-invalid @enderror"
                                            name="no_ktp" id="no_ktp" required>
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
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row border-bottom pb-4 mx-1">
                                    <label for="alamat" class="col-form-label">Alamat <span class="text-danger">*</span></label>
                                    <div class="col-sm-12">
                                        <div class="input-group">
                                            <textarea class="form-control @error('alamat') is-invalid @enderror" name="alamat" id="alamat" required></textarea>
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
                                <div class="form-group row border-bottom pb-4 mx-1">
                                    <label for="password" class="col-form-label">Password <span class="text-danger">*</span></label>
                                    <div class="col-sm-12">
                                        <div class="input-group">
                                            <input type="password"
                                                class="form-control @error('password') is-invalid @enderror" name="password"
                                                id="password" autocomplete="new-password" required>
                                            <span class="input-group-text" id="pw-icon" onclick="togglePassword(this)"
                                                style="cursor: pointer;">
                                                <i class="fas fa-eye-slash" style="font-size: 1rem"></i>
                                            </span>
                                            @error('password')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <p>
                                            <small>
                                                <i class="fa-solid fa-circle-info"></i>
                                                Harap gunakan password yang mudah di ingat untuk masuk ke akun
                                            </small>
                                        </p>
                                        <p>
                                            <span class="text-danger">* Wajib diisi</span>
                                        </p>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-end">
                                    <button type="submit" class="btn btn-success">
                                        <i class="fa-solid fa-floppy-disk me-1"></i> Registrasi
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    @include('frontend.component.footer')
@endsection
@push('scripts')
    <script>
        $(document).ready(function() {
            // format input number
            formatInputNumber('#no_hp');
            formatInputNumber('#no_ktp');
        });
    </script>
@endpush
