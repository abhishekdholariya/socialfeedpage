@extends('layout.masterlayout')

@section('title')
    Archive Page
@endsection

@section('main')
<div class="row">
      <div class="container">
        <div class="row mt-5">
            <div class="col-12 text-center">
                <h1>User Post</h1>
            </div>
        </div>
        <div class="row">
        @forEach($posts as $post)
            <div class="col-lg-4 col-md-6 gallery-item">
                <div class="card mt-4">
                    <img src="postimg/{{$post->post_img}}" class="card-img-top" alt="Post 1">
                    <div class="card-body">
                        {{-- <p class="card-text">{{$post->post_details}}</p> --}}
                        <div class="dropdown">
                            <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                Actions
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                <li>
                                    <a class="dropdown-item delete-post" data-post_id="{{ $post->id }}" href="#">Delete</a>
                                    <a href="#"><button class="dropdown-item delete-post" data-post_id="{{$post->id}}" type="button">Delete</button></a>
                                </li>
                                <li>
                                    @if($post->archive)
                                    <a href="#"><button class="dropdown-item unarchive-post" data-post_id="{{$post->id}}" type="button">UnArchive</button></a>
                                    @else
                                    <a href="#"><button class="dropdown-item archive-post" data-post_id="{{$post->id}}" type="button">Archive</button></a>
                                    @endif
                                </li>
                            </ul>
                        </div>  
                    </div>
                </div>
            </div>
        @endforeach
    </div>
      </div>
    </div>
@endsection
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
    const deletePost = "{{ route('deletepost') }}";
    const unarchivepost="{{ route('unarchivepost') }}";
    const archivePost = "{{route('archivepost')}}";
    </script>
    <script src="{{ asset('js/post.js') }}"></script>

