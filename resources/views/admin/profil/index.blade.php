@extends('component.layout.app')
@push('title')
    <title>Profil - Poliklinik Udinus</title>
@endpush
@section('content')
    <!-- Profil Admin -->
    <section id="profil-admin">
        <div class="container-fluid py-4">
            @include('component.alert')
            <div class="row">
                <div class="col-md-4">
                    <div class="card card-profile mb-4">
                        <img src="{{ asset('img/background/background-1.jpg') }}" alt="Image placeholder" class="card-img-top">
                        <div class="row justify-content-center">
                            <div class="col-4 col-lg-4 order-lg-2">
                                <div class="mt-n4 mt-lg-n6 mb-4 mb-lg-0">
                                    <img src="{{ asset('img/user/user.png') }}" class="rounded-circle img-fluid border border-2 border-dark">
                                </div>
                            </div>
                        </div>
                        <div class="card-body pt-0">
                            <div class="text-center mt-4">
                                <h5>
                                    {{ $admin->nama }}
                                </h5>
                                <div class="h6 font-weight-300">
                                    <h6>Admin</h6>
                                </div>
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
                            <form id="editFormProfil" action="{{ route('admin.profil.update') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="nama" class="col-form-label">Nama</label>
                                            <input type="text" class="form-control @error('nama') is-invalid @enderror" name="nama" id="nama" value="{{ old('nama', $admin->nama) }}" required>
                                            @error('nama')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="no_hp" class="col-form-label">No HP</label>
                                            <input type="text" class="form-control @error('no_hp') is-invalid @enderror" name="no_hp" id="no_hp" value="{{ old('no_hp', $admin->no_hp) }}" required>
                                            @error('no_hp')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="alamat" class="col-form-label">Alamat</label>
                                    <textarea class="form-control @error('alamat') is-invalid @enderror"
                                        name="alamat" id="alamat" required>{{ old('alamat', $admin->alamat) }}</textarea>
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
                            <form id="editFormPassword" action="{{ route('admin.password.update') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="current_password" class="col-form-label">Password Sekarang</label>
                                            <div class="col-sm-12">
                                                <div class="input-group">
                                                    <input type="password" class="form-control @error('current_password') is-invalid @enderror"
                                                        name="current_password" id="current_password" autocomplete="current-password">
                                                    <span class="input-group-text" id="pw-icon" onclick="togglePassword(this)"
                                                        style="cursor: pointer;">
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
                                                    <input type="password" class="form-control @error('new_password') is-invalid @enderror"
                                                        name="new_password" id="new_password" autocomplete="new-password">
                                                    <span class="input-group-text" id="pw-icon" onclick="togglePassword(this)"
                                                        style="cursor: pointer;">
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
    <script>
        $(document).ready(function() {
            // format input number
            formatInputNumber('#no_hp');
        });
    </script>
@endpush
