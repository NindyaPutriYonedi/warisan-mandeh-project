<?php
namespace App\Http\Controllers;


use App\Models\Product;
use App\Models\Review;


class HomeController extends Controller
{
public function index()
{
    $products = Product::whereIn('id', function ($q) {
            $q->selectRaw('MIN(id)')
              ->from('products')
              ->groupBy('name');
        })
        ->orderBy('id', 'desc')
        ->get();

    $reviews = Review::latest()->limit(6)->get();

    return view('home', compact('products','reviews'));
}
}
