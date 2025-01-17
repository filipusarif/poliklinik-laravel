@extends('component.layout.app')
@push('title')
    <title>Login - Poliklinik Udinus</title>
@endpush
@section('content')
    {{-- <body class="">
    <main class="main-content mt-0"> --}}
    <section>
        <div class="page-header min-vh-100">
            <div class="container">
                <div class="row">
                    <div class="col-xl-6 col-lg-6 col-md-6 d-flex flex-column mx-lg-0 mx-auto">
                        <div class="position-relative bg-gradient-dark h-100 m-3 px-7 border-radius-lg d-flex flex-column justify-content-center overflow-hidden"
                        style="background-image: url('{{ asset('img/frontend/auth/login-banner.png') }}'); background-size: cover; min-height: 20rem;">
                            <span class="mask bg-gradient-dark opacity-6"></span>
                            <h4 class="mt-5 text-white font-weight-bolder position-relative">Poliklinik Udinus</h4>
                            <p class="text-white position-relative">
                                Menyediakan Layanan Kesehatan Untuk Masyarakat
                            </p>
                        </div>
                    </div>
                    <div class="col-xl-6 col-lg-6 col-md-6 d-flex flex-column mx-lg-0 mx-auto">
                        <div class="card card-plain" style="background-color: rgb(255, 255, 255);">
                            <div class="card-header pb-0 text-start">
                                <h4 class="font-weight-bolder">Login</h4>
                                <p class="mb-0">Masukkan No Telepon dan Password Anda!</p>
                            </div>
                            <div class="card-body">
                                <form id="loginForm" class="text-start" action="{{ route('login') }}" method="POST">
                                    @csrf
                                    <div class="mb-3">
                                        <div class="input-group">
                                            <input type="text" name="no_hp" class="form-control form-control-lg @error('no_hp') is-invalid @enderror" placeholder="Masukan No Telepon Anda" required>
                                            <span class="input-group-text">
                                                <i class="fa-solid fa-phone text-dark text-lg"></i>
                                            </span>
                                            @error('no_hp')
                                                <span class="error invalid-feedback">
                                                    {{ $message }}
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <div class="input-group">
                                            <input type="password" id="password" name="password" class="form-control form-control-lg @error('password') is-invalid @enderror" placeholder="Masukan Password Anda" required autocomplete="current-password">
                                            <span class="input-group-text">
                                                <i class="fa-solid fa-eye-slash text-dark text-lg" id="togglePassword" style="cursor: pointer;"></i>
                                            </span>
                                            @error('password')
                                                <span class="error invalid-feedback">
                                                    {{ $message }}
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="text-center">
                                        <button type="submit" class="btn bg-dark text-white w-100 my-4 mb-2">
                                            Login
                                        </button>
                                    </div>
                                </form>
                            </div>
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
            $('#togglePassword').click(function() {
                const passwordInput = $('#password');
                const type = passwordInput.attr('type') === 'password' ? 'text' : 'password';
                passwordInput.attr('type', type);
                if (type === 'password') {
                    $(this).removeClass('fa-eye').addClass('fa-eye-slash');
                } else {
                    $(this).removeClass('fa-eye-slash').addClass('fa-eye');
                }
            });
        });
    </script>
@endpush