<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;

class CheckoutController extends Controller
{
    public function process(Request $request)
    {
        // Validasi form customer
        $request->validate([
            'customer_name'    => 'required|string',
            'customer_phone'   => 'required|string',
            'customer_address' => 'required|string',
        ]);

        // Ambil cart dari session
        $cart = session()->get('cart', []);

        if (empty($cart)) {
            return back()->with('error', 'Keranjang masih kosong.');
        }

        // Hitung total
        $grandTotal = 0;
        foreach ($cart as $item) {
            $grandTotal += $item['qty'] * $item['price'];
        }

        // Simpan order
        $order = Order::create([
            'customer_name'    => $request->customer_name,
            'customer_phone'   => $request->customer_phone,
            'customer_address' => $request->customer_address,
            'total_price'      => $grandTotal,
            'status'           => 'pending',
        ]);

        // Simpan order items
        foreach ($cart as $item) {

            $product = Product::findOrFail($item['variant_id']);

            OrderItem::create([
                'order_id'    => $order->id,
                'product_id'  => $product->id,
                'product_name'=> $product->name,
                'quantity'    => $item['qty'],
                'price'       => $product->price,
            ]);
        }

        // FORMAT PESAN WHATSAPP
        $message = "Halo Warisan Mandeh,\nSaya ingin memesan:\n\n";

        foreach ($cart as $item) {
            $message .= "{$item['name']} ({$item['weight']}) "
                      . "x{$item['qty']} - Rp "
                      . number_format($item['price'], 0, ',', '.') . "\n";
        }

        $message .= "\nTotal: Rp " . number_format($grandTotal, 0, ',', '.');
        $message .= "\n\nNama: {$request->customer_name}";
        $message .= "\nNo HP: {$request->customer_phone}";
        $message .= "\nAlamat: {$request->customer_address}";

        // Bersihkan cart
        session()->forget('cart');

        // Redirect ke WhatsApp
        $waNumber = "6281262264629";
        $url = "https://wa.me/{$waNumber}?text=" . urlencode($message);

        return redirect()->away($url);
    }

    public function buyNow(Request $request)
    {
        $request->validate([
            'variant_id' => 'required|exists:products,id',
            'qty'        => 'required|integer|min:1',
        ]);

        $product = Product::findOrFail($request->variant_id);

        // Simpan order
        $order = Order::create([
            'customer_name'    => 'Guest (langsung WA)',
            'customer_phone'   => '-',
            'customer_address' => '-',
            'total_price'      => $product->price * $request->qty,
            'status'           => 'pending',
        ]);

        // Simpan item
        OrderItem::create([
            'order_id'     => $order->id,
            'product_id'   => $product->id,
            'product_name' => $product->name,
            'quantity'     => $request->qty,
            'price'        => $product->price,
        ]);

        // Pesan WA
        $message  = "Halo Warisan Mandeh,\nSaya ingin membeli:\n\n";
        $message .= "{$product->name} ({$product->weight}) "
                 . "x{$request->qty} - Rp "
                 . number_format($product->price * $request->qty, 0, ',', '.');

        $url = "https://wa.me/6281262264629?text=" . urlencode($message);

        return redirect()->away($url);
    }
}
