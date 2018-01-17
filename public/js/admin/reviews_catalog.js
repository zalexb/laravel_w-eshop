$(document).ready(function () {

    function ajax_req(value,name,element,id) {
        $(window).off('click');
        var review_id = element.attr('data-id');

        $('.errors').empty();



        $.ajax({
            url:'/admin/reviews/edit_content',
            method:'post',
            headers: {
                dataType:'json',
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: {
                value:value,
                id:review_id
            },
            success: function(data){
                $('.errors').remove();
                if(data=='no_access'){
                    element.parent().append(
                        '<p class="errors" style=";font-size:130%;color:red;font-weight:bold;text-decoration: underline">' +
                        'Users have no access to edit!</p>');
                }
                else{
                    element[0].innerHTML = data;
                }
            }
        })
    }

    function area_show(){
        var html = $(this)[0].innerHTML;
        var name = $(this).attr('name');
        var el = $(this);
        var id = $(this).attr('data-id');

        $(this)[0].innerHTML = '<textarea id="area_container" name="'+name+'">' + html +'</textarea>';

        $(this).off('dblclick');//off event for clicking inside area

        //click any place
        $(window).click(function() {

            el.off('dblclick');


            el.on('dblclick',area_show);

            ajax_req($('#area_container').val(),name,el,id);

            el[0].innerHTML = html;
        });

        //stops window event on clicking inside area
        $('#area_container').click(function(event){
            event.stopPropagation();
        });
    }

    $('.single_value_review').on('dblclick',area_show);

//pagination
    function ajax_request(page) {

        page = typeof page !== 'undefined' ? page : false;//for pagination

        //pagination
        var request = {
            paginate:$('.filters[name="per_page"]').val(),
            sort_by:$('.filters[name="sort_by"]').val(),
        };

        var url = '/admin/admin_reviews';

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
                $('#review_single').html(data);
            }
        })
    }

    $('#pagin_reviews .pagination a').off('click');

    $('#pagin_reviews .pagination a').on('click',function (e) {
            ajax_request($(this).attr('href').split('page=')[1]);
            e.preventDefault();
        });

//pagination ends
    function delete_review(){
        var conf = confirm('Are you sure?');
        var review_id = $(this).attr('data-id');
        var div = $(this).parent().parent();

        if(conf==true){
            $.ajax({
                url:'/admin/review_delete',
                method:'post',
                headers: {
                    dataType:'json',
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data:{
                    id:review_id
                },
                success: function(data) {
                    console.log(data);
                    if(data=='no_access'){
                        $('.errors').remove();
                        div.parent()   .append(
                            '<p class="errors" style=";font-size:130%;color:red;font-weight:bold;text-decoration: underline">' +
                            'Users have no access to edit!</p>');
                    }else {
                        location.reload();
                    }
                }
            });
        }

    };

    $('.filters').off('change');
    $('.filters').on('change',ajax_req);

    $('.review_delete').off('click');
    $('.review_delete').on('click',delete_review);
});
