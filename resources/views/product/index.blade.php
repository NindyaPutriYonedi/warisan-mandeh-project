@extends('layouts.app')

@section('content')

<div class="mt-5 pt-4">
    <h3 class="fw-bold mb-4 text-center">Semua Produk</h3>

<div class="row row-cols-2 row-cols-md-4 g-4 product-grid">

    @foreach($products as $p)
    <div class="col">
        <div class="product-card">

            {{-- IMAGE --}}
            <div class="product-image">
                <img src="{{ asset('storage/' . $p->image) }}" alt="{{ $p->name }}">
            </div>

            {{-- CONTENT --}}
            <div class="product-content text-center">
                <h6 class="product-title">{{ $p->name }}</h6>

                <a href="{{ route('product.show', $p->id) }}"
                   class=" btn-sm product-btn">
                    Lihat Detail
                </a>
            </div>

        </div>
    </div>
    @endforeach

</div>

@endsection
