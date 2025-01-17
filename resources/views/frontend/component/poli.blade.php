@push('styles')
    <style>
        .poli-section {
            position: relative;
            background: url('/img/frontend/poli/poli-background.jpg') no-repeat center top;
            background-size: cover;
            z-index: 1;
        }

        /* CSS untuk owl carousel */
        .owl-carousel .item {
            display: flex;
            justify-content: center;
        }

        /* Card styling */
        .card {
            display: flex;
            flex-direction: column;
            height: 100%;
            min-height: 100px;
            overflow: hidden;
            position: relative;
            transition: transform 0.3s ease-in-out;
            /* Efek transisi untuk keseluruhan card */
        }

        /* Mengatur tinggi gambar supaya tidak terdistorsi */
        .card-img-top {
            object-fit: cover;
            transition: transform 2s ease-in-out;
            /* Efek transisi zoom selama 2 detik */
            height: 200px;
        }

        /* Zoom dan efek hover pada gambar saja */
        .card:hover {
            transform: scale(1.1);
            /* Zoom in gambar */
        }

        /* Efek mengangkat card */
        .card:hover {
            transform: translateY(-5px);
            /* Mengangkat card sedikit */
        }

        /* Body card agar bisa berkembang */
        .card-body {
            flex-grow: 1;
            /* Menjaga konten agar tumbuh mengisi ruang */
            display: flex;
            flex-direction: column;
        }

    </style>
@endpush
<section class="poli-section">

    <div class="container py-5">
        <div class="row mb-4">
            <div class="col-md-6">
                <div class="section-heading">
                    <h2>Poliklinik & Spesialisasi</h2>
                    <p>Akses langsung ke dokter spesialis dan ahli bedah, teknologi medis terkini, serta fasilitas bedah
                        berkualitas tinggi di sini.</p>
                </div>
            </div>
            <div class="col-md-6 text-end">
                <!-- Navigation buttons -->
                <div class="nav-control">
                    <button id="prevButton" class="btn btn-outline-dark" type="button">
                        <i class="fas fa-chevron-left"></i>
                    </button>
                    <button id="nextButton" class="btn btn-outline-dark" type="button">
                        <i class="fas fa-chevron-right"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Owl Carousel for Clinics -->
        <div id="clinicCarousel" class="owl-carousel owl-theme">
            @foreach ($polis as $poli)
                <div class="item m-2">
                    <div class="card shadow-none border w-100">
                        <div class="card-body">
                            <h5 class="card-title">{{ $poli->nama_poli }}</h5>
                            <p class="card-text">{{ $poli->keterangan }}</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
@push('scripts')
    <!-- Owl Carousel CSS -->
    <link rel="stylesheet" href="{{ asset('css/owlcarousel/owl.carousel.css') }}">
    <link rel="stylesheet" href="{{ asset('css/owlcarousel/owl.theme.default.min.css') }}">

    <!-- Owl Carousel JS -->
    <script src="{{ asset('js/plugins/owl.carousel.min.js') }}"></script>

    <script>
        $(document).ready(function() {

            // Initialize Owl Carousel
            var owl = $("#clinicCarousel").owlCarousel({
                loop: true,
                margin: 10,
                // stageClass: 'owl-stage d-flex',
                nav: false, // Disabling default nav
                dots: false, // Disabling default dots
                responsive: {
                    0: {
                        items: 1, // 1 item per slide on mobile
                    },
                    600: {
                        items: 2, // 2 items per slide on tablet
                    },
                    1200: {
                        items: 4, // 4 items per slide on desktop
                    }
                }
            });

            // Bind custom Prev button
            $('#prevButton').click(function() {
                owl.trigger('prev.owl.carousel'); // Trigger the 'prev' event to go to previous slide
            });

            // Bind custom Next button
            $('#nextButton').click(function() {
                owl.trigger('next.owl.carousel'); // Trigger the 'next' event to go to next slide
            });

            // Mendapatkan tinggi card tertinggi
            var maxHeight = 0;
            $('.card').each(function() {
                var thisHeight = $(this).outerHeight();
                if (thisHeight > maxHeight) {
                    maxHeight = thisHeight;
                }
            });

            console.log(maxHeight);

            // Menetapkan tinggi yang sama untuk semua card
            $('.card').height(maxHeight);

        });
    </script>
@endpush
