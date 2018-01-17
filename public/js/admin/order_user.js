$(document).ready(function () {
//pagination
    function ajax_request(page) {

        page = typeof page !== 'undefined' ? page : false;//for pagination


        //all checked elements

        //pagination
        var id = window.location.href.split('/')[5];

        var url = '/admin/single_user/order/'+id;

        if(page!=false)
            url += '?page='+page;


        $.ajax({
            url:url,
            method:'get',
            headers: {
                dataType:'json',
            },
            beforeSend:function(){
                $('body').loadingModal({text: 'Loading...'});
            },
            success: function(data){
                $('body').loadingModal('hide');
                $('body').loadingModal('destroy');
                $('#order_single').html(data);
            }
        })
    }

    $(document).ready(function () {
        $('#pagin_orders .pagination a').on('click',function (e) {
            ajax_request($(this).attr('href').split('page=')[1]);
            e.preventDefault();
        });
    });

//pagination ends
    function change_status(){
        var order_status = $(this).val();
        var id = $(this).attr('data-id');
        var div = $(this);


        $.ajax({
            url:'/admin/'+id+'/order_status',
            method:'post',
            headers: {
                dataType:'json',
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data:{
                status:order_status
            },
            success: function(data) {
                if(data=='no_access'){
                    $('.errors').remove();
                    div.parent()   .append(
                        '<p class="errors" style=";font-size:130%;color:red;font-weight:bold;text-decoration: underline">' +
                        'Users have no access to edit!</p>');
                }
            }
        });

    };



    $('.order_status').on('change',change_status);
});
