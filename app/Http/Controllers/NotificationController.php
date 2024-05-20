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
        // Fetch notifications from the database
        $notifications = Notification::latest()->get(); // Assuming you have a Notification model

        // Prepare the data to be sent as JSON response
        $notificationData = [];
        foreach ($notifications as $notification) {
            $notificationData[] = [
                'user_id' => $notification->user_id, // Replace with actual title attribute of your notification
                'created_at' => $notification->created_at->diffForHumans(), // Format the timestamp as needed
                'type' => $notification->type, // Replace with actual message attribute of your notification
            ];
        }

        // Return the notification data as JSON response
        return response()->json(['notifications' => $notificationData]);
    }
}
