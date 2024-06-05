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
                        let profileImgSrc = post.user.profile.startsWith('http') ? post.user.profile : `uploads/${post.user.profile}`;
                        
                        var newPostHtml = `
                    <div class="card gedf-card mb-2 posts">
                        <div class="card-header">
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="mr-2">
                                        <img class="rounded-circle" width="50" height="50" src="${profileImgSrc}" alt="profile img" />
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

                        if (post.user_id == user_id) {
                            newPostHtml += `
                                    <a href="#"><button class="dropdown-item delete-post" data-post_id="${post.id}" type="button">Delete</button></a>
                                    <a href="#"><button class="dropdown-item archive-post" data-post_id="${post.id}" type="button">Archive</button></a>
                                `;
                        } else {
                            newPostHtml += `
                                    <a href="#"><button class="dropdown-item" type="button">Report</button></a>
                                `;
                        }
                        newPostHtml += `
                                </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="text-muted h7 mb-2 d-flex justify-content-between">
                                <h5 class="card-title">${post.post_details}</h5>
                                <i class="fa fa-clock-o">${new Date(
                                    post.created_at
                                ).toLocaleString()}</i>
                            </div>
                            <p class="card-img m-auto">
                                <img src="postimg/${
                                    post.post_img
                                }" height="350px" width="100%" style="object-fit:cover" alt="post images" />
                            </p>
                        </div>
                        
                        <div class="card-footer">
                            <a href="#" class="card-link card-like" data-postid="${
                                post.id
                            }"><i class="${likeClass} fa-heart"></i></a>
                            <span class="like_count">${
                                post.likes.length
                            } </span>
                            <span>Likes</sapn>
                            <a href="#" class="card-link card-comment"  data-postid="${
                                post.id
                            }"><i class="fa-regular fa-comment"></i></a>
                            <span>Comments</sapn>
                        </div>`;
                        $(".all-posts").prepend(newPostHtml);
                        $("#postForm")[0].reset();
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
                        var likeCount = $(
                            `.card-link[data-postid=${post_id}]`
                        ).next(".like_count");
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
    // $(document).on("click", ".card-comment", function (e) {
    //     e.preventDefault();
    //     var post_id = $(this).data("postid");
    //     $.ajax({
    //         url: getComments,
    //         type: "POST",
    //         data: {
    //             post_id: post_id,
    //             _token: $('meta[name="csrf-token"]').attr("content"),
    //         },
    //         success: function (res) {
    //             if (res.success) {
    //                 var commentHtml = `
    //                 <!-- Comment Modal -->
    //                 <div class="modal fade" id="commentModel" tabindex="-1" role="dialog" aria-labelledby="commentModelLabel" aria-hidden="true">
    //                     <div class="modal-dialog" role="document">
    //                         <div class="modal-content">
    //                             <div class="modal-header">
    //                                 <h5 class="modal-title" id="commentModelLabel">Comments</h5>
    //                                 <button type="button" class="close close_comment_model">
    //                                     <span aria-hidden="true">&times;</span>
    //                                 </button>
    //                             </div>

    //                             <div class="modal-body">
    //                                 <ul id="comment-history" class="list-group">

    //                                     <!-- Comments appended -->

    //                                 </ul>
    //                             <div class="form-group">
    //                                 <textarea id="comment-text" class="form-control" placeholder="Write your comment here..."></textarea>
    //                             </div>
    //                             </div>

    //                             <div class="modal-footer">
    //                                 <button type="button" class="btn btn-secondary close_comment_model" data-dismiss="modal">Close</button>
    //                                 <button type="button" class="btn btn-primary " id="addComment" data-postId="${post_id}">Submit</button>
    //                             </div>
    //                         </div>
    //                     </div>
    //                 </div>
    //                 </div>`;

    //                 $("body").append(commentHtml);
    //                 $("#commentModel").modal("show");
    //                 modalElement = document.getElementById("commentModel");
    //                 modalElement.addEventListener("hide.bs.modal", function () {$("#commentModel").remove();});
    //                 $("#commentModel").modal({ keyboard: false });
    //                 $.each(res.comments, function (index, comment) {
    //                     var newComment = `<li class="list-group   list-group-item">
    //                     <div>
    //                         <div class="d-flex align-items-center">
    //                             <div class="mr-2">
    //                                 <img class="rounded-circle" width="45" height="45" src="uploads/${comment.user.profile}" alt="profile img" />
    //                             </div>
    //                             <div class="ml-2">
    //                                 <h6 class="fw-bold mb-1">${comment.user.fname}</h6>
    //                                 <small class="text-muted">${new Date(comment.created_at).toLocaleString()} </small>
    //                             </div>
    //                         </div>
    //                         <div class="mt-2 ml-5 pl-3">
    //                             <p class="text-muted">${comment.comment}</p>
    //                         </div>
    //                     </li>`;
    //                     $("#comment-history").append(newComment);
    //                 });
    //             }
    //         },
    //     });
    // });

    // comment reply add
    $(document).on("click", ".card-comment", function (e) {
        e.preventDefault();
        var post_id = $(this).data("postid");
        $.ajax({
            url: "/get-comments",
            type: "POST",
            data: {
                post_id: post_id,
                _token: $('meta[name="csrf-token"]').attr("content"),
            },
            success: function (res) {
                if (res.success) {
                    var commentHtml = `
                    <!-- Comment Modal -->
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
                    </div>`;
                    $("body").append(commentHtml);
                    $("#commentModel").modal("show");
                    modalElement = document.getElementById("commentModel");
                    modalElement.addEventListener("hide.bs.modal", function () {
                        $("#commentModel").remove();
                    });
                    $("#commentModel").modal({ keyboard: false });
                    $.each(res.comments, function (index, comment) {
                        var newComment = `
                        <li class="list-group-item">
                            <div>
                                <div class="d-flex align-items-center">
                                    <div class="mr-2">
                                        <img class="rounded-circle" width="45" height="45" src="uploads/${
                                            comment.user.profile
                                        }" alt="profile img" />
                                    </div>
                                    <div class="ml-2">
                                        <h6 class="fw-bold mb-1">${
                                            comment.user.fname
                                        }</h6>
                                        <small class="text-muted">${new Date(
                                            comment.created_at
                                        ).toLocaleString()}</small>
                                    </div>
                                </div>
                                <div class="mt-2 ml-5 pl-3">
                                    <p class="text-muted">${comment.comment}</p>
                                    <button class="btn btn-sm btn-link reply-btn" data-comment-id="${
                                        comment.id
                                    }">Reply</button>
                                    <div class="reply-section" id="reply-section-${
                                        comment.id
                                    }" style="display: none;">
                                        <textarea class="form-control reply-text" placeholder="Write your reply here..."></textarea>
                                        <button class="btn btn-primary btn-sm submit-reply-btn" data-post-id="${post_id}" data-parent-id="${
                            comment.id
                        }">Submit Reply</button>
                                    </div>
                                    <ul class="list-group reply-list" id="reply-list-${
                                        comment.id
                                    }">
                                        ${comment.replies
                                            .map(
                                                (reply) => `
                                        <li class="list-group-item">
                                            <div class="d-flex align-items-center">
                                                <div class="mr-2">
                                                    <img class="rounded-circle" width="35" height="35" src="uploads/${
                                                        reply.user.profile
                                                    }" alt="profile img" />
                                                </div>
                                                <div class="ml-2">
                                                    <h6 class="fw-bold mb-1">${
                                                        reply.user.fname
                                                    }</h6>
                                                    <small class="text-muted">${new Date(
                                                        reply.created_at
                                                    ).toLocaleString()}</small>
                                                </div>
                                            </div>
                                            <div class="mt-2 ml-5 pl-3">
                                                <p class="text-muted">${
                                                    reply.comment
                                                }</p>
                                            </div>
                                        </li>`
                                            )
                                            .join("")}
                                    </ul>
                                </div>
                            </div>
                        </li>`;
                        $("#comment-history").append(newComment);
                    });
                }
            },
        });
    });

    $(document).on("click", ".reply-btn", function () {
        var commentId = $(this).data("comment-id");
        $("#reply-section-" + commentId).toggle();
    });

    $(document).on("click", ".submit-reply-btn", function () {
        var postId = $(this).data("post-id");
        var parentId = $(this).data("parent-id");
        var replyText = $("#reply-section-" + parentId)
            .find(".reply-text")
            .val();
        if (replyText) {
            $.ajax({
                url: "/submit-reply",
                type: "POST",
                data: {
                    post_id: postId,
                    parent_id: parentId,
                    comment: replyText,
                    _token: $('meta[name="csrf-token"]').attr("content"),
                },
                success: function (res) {
                    console.log(res);
                    if (res.success) {
                        var newReply = `
                        <li class="list-group-item">
                            <div class="d-flex align-items-center">
                                <div class="mr-2">
                                    <img class="rounded-circle" width="35" height="35" src="uploads/${
                                        res.comment.user.profile
                                    }" alt="profile img" />
                                </div>
                                <div class="ml-2">
                                    <h6 class="fw-bold mb-1">${
                                        res.comment.user.fname
                                    }</h6>
                                    <small class="text-muted">${new Date(
                                        res.comment.created_at
                                    ).toLocaleString()}</small>
                                </div>
                            </div>
                            <div class="mt-2 ml-5 pl-3">
                                <p class="text-muted">${res.comment.comment}</p>
                            </div>
                        </li>`;
                        $("#reply-list-" + parentId).append(newReply);
                        $("#reply-section-" + parentId)
                            .find(".reply-text")
                            .val("");
                        $("#reply-section-" + parentId).hide();
                    }
                },
            });
        }
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
                            var newComments = `<li class="list-group   list-group-item">
                            <div>
                                <div class="d-flex align-items-center">
                                    <div class="mr-2">
                                        <img class="rounded-circle" width="45" height="45" src="uploads/${
                                            comment.user.profile
                                        }" alt="profile img" />
                                    </div>
                                    <div class="ml-2">
                                        <h6 class="fw-bold mb-1">${
                                            comment.user.fname
                                        }</h6>
                                        <small class="text-muted">${new Date(
                                            comment.created_at
                                        ).toLocaleString()} </small>
                                    </div>
                                </div>
                                <div class="mt-2 ml-5 pl-3">
                                    <p class="text-muted">${comment.comment}</p>
                                </div>
                            </li>`;
                            $("#comment-history").append(newComments);
                        });
                        $("#comment-history").append(newComments);
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
    $(document).on("click", ".delete-post", function (e) {
        e.preventDefault();
        var post_id = $(this).data("post_id");
        var postElement = $(this).closest(".posts");
        $.ajax({
            url: deletePost,
            type: "DELETE",
            data: {
                post_id: post_id,
                _token: $('meta[name="csrf-token"]').attr("content"),
            },
            success: function (res) {
                if (res.success) {
                    alert("successfully delete");
                    postElement.remove();
                } else {
                    alert("not delete post");
                }
            },
        });
    });

    //archive post
    $(document).on("click", ".archive-post", function (e) {
        e.preventDefault();
        var post_id = $(this).data("post_id");
        var postElement = $(this).closest(".posts");
        $.ajax({
            url: archivePost,
            type: "POST",
            data: {
                post_id: post_id,
                _token: $('meta[name="csrf-token"]').attr("content"),
            },
            success: function (res) {
                if (res.success) {
                    alert("Post archived successfully");
                    // $(this).closest('.post-item').remove();
                    fetchAllPosts();
                } else {
                    alert("Failed to archive post: " + res.message);
                }
            },
            error: function (xhr, status, error) {
                console.error("Archive error:", status, error);
                alert("An error occurred while archiving the post.");
            },
        });
    });

    // unarchive post
    $(document).on("click", ".unarchive-post", function (e) {
        e.preventDefault();
        var post_id = $(this).data("post_id");
        var postElement = $(this).closest(".posts");
        console.log(post_id);
        $.ajax({
            url: unarchivepost,
            type: "POST",
            data: {
                post_id: post_id,
                _token: $('meta[name="csrf-token"]').attr("content"),
            },
            success: function (res) {
                if (res.success) {
                    alert("Post unarchived successfully");
                    // $(this).closest('.post-item').remove();
                } else {
                    alert("Failed to unarchive post: " + res.message);
                }
            },
            error: function (xhr, status, error) {
                console.error("Unarchive error:", status, error);
                alert("An error occurred while unarchiving the post.");
            },
        });
    });

    // edit post
    $(document).on("click", ".edit-post", function (e) {
        e.preventDefault();
        var post_id = $(this).data("post_id");
        $.ajax({});
    });

    //function call on all post
    fetchAllPosts();
});

// <div class="dropdown">
// <button class="btn btn-link" type="button" id="drop-dwon" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
//     <i class="fa fa-ellipsis-h"></i>
// </button>
// <div class="dropdown-menu" aria-labelledby="dropdownMenu2">`;

// if (post.user_id==user_id) {

// newPostHtml +=`
//     <a href="#"><button class="dropdown-item edit-post" data-post_id="${post.id} type="button">Edit</button></a>
//     <a href="#"><button class="dropdown-item delete-post" data-post_id="${post.id}" type="button">Delete</button></a>
//     <a href="#"><button class="dropdown-item archive-post" data-post_id="${post.id}" type="button">Archive</button></a>
// `;
// }
// else{
// newPostHtml+=`
//     <a href="#"><button class="dropdown-item" type="button">Report</button></a>
// `;
// }
// newPostHtml+=`

// </div>
// </div>
