<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    public function show()
    {
        return view('login');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {

            Session::regenerate();
            $user = Auth::user();
            return redirect('/');
        }
        
        return back()->withErrors(['email' => 'These credentials do not match our records.', 'password' => 'This Password not match']);
    }

    public function destroy()
    {
        Auth::logout();
        return redirect('/login');
    }
}
