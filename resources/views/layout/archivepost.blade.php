<!DOCTYPE html>
<html lang="en">
<head>
    @include('layout.header')
</head>
<body>
    @include('layout.navbar')
  <div class="container mt-5">
    <div class="row">
      <div class="col-12">
        <h1 class="mb-4">User Posts</h1>
      </div>
    </div>
    <div class="row">
      <!-- Post 1 -->
      <div class="col-12 mb-4">
        <div class="card">
          <div class="row no-gutters">
            <div class="col-md-4">
              <img src="https://via.placeholder.com/600x400" class="card-img" alt="Post Image">
            </div>
            <div class="col-md-8">
              <div class="card-body">
                <h5 class="card-title">Post Title 1</h5>
                <p class="card-text">This is a brief summary of the post content. It gives a quick overview of what the post is about.</p>
                <a href="#" class="btn btn-primary">Read More</a>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- Post 2 -->
      <div class="col-12 mb-4">
        <div class="card">
          <div class="row no-gutters">
            <div class="col-md-4">
              <img src="https://via.placeholder.com/600x400" class="card-img" alt="Post Image">
            </div>
            <div class="col-md-8">
              <div class="card-body">
                <h5 class="card-title">Post Title 2</h5>
                <p class="card-text">This is a brief summary of the post content. It gives a quick overview of what the post is about.</p>
                <a href="#" class="btn btn-primary">Read More</a>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- Post 3 -->
      <div class="col-12 mb-4">
        <div class="card">
          <div class="row no-gutters">
            <div class="col-md-4">
              <img src="https://via.placeholder.com/600x400" class="card-img" alt="Post Image">
            </div>
            <div class="col-md-8">
              <div class="card-body">
                <h5 class="card-title">Post Title 3</h5>
                <p class="card-text">This is a brief summary of the post content. It gives a quick overview of what the post is about.</p>
                <a href="#" class="btn btn-primary">Read More</a>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- Additional posts can be added in the same structure -->
    </div>
  </div>

  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
