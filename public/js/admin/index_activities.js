$(document).ready(function () {
//pagination
    function ajax_request(page) {

        page = typeof page !== 'undefined' ? page : false;//for pagination


        //all checked elements

        //pagination

        var url = '/admin/index_activities';

        if (page != false)
            url += '?page=' + page;


        $.ajax({
            url: url,
            method: 'get',
            headers: {
                dataType: 'json',
            },
            beforeSend: function () {
                $('body').loadingModal({text: 'Loading...'});
            },
            success: function (data) {
                $('body').loadingModal('hide');
                $('body').loadingModal('destroy');
                $('#activities').html(data);
            }
        })
    }

        $('#notifications_pagin .pagination a').on('click', function (e) {
            ajax_request($(this).attr('href').split('page=')[1]);
            e.preventDefault();
        });
});