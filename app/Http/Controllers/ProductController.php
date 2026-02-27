<?php

namespace App\Http\Controllers;

use App\Models\Review;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
//     public function home()
// {
//     $products = Product::orderBy('id', 'desc')->get();
//     $reviews = Review::orderBy('id', 'desc')->get();

//     return view('home', compact('products', 'reviews'));
// }


    // === UNTUK HALAMAN DETAIL PRODUK ===
    // public function show($id)
    // {
    //     $product = Product::findOrFail($id);
    //     return view('product.show', compact('product'));
    // }
    public function show($id)
{
    $product = Product::findOrFail($id);

    // Ambil semua varian berdasarkan nama
    $variants = Product::where('name', $product->name)
        ->orderBy('price')
        ->get();

    return view('product.show', compact('product', 'variants'));
}

    public function all()
{
    $products = Product::whereIn('id', function ($q) {
            $q->selectRaw('MIN(id)')
              ->from('products')
              ->groupBy('name');
        })
        ->orderBy('id', 'desc')
        ->get();

    return view('product.index', compact('products'));
}


}
