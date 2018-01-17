$(document).ready(function () {

   function request(container,el) {
       $(window).off('click');

       var name = container.attr('name');
       var value = container.val();
       var check = false;


       $('.errors').empty();

       //regulars starts

       if(name=='first_name'||name=='last_name') {
           if(!value.match(/^[a-zA-Z]+$/)){
               $('.errors').remove();
               el.parent().append(
                   '<p  class="errors" style=";font-size:130%;color:red;font-weight:bold;text-decoration: underline">' +
                   'This field must be correct</p>');
           }
           else
               check = true;
       }
       else if(name=='email'){
           if(!value.match(/^([a-z0-9_\.-]+)@([a-z0-9_\.-]+)\.([a-z\.]{2,6})$/)){
               $('.errors').remove();
               el.parent().append(
                   '<p  class="errors" style=";font-size:130%;color:red;font-weight:bold;text-decoration: underline">' +
                   'This field must be string</p>');
           }
           else
               check = true;
       }
       else if(name=='phone'||name=='postal_zip'){
           if(!value.match(/^([0-9]+)$/)) {
               $('.errors').remove();
               el.parent().append(
                   '<p  class="errors" style=";font-size:130%;color:red;font-weight:bold;text-decoration: underline">' +
                   'This field must be correct</p>');
           }
           else
               check = true;

       }
       else if(name=='address'){
           check = true;
       }




       var id = window.location.href.split('/')[5];

       if(check == true) {
           $.ajax({
               url: '/admin/orders/' + id + '/edit',
               method: 'post',
               headers: {
                   dataType: 'json',
                   'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
               },
               data: {
                   value: value,
                   name: name
               },
               success: function (data) {
                   $('.errors').remove();
                   if (data == 'no_access') {
                       el.append(
                           '<p class="errors" style=";font-size:130%;color:red;font-weight:bold;text-decoration: underline">' +
                           'Users have no access to edit!</p>');
                   }
                   else {
                       el[0].innerHTML = data;
                   }

               }
           });
       }

   }

    function selector_change() {
        var name = $(this).attr('name');
        var value = $(this).val();
        var el = $(this);
        var id = window.location.href.split('/')[5];

        $.ajax({
            url:'/admin/orders/'+id+'/edit',
            method:'post',
            headers: {
                dataType:'json',
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: {
                value:value,
                name:name
            },
            success: function(data){
                $('.errors').remove();
                if(data=='no_access'){
                    el.append(
                        '<p class="errors" style=";font-size:130%;color:red;font-weight:bold;text-decoration: underline">' +
                        'Users have no access to edit!</p>');
                }
                else if(name == 'city_id'){
                    $('span[name="country"]')[0].innerHTML = data;
                }
            }
        });

    }

    function area_show(){
        var html = $(this)[0].innerHTML;
        var name = $(this).attr('name');
        var el = $(this);

        $(this)[0].innerHTML = '<textarea id="area_container" name="'+name+'">' + html +'</textarea>';

        $(this).off('dblclick');//off event for clicking inside area

        //click any place
        $(window).click(function() {

            el.off('dblclick');


            request($('#area_container'),el);

            el[0].innerHTML = html;

            el.on('dblclick',area_show);
        });

        //stops window event on clicking inside area
        $('#area_container').click(function(event){
            event.stopPropagation();
        });
    }

    function good_num() {
        var id = window.location.href.split('/')[5];
        var good_id = $(this).attr('data-id');
        var good_num = $(this).val();
        var data_price = $(this).attr('data-price');
        var el = $(this);
        if(good_num>=1) {
            $.ajax({
                url: '/admin/orders/' + id + '/edit_good_num',
                method: 'post',
                headers: {
                    dataType: 'json',
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    good_id: good_id,
                    good_num: good_num
                },
                success: function (data) {
                    $('.errors').remove();

                    if (data == 'no_access') {
                        el.parent().append(
                            '<p class="errors" style=";font-size:130%;color:red;font-weight:bold;text-decoration: underline">' +
                            'Users have no access to edit!</p>');
                    }
                    else {
                        $('#order_total')[0].innerHTML = data;
                        $('#total_price' + good_id)[0].innerHTML = '$' + data_price * good_num;
                    }
                }
            });
        }
    }




    function delete_good() {
        var id = window.location.href.split('/')[5];
        var check = confirm('Are you sure?');
        var good_id = $(this).attr('data-id');
        var el = $(this);
        if(check==true) {
            $.ajax({
                url: '/admin/orders/' + id + '/delete_good',
                method: 'post',
                headers: {
                    dataType: 'json',
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    good_id: good_id
                },
                success: function (data) {
                    $('.errors').remove();
                    if (data == 'no_access') {
                        el.append(
                            '<p class="errors" style=";font-size:130%;color:red;font-weight:bold;text-decoration: underline">' +
                            'Users have no access to edit!</p>');
                    } else
                        location.reload();
                }
            });
        }
    }

    function add_good(){
        var id = window.location.href.split('/')[5];

        if($('input[name="goods_num"]').val()>=1&&$('input[name="goods_num"]').val().match(/^([0-9]+)$/)){

        $('#form_add_good').attr('action','/admin/orders/'+id+'/add_order_goods');

        $('#form_add_good').attr('method','POST');

        $('#form_add_good').submit();

        }else{
            e.preventDefault();
        }
    }

    function add_show() {
        var id = window.location.href.split('/')[5];
        var good_id = $(this).attr('data-id');
        var el = $(this);
        $(this).css('display','none');
        $(this).off('click');

        $.ajax({
                url: '/admin/orders/' + id + '/add_good_check',
                method: 'post',
                headers: {
                    dataType: 'json',
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    good_id: good_id
                },
                success: function (data) {
                    $('.errors').remove();
                    if (data == 'no_access') {
                        el.append(
                            '<p class="errors" style=";font-size:130%;color:red;font-weight:bold;text-decoration: underline">' +
                            'Users have no access to edit!</p>');
                    } else{
                           var select = '<select name="good_id">';

                       data.forEach(function (good) {
                               select += '<option value="'+good.id+'">'+good.id+'</option>'
                       });

                           select += '</select><p style="padding: 10px 0px"><input required min="1" type="number" name="goods_num" placeholder="Number of goods">' +
                               '</p><input type="submit" value="Add" id="add_good_ok">';

                           $('#add_good').css('display','block');
                           $('#form_add_good').append(select);
                           $('#add_good_ok').on('click',add_good);
                    }
                }
            });

    }



    $('.single_value_review').on('dblclick',area_show);
    $('.selector_order').on('change',selector_change);

    $('select[name="country_id"]').on('change',function () {
        var name = $(this).attr('name');
        var value = $(this).val();
        var el = $(this);

        var id = window.location.href.split('/')[5];

        $.ajax({
            url:'/admin/orders/'+id+'/edit',
            method:'post',
            headers: {
                dataType:'json',
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: {
                value:value,
                name:name
            },
            success: function(data){
                $('.errors').remove();
                if(data=='no_access'){
                    el.append(
                        '<p class="errors" style=";font-size:130%;color:red;font-weight:bold;text-decoration: underline">' +
                        'Users have no access to edit!</p>');
                }else
                    location.reload();
            }
        });
    });

    $('.add_good').on('click',add_show);
    $('.good_num').on('change',good_num);
    $('.delete_good').on('click',delete_good);



});