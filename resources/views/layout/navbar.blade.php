{{-- navbar start--}}
<nav class="navbar navbar-expand-lg navbar-light bg-light sidebar">
    <div class="container-fluid">
  
      <div class="col-lg-3 col-sm-12">
        <a class="navbar-brand" href="#">
          <img src="https://www.iconfinder.com/static/img/favicons/favicon-32x32.png?87b2a5c3aa" alt="linkedinsvg" width="30" height="24" class="d-inline-block align-text-top" /> Social Page
        </a>
      </div>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
  
      <div class="col d-flex justify-content-around align-items-center">
        <a class="navbar-brand position-relative" href="#">
          <i class="fa-solid fa-envelope p-3 border rounded-circle">
            <span class="position-absolute badge bg-danger">11</span></i></a>
        <a class="navbar-brand" href="#">
          <i class="fa-solid fa-heart p-3 border rounded-circle">
            <span class="position-absolute badge bg-danger">10</span></i></a>
        <a class="navbar-brand" href="#">
          <i class="fa-solid fa-users p-3 border rounded-circle">
            <span class="position-absolute badge bg-danger">11</span></i></a>
        <a class="navbar-brand" href="#">
          <i class="fa-solid fa-user-plus p-3 border rounded-circle"></i></a>
  
      </div>
      <div class="col-lg-3 col-sm-12 d-flex justify-content-end">
        <form class="form-inline">
          <div class="input-group">
            @guest
              <a href="{{route('register')}}"><button type="button" style="margin-left: 30px" class="btn btn-primary submit-button">Register</button></a>
              <a href="{{route('login')}}"><button type="button" style="margin-left: 10px" class="btn btn-primary submit-button">Login</button></a>
            @endguest
            @auth
            <a href="{{route('logout')}}"><button type="button"  style="margin-left: 10px" class="btn btn-primary submit-button">Logout</button></a>
            @endauth
            {{-- <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
              @csrf
              @method('DELETE')
              <button type="submit" style="margin-left: 10px" class="btn btn-primary submit-button">{{ __('Logout') }}</button>
          </form> --}}
          </div>
        </form>
      </div>
    </div>
</nav>
  
  <!-- login modal -->
  <div class="modal fade" id="mymodal" data-backdrop="static">
    <div class="modal-dialog modal-dialog-scrollable">
      <div class="modal-content">
        
        <div class="modal-header">
          <h4 class="text-lg-center modal-title">Login</h4>
          <button type="button" class="close" data-bs-dismiss="modal"><span>&times;</span></button>
        </div>
        
        <div class="modal-body">
          <form>
            <div class="mb-1">
              <label for="recipient-name" class="col-form-label">Email:</label>
              <input type="text" class="form-control" id="recipient-name">
            </div>
            <div class="mb-1">
              <label for="message-text" class="col-form-label">Password:</label>
              <input type="password" class="form-control" id="recipient-pass">
            </div>
          </form>
        </div>
        
        <div class="modal-footer">
          <input type="submit" value="Close" class="btn btn-danger" data-bs-dismiss="modal" />
          <input type="submit" value="Save" class="btn btn-primary" />
        </div>
      </div>
    </div>
  </div>
  
  <!-- register modal -->
  <div class="modal fade" id="registermodal" data-backdrop="static">
    <div class="modal-dialog modal-dialog-scrollable">
      <div class="modal-content">
        
        <div class="modal-header">
          <h4 class="text-center modal-title background-color:red">Register</h4>
          <button type="button" class="close" data-bs-dismiss="modal"><span>&times;</span></button>
        </div>
        
        <div class="modal-body">
          <form action="#controller/register" method="POST" enctype="multipart/form-data">
            <div class="form-group">
              <label for="user_fname">First Name:</label>
              <input type="text" class="form-control" id="fname" name="fname">
            </div>
            <div class="form-group">
              <label for="username">Username:</label>
              <input type="text" class="form-control" id="username" name="username">
            </div>
            <div class="form-group">
              <label for="user_email">Email:</label>
              <input type="email" class="form-control" id="email" name="email">
            </div>
            <div class="form-group">
              <label for="user_password">Password:</label>
              <input type="password" class="form-control" id="password" name="passwrod">
            </div>
            <div class="form-group">
              <label>Gender:</label>
              <div class="form-check">
                <input class="form-check-input" type="radio" name="gender" id="male" value="male">
                <label class="form-check-label" for="male">
                  Male
                </label>
              </div>
              <div class="form-check">
                <input class="form-check-input" type="radio" name="gender" id="female" value="female">
                <label class="form-check-label" for="female">
                  Female
                </label>
              </div>
              <div class="form-check">
                <input class="form-check-input" type="radio" name="gender" id="other" value="other">
                <label class="form-check-label" for="other">
                  Other
                </label>
              </div>
            </div>
            <div class="form-group">
              <label for="user_profile">Profile:</label>
              <input type="file" class="form-control-file" id="profile" name="profile">
            </div>
          </form>
        </div>
        
        <div class="modal-footer">
          <input type="submit" value="Close" class="btn btn-danger" data-bs-dismiss="modal" />
          <button type="submit" class="btn btn-success">Registerion</button>
        </div>
      </div>
    </div>
  </div>
  {{-- navbar end --}}
  