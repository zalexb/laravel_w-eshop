$(document).ready(function () {

    function ajax_request(page) {

        page = typeof page !== 'undefined' ? page : false;//for pagination

        var request = {};

        //all checked elements
        $('.sort[checked]').each(function (index, elem) {
            if(request[elem.name])
                request[elem.name].push(elem.value);
            else
                request[elem.name] = [elem.value];
        });
        //pagination
        var parsed_url = window.location.href.split('/');

        if(parsed_url[3]=='search'){
            request['search'] = parsed_url[4].replace(/%20/g,' ');
        }

        var url = '/products';

        if(parsed_url[3]=='admin')
            url = '/admin/goods';

        if(page!=false)
            url += '?page='+page;

        //sort by
        var filters = $('.filters');
        filters.each(function (index,item) {
            request[item.name]=item.value;
        });

        // price
        var price = $( "#price_slider" ).slider( "values");

        request['price']=price;


        $.ajax({
            url:url,
            method:'get',
            headers: {
                dataType:'json',
                // 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: request,
            beforeSend:function(){
                $('body').loadingModal({text: 'Loading...'});
            },
            success: function(data){
                $('body').loadingModal('hide');
                $('body').loadingModal('destroy');
                $('#goods').html(data);
            }
        })
    }


    function checked_on(event){

        if($(this).attr('type')=='radio')
            $('.sort[checked][type="radio"]').removeAttr('checked');

        $(this).attr('checked','');

        ajax_request();

        $(this).off("click",checked_on).on('click',checked_off);
    }

    function checked_off(event) {

        $(this).removeAttr('checked');

        ajax_request();

        $(this).off("click",checked_off).on('click',checked_on);
    }

    $('.sort:not( :checked)').on('click',checked_on);

    $('.sort[checked]').on('click',checked_off);

//selection
    $('.filters').on('change',function () {
        ajax_request();
    });


    $( "#price_slider" ).slider({
        range:true,
        min: 100,
        max: 10000,
        values: [ 100, 10000 ],
        slide: function( event, ui ) {
            $( "#price" ).val( "$" + ui.values[ 0 ] + " - $" + ui.values[ 1 ] );
        }
    });
    $( "#price" ).val( "$" + $( "#price_slider" ).slider( "values", 0 ) +
        " - $" + $( "#price_slider" ).slider( "values", 1 ) );





    $( "#price_slider" ).on( "slidechange", function( event, ui ) {

        ajax_request();
    })


});