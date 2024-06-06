<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use Exception;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class NotificationController extends Controller
{
    public function show(){
        try{
            $user_id=Auth::id();
            $notifications = Notification::with('user','post')->whereHas('post',function($query) use ($user_id){
            $query->where('user_id',$user_id);})
            ->where('type','like')
            ->orderBy('created_at','desc')
            ->get();
            return view('pages.notification', compact('notifications'));
        }catch (Exception $e) {
                Log::info('Show Notification');
                Log::info($e->getMessage());
                return response()->json(['success' => false]);
        }
}


}
