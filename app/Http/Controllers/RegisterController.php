<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Http\Requests\RegisterRequest;
use App\Jobs\SendWelcomeBackEmail;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class RegisterController extends Controller
{
    public function show(){
        return view('auth.register');
    }
    public function store(RegisterRequest $request){
        try{
            $user= new User();
            $user->fname=$request->input('fname');
            $user->lname=$request->input('lname');
            $user->email=$request->input('email');
            $user->password=Hash::make($request->input('password'));
            $user->headline=$request->input('headline');

            $profile = $request->file('profile');
            $profileName = time() . '.' . $profile->getClientOriginalExtension();
            $profile->move(public_path('uploads'), $profileName);   
            $user->profile=$profileName;
            $user->save();

            SendWelcomeBackEmail::dispatch($user);

            return redirect()->route('login')->with('success', 'User registered successfully.');
        }catch (Exception $e) {
                Log::info('add user');
                Log::info($e->getMessage());
                return response()->json(['success' => false]);
        }
    }
    
    public function update(ProfileUpdateRequest $request, $id)
    {
        try{
        $user = User::find($id);
        if (!$user) {
            return response()->json(['error' => 'User not found'], 404);
        }
            $user->fname = $request->input('fname');
            $user->lname = $request->input('username');
            $user->email = $request->input('email');

            if ($request->hasFile('profile')) {
                $profile = $request->file('profile');
                $profileName = time() . '.' . $profile->getClientOriginalExtension();
                $profile->move(public_path('uploads'), $profileName);   
                $user->profile = $profileName;
            }
            $user->save();
            return redirect()->back();
        }catch (Exception $e) {
                Log::info('update profile');
                Log::info($e->getMessage());
                return response()->json(['success' => false]);
        }
    }

}

