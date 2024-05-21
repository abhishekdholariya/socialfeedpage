<!DOCTYPE html>
<html lang="en">
<head>
    @section('title')
    Login Form
    @endsection
    
    @include('layout.header')
</head>

<body>
    
    <div class="container register">
        <div class="row">
            <div class="col-md-3 register-left d-flex align-items-center">
                <h3>Welcome Back</h3>
            </div>
            <div class="col-md-9 register-right">
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                        <h3 class="register-heading">Login Form</h3>
                        <form id="loginForm" action="" method="POST">
                            @csrf
                            <div class="row register-form d-flex justify-content-center">
                                <div class="col-8">
                                    <div class="form-group">
                                        <input type="text" class="form-control" placeholder="Your Email *" name="email">
                                    </div>
                                    <div class="form-group">
                                        <input type="password" class="form-control" placeholder="Password *" name="password">
                                    </div>
                                    <div class="form-group d-flex justify-content-between">
                                        <div>
                                            <h6>New to Social page? <a href="/register">Join Now</a></h6>
                                        </div>
                                        <div>
                                            <h6><a href="">Forgot Password?</a></h6>
                                        </div>
                                    </div>
                                </div>
                                <input type="submit" class="btnRegister" value="Login" />
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function () {
            $('#loginForm').validate({
                rules: {
                    email: {
                        required: true,
                        email: true
                    },
                    password: {
                        required: true,
                        minlength: 6
                    }
                },
                messages: {
                    email: {
                        required: "Please enter your email",
                        email: "Please enter a valid email address"
                    },
                    password: {
                        required: "Please enter your password",
                        minlength: "Your password must be at least 6 characters long"
                    }
                },
                errorElement: 'div',
                errorPlacement: function(error, element) {
                    error.addClass('invalid-feedback');
                    error.insertAfter(element);
                },
                highlight: function(element, errorClass, validClass) {
                    $(element).addClass('is-invalid').removeClass('is-valid');
                },
                unhighlight: function(element, errorClass, validClass) {
                    $(element).removeClass('is-invalid').addClass('is-valid');
                }
            });
        });
    </script>
</body>
</html>