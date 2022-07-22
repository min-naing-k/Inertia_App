<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class LoginController extends Controller
{
  public function create()
  {
    return Inertia::render('Auth/Login');
  }

  public function store()
  {
    $credentials = request()->validate([
      'email' => 'required|email',
      'password' => 'required',
    ]);

    if (!Auth::attempt($credentials)) {
      return back()->withErrors(['email' => 'The provided credentials do not match our records.']);
    }

    request()->session()->regenerate();

    return redirect()->intended();
  }

  public function destroy()
  {
    Auth::logout();

    return redirect()->route('login');
  }
}
