@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row g-5 align-items-start">

        {{-- IMAGE --}}
        <div class="col-md-4">
            <div class="image-frame">
                <img src="{{ asset('storage/' . $product->image) }}"
                     alt="{{ $product->name }}">
            </div>
        </div>

        {{-- CONTENT --}}
        <div class="col-md-6">

            <h1 class="product-name">{{ $product->name }}</h1>

            <p class="product-description">
                {!! nl2br(e($product->description)) !!}
            </p>

            {{-- PRICE --}}
            <div class="product-price">
    <span class="price-label">Price</span>
    <div id="priceDisplay" class="product-price">
        —
    </div>
</div>


            {{-- ACTION --}}
<div class="action-box">

    {{-- INPUT ROW --}}
    <div class="row g-4 align-items-end mb-4">

        {{-- VARIANT --}}
        <div class="col-md-4">
            <label class="label">Berat</label>
            <select id="variantSelect" class="form-select clean-select">
                <option value="">Pilih berat</option>
                @foreach($variants as $v)
                    <option value="{{ $v->id }}"
                            data-price="{{ $v->price }}">
                        {{ $v->weight }}
                    </option>
                @endforeach
            </select>
        </div>

        {{-- QTY --}}
        <div class="col-auto">
            <label class="label">Jumlah</label>
            <div class="qty-box">
                <button type="button" onclick="changeQty(-1)">−</button>
                <input id="qtyInput" type="text" value="1" readonly>
                <button type="button" onclick="changeQty(1)">+</button>
            </div>
        </div>

    </div>

    {{-- BUTTON ROW --}}
    <div class="d-flex align-items-center gap-3">

        {{-- CART --}}
        <form action="{{ route('cart.add') }}" method="POST">
            @csrf
            <input type="hidden" name="variant_id" id="cartVariant">
            <input type="hidden" name="qty" id="cartQty">

            <button class="btn btn-light border border-orange rounded-circle"
                    style="width:48px;height:48px">
                <i class="bi bi-cart-plus fs-5 text-orange"></i>
            </button>
        </form>

        {{-- BUY --}}
        <form action="{{ route('buy.now') }}" method="POST">
            @csrf
            <input type="hidden" name="variant_id" id="buyVariant">
            <input type="hidden" name="qty" id="buyQty">

            <button class="btn btn-orange px-5 py-2 fw-semibold">
                Beli
            </button>
        </form>

    </div>

</div>


<style>
.image-frame {
    border-radius: 20px;
    overflow: hidden;
}
.image-frame img {
    width: 100%;
    height: 420px;
    object-fit: cover;
}

.product-name {
    font-size: 2.3rem;
    font-weight: 700;
    margin-bottom: 14px;
}

.product-description {
    color: #666;
    line-height: 1.9;
    max-width: 520px;
    margin-bottom: 28px;
}

.price-wrapper {
    margin-bottom: 32px;
}
.price-label {
    font-size: .85rem;
    font-weight: 600;
    color: #999;
}
.product-price {
    font-size: 1.9rem;
    font-weight: 800;
    color: #ff7a18;
}

.action-box {
    border-top: 1px solid #eee;
    padding-top: 28px;
}

.label {
    font-size: .85rem;
    font-weight: 600;
    margin-bottom: 6px;
    display: block;
}

.qty-box {
    display: flex;
    align-items: center;
    border: 1px solid #ddd;
    border-radius: 10px;
    overflow: hidden;
}
.qty-box button {
    border: none;
    background: none;
    padding: 6px 14px;
    font-size: 18px;
}
.qty-box input {
    width: 46px;
    text-align: center;
    border: none;
    font-weight: 600;
}

.clean-select {
    border-radius: 10px;
}

.btn-light.border-orange:hover {
    background-color: rgba(255, 122, 24, 0.08);
}

</style>

<script>
const variantSelect = document.getElementById('variantSelect');
const qtyInput      = document.getElementById('qtyInput');
const priceDisplay  = document.getElementById('priceDisplay');

function updatePrice() {
    const variantId = variantSelect.value;

    // Jika belum pilih berat
    if (!variantId) {
        priceDisplay.innerText = 'Price';
        return;
    }

    const selectedOption = variantSelect.querySelector(
        `option[value="${variantId}"]`
    );

    const price = parseInt(selectedOption.dataset.price);
    const qty   = parseInt(qtyInput.value);

    if (isNaN(price) || isNaN(qty)) {
        priceDisplay.innerText = 'Price';
        return;
    }

    const total = price * qty;

    priceDisplay.innerText =
        'Rp ' + new Intl.NumberFormat('id-ID').format(total);
}

// GANTI BERAT → UPDATE PRICE
variantSelect.addEventListener('change', updatePrice);

// QTY + / −
function changeQty(step) {
    let qty = parseInt(qtyInput.value);
    qty = Math.max(1, qty + step);
    qtyInput.value = qty;
    updatePrice();
}

/* SUBMIT BELI */
document.querySelector('form[action*="buy"]').addEventListener('submit', function (e) {
    if (!variantSelect.value) {
        alert('Silakan pilih berat terlebih dahulu');
        e.preventDefault();
        return;
    }
    document.getElementById('buyVariant').value = variantSelect.value;
    document.getElementById('buyQty').value = qtyInput.value;
});

/* SUBMIT CART */
document.querySelector('form[action*="cart"]').addEventListener('submit', function (e) {
    if (!variantSelect.value) {
        alert('Silakan pilih berat terlebih dahulu');
        e.preventDefault();
        return;
    }
    document.getElementById('cartVariant').value = variantSelect.value;
    document.getElementById('cartQty').value = qtyInput.value;
});
</script>

@endsection
