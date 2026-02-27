<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::orderBy('id', 'desc')->get();
        return view('admin.products.index', compact('products'));
    }

    public function create()
    {
        return view('admin.products.create');
    }

    public function store(Request $r)
    {
        $r->validate([
            'name' => 'required|string',
            'weight' => 'required|string', 
            'price' => 'required|numeric',
            'description' => 'nullable|string',
            'image' => 'nullable|image|max:2048'
        ]);

        $path = null;
        if ($r->hasFile('image')) {
            $path = $r->file('image')->store('products', 'public');
        }

        Product::create([
            'name' => $r->name,
            'weight' => $r->weight,
            'price' => $r->price,
            'description' => $r->description,
            'image' => $path
        ]);

        return redirect()
            ->route('admin.products.index')
            ->with('success', 'Produk berhasil ditambahkan');
    }

    public function edit($id)
    {
        $product = Product::findOrFail($id);
        return view('admin.products.edit', compact('product'));
    }

    public function update(Request $r, $id)
    {
        $r->validate([
            'name' => 'required|string',
            'weight' => 'required|string',
            'price' => 'required|numeric',
            'description' => 'nullable|string',
            'image' => 'nullable|image|max:2048'
        ]);

        $p = Product::findOrFail($id);

        $p->name = $r->name;
        $p->weight = $r->weight;
        $p->price = $r->price;
        $p->description = $r->description;

        if ($r->hasFile('image')) {
            if ($p->image && Storage::disk('public')->exists($p->image)) {
                Storage::disk('public')->delete($p->image);
            }
            $p->image = $r->file('image')->store('products', 'public');
        }

        $p->save();

        return redirect()
            ->route('admin.products.index')
            ->with('success', 'Produk berhasil diperbarui');
    }

    public function destroy($id)
    {
        $p = Product::findOrFail($id);

        if ($p->image && Storage::disk('public')->exists($p->image)) {
            Storage::disk('public')->delete($p->image);
        }

        $p->delete();

        return back()->with('success', 'Produk berhasil dihapus');
    }
}
