@extends('layout.masterlayout')

@section('title')
    Social Page
@endsection

@section('main')
    <div class="container-fluid gedf-wrapper">
        <div class="row">

            <!-- profile start -->
            @include('layout.profile')
            <!--  profile end -->

            <!-- main conitant -->
            <div class="col-md-6 gedf-main">
                <div class="card gedf-card mb-2">
                    <div class="card-header">
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="mr-2">
                                    @auth

                                        <img class="rounded-circle" width="45" height="45"
                                            src="uploads/{{ auth()->user()->profile }}" alt="profile pic" />
                                    @endauth
                                    @guest
                                        <img class="rounded-circle" width="45" height="45"
                                            src="{{ asset('images/default.jpeg') }}" alt="profile pic" />
                                    @endguest
                                </div>
                                <div class="ml-2">
                                    <div>
                                        <button type="button" class="btn btn-light btn-lg border custom"
                                            data-bs-toggle="modal" data-bs-target="#post_modal">Start a post</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <class="mb-1" hr />

                <!-- post start -->
                <div class="all-posts">

                </div>
                <!-- Post end -->

            </div>
            <div class="col-md-3">
                @include('layout.news')
                <hr />
                @include('layout.footer')
            </div>
        </div>
    </div>

    <!-- add post modal -->
    <div class="modal fade" id="post_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Post to Anyone</h5>
                    <button type="button" class="close" data-bs-dismiss="modal"><span>&times;</span></button>
                </div>
                <div class="modal-body">
                    <form action="" method="POST" id="postForm" enctype="multipart/form-data">
                        @csrf
                        <div class="card gedf-card mb-2">
                            <div class="card-body">
                                <div class="tab-content" id="myTabContent">
                                    <div class="tab-pane fade show active" id="posts">
                                        <div class="form-group">
                                            <label class="sr-only" for="message">Post</label>
                                            <textarea class="form-control" id="message" name="message" placeholder="What do you want to talk about?"></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div>
                                    <input type="file" name="img" id="img">
                                </div>
                    </form>
                    <div class="btn-toolbar justify-content-end">
                        <div class="btn-group">
                            <button type="submit" id="addpost" class="btn btn-success"
                                data-bs-dismiss="modal">Post</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<script>
    const allPost = "{{ route('allpost') }}";
    const addPost = "{{ route('addpost') }}";
    const user_id = "{{ auth()->id() ?? 0 }}";
    const likePost = "{{ route('likepost') }}";
    const commentPost = "{{ route('commentpost') }}";
    const getComments = "{{ route('getcomments') }}";
    const deletePost = "{{ route('deletepost') }}";
    const archivePost = "{{ route('archivepost') }}";
</script>

<script src="{{ asset('js/post.js') }}"></script>
