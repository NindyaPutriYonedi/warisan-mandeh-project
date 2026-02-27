@extends('layouts.admin')

@section('content')

<style>

.page-card {
    background: #ffffff;
    border-radius: 18px;
    padding: 24px;
    box-shadow: 0 10px 25px rgba(0,0,0,.05);
}

.btn-soft-primary {
    background: #eef2ff;
    color: #4f46e5;
    border: none;
}
.btn-soft-danger {
    background: #fef2f2;
    color: #dc2626;
    border: none;
}
.btn-soft-warning {
    background: #fff7ed;
    color: #d97706;
    border: none;
}

.btn-soft-primary:hover,
.btn-soft-danger:hover,
.btn-soft-warning:hover {
    filter: brightness(0.95);
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

.product-img {
    width: 60px;
    height: 60px;
    object-fit: cover;
    border-radius: 14px;
    box-shadow: 0 6px 12px rgba(0,0,0,.08);
}

.price {
    font-weight: 600;
    color: #16a34a;
}

.action-btn {
    width: 36px;
    height: 36px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
}
</style>

<div class="page-card">

    <!-- HEADER -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h4 class="fw-bold mb-1">Kelola Produk</h4>
        </div>

        <a href="{{ route('admin.products.create') }}"
           class="btn btn-soft-primary rounded-pill px-4 py-2 shadow-sm">
            <i class="bi bi-plus-lg me-1"></i> Tambah Produk
        </a>
    </div>

    <!-- TABLE -->
    <div class="table-responsive">
        <table class="table table-modern">
            <thead>
                <tr>
                    <th>Produk</th>
                    <th>Berat</th>
                    <th>Harga</th>
                    <th class="text-center">Aksi</th>
                </tr>
            </thead>

            <tbody>
            @forelse($products as $p)
                <tr>
                    <!-- PRODUK -->
                    <td>
                        <div class="d-flex align-items-center gap-3">
                            @if($p->image)
                                <img src="{{ asset('storage/'.$p->image) }}"
                                     class="product-img">
                            @else
                                <div class="product-img bg-light d-flex align-items-center justify-content-center text-muted">
                                    <i class="bi bi-image"></i>
                                </div>
                            @endif

                            <div>
                                <strong class="d-block">{{ $p->name }}</strong>
                            </div>
                        </div>
                    </td>

                    <!-- BERAT -->
                    <td>
                        {{ $p->weight ?? '-' }}
                    </td>

                    <!-- HARGA -->
                    <td class="price">
                        Rp {{ number_format($p->price) }}
                    </td>

                    <!-- AKSI -->
                    <td>
                        <div class="d-flex justify-content-center gap-2">
                            <a href="{{ route('admin.products.edit', $p->id) }}"
                               class="btn btn-soft-warning action-btn"
                               title="Edit">
                                <i class="bi bi-pencil"></i>
                            </a>

                            <form action="{{ route('admin.products.destroy', $p->id) }}"
                                  method="POST"
                                  onsubmit="return confirm('Yakin hapus produk ini?')">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-soft-danger action-btn"
                                        title="Hapus">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="text-center py-5 text-muted">
                        <i class="bi bi-box-seam fs-2 d-block mb-2"></i>
                        Belum ada produk
                    </td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>

</div>

@endsection
