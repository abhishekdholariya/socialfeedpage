<?php

namespace App\Http\Controllers;

use App\Models\User;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Log;
use Laravel\Socialite\Facades\Socialite;

class GoogleLoginController extends Controller
{
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect(); 
    }

    public function handleGoogleCallback(): RedirectResponse
    {
        try{
            $user = Socialite::driver('google')->user();
            $existingUser = User::where('google_id', $user->id)->first();
            if ($existingUser) {
                auth()->login($existingUser, true);
            } else {
                $newUser = new User();
                $newUser->fname = $user->user['given_name'];
                $newUser->lname = $user->user['family_name'];
                $newUser->email = $user->email;
                $newUser->google_id = $user->id;
                $newUser->profile=$user->avatar;
                $newUser->google_id=$user->id;
                $newUser->save();
                auth()->login($newUser, true);
            }
            return redirect()->intended('/');
        }catch (Exception $e) {
            Log::info('User google login');
            Log::info($e->getMessage());
            return response()->json(['success' => false]);
        }   
    }
}
