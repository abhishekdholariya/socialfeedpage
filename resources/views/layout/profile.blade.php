{{-- profile start --}}
<div class="col-md-3">
    @auth

        <div class="card">
            <div class="card-body" data-bs-toggle="modal" data-bs-target="#profilemodal">
                <div class="h5 text-center">My Profile</div>
                <div class="m-0">
                    <img class="rounded-circle user-img" width="70" height="60"
                        src="uploads/{{ auth()->user()->profile }}" alt="profile_img" id="profile-img" />
                </div>
                <div class="h7 font-weight-bold text-center">
                    UserName : <span id="profile-name">{{ auth()->user()->fname }}</span>
                </div>
                <div class="h7 font-weight-bold text-center">
                    {{ auth()->user()->headline }}
                </div>
                <div class="h7 font-weight-bold text-center">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">
                            <div class="h6 text-muted">Followers</div>
                            <div class="h5">523</div>
                        </li>
                        <li class="list-group-item">
                            <div class="h6 text-muted">City</div>
                            <div class="h5">Ahmedabad, Gujarat, India</div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    @endauth

    <div class="container mt-5">
        <h2 class="mb-4">Followers List</h2>
        
        <div class="list-group">
            <span class="list-group-item list-group-item-action d-flex align-items-center">
                <img src="https://via.placeholder.com/50" class="rounded-circle mr-3" alt="Profile Picture">
                <div class="flex-grow-1">
                    <h5 class="mb-1">Abhi</h5>
                    <p class="mb-1">web dewloper</p>
                </div>
                <button class="btn btn-primary">Follow</button>
            </span>
        </div>
        
    </div>
    
</div>

@auth

<!-- profile modal -->
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
                            <label for="user_password">Password:</label>
                            <input type="password" class="form-control" id="password" name="password"
                                value="{{ auth()->user()->password }}">
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
    </script>
@endauth
