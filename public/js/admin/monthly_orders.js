$(document).ready(function () {
//pagination
    function ajax_request(page) {

        page = typeof page !== 'undefined' ? page : false;//for pagination


        //all checked elements

        //pagination

        var url = '/admin/monthly_orders';

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
                $('#monthly_orders_div').html(data);
            }
        })
    }

    $('#monthly_orders .pagination a').on('click', function (e) {
        ajax_request($(this).attr('href').split('page=')[1]);
        e.preventDefault();
    });
});