$(document).ready(function () {
    $('.filters').off('change');
    $('.pagination a').off('click');

    function ajax_req(page){
        var request = {
            paginate:$('.filters[name="per_page"]').val(),
            sort_by:$('.filters[name="sort_by"]').val(),
        };
        var url =   '/admin/users_table';


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
                $('#users').html(data);
            }
        })
    }

    $('.filters').on('change',ajax_req);


    $('.pagination a').on('click',function (e) {
        ajax_req($(this).attr('href').split('page=')[1]);
        e.preventDefault();
    });
});