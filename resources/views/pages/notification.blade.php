@extends('layout.masterlayout')

@section('title')
    Notification Page
@endsection

@section('main')
    <div class="container mt-5">
        <h2>Notifications</h2>
        <div class="list-group" id="notificationList">
            @forEach($notifications as $notification)
                    <div class="container">
                        <div class="list-group">
                            <span class="list-group-item list-group-item-action d-flex align-items-center">
                                <img class="rounded-circle mr-3 profile-img" width="50" height="50" src="postimg/{{$notification->post->post_img}}" alt="profile img">
                                <div class="flex-grow-1">
                                <h5 class="mb-1">Your Post {{$notification->type}} By {{$notification->user->fname}}</h5>
                            </span>
                        </div>
                        <h5 class="mb-1">{{$notification->created_at->diffForHumans()}}</h5>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
