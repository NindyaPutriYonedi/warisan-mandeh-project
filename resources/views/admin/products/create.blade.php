@extends('layouts.admin')

@section('content')
<h3 class="fw-bold mb-4">Tambah Produk</h3>

<form action="{{ route('admin.products.store') }}"
      method="POST"
      enctype="multipart/form-data">
@csrf

<div class="mb-3">
    <label class="form-label">Nama Produk</label>
    <input type="text"
           name="name"
           class="form-control"
           placeholder="Nama produk"
           required>
</div>

<div class="row mb-3">
    <div class="col-md-6">
        <label class="form-label">Berat</label>
        <input type="text"
               name="weight"
               class="form-control"
               placeholder="contoh: 1/2 kg"
               required>
    </div>

    <div class="col-md-6">
        <label class="form-label">Harga</label>
        <input type="number"
               name="price"
               class="form-control"
               placeholder="contoh: 25000"
               required>
    </div>
</div>

<div class="mb-3">
    <label class="form-label">Deskripsi</label>
    <textarea name="description"
              class="form-control"
              rows="4"
              placeholder="Deskripsi produk (opsional)"></textarea>
</div>

<div class="mb-3">
    <label class="form-label">Gambar</label>
    <input type="file"
           name="image"
           class="form-control">
</div>

<button class="btn btn-primary px-4 py-2">
    Simpan
</button>

<a href="{{ route('admin.products.index') }}"
   class="btn btn-secondary px-4 py-2">
    Kembali
</a>
</form>
@endsection
