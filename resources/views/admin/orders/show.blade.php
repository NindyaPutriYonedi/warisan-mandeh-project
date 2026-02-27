@extends('layouts.admin')

@section('content')

<!-- HEADER -->
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h4 class="fw-bold mb-1">Detail Order</h4>
        {{-- <small class="text-muted">Order{{ $order->id }}</small> --}}
    </div>

    <a href="{{ route('admin.orders.index') }}" class="btn btn-outline-secondary btn-sm">
        Kembali
    </a>
</div>

<!-- INFO ORDER -->
<div class="card border-0 shadow-sm rounded-4 mb-4">
    <div class="card-body p-4">
        <div class="row g-4">

            <div class="col-md-6">
                <p class="mb-2 text-muted">Nama Pelanggan</p>
                <h6 class="fw-semibold">{{ $order->customer_name }}</h6>

                <p class="mb-2 text-muted mt-3">No HP</p>
                <h6 class="fw-semibold">{{ $order->customer_phone }}</h6>

                <p class="mb-2 text-muted mt-3">Alamat</p>
                <h6 class="fw-semibold">{{ $order->customer_address }}</h6>
            </div>

            <div class="col-md-6">
                <div class="bg-light rounded-4 p-3 mb-3">
                    <p class="mb-1 text-muted">Total Harga</p>
                    <h4 class="fw-bold text-success mb-0">
                        Rp {{ number_format($order->total_price, 0, ',', '.') }}
                    </h4>
                </div>

                <p class="mb-2 text-muted">Status Order</p>
                @php
                    $badge = [
                        'pending' => 'warning',
                        'diproses' => 'primary',
                        'terkirim' => 'success',
                        'dibatalkan' => 'danger',
                    ][$order->status] ?? 'secondary';
                @endphp

                <span class="badge bg-{{ $badge }} px-3 py-2 rounded-pill">
                    {{ ucfirst($order->status) }}
                </span>
            </div>

        </div>
    </div>
</div>

<!-- ITEM PESANAN -->
<div class="card border-0 shadow-sm rounded-4">
    <div class="card-body p-4">
        <h5 class="fw-semibold mb-4">Item Pesanan</h5>

        <div class="table-responsive">
            <table class="table align-middle">
                <thead class="text-muted small border-bottom">
                    <tr>
                        <th>Produk</th>
                        <th class="text-center">Qty</th>
                        <th class="text-end">Harga</th>
                        <th class="text-end">Subtotal</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($order->items as $it)
                        @php
                            $subtotal = $it->quantity * $it->price;
                        @endphp

                        <tr>
                            <td class="fw-medium">
                                {{
                                    $it->product_name
                                    ?? ($it->product->name ?? 'Produk tidak ditemukan')
                                }}
                            </td>

                            <td class="text-center">
                                <span class="badge bg-light text-dark px-3">
                                    {{ $it->quantity }}
                                </span>
                            </td>

                            <td class="text-end">
                                Rp {{ number_format($it->price, 0, ',', '.') }}
                            </td>

                            <td class="text-end fw-semibold">
                                Rp {{ number_format($subtotal, 0, ',', '.') }}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

    </div>
</div>

@endsection
