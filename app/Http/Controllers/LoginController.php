<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use Exception;

use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    public function show()
    {
        return view('auth.login');
    }

    public function store(LoginRequest $request)
    {
        try{
            $credentials = $request->only('email', 'password');
            if (Auth::attempt($credentials)) {
                Session::regenerate();
                return redirect('/');
            }
            return back()->withErrors([
                'email' => 'These credentials do not match our records.', 
                'password' => 'This Password does not match'
            ]);
        }catch (Exception $e) {
            Log::info('user login');
            Log::info($e->getMessage());
            return response()->json(['success' => false]);
        }
    }

    public function destroy()
    {
        try{
            Auth::logout();
            return redirect('/login');
        }catch (Exception $e) {
            Log::info('user logout');
            Log::info($e->getMessage());
            return response()->json(['success' => false]);
        }
        
    }
}
