<x-notification>
    <x-slot name="trigger">
        <div class="flex items-center">
            <button type="button"
                class="hover:bg-gray-100 border border-gray-300 p-2
                 bg-gray-50  rounded-md shadow-sm text-gray-800 flex items-center">

                 <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                 stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                 <path stroke-linecap="round" stroke-linejoin="round"
                     d="M14.857 17.082a23.848 23.848 0 005.454-1.31A8.967 8.967 0 0118 9.75v-.7V9A6 6 0 006 9v.75a8.967 8.967 0 01-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 01-5.714 0m5.714 0a3 3 0 11-5.714 0M3.124 7.5A8.969 8.969 0 015.292 3m13.416 0a8.969 8.969 0 012.168 4.5" />
             </svg>

            </button>
        </div>

    </x-slot>
    <x-slot name="content">
        <div class="flex justify-between">

            <ul id="notificationList" class="py-2 px-2 hover:bg-gray-200 cursor-pointer text-gray-600"></ul>
        </div>
            <div class="flex justify-end mx-2 ">

                <span id="text" class="mt-1  text-gray-700 mb-2 text-sm mx-2"></span>
        </div>
        </x-slot>
    </x-notification>

    <script src="{{ asset('assets/js/jquery-3.6.3.min.js') }}"></script>
    <script>
        $(document).ready(function () {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            function fetchNotifications(page = 1) {
                $.ajax({
                    url: '/fetch-notifications?page=' + page,
                    type: 'GET',
                    dataType: 'json',
                    success: function (data) {
                        updateNotificationList(data.notifications.data);
                        updateTextInfo(data.total, data.notifications);
                    },
                    error: function (error) {
                        console.error('Error fetching notifications:', error);
                    }
                });
            }

            fetchNotifications();

            function updateNotificationList(notifications) {
                var notificationList = $('#notificationList');

                notificationList.empty();

                if (notifications.length > 0) {
                    $.each(notifications, function (index, notification) {
                        var listItem = $('<li class="border-b border-gray-300 py-2 px-3 ">' + notification.data.message + '</li>');
                        var markAsReadButton = $('<p class="mark-as-read float-end flex justify-end text-end text-blue-500" data-notification-id="' + notification.id + '">Mark as read</p>');
                        listItem.append(markAsReadButton);
                        notificationList.append(listItem);
                    });

                    $('.mark-as-read').on('click', function () {
                        var notificationId = $(this).data('notification-id');

                        $.ajax({
                            url: '/mark-as-read/' + notificationId,
                            type: 'POST',
                            dataType: 'json',
                            success: function (response) {
                                fetchNotifications();
                            },
                            error: function (error) {
                                console.error('Error marking notification as read:', error);
                            }
                        });
                    });
                } else {
                    notificationList.append('<li class="mx-2">No new notifications</li>');
                }
            }

            function updateTextInfo(total, notifications) {
                var textInfo = $('#text');
                var start = (notifications.current_page - 1) * notifications.per_page + 1;
                var end = start + notifications.per_page - 1;

                textInfo.text('Showing ' + start + ' to ' + end + ' of ' + total + ' Results');
            }
        });
    </script>
