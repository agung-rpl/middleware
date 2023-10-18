<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index() {
        return view('admin.login');
    }

    public function authenticate(Request $request) {
        $credential = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if (auth::attempt($credential)){

            $request->session()->regenerate();

            return redirect()->intended(route('mastersiswa'));
        }

        return back ()->withErrors([
            'email' => 'Username atau Password yang dimasukkan salah.',
        ])->onlyInput('email');
    }

        public function logout(Request $request){
            Auth::logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();
            // dd('tes');

            return redirect()->route('login');
        }
}