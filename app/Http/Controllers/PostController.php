<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Eloquent\Casts\Json;
use Illuminate\Http\Request;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class PostController extends Controller
{
    public function show(){
        try{
            $posts = Post::with('user','likes')->withCount('comments')->get();
            return response()->json(['success' => true, 'posts' => $posts]);
        }
        catch (Exception $e) {
            Log::info('Post store');
            Log::info($e->getMessage());
            return response()->json(['success' => false]);
        }
    }

    public function addpost(Request $request) {
        try {
            $request->validate([
                'message'=>'required',
                'img'=>'required|image'
            ]);
    
            $profile = $request->file('img');
            $profileName = time() . '.' . $profile->getClientOriginalExtension();
            $profile->move(public_path('postimg'), $profileName);   
            
            $post = new Post;
            $post->post_details = $request->message;
            $post->post_img = $profileName;
            $post->user_id = auth()->user()->id;
            $post->save();
    
            return response()->json(['success' => true, 'post' => $post]);

        } catch (Exception $e) {
            Log::info('Post store');
            Log::info($e->getMessage());
            return response()->json(['success' => false]);
        }
    }
    
    // like on post
    public function likepost(Request $request){
        try {
            $post_id = $request->post_id;
            $user_id = $request->user_id;
            $like = Post::find($post_id)->likes()->where('user_id',$user_id)->first();
            if($like){
                $like->delete();
                $total_post_like = Post::find($post_id)->likes()->count();
                return response()->json(['success' => true, 'like' => false, 'total_post_like' => $total_post_like]);
            }else{
                Post::find($post_id)->likes()->create(['user_id'=>$user_id]);
                $total_post_like = Post::find($post_id)->likes()->count();
                // Get the post owner
                $post = Post::findOrFail($post_id);
                $postOwner = $post->user;
                // Create a notification for the post owner
                Notification::create([
                    'user_id' => $postOwner->id,
                    'post_id' => $post_id,
                    'type' => 'like'
                ]);
                return response()->json(['success' => true, 'like' => true, 'total_post_like' => $total_post_like]);
            }
        } catch (Exception $e) {
            Log::info('Post like');
            Log::info($e->getMessage());
            return response()->json(['success' => false]);
        }
    }

    // comment on post
    public function commentpost(Request $request){
        try {
            $post_id = $request->post_id;
            $user_id = $request->user_id;
            $comment = $request->comment;
            $comment_data = Post::find($post_id)->comments()->create(['user_id'=>$user_id,'comment'=>$comment]);

            $comments = Post::find($post_id)->comments()->with('user')->get();
            return response()->json(['success' => true, 'comments' => $comments]);
        } catch (Exception $e) {
            Log::info('Post comment');
            Log::info($e->getMessage());
            return response()->json(['success' => false]);
        }
    }

    // getcomments
    public function getcomments(Request $request){
        try {
            $post_id = $request->post_id;
            $comments = Post::find($post_id)->comments()->with('user')->get();
            return response()->json(['success' => true, 'comments' => $comments]);
        } catch (Exception $e) {
            Log::info('Post getcomments');
            Log::info($e->getMessage());
            return response()->json(['success' => false]);
        }
    }

    //delete post
    public function deletePost(Request $request){
        try {
            $post_id = $request->post_id;
            $post = Post::findOrFail($post_id);
            $post->delete(); 
            return response()->json(['success' => true]);
        } catch (Exception $e) {
            Log::info('Post delete');
            Log::info($e->getMessage());
            return response()->json(['success' => false]);
        }
    }
}


