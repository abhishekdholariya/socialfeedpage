{{-- <!DOCTYPE html>
<html lang="en">

<head>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.5/css/materialize.min.css">
    <style>
        body {
            background: #fff;
        }

        .error {
            color: red;
            margin-top: 60px;
            font-size: 0.8rem;
        }

        .form-section {
            padding: 20px;
            box-sizing: border-box;
        }

        .input-field {
            margin-bottom: 0;
        }
    </style>
</head>

<body>
    <div class="container">
        <center>
        <div class="row">
            <div class="col-md-6">
                <div class="form-section">
                    <h5 class="indigo-text">Personal Information</h5>
                    <div class="z-depth-5 grey lighten-4 row"
                    style="display: inline-block; padding: 32px 48px 0px 48px; border: 1px solid #EEE;">
                    <form id="registrationForm" action="{{route('adduser')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class='row'>
                            <div class='input-field col s6'>
                                <label for='fname'>First Name</label>
                                <input type="text" class="validate" name="fname" value="{{ old('fname') }}" id="fname">
                                @if ($errors->has('fname'))
                                    <div class="error">{{ $errors->first('fname') }}</div>
                                @endif
                            </div>
                            <div class='input-field col s6'>
                                <input type="text" class="validate" name="lname" value="{{ old('lname') }}" id="lname">
                                <label for='lname'>Last Name</label>
                                @if ($errors->has('lname'))
                                    <div class="error">{{ $errors->first('lname') }}</div>
                                @endif
                            </div>
                        </div>
                        <div class='row'>
                            <div class='input-field col s6'>
                                <input type="text" class="validate" name="email" value="{{ old('email') }}" id="email">
                                <label for='email'>Email</label>
                                @if ($errors->has('email'))
                                    <div class="error">{{ $errors->first('email') }}</div>
                                @endif 
                            </div>
                            <div class='input-field col s6'>
                                <input type="password" class="validate" name="password" value="{{ old('password') }}" id="password">
                                <label for='password'>Password</label> 
                                @if ($errors->has('password'))
                                    <div class="error">{{ $errors->first('password') }}</div>
                                @endif                               
                            </div>
                        </div>
                        <div class="row">
                            <div class='input-field col s6'>
                                <input type="text" class="validate" name="headline" value="{{ old('headline') }}" id="headline">
                                <label for='headline'>Headline</label>
                                @if ($errors->has('headline'))
                                    <div class="error">{{ $errors->first('headline') }}</div>
                                @endif
                            </div>
                            <div class='file-field input-field col s6'>
                                <div class="btn">
                                    <span>Profile</span>
                                    <input type="file" name="profile" id="profile">
                                </div>
                                @if ($errors->has('profile'))
                                    <div class="error">{{ $errors->first('profile') }}</div>
                                @endif
                            </div>
                        </div>
                        <br>
                        <center>
                            <div class='row'>
                                <button type='submit' name='btn_login'
                                    class='col s12 btn btn-large waves-effect indigo btnRegister'>Register</button>
                            </div>
                        </center>
                    </form>
                    </div>
                </div>
                <a href="/login">Already have an account? Login</a>
            </div>
        </div>
    </center>
    </div>

    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.1/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.5/js/materialize.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.20.0/dist/jquery.validate.min.js"></script>
    
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
                errorPlacement: function (error, element) {
                    error.insertAfter(element);
                }
            });
        });
    </script>
</body>

</html> --}}


<!DOCTYPE html>
<html lang="en">
<head>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" type="text/css"
        href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.5/css/materialize.min.css">
    <style>
        body {
            background: #fff;
        }
        .error {
            color: red;
            font-size: 0.8rem;
        }
        .form-section {
            padding: 20px;
            box-sizing: border-box;
        }
    </style>
</head>
<body>
    <div class="container">
        <center>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-section">
                        <h5 class="indigo-text">Personal Information</h5>
                        <div class="z-depth-2 grey lighten-2 row"
                            style="display: inline-block; padding: 32px 48px 0px 48px; border: 1px solid #EEE;">
                            <form id="registrationForm" method="POST" action="{{route('adduser')}}"
                                enctype="multipart/form-data" style="width: 80%;">
                                @csrf
                                <div class='row'>
                                    <div class='input-field col s6'>
                                        <label for='fname'>First Name</label>
                                        <input type="text" class="validate" name="fname"
                                            value="{{ old('fname') }}" id="fname">
                                        @if ($errors->has('fname'))
                                            <div class="error">{{ $errors->first('fname') }}</div>
                                        @endif
                                    </div>
                                    <div class='input-field col s6'>
                                        <input type="text" class="validate" name="lname"
                                            value="{{ old('lname') }}" id="lname">
                                        <label for='lname'>Last Name</label>
                                        @if ($errors->has('lname'))
                                            <div class="error" style="color: red;">{{ $errors->first('lname') }}</div>
                                        @endif
                                    </div>
                                </div>
                                <div class='row'>
                                    <div class='input-field col s6'>
                                        <input type="text" class="validate" name="email"
                                            value="{{ old('email') }}" id="email">
                                        <label for='email'>Email</label>
                                        @if ($errors->has('email'))
                                            <div class="error">{{ $errors->first('email') }}</div>
                                        @endif
                                    </div>
                                    <div class='input-field col s6'>
                                        <input type="password" class="validate" name="password"
                                            value="{{ old('password') }}" id="password">
                                        <label for='password'>Password</label>
                                        @if ($errors->has('password'))
                                            <div class="error">{{ $errors->first('password') }}</div>
                                        @endif
                                    </div>
                                </div>
                                <div class="row">
                                    <div class='input-field col s6'>
                                        <input type="text" class="validate" name="headline"
                                            value="{{ old('headline') }}" id="headline">
                                        <label for='headline'>Headline</label>
                                        @if ($errors->has('headline'))
                                            <div class="error">{{ $errors->first('headline') }}</div>
                                        @endif
                                    </div>
                                    <div class='input-field col s6'>
                                        <input type="file" name="profile" id="profile"> 
                                        @if ($errors->has('profile'))
                                            <div class="error">{{ $errors->first('profile') }}</div>
                                        @endif
                                    </div>
                                </div>
                                <br>
                                <center>
                                    <div class='row'>
                                        <button type='submit' name='btn_login'
                                            class='col s12 btn btn-large waves-effect indigo btnRegister'>Register</button>
                                    </div>
                                </center>
                            </form>
                        </div>
                    </div>
                    <a href="/login">Already have an account? Login</a>
                </div>
            </div>
        </center>
    </div>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.1/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.5/js/materialize.min.js">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.20.0/dist/jquery.validate.min.js"></script>
    <script>
        $(document).ready(function() {
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