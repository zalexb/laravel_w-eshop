$(document).ready(function () {
    $.ajax({
        url:'/admin/notification_check',
        method:'get',
        headers: {
            dataType:'json',
        },
        success:function (data) {
            if( data.new_notifs_num > 0){
                $('.header_notifications')[0].innerText = 'You have '+data.new_notifs_num+'new notifications';
                $('.new_notifications_num')[0].innerText = data.new_notifs_num;
                $('.new_notifications_num').css('display','block');
            }
            if( data.new_mails > 0){
                $('.header_messages')[0].innerText = 'You have '+data.new_mails+'new messages';
                $('.new_mails_num').css('display','block');
                $('.new_mails_num')[0].innerText = data.new_mails;
            }
        }
    });
    $('.notification_drop').click(function () {
        if($('p').hasClass('new_notifications')) {
            var ids = [];

            $('.new_notifications').each(function (i, el) {
                ids.push($(this).attr('data-id'))
            });

            $.ajax({
                url:'/admin/notifications',
                method:'post',
                headers: {
                    dataType:'json',
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data:{
                    'ids':ids
                },
                success:function (data) {
                    var new_notifications_num = $('.new_notifications_num')[0].innerText - ids.length;
                    if(new_notifications_num<=0)
                        $('.new_notifications_num').css('display','none');
                    else
                        $('.new_notifications_num')[0].innerText = new_notifications_num;
                }
            })
        }
    });
});


