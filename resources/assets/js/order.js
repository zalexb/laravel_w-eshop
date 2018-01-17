$(document).ready(function () {
//ajax for select city
    $('select[name="country_id"]').change(function () {
        $.ajax({
            url: '/orderForm_cities',
            method: 'post',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            dataType:'Json',
            data: {
              country_id:$('select[name="country_id"]').val()
            },
            beforeSend: function () {
                $('#order_form p select[name="city_id"]')[0].innerHTML = '<option></option>';
                $('#city_select').css('display','none');
            },
            success: function (data) {
                $('#city_select').css('display','block');
                var cities = '';
                data.forEach(function (item, index) {
                   cities += '<option value="'+item.id+'">'+item.name+'</option>';
                });
                $('#order_form p select[name="city_id"]').append(cities);
            }
        });

    });


    //validation

    jQuery.validator.addMethod("name", function(value, element) {
        return this.optional(element) || /^[a-z ,.'-]+$/i.test(value);
    }, "Please write correctly");
    $("#order_form").validate({
        rules: {
            first_name: {
                required: true,
                name: true
            }
            ,
            last_name: {
                required: true,
                name: true
            },
            address: {
                required: true,
                minlength: 5,
                name: false
            },
            country_id:{
                required: true,
                name: false
            },
            city_id:{
              required:true,
                name: false
            },
            phone: {
                required: true,
                number: true,
                minlength: 7,
                maxlength: 12,
                name: false
            },
            postal_zip:{
                required: true,
                number: true,
                name:false
            },
            delivery_type:{
                required:true,
                name:false
            }
        },
        messages: {
            phone:{
                required: 'We need your phone number to contact you',
                number: 'This field must be in format of 380964477115',
                minlength: 'This field must be in format of 380964477115',
                maxlength: 'This field must be in format of 380964477115'
            },
            first_name: {
                required: "Please specify your name",
                name: "Please write correct name"
            },
            last_name: {
                required: "Please specify your last name",
                name: "Please write correct last name"
            }

        },
        submitHandler: function(form) {
            $.ajax({
                url:'/order_create',
                method:'post',
                headers: {
                    dataType:'json',
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    first_name: $('#order_form input[name=first_name]').val(),
                    last_name: $('#order_form input[name=last_name]').val(),
                    country_id: $('#order_form select[name=country_id]').val(),
                    city_id: $('#order_form select[name=city_id]').val(),
                    address: $('#order_form input[name=address]').val(),
                    phone: $('#order_form input[name=phone]').val(),
                    goods: JSON.parse(localStorage.getItem('basket')),
                    delivery_type: $('#order_form select[name=delivery_type]').val(),
                    postal_zip: $('#order_form input[name=postal_zip]').val(),

                },
                beforeSend:function(data){
                    $('body').loadingModal({text: 'Loading...'});
                     if($('.order_answer')){
                         $('.order_answer').remove();
                     }
                },
                success: function(data){
                     $('body').loadingModal('hide');
                     $('body').loadingModal('destroy') ;
                    if(data=="true"){
                        $('#modal_order').append('<h2 class="order_answer" style="color: green">Your order created successfully</h2>');
                        $('#order_form').empty();
                        localStorage.removeItem('basket');
                       openBasket();//перегружаем корзину
                       empty();// очищаем сумарную сумму в хеде
                    }
                    else{
                        $('#modal_order').append('<h2 class="order_answer" style="color: red">Something went wrong</h2>');
                    }
                }
            })
        }
    })

});