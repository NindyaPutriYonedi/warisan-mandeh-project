<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class CartController extends Controller
{
    public function index()
    {
        $cart = session()->get('cart', []);
        return view('cart.index', compact('cart'));
    }

    public function add(Request $request)
{
    $request->validate([
        'variant_id' => 'required|exists:products,id',
        'qty'        => 'required|integer|min:1',
    ]);

    $product = Product::findOrFail($request->variant_id);

    $cart = session()->get('cart', []);

    $key = $product->id;

    if (isset($cart[$key])) {
        $cart[$key]['qty'] += $request->qty;
    } else {
        $cart[$key] = [
            'variant_id' => $product->id,
            'name'       => $product->name,
            'weight'     => $product->weight,
            'price'      => $product->price,
            'image'      => $product->image,
            'qty'        => $request->qty,
        ];
    }

    session()->put('cart', $cart);

    return redirect()
        ->route('cart.index')
        ->with('success', 'Produk berhasil ditambahkan ke keranjang.');
}

    public function update(Request $request, $variantId)
    {
        $request->validate([
            'qty' => 'required|integer|min:1',
        ]);

        $cart = session()->get('cart', []);

        if (isset($cart[$variantId])) {
            $cart[$variantId]['qty'] = $request->qty;
            session()->put('cart', $cart);
        }

        return back()->with('success', 'Jumlah berhasil diperbarui.');
    }

    public function remove($variantId)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$variantId])) {
            unset($cart[$variantId]);
            session()->put('cart', $cart);
        }

        return back()->with('success', 'Produk berhasil dihapus dari keranjang.');
    }
}
