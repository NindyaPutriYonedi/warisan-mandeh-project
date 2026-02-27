@extends('layouts.admin')

@section('content')

{{-- TOP BAR --}}
<div class="topbar d-flex justify-content-between align-items-center">
    <h6 class="mb-0 fw-semibold">Dashboard</h6>
    <span>Admin</span>
</div>

{{-- STAT CARDS --}}
<div class="row mt-4 g-4">
    {{-- TOTAL PRODUCTS --}}
    <div class="col-md-4">
        <div class="stat-card d-flex justify-content-between align-items-center">
            <div>
                <small>Total Products</small>
                <h2>{{ $totalProducts }}</h2>
            </div>
            <i class="bi bi-box-seam fs-2 text-warning opacity-75"></i>
        </div>
    </div>

    {{-- NEW ORDERS --}}
    <div class="col-md-4">
        <div class="stat-card d-flex justify-content-between align-items-center">
            <div>
                <small>New Orders</small>
                <h2>{{ $newOrders }}</h2>
            </div>
            <i class="bi bi-bag-check fs-2 text-warning opacity-75"></i>
        </div>
    </div>

    {{-- AVG RATING --}}
    <div class="col-md-4">
        <div class="stat-card d-flex justify-content-between align-items-center">
            <div>
                <small>Avg Rating</small>
                <h2>{{ number_format($averageRating, 1) }}</h2>
            </div>
            <i class="bi bi-star-fill fs-2 text-warning opacity-75"></i>
        </div>
    </div>
</div>


{{-- PERFORMANCE --}}<div class="row mt-4 g-4">

    {{-- LEFT: PERFORMANCE --}}
    <div class="col-md-7">
        <div class="content-box">
            <h6 class="fw-semibold mb-3">Performance Penjualan Bulanan</h6>

            <div class="mb-3">
                <small class="text-muted">Total Income (Delivered Orders)</small>
                <h4 class="fw-bold text-success">
                    Rp {{ number_format($totalIncome, 0, ',', '.') }}
                </h4>
            </div>

            <canvas id="salesBarChart" height="140"></canvas>
        </div>
    </div>

    {{-- RIGHT: PENDING ORDERS --}}
    <div class="col-md-5">
        <div class="content-box">
            <h6 class="fw-semibold mb-3">Orders Pending</h6>

            @forelse($pendingOrders as $order)
    <div class="pending-item">
        <div>
            <strong class="d-block">
                {{ $order->customer_name }}
            </strong>

            {{-- LIST PRODUK --}}
            <small class="text-muted">
                @foreach($order->items as $item)
                    {{ $item->product_name ?? $item->product->name ?? 'Produk' }}
                    {{ $item->quantity }}<br>
                @endforeach
            </small>
        </div>

        <span class="badge bg-warning text-dark align-self-start">
            Pending
        </span>
    </div>
@empty

                <p class="text-muted">No pending orders.</p>
            @endforelse
        </div>
    </div>

</div>



{{-- CHART --}}<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
new Chart(document.getElementById('salesBarChart'), {
    type: 'bar',
    data: {
        labels: @json($months),
        datasets: [{
            data: @json($sales),
            backgroundColor: '#ff6a00',
            borderRadius: 6
        }]
    },
    options: {
        plugins: {
            legend: { display: false }
        },
        scales: {
            y: {
                beginAtZero: true,
                ticks: {
                    callback: value => 'Rp ' + value.toLocaleString('id-ID')
                }
            }
        }
    }
});
</script>


@endsection
