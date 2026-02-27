@extends('layouts.app')

@section('content')

<div class="container py-5">

    <div class="row justify-content-center mb-5">
        <div class="col-lg-10">
            <div class="card border-0 shadow-sm rounded-4 p-4">
                <div class="row align-items-center">

                    <div class="col-md-4 text-center">
                        <img src="storage/logo-wm.jpeg"
                             class="rounded-circle shadow-sm"
                             style="width: 220px; height: 220px; object-fit: cover;"
                             alt="Owner Warisan Mandeh">
                    </div>

                    <div class="col-md-8">
                        <span class="text-uppercase small text-muted">Owner</span>
                        <h2 class="fw-bold text-orange mt-1">Desi Susanti</h2>

                        <p class="text-secondary mt-3" style="line-height: 1.9;">
                            Warisan Mandeh lahir dari dapur keluarga dengan kecintaan
                            terhadap kuliner Minang tradisional. Resep dan peralatan
                            memasak diwariskan secara turun-temurun untuk menjaga
                            keaslian rasa di setiap sajian.
                        </p>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <div class="row justify-content-center mb-5">
        <div class="col-lg-10">
            <div class="row g-4">

                <div class="col-md-4">
                    <div class="card border-0 shadow-sm rounded-4 text-center h-100 py-4">
                        <i class="bi bi-tiktok fs-1 text-orange"></i>
                        <h6 class="fw-semibold mt-3">TikTok</h6>
                        <a href="https://www.tiktok.com/@warisanmandeh?_r=1&_t=ZS-93ifEMU2f9p" target="_blank" class="text-secondary text-decoration-none small">
                        WARISAN MANDEH
                        </a>
                    </div>
                </div>


                <div class="col-md-4">
                    <div class="card border-0 shadow-sm rounded-4 text-center h-100 py-4">
                        <i class="bi bi-instagram fs-1 text-orange"></i>
                        <h6 class="fw-semibold mt-3">Instagram</h6>
                        <a href="https://instagram.com/warisan_mandeh"
                           class="text-secondary text-decoration-none small">
                            @warisanmandeh
                        </a>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card border-0 shadow-sm rounded-4 text-center h-100 py-4">
                        <i class="bi bi-facebook fs-1 text-orange"></i>
                        <h6 class="fw-semibold mt-3">Facebook</h6>
                        <a href="https://www.facebook.com/warisan.mandeh" target="_blank"
                            class="text-secondary text-decoration-none small">
                                Warisan Mandeh
                    </a>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <div class="row justify-content-center mb-5">
        <div class="col-lg-10">
            <div class="row align-items-center">

                <div class="col-md-6">
                    <div class="pe-md-4">
                        <h3 class="fw-bold text-orange mb-3">Perjalanan Kami</h3>
                        <p class="text-secondary" style="line-height: 1.9;">
                            Perjalanan Warisan Mandeh dimulai dari dapur keluarga,
                            menggunakan resep dan peralatan tradisional yang diwariskan
                            oleh Mandeh kepada generasi berikutnya.
                            <br><br>
                            Resep kami bukan hasil coba-coba, melainkan warisan
                            rasa yang dijaga melalui takaran, teknik, dan proses
                            memasak agar cita rasa Minang tetap hidup.
                        </p>
                    </div>
                </div>

                <div class="col-md-6 text-center">
                    <img src="storage/produk.jpg"
                         class="img-fluid rounded-4 shadow-sm"
                         style="height: 340px; width: 100%; object-fit: cover;"
                         alt="Perjalanan Warisan Mandeh">
                </div>

            </div>
        </div>
    </div>

<div class="row justify-content-center">
    <div class="col-lg-10 text-center mb-4">
        <h3 class="fw-bold text-orange">Lokasi Kami</h3>
        <p class="text-secondary">
            Perum Cahaya Mandani, Lubuk Minturun, Kota Padang
        </p>
    </div>

    <div class="col-lg-10">
        <div class="ratio ratio-16x9 rounded-4 overflow-hidden shadow-sm">
            <iframe
                src="https://www.google.com/maps?q=Perum+Cahaya+Mandani+Lubuk+Minturun+Padang&output=embed"
                style="border:0;"
                loading="lazy"
                allowfullscreen>
            </iframe>
        </div>
    </div>
</div>


</div>

@endsection
