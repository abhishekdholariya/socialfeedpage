<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    public function show(){
        $user_id=Auth::id();
        $notifications = Notification::with('user','post')->whereHas('post',function($query) use ($user_id){
            $query->where('user_id',$user_id);
        })
        ->where('type','like')
        ->orderBy('created_at','desc')
        ->get();
        // return $notifications;
        return view('layout.notification', compact('notifications'));
    }


}
