@if ($errors->any())
    <div class="alert alert-danger alert-dismissible fade show w-100 py-2" role="alert">
        <div class="container py-3">
            <h5 class="alert-heading">Terjadi Kesalahan!</h5>
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        <button type="button" class="btn-close me-3" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif
