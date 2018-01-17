$(document).ready(function () {
//pagination
    function ajax_request(page) {

        page = typeof page !== 'undefined' ? page : false;//for pagination


        //all checked elements

        //pagination
        var id = window.location.href.split('/')[5];

        var url = '/admin/favorite_single/'+id;

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
                $('#favorite_single').html(data);
            }
        })
    }

    $(document).ready(function () {
        $('#pagin_favorites .pagination a').on('click',function (e) {
            ajax_request($(this).attr('href').split('page=')[1]);
            e.preventDefault();
        });
    });

//pagination ends
    function delete_favorite(){
        var conf = confirm('Are you sure?');
        var favorite_id = $(this).parent().attr('data-id');
        var id = window.location.href.split('/')[5];
        var div = $(this).parent();

        if(conf==true){
            $.ajax({
                url:'/admin/user/'+id+'/favorite_delete',
                method:'post',
                headers: {
                    dataType:'json',
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data:{
                    id:favorite_id
                },
                success: function(data) {
                    if(data=='no_access'){
                        $('.errors').remove();
                        div.parent()   .append(
                            '<p class="errors" style=";font-size:130%;color:red;font-weight:bold;text-decoration: underline">' +
                            'Users have no access to edit!</p>');
                    }else {
                        div.remove();
                    }
                }
            });
        }

    };



    $('.favorite_delete').on('click',delete_favorite);
});
