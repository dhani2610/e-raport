<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
  public function index()
  {
    return view('pages.auth.login');
  }

  public function cekLogin(Request $request)
  {
    $input = $request->validate([
      'username' => ['required'],
      'password' => ['required'],
    ]);

    if (Auth::attempt($input)) {
        if (Auth::user()->is_aktif == true) {
          return redirect(route('dashboard.index'))->withInfo('Anda berhasil masuk!');
        } else {
          Auth::logout();
          return back()->withFailed('Akun anda tidak aktif!');
        }
    } else {
      return back()->withFailed('Username atau password salah!');
    }
  }
}
