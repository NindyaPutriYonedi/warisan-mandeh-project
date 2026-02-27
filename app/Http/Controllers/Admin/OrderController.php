<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Product;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::orderBy('id', 'desc')->get();
        return view('admin.orders.index', compact('orders'));
    }

    // public function show($id)
    // {
    //     $order = Order::with('product')->findOrFail($id);
    //     return view('admin.orders.show', compact('order'));
    // }

    public function show($id)
{
    $order = Order::with(['items.product'])->findOrFail($id);
    return view('admin.orders.show', compact('order'));
}


    public function updateStatus(Request $r, $id)
    {
        $r->validate([
            'status' => 'required|string'
        ]);

        $order = Order::findOrFail($id);
        $order->status = $r->status;
        $order->save();

        return back()->with('success', 'Status order berhasil diperbarui');
    }

    public function destroy($id)
    {
        $order = Order::findOrFail($id);
        $order->delete();

        return back()->with('success', 'Order berhasil dihapus');
    }
}
