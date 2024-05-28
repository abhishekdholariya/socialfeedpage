<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IndexController extends Controller
{
    public function show(){
        return view('index');
    }
// public function index(){
//     $friends = User::where('id','!=',Auth::id())->get();
//     return view('index',compact('friends'));
// }

public function index()
{
    // $friends = Auth::user()->follows;
    // $potentialFriends = User::where('id', '!=', Auth::id())
    //                         ->whereDoesntHave('followers', function ($query) {
    //                             $query->where('user_id', Auth::id());
    //                         })
    //                         ->get();

    // return view('index', compact('potentialFriends', 'friends'));
    if (!Auth::check()) {
        return redirect()->route('login')->with('error', 'You must be logged in to view this page.');
    }
    $user = Auth::user();

    $friends = $user->follows; 
    $potentialFriends = User::where('id', '!=', $user->id)
                            ->whereDoesntHave('followers', function ($query) use ($user) {
                                $query->where('user_id', $user->id);
                            })
                            ->get();
    return view('index', compact('potentialFriends', 'friends'));
}

public function follow(Request $request)
{
    $userToFollow = User::findOrFail($request->user_id);
    // Check if already following
    if (!Auth::user()->isFollowing($userToFollow)) {
        Auth::user()->follow($userToFollow);
    }
    return response()->json(['status' => 'success', 'message' => 'User followed successfully', 'user' => $userToFollow]);
}

public function unfollow(Request $request)
{
    $userToUnfollow = User::findOrFail($request->user_id);
    // Check if already following
    if (Auth::user()->isFollowing($userToUnfollow)) {
        Auth::user()->unfollow($userToUnfollow);
    }
    return response()->json(['status' => 'success', 'message' => 'User unfollowed successfully', 'user' => $userToUnfollow]);
}
}