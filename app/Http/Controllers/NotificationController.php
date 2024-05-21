<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use App\Models\Post;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function show(){
        return view('layout.notification');
    }

    public function likenotify(Request $request){
        $notifications = Notification::with(['user', 'post.user'])->latest()->get();

        $notificationData = $notifications->map(function ($notification) {
            return [
                'post' => $notification->post->post_img,
                'post_user_name' => $notification->post->user->fname, 
                'post_user_profile' => $notification->post->user->profile,
                'user_name' => $notification->user->fname,
                'user_profile' => $notification->user->profile,
                'created_at' => $notification->created_at->diffForHumans(),
                'type' => $notification->type,
            ];
        });

    return response()->json(['notifications' => $notificationData]);
    }
}
