<!DOCTYPE html>
<html lang="en">

<head>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" type="text/css"
        href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.5/css/materialize.min.css">
    <link rel="stylesheet" href="{{url('css/changepassword.css')}}" />
</head>

<body>
    <div class="section"></div>
    <main>
        <center>
            <div class="section"></div>
            <h5 class="indigo-text">Reset Password your account</h5>
            <div class="section"></div>
            <div class="container">
                <div class="z-depth-2 grey lighten-2 row" style="display: inline-block; padding: 32px 48px 0px 48px; border: 1px solid #EEE;">
                    <form id="loginForm" action="{{ route('resetpasswordpost') }}" method="POST">
                        @csrf
                        <input type="hidden" name="token" value="{{ $token }}">
                        <div class='row'>
                            <div class='input-field col s12'>
                                <input type="text" class="validate" name="email" id='email' value="{{ old('email') }}">
                                @if ($errors->has('email'))
                                    <div class="error">{{ $errors->first('email') }}</div>
                                @endif
                                <label for='email'>Enter your email</label>
                            </div>
                        </div>
                        <div class='row'>
                            <div class='input-field col s12'>
                                <input type="password" class="validate" name="newpassword" id='newpassword'>
                                @if ($errors->has('newpassword'))
                                    <div class="error">{{ $errors->first('newpassword') }}</div>
                                @endif
                                <label for='newpassword'>Enter new password</label>
                            </div>
                        </div>
                        <div class='row'>
                            <div class='input-field col s12'>
                                <input type="password" class="validate" name="newpassword_confirmation" id='newpassword_confirmation'>
                                @if ($errors->has('newpassword_confirmation'))
                                    <div class="error">{{ $errors->first('newpassword_confirmation') }}</div>
                                @endif
                                <label for='newpassword_confirmation'>Confirm new password</label>
                            </div>
                        </div>
                        <br />
                        <center>
                            <div class='row'>
                                <button type='submit' name='btn_login' class='col s12 btn btn-large waves-effect indigo btnRegister'>Submit</button>
                            </div>
                        </center>
                    </form>
                </div>
            </div>
        </center>
        
    </main>

    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.1/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.5/js/materialize.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.20.0/dist/jquery.validate.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#loginForm').validate({
                rules: {
                    email: {
                        required: true,
                        email: true
                    },
                    newpassword: {
                        required: true,
                        minlength: 6
                    },
                    conpassword:{
                        required:true,
                        minlength:6
                    }
                },
                messages: {
                    email: {
                        required: "Please enter your email",
                        email: "Please enter a valid email address"
                    },
                    newpassword: {
                        required: "Please enter your password",
                        minlength: "must be at least 6 characters"
                    },
                    conpassword : {
                        required: "Please enter your confirm password",
                        minlength: "must be at least 6 characters"
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
