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
                                <div class="list-group-item list-group-item-action">
                                    <div class="d-flex w-100 justify-content-between">
                                        <h5 class="mb-1">${notification.user_id}</h5>
                                        <small>${notification.created_at}</small>
                                    </div>
                                    <p class="mb-1">${notification.type}</p>
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
