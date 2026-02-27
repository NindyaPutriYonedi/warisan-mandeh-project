<?php
namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;


class OrderController extends Controller
{
public function checkoutForm(Request $r){
$sid = $r->session()->get('cart_session_id');
$items = Cart::with('product')->where('session_id',$sid)->get();
if($items->isEmpty()) return redirect()->route('home')->with('error','Keranjang kosong');
return view('checkout.checkout', compact('items'));
}


public function placeOrder(Request $r){
$r->validate([
'customer_name'=>'required|string',
'customer_phone'=>'required|string',
'customer_address'=>'required|string',
]);


$sid = $r->session()->get('cart_session_id');
$items = Cart::with('product')->where('session_id',$sid)->get();
if($items->isEmpty()) return redirect()->route('home')->with('error','Keranjang kosong');


$total = 0;
foreach($items as $it) $total += $it->product->price * $it->quantity;


$order = Order::create([
'customer_name'=>$r->customer_name,
'customer_phone'=>$r->customer_phone,
'customer_address'=>$r->customer_address,
'status'=>'pending',
'total_price'=>$total
]);


foreach($items as $it){
OrderItem::create([
'order_id'=>$order->id,
'product_id'=>$it->product->id,
'quantity'=>$it->quantity,
'price'=>$it->product->price
]);
}


// clear cart
Cart::where('session_id',$sid)->delete();
$r->session()->forget('cart_session_id');


// Redirect langsung ke WhatsApp
$message = "Pesanan: Total Rp.".number_format($total,0,',','.')."\nNama: {$order->customer_name}\nTelepon: {$order->customer_phone}\nAlamat: {$order->customer_address}\nTerima kasih!";
$phone = config('app.whatsapp_number'); 
$waUrl = 'https://wa.me/' . preg_replace('/[^0-9]/','',$phone) . '?text=' . urlencode($message);
}

}
