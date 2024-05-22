<!DOCTYPE html>
<html lang="en">
<head>
    @include('layout.header')
</head>
<body>
  @include('layout.navbar')
    <div class="container mt-5">
        <h2>Notifications</h2>
        <div class="list-group" id="notificationList">
            @forEach($notifications as $notification)
                <div class="container">
                    <div class="list-group">
                <span class="list-group-item list-group-item-action d-flex align-items-center">
                    <img class="rounded-circle mr-3 profile-img" width="50" height="50" src="postimg/{{$notification->post->post_img}}" alt="profile img">
                <div class="flex-grow-1">
                    <h5 class="mb-1">{{$notification->user->fname}} by post {{$notification->type}}</h5>
                </div>
                <h5 class="mb-1">{{$notification->created_at->diffForHumans()}}</h5>
                </span>
                </div>
                </div>
            @endforeach
        </div>
    </div>
    <script>
        // $(document).ready(function() {
        //     $.ajax({
        //         url: '/notification', 
        //         type: 'GET',
        //         success: function(res) {
        //             console.log(res);
        //             // Check if notifications exist
        //             if (res.notifications && res.notifications.length > 0) {
        //                 res.notifications.forEach(function(notification) {
        //                     var notificationItem = `
        //                         <div class="container">
        //                         <div class="list-group">
        //                         <span class="list-group-item list-group-item-action d-flex align-items-center">
        //                         <img class="rounded-circle mr-3 profile-img" width="50" height="50" src="postimg/${notification.post}" alt="profile img">
        //                         <div class="flex-grow-1">
        //                             <h5 class="mb-1">${notification.user_name} by post ${notification.type}</h5>
        //                         </div>
        //                         <h5 class="mb-1">${notification.created_at}</h5>
        //                         </span>
        //                         </div>
        //                         </div>`;
        //                     $('#notificationList').append(notificationItem);
        //                 });
        //             } else {
        //                 // No notifications
        //                 $('#notificationList').html('<p>No notifications found.</p>');
        //             }
        //         },
        //         error: function(xhr, status, error) {
        //             console.error('Error fetching notifications:', status, error);
        //             $('#notificationList').html('<p>Error fetching notifications.</p>');
        //         }
        //     });
        // });
    </script>
</body>
</html>
