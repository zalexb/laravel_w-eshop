$(document).ready(function(){
    $('#search_form').submit(function () {
        window.location.href = '/search/'+$('#search_input').val();
    });

    $('#search_input').keypress(function () {
        $('#search_modal').css('display','block').animate({opacity:1},200);
        var search_value = $('#search_input').val();
        var request = $.ajax({
            url:'/search',
            method:'post',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: {value : search_value},
            dataType:'json',
            // contentType:'application/json'
        });
        request.done(function(data){
            $('#search_table').empty();
            data.forEach(function (good,index) {
                if(index>=3)
                    delete data[index];
            });
            data.forEach(function(good,index,array){


                $('#search_table').append('<tr>' +
                    '<td><a href="/single/'+good['id']+'">' +
                    '<img class="search_img" src="/images/goods/'+good['image']['link']+'" alt="'+good['image']['alt']+'">' +
                    '<span>'+good['name']+'</span></a></td>'+
                    '</tr>')
            });
            if(data.length>3)
                $('#search_table').append('<a style="padding-left:7%" class="search_more" href="/search/'+$('#search_input').val()+'">View more</a>');
            if(data.length==0)
                $('#search_table').append('<tr><td>Nothing found</td></tr>')
        });
        request.fail(function(jqXHR, textStatus){

        });
    });
    //закрытие окна
    $('#search_close').click( function(){ // лoвим клик пo крестику или пoдлoжке
        $('#search_modal')
            .animate({opacity: 0}, 200,  // плaвнo меняем прoзрaчнoсть нa 0 и oднoвременнo двигaем oкнo вверх
                function(){ // пoсле aнимaции
                    $(this).css('display', 'none'); // делaем ему display: none;
                }
            );
    });
});