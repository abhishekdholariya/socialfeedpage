<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IndexController extends Controller
{
// public function index(){
//     $friends = User::where('id','!=',Auth::id())->get();
//     return view('index',compact('friends'));
// }
// public function index()
//     {
//         $friends = User::where('id', '!=', Auth::id())
//                 ->whereDoesntHave('followers', function ($query) {
//                     $query->where('user_id', Auth::id());
//                 })
//                 ->get();

//         return view('index', compact('friends'));
//     }

public function index()
{
    $friends = Auth::user()->follows;
    $potentialFriends = User::where('id', '!=', Auth::id())
                            ->whereDoesntHave('followers', function ($query) {
                                $query->where('user_id', Auth::id());
                            })
                            ->get();

    return view('index', compact('potentialFriends', 'friends'));
}


// public function follow(Request $request)
//     {
//         $userToFollow = User::findOrFail($request->user_id);

//         Auth::user()->follow($userToFollow);

//         return response()->json(['status' => 'success', 'message' => 'User followed successfully', 'user' => $userToFollow]);
//     }

public function follow(Request $request)
{
    $userToFollow = User::findOrFail($request->user_id);

    // Check if already following to prevent duplicate follows
    if (!Auth::user()->isFollowing($userToFollow)) {
        Auth::user()->follow($userToFollow);
    }

    return response()->json(['status' => 'success', 'message' => 'User followed successfully', 'user' => $userToFollow]);
}
}