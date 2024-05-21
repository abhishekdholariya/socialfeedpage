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
            <!-- Notifications dynamically added -->
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $.ajax({
                url: '/notifications', 
                type: 'GET',
                success: function(res) {
                    console.log(res);
                    // Check if notifications exist
                    if (res.notifications && res.notifications.length > 0) {
                        res.notifications.forEach(function(notification) {
                            var notificationItem = `
                                <div class="container">
                                <div class="list-group">
                                <span class="list-group-item list-group-item-action d-flex align-items-center">
                                <img class="rounded-circle mr-3 profile-img" width="50" height="50" src="postimg/${notification.post}" alt="profile img">
                                <div class="flex-grow-1">
                                    <h5 class="mb-1">${notification.post_user_name} by ${notification.user_name} on post ${notification.type}</h5>
                                </div>
                                <h5 class="mb-1">${notification.created_at}</h5>
                                </span>
                                </div>
                                </div>`;
                            $('#notificationList').append(notificationItem);
                        });
                    } else {
                        // No notifications
                        $('#notificationList').html('<p>No notifications found.</p>');
                    }
                },
                error: function(xhr, status, error) {
                    console.error('Error fetching notifications:', status, error);
                    $('#notificationList').html('<p>Error fetching notifications.</p>');
                }
            });
        });
    </script>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
