$(document).ready(function() {
    $('.user-link').click(function (e) {

        let link_id = $(this).data('link-id');
        let link_url = $(this).attr('href');



        $.ajax({
            method: 'POST',
            url: '/visits/' + link_id,
            data: {url: link_url},
            success: function (data) {
                console.log(data);
            }
        });
    });
});