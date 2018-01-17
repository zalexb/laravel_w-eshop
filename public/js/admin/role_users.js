$(document).ready(function () {


//pagination
    function ajax_request(page) {

        page = typeof page !== 'undefined' ? page : false;//for pagination


        //all checked elements

        //pagination
        var id = window.location.href.split('/')[5];

        var url = '/admin/single_role/'+id;

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
                $('#users').html(data);
            }
        })
    }

    $(document).ready(function () {
        $('#pagin_users .pagination a').on('click',function (e) {
            ajax_request($(this).attr('href').split('page=')[1]);
            e.preventDefault();
        });
    });

//pagination ends
    function detach(){
        var conf = confirm('Are you sure?');
        var user_id = $(this).attr('data-id');
        var div = $(this).parent();
        var role_id = window.location.href.split('/')[5];

        if(conf==true){
            $.ajax({
                url:'/admin/detach_user',
                method:'post',
                headers: {
                    dataType:'json',
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data:{
                    user_id:user_id,
                    role_id:role_id
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



    $('.detach_user_role').on('click',detach);
})
