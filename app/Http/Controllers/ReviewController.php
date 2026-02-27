<?php
namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\Review;


class ReviewController extends Controller
{
public function create(){
return view('reviews.create');
}


public function store(Request $r){
$r->validate(['name'=>'required','rating'=>'required|integer|min:1|max:5','message'=>'required']);
Review::create($r->only(['name','rating','message']));
return redirect()->route('home')->with('success','Terima kasih atas ulasan Anda!');
}
}
