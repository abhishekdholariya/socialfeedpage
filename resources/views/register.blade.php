<!DOCTYPE html>
<html lang="en">
<head>
    @section('title')
    Registration Form
    @endsection

    @include('layout.header')
</head>
<body>
    <div class="container register">
        <div class="row">
            <div class="col-md-3 register-left">
                <h3 class="mt-5">Welcome</h3>
                <h3>Registration Form</h3><br><br>
                <a href="/login"><input type="submit" name="" value="Login" /></a><br/>
            </div>
            <div class="col-md-9 register-right">
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                        <h3 class="register-heading">Enter Your Information</h3>
                        <form id="registrationForm" action="{{route('adduser')}}" method="POST" enctype="multipart/form-data">
                            @csrf
                        <div class="row register-form">
                            <div class="col-md-6">
                                    <div class="form-group">
                                        <input type="text" class="form-control" placeholder="First Name *" name="fname" id="fname">
                                    </div>
                                    <div class="form-group">
                                        <input type="text" class="form-control" placeholder="Last Name *" name="lname" id="lname">
                                    </div>
                                    <div class="form-group">
                                        <input type="email" class="form-control" placeholder="Your Email *" name="email" id="email">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    
                                    <div class="form-group">
                                        <input type="password" class="form-control" placeholder="Password *" name="password" id="password">
                                    </div>
                                    <div class="form-group">
                                        <input type="text" class="form-control" placeholder="headline *" name="headline" id="headline">
                                    </div>
                                    <div class="form-group">
                                        <label for="profile">Profile:</label>
                                        <input type="file" class="form-control-file" id="profile" name="profile">
                                    </div>
                                    <input type="submit" class="btnRegister" value="Register" />
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function () {
            $('#registrationForm').validate({
                rules: {
                    fname: {
                        required: true
                    },
                    lname: {
                        required: true
                    },
                    password: {
                        required: true
                    },
                    email: {
                        required: true,
                        email: true
                    },
                    headline: {
                        required: true
                    },
                    profile: {
                        required: true,
                        accept: "image/*"
                    }
                },
                messages: {
                    fname: "Please enter your first name",
                    lname: "Please enter your last name",
                    password: "Please enter a password",
                    email: {
                        required: "Please enter your email",
                        email: "Please enter a valid email address"
                    },
                    headline: "Please enter a headline",
                    profile: {
                        required: "Please select a profile picture",
                        accept: "Please select a valid image file (jpg, jpeg, png, gif)"
                    }
                },
            });
        });
    </script>
</body>
</html>
