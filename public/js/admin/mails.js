$(document).ready(function () {
    function ajax(){
        $('#mails_drop').off('click');
        $('#ul_mail').empty();
        $.ajax({
            url:'/admin/get_mails',
            method:'post',
            headers: {
                dataType:'json',
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success:function (data) {

                for(var el in data) {
                    var new_class = data[el].users[0].checked==null ? 'new_mails' : '';
                    $('#ul_mail').append('<li>' +
                        '<div class="user_img">' +
                        '</div>' +
                        '<div data-id="'+data[el].id+'" class="notification_desc '+new_class+'">' +
                        '<p>'+data[el].email+'</p>' +
                        '<p><span>'+data[el].diff_in_time+'</span></p>' +
                        '</div>' +
                        '<div class="clearfix"></div>' +
                        '</li>')
                }
                $('#ul_mail').append('<li>' +
                    ' <div class="notification_bottom">' +
                    ' <a href="/admin/inbox">See all messages</a>' +
                    '  </div>' +
                    ' </li>')

                if($('div').hasClass('new_mails')) {
                    var ids = [];

                    $('.new_mails').each(function (i, el) {
                        ids.push($(this).attr('data-id'))
                    });

                    $.ajax({
                        url:'/admin/mails_checked',
                        method:'post',
                        headers: {
                            dataType:'json',
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        data:{
                            'ids':ids
                        },
                        success:function (data) {
                            var new_mails_num = $('.new_mails_num')[0].innerText - ids.length;
                            if(new_mails_num<=0)
                                $('.new_mails_num').css('display','none');
                            else
                                $('.new_mails_num')[0].innerText = new_mails_num;

                        }
                    })
                }
            }
        })
    }
    $('#mails_drop').on('click',ajax);
});


