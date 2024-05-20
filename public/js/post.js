let modalElement = null;

$(function () {

    // get all post
    function fetchAllPosts() {
        $.ajax({
            url: allPost,
            type: "POST",
            data: {
                _token: $('meta[name="csrf-token"]').attr("content"),
                user_id: user_id,
            },
            success: function (res) {
                console.log(res);
                if (res.success) {
                    $.each(res.posts, function (index, post) {
                        var isLiked = post.likes.find(function (like) {
                            if (like.user_id == user_id) {
                                return true;
                            } else {
                                return false;
                            }
                        });
                        let likeClass = isLiked ? "fa-solid" : "fa-regular";

                        var newPostHtml = `
                    <div class="card gedf-card mb-2 posts">
                        <div class="card-header">
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="mr-2">
                                        <img class="rounded-circle" width="50" height="50" src="uploads/${post.user.profile}" alt="profile img" />
                                    </div>
                                    <div class="ml-2">
                                        <div class="h5 m-0">${post.user.fname}</div>
                                        <div class="h7 text-muted">${post.user.headline}</div>
                                    </div>
                                </div>
                                <div class="dropdown">
                                    <button class="btn btn-link" type="button" id="drop-dwon" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="fa fa-ellipsis-h"></i>
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenu2">`;

                                    if (post.user_id==user_id) {
                                        
                                    newPostHtml +=`
                                        <a href="#"><button class="dropdown-item edit-post" data-post_id="${post.id} type="button">Edit</button></a>
                                        <a href="#"><button class="dropdown-item delete-post" data-post_id="${post.id}" type="button">Delete</button></a>
                                    `;
                                    }
                                    else{
                                    newPostHtml+=`
                                        <a href="#"><button class="dropdown-item" type="button">Report</button></a>
                                    `;
                                }
                                newPostHtml+=`

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="text-muted h7 mb-2 d-flex justify-content-between">
                                <h5 class="card-title">${post.post_details}</h5>
                                <i class="fa fa-clock-o">${new Date(post.created_at).toLocaleString()}</i>
                            </div>
                            <p class="card-text">
                                <img src="postimg/${post.post_img}" style="height:300px" alt="post images" />
                            </p>
                        </div>
                        
                        <div class="card-footer">
                            <a href="#" class="card-link card-like" data-postid="${post.id}"><i class="${likeClass} fa-heart"></i></a>
                            <span class="like_count">${post.likes.length} </span>
                            <span>Likes</sapn>
                            <a href="#" class="card-link card-comment"  data-postid="${post.id}"><i class="fa-regular fa-comment"></i></a>
                            <span>Comments</sapn>
                        </div>`;
                        $(".all-posts").prepend(newPostHtml);
                    });
                } else {
                    alert("No response");
                }
            },
            error: function (xhr, status, error) {
                console.error(xhr.responseText);
            },
        });
    }

    // add post
    $("#postForm").submit(function (e) {
        e.preventDefault();
        if (user_id != 0) {
            var formData = new FormData(this);
            $.ajax({
                url: addPost,
                type: "POST",
                data: formData,
                processData: false,
                contentType: false,
                success: function (response) {
                    fetchAllPosts();
                },
                error: function (xhr, status, error) {
                    console.error(xhr.responseText);
                },
            });
        } else {
            alert("Please login to post");
        }
    });

    // like on post
    $(document).on("click", ".card-like", function (e) {
        e.preventDefault();
        if (user_id != 0) {
            var post_id = $(this).data("postid");
            $.ajax({
                url: likePost,
                type: "POST",
                data: {
                    post_id: post_id,
                    user_id: user_id,
                    _token: $('meta[name="csrf-token"]').attr("content"),
                },
                success: function (res) {
                    if (res.success) {
                        // total_post_like
                        var likeCount = $(`.card-link[data-postid=${post_id}]`).next(".like_count");
                        if (res.like) {
                            $(`.card-like[data-postid=${post_id}] i`)
                                .addClass("fa-solid")
                                .removeClass("fa-regular");
                        } else {
                            $(`.card-like[data-postid=${post_id}] i`)
                                .addClass("fa-regular")
                                .removeClass("fa-solid");
                        }
                        likeCount.text(res.total_post_like);
                    }
                },
                error: function (xhr, status, error) {
                    console.error(xhr.responseText);
                },
            });
        } else {
            alert("Please login to like post");
        }
    });

    // get comment
    $(document).on("click", ".card-comment", function (e) {
        e.preventDefault();
        var post_id = $(this).data("postid");
        $.ajax({
            url: getComments,
            type: "POST",
            data: {
                post_id: post_id,
                _token: $('meta[name="csrf-token"]').attr("content"),
            },
            success: function (res) {
                if (res.success) {
                    var commentHtml = `<!-- Comment Modal -->
                    <div class="modal fade" id="commentModel" tabindex="-1" role="dialog" aria-labelledby="commentModelLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="commentModelLabel">Comments</h5>
                                    <button type="button" class="close close_comment_model">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            
                                <div class="modal-body">
                                    <ul id="comment-history" class="list-group">

                                        <!-- Comments appended -->
                                    
                                    </ul>
                                <div class="form-group">
                                    <textarea id="comment-text" class="form-control" placeholder="Write your comment here..."></textarea>
                                </div>
                                </div>
                                    
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary close_comment_model" data-dismiss="modal">Close</button>
                                    <button type="button" class="btn btn-primary " id="addComment" data-postId="${post_id}">Submit</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    </div>`;

                    $("body").append(commentHtml);
                    $("#commentModel").modal("show");
                    modalElement = document.getElementById("commentModel");
                    modalElement.addEventListener("hide.bs.modal", function () {$("#commentModel").remove();});
                    $("#commentModel").modal({ keyboard: false });
                    $.each(res.comments, function (index, comment) {
                        var newComment = `<li class="list-group   list-group-item">
                        <div>
                            <div class="d-flex align-items-center">
                                <div class="mr-2">
                                    <img class="rounded-circle" width="45" height="45" src="uploads/${comment.user.profile}" alt="profile img" />
                                </div>
                                <div class="ml-2">
                                    <h6 class="fw-bold mb-1">${comment.user.fname}</h6>
                                    <small class="text-muted">${new Date(comment.created_at).toLocaleString()} </small>
                                </div>
                            </div>
                            <div class="mt-2 ml-5 pl-3">
                                <p class="text-muted">${comment.comment}</p>
                            </div>
                        </li>`;
                        $("#comment-history").append(newComment);
                    });
                }
            },
        });
    });

    // comment on post
    $(document).on("click", "#addComment", function (e) {
        e.preventDefault();
        if (user_id != 0) {
            var post_id = $(this).data("postid");
            var comment = $("#comment-text").val();
            $.ajax({
                url: commentPost,
                type: "POST",
                data: {
                    post_id: post_id,
                    comment: comment,
                    user_id: user_id,
                    _token: $('meta[name="csrf-token"]').attr("content"),
                },
                success: function (res) {
                    if (res.success) {
                        $("#comment-text").val("");
                        $("#comment-history").html("");
                        $.each(res.comments, function (index, comment) {
                            var newComment = `<li class="list-group   list-group-item">
                            <div>
                                <div class="d-flex align-items-center">
                                    <div class="mr-2">
                                        <img class="rounded-circle" width="45" height="45" src="uploads/${comment.user.profile}" alt="profile img" />
                                    </div>
                                    <div class="ml-2">
                                        <h6 class="fw-bold mb-1">${comment.user.fname}</h6>
                                        <small class="text-muted">${new Date(comment.created_at).toLocaleString()} </small>
                                    </div>
                                </div>
                                <div class="mt-2 ml-5 pl-3">
                                    <p class="text-muted">${comment.comment}</p>
                                </div>
                            </li>`;
                            $("#comment-history").append(newComment);
                        });
                        $("#comment-history").append(newComment);
                    }
                },
            });
        } else {
            alert("Please login to comment on post");
        }
    });

    $(document).on("click", ".close_comment_model", function (e) {
        e.preventDefault();
            $("#commentModel").modal("hide");
    });

    // delete post
    $(document).on("click", ".delete-post",function(e){
        e.preventDefault();
        var post_id=$(this).data("post_id");
        var postElement = $(this).closest('.posts');
        $.ajax({
            url: deletePost,
            type: "DELETE",
            data: {
                post_id: post_id,
                _token: $('meta[name="csrf-token"]').attr("content"),
            },
            success: function(res){
                if(res.success){
                    alert("successfully delete");
                    postElement.remove();
                }else{
                    alert("not delete post");
                }
            }
        })
    })
        
    // edit post
    $(document).on("click",".edit-post",function(e){
        e.preventDefault();
        var post_id=$(this).data("post_id");
        $.ajax({
            
        })
    })

    //function call on all post
    fetchAllPosts();

});



