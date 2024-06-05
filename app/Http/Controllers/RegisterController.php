<?php

namespace App\Http\Controllers;

use App\Jobs\SendWelcomeBackEmail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function show(){
        return view('register');
    }
    public function store(Request $request){
        $request->validate([
            'fname'=>'required',
            'lname'=>'required',
            'email'=>'required | email | unique:users,email',
            'password'=>'required | min:6',
            'headline'=>'required',
            'profile'=>'required | nullable | image | max:2048'
        ]);
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
        
        return redirect('/login')->with('success', 'User registered successfully.');
    }
    
    public function update(Request $request, $id)
    {
        $request->validate([
            'fname' => 'required',
            'username' => 'required',
            'email' => 'required | email',
            'profile' => 'required | nullable | image | max:2048',
        ]);

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
    }

}

