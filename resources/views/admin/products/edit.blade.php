@extends('layouts.admin')

@section('content')
<h4 class="fw-bold mb-4">Edit Produk</h4>

<form action="{{ route('admin.products.update', $product->id) }}"
      method="POST"
      enctype="multipart/form-data">
@csrf

<div class="mb-3">
    <label class="form-label">Nama Produk</label>
    <input type="text" name="name" class="form-control"
           value="{{ $product->name }}" required>
</div>

<div class="row mb-3">
    <div class="col-md-6">
        <label class="form-label">Berat</label>
        <input type="text" name="weight" class="form-control"
               value="{{ $product->weight }}"
               placeholder="contoh: 1/2 kg" required>
    </div>

    <div class="col-md-6">
        <label class="form-label">Harga</label>
        <input type="number" name="price" class="form-control"
               value="{{ $product->price }}" required>
    </div>
</div>

<div class="mb-3">
    <label class="form-label">Deskripsi</label>
    <textarea name="description" class="form-control" rows="4">
{{ $product->description }}
    </textarea>
</div>

<div class="mb-3">
    <label class="form-label">Gambar</label>
    <input type="file" name="image" class="form-control">

    @if($product->image)
        <img src="{{ asset('storage/'.$product->image) }}"
             width="120" class="mt-2 rounded">
    @endif
</div>

<button class="btn btn-primary px-4">Simpan Perubahan</button>
<a href="{{ route('admin.products.index') }}"
   class="btn btn-secondary">Batal</a>

</form>
@endsection
