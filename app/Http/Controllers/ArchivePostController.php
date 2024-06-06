<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Exception;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class ArchivePostController extends Controller
{
    public function show(){
        try{
            $user_id=Auth::id();
            $posts=Post::with('user')->where('user_id',$user_id)->orderBy('created_at','desc')->get();
            return view('pages.archivepost', compact('posts'));
        }catch (Exception $e) {
            Log::info('Archive post');
            Log::info($e->getMessage());
            return response()->json(['success' => false]);
        }
    }
}
