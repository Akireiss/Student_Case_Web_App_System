
    $(document).ready(function () {
        $('.sidebar a').click(function (e) {
            e.preventDefault();
            var url = $(this).attr('href');
            $.ajax({
                url: url,
                success: function (data) {
                    $('#page-content').html(data);
                }
            });
        });
    });
