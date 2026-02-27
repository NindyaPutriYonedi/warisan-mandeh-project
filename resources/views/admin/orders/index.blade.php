@extends('layouts.admin')

@section('content')

<style>
.page-card {
    background: #ffffff;
    border-radius: 18px;
    padding: 24px;
    box-shadow: 0 10px 25px rgba(0,0,0,.05);
}

.table-modern th {
    font-size: 14px;
    color: #6b7280;
    border-bottom: 1px solid #e5e7eb;
}

.table-modern td {
    border-bottom: 1px solid #f1f5f9;
    vertical-align: middle;
}

.btn-soft-dark {
    background: #f1f5f9;
    color: #111827;
    border: none;
}

.btn-soft-dark:hover {
    filter: brightness(0.95);
}

.select-status {
    border-radius: 999px;
    padding-left: 14px;
    padding-right: 14px;
    border: 1px solid #fed7aa;
    background: #fff7ed;
    color: #c2410c;
    font-weight: 600;
    font-size: 14px;
}

.select-status:focus {
    box-shadow: none;
    border-color: #fb923c;
}

.order-id {
    font-weight: 600;
    color: #9a3412;
}

.customer-phone {
    font-size: 13px;
    color: #6b7280;
}

.product-list {
    font-size: 14px;
}

.action-btn {
    padding: 6px 14px;
    border-radius: 999px;
    font-size: 13px;
}

</style>

<div class="page-card">

    <!-- HEADER -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h4 class="fw-bold mb-1 text-orange">Daftar Order</h4>
            <small class="text-muted">Pantau dan kelola pesanan masuk</small>
        </div>
    </div>

    <!-- TABLE -->
    <div class="table-responsive">
        <table class="table table-modern">
            <thead>
                <tr class="text-center">
                    <th style="width:70px">No</th>
                    <th class="text-start">Produk</th>
                    <th class="text-start">Customer</th>
                    <th>Status</th>
                    <th style="width:110px">Aksi</th>
                </tr>
            </thead>

            <tbody>
                @forelse($orders as $o)
                <tr>
                    <!-- No -->
                    <td class="text-center order-id">
                        {{ $loop->iteration }}
                    </td>


                    <!-- PRODUK -->
                    <td class="product-list">
                        @foreach($o->items as $item)
                            {{ $item->product_name ?? $item->product->name ?? 'Produk tidak ditemukan' }} <br>
                        @endforeach
                    </td>

                    <!-- CUSTOMER -->
                    <td>
                        <strong>{{ $o->customer_name }}</strong><br>
                        <span class="customer-phone">{{ $o->customer_phone }}</span>
                    </td>

                    <!-- STATUS -->
                    <td class="text-center">
                        <form action="{{ route('admin.orders.status', $o->id) }}" method="POST">
                            @csrf
                            <select name="status"
        class="form-select form-select-sm select-status
        @if($o->status == 'pending') text-warning border-warning
        @elseif($o->status == 'terkirim') text-success border-success
        @elseif($o->status == 'dibatalkan') text-danger border-danger
        @else text-primary border-primary
        @endif"
        onchange="this.form.submit()">


                                <option value="pending"    {{ $o->status=='pending'?'selected':'' }}>Pending</option>
                                <option value="diproses"   {{ $o->status=='diproses'?'selected':'' }}>Diproses</option>
                                <option value="terkirim"   {{ $o->status=='terkirim'?'selected':'' }}>Terkirim</option>
                                <option value="dibatalkan" {{ $o->status=='dibatalkan'?'selected':'' }}>Dibatalkan</option>

                            </select>
                        </form>
                    </td>

                    <!-- AKSI -->
                    <td class="text-center">
                        <a href="{{ route('admin.orders.show', $o->id) }}"
                           class="btn btn-soft-dark action-btn">
                            <i class="bi bi-eye me-1"></i> Detail
                        </a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="text-center py-5 text-muted">
                        <i class="bi bi-bag-x fs-2 d-block mb-2"></i>
                        Belum ada order masuk
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

</div>

@endsection
