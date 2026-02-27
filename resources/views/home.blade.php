@extends('layouts.app')

@section('content')

{{-- HERO --}}
<section class="hero-wrap">
    <div class="container">
        <div class="row align-items-center justify-content-center">

            <div class="col-md-6 hero-text">
                <h1 class="hero-title">
    Aneka Snack Tradisional Minang, Lestarikan Budaya Lewat Makanan
</h1>

<p class="hero-desc">
    Warisan Mandeh menghadirkan cemilan rumahan khas Padang
    dengan raso nan asli, diracik dari resep turun-temurun
    untuk setiap momen kebersamaan.
</p>


                <a href="{{ route('product.index') }}" class="btn-main">
                    Lihat Menu
                </a>
            </div>

            <div class="col-md-4 text-center hero-visual">
                <img src="{{ asset('storage/new-hero.png') }}" class="hero-img">
            </div>

        </div>
    </div>
</section>


{{-- WHY --}}
<section class="section why-section">
    <div class="container text-center">
        <h3 class="section-title">Kenapa memilih kami?</h6>

        <div class="row justify-content-center mt-4">
            <div class="col-md-4">
                <div class="why-box">
                    <i class="bi bi-shield-check"></i>
                    <p>Tanpa pengawet</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="why-box">
                    <i class="bi bi-book"></i>
                    <p>Resep turun temurun</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="why-box">
                    <i class="bi bi-wallet"></i>
                    <p>Harga Terjangkau</p>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- CTA --}}
<section class="cta-wrap">
    <div class="container text-center">
        <h6>Mau Pesan untuk acara?</h6>
        <p>
            Kami menerima pesanan untuk oleh-oleh, arisan, kantor, dan berbagai acara lainnya
        </p>
        <a href="https://wa.me/6289529639475?text=Halo%20Warisan%20Mandeh,%20saya%20ingin%20bertanya%20tentang%20menu."
   target="_blank"
   class="btn btn-outline-light btn-sm px-4">
    Chat Sekarang
</a>

    </div>
</section>

{{-- HOW --}}
<section class="section how-section">
    <div class="container">

        <div class="row align-items-center">

            {{-- IMAGE KIRI --}}
            <div class="col-md-4 text-center">
                <img src="{{ asset('storage/newHto.png') }}" class="how-img">
            </div>

            {{-- KONTEN KANAN --}}
            <div class="col-md-8">

                <h5 class="section-title text-start mb-4">
                    Bagaimana cara order di Warisan Mandeh?
                </h5>

                <div class="row g-4">

                    <div class="col-md-4">
                        <div class="how-box">
                            <i class="bi bi-cart"></i>
                            <p>Pilih Menu & Masuk Keranjang</p>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="how-box">
                            <i class="bi bi-chat"></i>
                            <p>Chat & Konfirmasi Order</p>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="how-box">
                            <i class="bi bi-truck"></i>
                            <p>Pembayaran & Pengantaran</p>
                        </div>
                    </div>

                </div>

            </div>
        </div>

    </div>
</section>

{{-- REVIEW FORM --}}
<section class="section review-section">
    <div class="container">
        <h3 class="section-title text-center mb-4">Tulis Review Anda</h3>

        <div class="row justify-content-center">
            <div class="col-md-6">
                <form action="{{ route('review.store') }}" method="POST" class="review-card">
                    @csrf

                    {{-- Nama --}}
                    <div class="mb-3">
                        <label for="name" class="form-label">Nama</label>
                        <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror"
                               value="{{ old('name') }}" placeholder="Masukkan nama Anda">
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Rating --}}
                    <div class="mb-3">
                        <label class="form-label d-block">Rating</label>
                        <div class="rating-input">
                            @for($i = 5; $i >= 1; $i--)
                                <input type="radio" name="rating" id="star{{ $i }}" value="{{ $i }}" {{ old('rating')==$i ? 'checked' : '' }}>
                                <label for="star{{ $i }}"><i class="bi bi-star-fill"></i></label>
                            @endfor
                        </div>
                        @error('rating')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    {{-- Pesan --}}
                    <div class="mb-3">
                        <label for="message" class="form-label">Pesan</label>
                        <textarea name="message" id="message" rows="4" class="form-control @error('message') is-invalid @enderror"
                                  placeholder="Tulis ulasan Anda">{{ old('message') }}</textarea>
                        @error('message')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-orange w-100">Kirim Review</button>
                </form>
            </div>
        </div>
    </div>
</section>


{{-- TESTIMONIAL CAROUSEL --}}
<section class="section">
    <div class="container text-center">
        <h3 class="section-title mb-5">Customer Testimonials</h3>

        <div id="testimonialCarousel" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">

                @foreach($reviews->chunk(3) as $chunkIndex => $chunk)
                <div class="carousel-item {{ $chunkIndex === 0 ? 'active' : '' }}">
                    <div class="row justify-content-center g-4">

                        @foreach($chunk as $r)
                        <div class="col-md-4 d-flex">
                            <div class="testi-box w-100">
                                <i class="bi bi-quote"></i>

                                {{-- RATING --}}
                                <div class="rating mb-3">
                                    @for ($i = 1; $i <= 5; $i++)
                                        <i class="bi {{ $i <= $r->rating ? 'bi-star-fill' : 'bi-star' }}"></i>
                                    @endfor
                                </div>

                                {{-- MESSAGE --}}
                                <p class="testi-message">
                                    {{ $r->message }}
                                </p>

                                {{-- USER --}}
                                <div class="testi-user">
                                    <strong>{{ $r->name }}</strong>
                                </div>
                            </div>
                        </div>
                        @endforeach

                    </div>
                </div>
                @endforeach

            </div>

            {{-- CONTROLS --}}
            <button class="carousel-control-prev" type="button"
                    data-bs-target="#testimonialCarousel" data-bs-slide="prev">
                <span class="carousel-control-prev-icon"></span>
            </button>

            <button class="carousel-control-next" type="button"
                    data-bs-target="#testimonialCarousel" data-bs-slide="next">
                <span class="carousel-control-next-icon"></span>
            </button>
        </div>
    </div>
</section>


@endsection
