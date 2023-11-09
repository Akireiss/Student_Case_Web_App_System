$(document).ready(function() {
    function fetchNewNotifications() {
        $.ajax({
            type: 'GET',
            url: '/fetch-new-notifications',
            success: function(data) {
            }
        });
    }

    fetchNewNotifications();

    var refreshInterval = 30000; // 30 seconds
    setInterval(fetchNewNotifications, refreshInterval);

    $('.mark-as-read').click(function() {
        var notificationId = $(this).data('notification-id');
        var notificationElement = $(this).closest('.bg-green-100');

        $.ajax({
            type: 'POST',
            url: '/mark-notification-read/' + notificationId,
            data: {
                '_token': '{{ csrf_token() }}'
            },
            success: function(data) {
                notificationElement.fadeOut(); // Remove the notification from view
            }
        });
    });

    $('.close-notification').click(function() {
        var notificationElement = $(this).closest('.bg-green-100');
        notificationElement.fadeOut(); // Remove the notification from view
    });
});
