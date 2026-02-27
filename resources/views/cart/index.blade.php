@extends('layouts.app')

@section('content')
<div class="container my-5">

    {{-- TITLE --}}
    <h2 class="fw-bold mb-4">Keranjang Belanja</h2>

    @if(empty($cart))
        <div class="text-muted">Keranjang masih kosong.</div>
    @else

    {{-- CART TABLE --}}
    <div class="table-responsive mb-5">
        <table class="table cart-table align-middle">
            <thead>
                <tr>
                    <th>Produk</th>
                    <th class="text-center">Jumlah</th>
                    <th>Berat</th>
                    <th>Harga</th>
                    <th>Total</th>
                    <th></th>
                </tr>
            </thead>

            <tbody>
                @php $grandTotal = 0; @endphp

                @foreach($cart as $id => $item)
                    @php
                        $total = (int)$item['qty'] * (int)$item['price'];
                        $grandTotal += $total;
                    @endphp

                    <tr>
                        {{-- PRODUK --}}
                        <td>
                            <div class="d-flex align-items-center gap-3">
                                <img src="{{ asset('storage/'.$item['image']) }}" class="cart-img">
                                <div>
                                    <div class="fw-semibold">{{ $item['name'] }}</div>
                                    <div class="text-muted small">{{ $item['weight'] }}</div>
                                </div>
                            </div>
                        </td>

                        {{-- QTY --}}
                        <td class="text-center">
                            <div class="qty-inline">
                                <form action="{{ route('cart.update', $id) }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="qty" value="{{ $item['qty'] - 1 }}">
                                    <button class="qty-btn" {{ $item['qty'] <= 1 ? 'disabled' : '' }}>−</button>
                                </form>

                                <span class="qty-value">{{ $item['qty'] }}</span>

                                <form action="{{ route('cart.update', $id) }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="qty" value="{{ $item['qty'] + 1 }}">
                                    <button class="qty-btn">+</button>
                                </form>
                            </div>
                        </td>

                        {{-- BERAT --}}
                        <td>
                        <div class="text-muted small">
        {{ $item['weight'] }}
    </div>
</td>

                        {{-- HARGA --}}
                        <td>
                            Rp {{ number_format($item['price'], 0, ',', '.') }}
                        </td>

                        {{-- TOTAL --}}
                        <td class="fw-semibold text-orange">
                            Rp {{ number_format($total, 0, ',', '.') }}
                        </td>

                        {{-- REMOVE --}}
                        <td>
                            <form action="{{ route('cart.remove', $id) }}" method="POST">
                                @csrf
                                <button class="btn-remove">×</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>

            {{-- <tfoot>
                <tr class="cart-total-row">
                    <td colspan="4" class="text-end fw-semibold">Total</td>
                    <td colspan="2" class="fw-bold text-orange fs-5">
                        Rp {{ number_format($grandTotal, 0, ',', '.') }}
                    </td>
                </tr>
            </tfoot> --}}
        </table>
    </div>

    {{-- CHECKOUT --}}
<div class="checkout-section mt-5">
    <h3 class="fw-bold mb-4 text-center">Informasi Pemesanan</h3>

    <div class="row justify-content-center g-4">

        {{-- FORM --}}
        <div class="col-md-7">
            <div class="checkout-box">
                <form action="{{ route('checkout.process') }}" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label class="form-label">Nama Lengkap</label>
                        <input type="text" name="customer_name"
                               class="form-control clean-input"
                               placeholder="Nama"
                               required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">No. WhatsApp</label>
                        <input type="text" name="customer_phone"
                               class="form-control clean-input"
                               placeholder="No. HP"
                               required>
                    </div>

                    <div class="mb-4">
                        <label class="form-label">Alamat Pengiriman</label>
                        <textarea name="customer_address"
                                  rows="3"
                                  class="form-control clean-input"
                                  placeholder="Alamat"
                                  required></textarea>
                    </div>

                    <button type="submit"
                            class="btn btn-orange w-100 py-3 fw-semibold">
                        Checkout
                    </button>
                </form>
            </div>
        </div>

        {{-- RINGKASAN --}}
        <div class="col-md-4">
            <div class="summary-box">
                <div class="summary-title">Ringkasan Pesanan</div>

                <div class="summary-row">
                    <span>Total Item</span>
                    <strong>{{ count($cart) }} produk</strong>
                </div>

                <div class="summary-row">
                    <span>Total Harga</span>
                    <strong class="text-orange">
                        Rp {{ number_format($grandTotal, 0, ',', '.') }}
                    </strong>
                </div>
            </div>
        </div>

    </div>
</div>

    @endif
</div>

{{-- STYLE --}}
<style>
.cart-table {
    border-collapse: separate;
    border-spacing: 0 14px;
}

.cart-table thead th {
    border: none;
    color: #999;
    font-weight: 600;
    font-size: .85rem;
}

.cart-table tbody tr {
    background: #fff;
    border-radius: 14px;
    box-shadow: 0 6px 18px rgba(0,0,0,.04);
}

.cart-table tbody td {
    border: none;
    padding: 18px;
}

.cart-img {
    width: 60px;
    height: 60px;
    object-fit: cover;
    border-radius: 12px;
}

.qty-inline {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 10px;
}

.qty-btn {
    border: 1px solid #ddd;
    background: none;
    width: 28px;
    height: 28px;
    border-radius: 6px;
    font-weight: 600;
}

.qty-value {
    min-width: 24px;
    text-align: center;
}

.btn-remove {
    border: none;
    background: none;
    font-size: 22px;
    color: #bbb;
}
.btn-remove:hover {
    color: #ff7a18;
}

.cart-total-row td {
    border: none;
    padding-top: 24px;
}

.checkout-box {
    max-width: 520px;
    background: #fff;
    padding: 28px;
    border-radius: 20px;
    box-shadow: 0 12px 30px rgba(0,0,0,.06);
}

.clean-input {
    border-radius: 10px;
    padding: 10px 14px;
}

.checkout-section {
    margin-top: 60px;
}

.summary-box {
    background: #fff;
    padding: 26px;
    border-radius: 20px;
    box-shadow: 0 12px 30px rgba(0,0,0,.06);
}

.summary-title {
    font-weight: 700;
    margin-bottom: 18px;
}

.summary-row {
    display: flex;
    justify-content: space-between;
    margin-bottom: 14px;
    font-size: .95rem;
}

</style>
@endsection
