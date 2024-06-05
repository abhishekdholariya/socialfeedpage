<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserCollection;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller 
{

    public function show($id)
    {
        $user = User::findOrFail($id);
        return new UserResource($user);
    }

    public function index()
    {
        $users = USer::paginate();
        return new UserCollection($users);
    }
}
