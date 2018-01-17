$(document).ready(function () {

    function ajax_req(page){
        var request = {
            paginate:$('.filters[name="per_page"]').val(),
            sort_by:$('.filters[name="sort_by"]').val(),
        };
        var url =   '/admin/all_orders';


        if(page!=false)
            url += '?page='+page;

        $.ajax({
            url:url,
            method:'get',
            headers: {
                dataType:'json',
            },
            data:request,
            beforeSend:function(){
                $('body').loadingModal({text: 'Loading...'});
            },
            success: function(data){
                $('body').loadingModal('hide');
                $('body').loadingModal('destroy');
                $('#orders').html(data);
            }
        })
    }
    $('.filters').off('change');
    $('.filters').on('change',ajax_req);

    $('.pagination a').off('click');
    $('.pagination a').on('click',function (e) {
        ajax_req($(this).attr('href').split('page=')[1]);
        e.preventDefault();
    });
});