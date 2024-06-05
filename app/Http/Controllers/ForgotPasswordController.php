<?php

namespace App\Http\Controllers;

use App\Models\ForgotPassword;
use App\Models\User;
use App\Jobs\SendForgotPasswordEmail;
use GuzzleHttp\Psr7\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class ForgotPasswordController extends Controller
{
    public function show(){
        return view('layout.forgotpassword');
    }

    public function store(Request $request){
        $request->validate([
            'email'=>'required | email | exists:users'
        ]);
        $token=Str::random(64);
        $data = new ForgotPassword();
        $data->email=$request->input('email');
        $data->token=$token;
        
        $data->save();

        // Mail::send("emails.forgotpassword", ['token'=>$token], function($message) use ($request){
        //     $message->to($request->email)->subject("Reset Password");
        // });
        SendForgotPasswordEmail::dispatch($request->email, $token);
        
        return redirect()->to(route("forgotpassword"))->with('success','send email');
    }

    public function reset($token){
        return view('layout.changepassword',compact('token'));
    }

    public function update(Request $request){
        $request->validate([
            'email' => 'required|email|exists:users,email',
            'newpassword' => 'required|min:6|confirmed'
        ]);
    
        $updatePassword = ForgotPassword::where([
            'email' => $request->email,
            'token' => $request->token,
        ])->first();
    
        if(!$updatePassword){
            return redirect()->route('resetpassword', ['token' => $request->token])->with('error', 'Invalid token or email.');
        }
    
        $user = User::where('email', $request->email)->first();
        if($user){
            $user->password = Hash::make($request->newpassword);
            $user->save();
            ForgotPassword::where(['email' => $request->email])->delete();
            return redirect()->route('login')->with('success', 'Password successfully updated.');
        }
    
        return redirect()->route('resetpassword', ['token' => $request->token])->with('error', 'Invalid email address.');
    }
    
}
