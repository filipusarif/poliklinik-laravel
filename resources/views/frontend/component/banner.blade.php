@push('styles')
    <style>
        .doctor-search-section {
            padding-top: 95px;
            background: url('/img/frontend/banner/doctor-banner-01.jpg') no-repeat center top;
            background-size: cover;
        }

        .doctor-search-section .banner-header h2 {
            color: #002578;
            font-size: 36px;
            font-weight: 700;
            margin-bottom: 20px;
        }

        .doctor-search-section .banner-header h2 span {
            color: #0E82FD;
        }

        .doctor-search-section .banner-header p {
            font-size: 18px;
            color: #374151;
        }

        .doctor-form {
            background-color: #ffffff;
            padding: 2rem;
            border-radius: 3rem;
            max-width: 600px;
            margin: 0 auto;
        }

        @media (max-width: 991.98px) {
            .doctor-search-section .dr-img {
                display: none;
            }
        }
    </style>
@endpush

<!-- Home Banner -->
<section class="doctor-search-section">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-7 mb-lg-0 mb-4">
                <div class="doctor-search">
                    <div class="banner-header">
                        <h2><span>Atur Jadwal,</span> Temu Dokter!</h2>
                        <p>Akses ke dokter dan ahli bedah terbaik, teknologi canggih, serta fasilitas bedah berkualitas tinggi di sini.</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-5 mb-lg-0 mb-4">
                <img src="https://doccure.dreamstechnologies.com/html/template/assets/img/banner/doctor-banner.png"
                    class="img-fluid dr-img" alt="doctor-image">
            </div>
        </div>
    </div>
</section>
