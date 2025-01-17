@extends('component.layout.app')
@section('content')
    <!-- Edit Obat -->
    <section id="edit-obat">
        <div class="container-fluid py-4">
            <div class="row">
                <div class="col-12">
                    <div class="card mb-4">
                        <div class="card-header pb-0">
                            <h3>Edit Obat</h3>
                            <a href="{{ route('admin.obat.index') }}" class="btn btn-success shadow-sm float-right mt-2">
                                <i class="fa fa-arrow-left me-1"></i>
                                Kembali
                            </a>
                        </div>
                        <div class="card-body">
                            @include('component.alert')
                            <form id="editObatForm" method="POST" action="{{ route('admin.obat.update', $obat->id) }}" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group row border-bottom pb-4 mx-1">
                                            <label for="nama_obat" class="col-form-label">Nama Obat</label>
                                            <div class="col-sm-12">
                                                <input type="text" class="form-control @error('nama_obat') is-invalid @enderror"
                                                    name="nama_obat" id="nama_obat" value="{{ old('nama_obat', $obat->nama_obat) }}" required>
                                                @error('nama_obat')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group row border-bottom pb-4 mx-1">
                                            <label for="kemasan" class="col-form-label">Kemasan</label>
                                            <div class="col-sm-12">
                                                <input type="text" class="form-control @error('kemasan') is-invalid @enderror"
                                                    name="kemasan" id="kemasan" value="{{ old('kemasan', $obat->kemasan) }}" required>
                                                @error('kemasan')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group row border-bottom pb-4 mx-1">
                                            <label for="harga" class="col-form-label">Harga</label>
                                            <div class="col-sm-12">
                                                <div class="input-group">
                                                    <span class="input-group-text">Rp</span>
                                                    <input type="text" class="form-control @error('harga') is-invalid @enderror" name="harga" id="harga"        value="{{ old('harga', number_format($obat->harga, 0, ',', '.')) }}" required>
                                                    @error('harga')
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
    <script>
        $(document).ready(function () {
            // format input number
            formatInputRibuan('#harga');

            // Sebelum formulir dikirim, hapus titik untuk mengirim data dalam format angka murni
            formatHargaInput('editObatForm', 'harga');
        });
    </script>
@endpush