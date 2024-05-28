{{-- profile start --}}
<div class="col-md-3">
    @auth
        <div class="card">
            <div class="card-body">
                <div class="h5 text-center">My Profile</div>
                <center>
                <div class="m-0">
                    @if(auth()->user()->google_id)
                    <img class="rounded-circle user-img" width="70" height="70"
                        src="{{ auth()->user()->profile }}" alt="profile_img" id="profile-img" />
                    @else
                    <img class="rounded-circle user-img" width="70" height="70"
                        src="uploads/{{ auth()->user()->profile }}" alt="profile_img" id="profile-img" />
                    @endif
                    </div>
                </center>
                <div class="h7 font-weight-bold text-center">
                    UserName : <span id="profile-name">{{ auth()->user()->fname }} {{ auth()->user()->lname }}</span>
                </div>
                <div class="h7 font-weight-bold text-center">
                    Email : {{ auth()->user()->email }}
                </div>
                <div class="h7 font-weight-bold text-center">
                    Headline : {{ auth()->user()->headline }}
                </div>
                <div class="h7 font-weight-bold text-center">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">
                            <div class="h6 text-muted">Followers</div>
                            <div class="h5">523</div>
                        </li>
                        <li class="list-group-item">
                            <div class="h6 text-muted"><button class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#profilemodal">Edit Profile</button></div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    @endauth
    
    @php
    function profileImg($profile) {
        return Str::startsWith($profile, ['http://', 'https://']) ? $profile : asset('uploads/' . $profile);
    }
    @endphp
    <!-- Followers List -->
    <div class="container mt-5">
        <h2 class="mb-4">Followers List</h2>
        <div class="list-group" id="followersList">
            @foreach ($potentialFriends as $friend)
            <span class="list-group-item list-group-item-action d-flex align-items-center">
                <img class="rounded-circle mr-3 profile-img" width="50" height="50" src="{{ profileImg($friend->profile) }}" alt="profile img">
                <div class="flex-grow-1">
                    <h5 class="mb-1">{{$friend->fname}}</h5>
                    <p class="mb-1">{{$friend->headline}}</p>
                </div>
                <button class="btn btn-primary follow-btn" data-id="{{$friend->id}}">Follow</button>
            </span>
            @endforeach
        </div>
    </div>

@auth
    <div class="container mt-5">
        <h2 class="mb-4">Friends List</h2>
        <div class="list-group" id="friendsList">
            @foreach ($friends as $friend)
            <span class="list-group-item list-group-item-action d-flex align-items-center">
                <img class="rounded-circle mr-3 profile-img" width="50" height="50" src="{{ profileImg($friend->profile) }}" alt="profile img">
                <div class="flex-grow-1">
                    <h5 class="mb-1">{{$friend->fname}}</h5>
                    <p class="mb-1">{{$friend->headline}}</p>
                </div>
                <button class="btn btn-primary unfollow-btn" data-id="{{$friend->id}}">Unfollow</button>
            </span>
            @endforeach
        </div>
    </div>
@endauth 

</div>

@auth

{{-- profile modal --}}
<div class="modal fade" id="profilemodal" data-backdrop="static">
    <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="text-lg-center modal-title">Profile</h4>
                <button type="button" class="close" data-bs-dismiss="modal"><span>&times;</span></button>
                </div>
                <div class="modal-body">
                    <form action="" id="profileForm" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="user_fname">First Name:</label>
                            <input type="text" class="form-control" id="fname" name="fname"
                                value="{{ auth()->user()->fname }}">
                        </div>
                        <div class="form-group">
                            <label for="username">Last Name:</label>
                            <input type="text" class="form-control" id="username" name="username"
                                value="{{ auth()->user()->lname }}">
                        </div>
                        <div class="form-group">
                            <label for="user_email">Email:</label>
                            <input type="email" class="form-control" id="email" name="email"
                                value="{{ auth()->user()->email }}">
                        </div>
                        <div class="form-group">
                            <label for="user_profile">Profile:</label>
                            <input type="file" class="form-control-file" id="profile" name="profile"
                                value="{{ auth()->user()->profile }}">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <input type="button" value="Close" class="btn btn-danger" data-bs-dismiss="modal" />
                    <button type="button" id="saveProfile" class="btn btn-success" data-bs-dismiss="modal">Save</button>
                </div>
            </div>
        </div>
    </div>
{{-- profile end --}}
@endauth

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
@auth
    <script>
        // profile update
        $(document).ready(function() {
            $('#saveProfile').click(function(e) {
                e.preventDefault();
                var formData = new FormData($('#profileForm')[0]);
                var userid = {{ auth()->user()->id }};
                $.ajax({
                    url: '/profileupdate/' + userid,
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        window.location.reload();
                    },
                    error: function(xhr, status, error) {
                        console.error(xhr.responseText);
                        alert('An error updating the profile');
                    }
                });
            });
        });

        document.addEventListener('DOMContentLoaded', function() {
            // follow
            $('.follow-btn').on('click', function() {
                const userId = $(this).data('id');
                const button = $(this);
                    $.ajax({
                    url: '{{ route("follow") }}',
                    type: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        user_id: userId
                    },
                    success: function(response) {
                        console.log('Follow response:', response);
                        if (response.status === 'success') {
                            // Remove the user from the followers list
                            button.closest('.list-group-item').remove();

                            // Add the user to the friends list
                            let profileImgSrc = response.user.profile.startsWith('http') ? response.user.profile : `uploads/${response.user.profile}`;
                            const friendItem = $('<span class="list-group-item list-group-item-action d-flex align-items-center"></span>');
                            friendItem.append('<img class="rounded-circle mr-3 profile-img" width="50" height="50" src="profileImgSr" alt="profile img">');
                            friendItem.append('<div class="flex-grow-1"><h5 class="mb-1">' + response.user.fname + '</h5><p class="mb-1">' + response.user.headline + '</p></div>');
                            friendItem.append('<button class="btn btn-primary unfollow-btn" data-id="' + response.user.id + '">Unfollow</button>')
                            $('#friendsList').append(friendItem);
                        } else {
                            alert(response.message);
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error('Follow error:', status, error);
                        alert('An error occurred while following the user.');
                    }
                });
            });

            //unfollow
            $('.unfollow-btn').on("click",function(){
                const userId = $(this).data('id');
                const button = $(this);
                console.log('Follow button clicked for user ID:', userId);
                $.ajax({
                    url: '{{ route("unfollow") }}',
                    type: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        user_id: userId
                    },
                    success: function(response) {
                        console.log('Follow response:', response);
                        if (response.status === 'success') {
                            button.closest('.list-group-item').remove();
                            // Add the user to the friends list
                            const followers = $('<span class="list-group-item list-group-item-action d-flex align-items-center"></span>');
                            followers.append('<img class="rounded-circle mr-3 profile-img" width="50" height="50" src="uploads/' + response.user.profile + '" alt="profile img">');
                            followers.append('<div class="flex-grow-1"><h5 class="mb-1">' + response.user.fname + '</h5><p class="mb-1">' + response.user.headline + '</p></div>');
                            friendItem.append('<button class="btn btn-primary follow-btn" data-id="' + response.user.id + '">Follow</button>')
                            $('#followersList').append(followers);
                        } else {
                            alert(response.message);
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error('Follow error:', status, error);
                        alert('An error occurred while following the user.');
                    }
                });
            })
});

    </script>
@endauth
