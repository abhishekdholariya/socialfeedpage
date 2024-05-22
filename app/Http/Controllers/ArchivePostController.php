<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ArchivePostController extends Controller
{
    public function show(){
       $user_id=Auth::id();
        $posts=Post::with('user')->where('user_id',$user_id)->orderBy('created_at','desc')->get();
        return view('layout.archivepost', compact('posts'));
    }
}
