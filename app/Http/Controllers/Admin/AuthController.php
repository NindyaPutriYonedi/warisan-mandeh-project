<?php
namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class AuthController extends Controller
{
public function login() {
    return view('admin.login');
}

public function loginProcess(Request $r) {
    $r->validate(['email'=>'required|email','password'=>'required']);

    if (auth()->attempt($r->only('email','password'))) {
        return redirect()->route('admin.dashboard');
    }

    return back()->with('error', 'Email atau password salah');
}



public function logout(){
Auth::logout();
return redirect()->route('admin.login');
}
}
