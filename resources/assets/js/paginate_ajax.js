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
$(document).ready(function () {
    $('.pagination a').on('click',function (e) {
        ajax_request($(this).attr('href').split('page=')[1]);
        e.preventDefault();
    });
});