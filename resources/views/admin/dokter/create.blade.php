@extends('component.layout.app')
@push('title')
    <title>Tambah Dokter - Poliklinik Udinus</title>
@endpush
@push('styles')
    <link rel="stylesheet" href="{{ asset('css/select2/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/select2/select2-bootstrap-5-theme.min.css') }}"
@endpush
@section('content')
    <!-- Tambah Dokter -->
    <section id="tambah-dokter">
        <div class="container-fluid py-4">
            <div class="row">
                <div class="col-12">
                    <div class="card mb-4">
                        <div class="card-header pb-0">
                            <h3>Tambah Dokter</h3>
                            <a href="{{ route('admin.dokter.index') }}" class="btn btn-success shadow-sm float-right mt-2">
                                <i class="fa fa-arrow-left me-1"></i>
                                Kembali
                            </a>
                        </div>
                        <div class="card-body">
                            @include('component.alert')
                            <form method="POST" action="{{ route('admin.dokter.store') }}" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group row border-bottom pb-4 mx-1">
                                            <label for="nama" class="col-form-label">Nama Dokter</label>
                                            <div class="col-sm-12">
                                                <input type="text" class="form-control @error('nama') is-invalid @enderror"
                                                    name="nama" id="nama" required>
                                                @error('nama')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group row border-bottom pb-4 mx-1">
                                            <label for="no_hp" class="col-form-label">No HP</label>
                                            <div class="col-sm-12">
                                                <input type="text" class="form-control @error('no_hp') is-invalid @enderror"
                                                    name="no_hp" id="no_hp" required>
                                                @error('no_hp')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group row border-bottom pb-4 mx-1">
                                            <label for="alamat" class="col-form-label">Alamat</label>
                                            <div class="col-sm-12">
                                                <textarea class="form-control @error('alamat') is-invalid @enderror"
                                                    name="alamat" id="alamat" required></textarea>
                                                @error('alamat')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group row border-bottom pb-4 mx-1">
                                            <label for="id_poli" class="col-form-label">Poli</label>
                                            <div class="col-sm-12">
                                                <select class="form-control @error('id_poli') is-invalid @enderror" name="id_poli" id="id_poli">
                                                    <option value="" disabled selected>Pilih Poli</option>
                                                    @foreach ($polis as $poli)
                                                        <option value="{{ $poli->id }}">
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
                                        <div class="form-group row border-bottom pb-4 mx-1">
                                            <label for="password" class="col-form-label">Password</label>
                                            <div class="col-sm-12">
                                                <div class="input-group">
                                                    <input type="password" class="form-control @error('password') is-invalid @enderror"
                                                        name="password" id="password" autocomplete="new-password" required>
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
                                            </div>
                                        </div>
                                        <div class="d-flex justify-content-end">
                                            <button type="submit" class="btn btn-success">
                                                <i class="fa-solid fa-download me-1"></i> Simpan
                                            </button>
                                        </div>                                        
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
        $(document).ready(function () {
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