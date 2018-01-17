$(document).ready(function () {
    var url = window.location.href.split('/');

    if(url[3]=="checkout"){
        openBasket();
    }
    /*dropDOwn menu in profile*/
    function DropDown(el) {
        this.dd = el;
        this.initEvents();
    }
    DropDown.prototype = {
        initEvents : function() {
            var obj = this;

            obj.dd.on('click', function(event){
                $('.wrapper_profile').toggleClass('active');
                event.stopPropagation();
            });
        }
    };
    $(function() {

        var dd = new DropDown( $('#profile_drop') );

        $(document).click(function() {
            // all dropdowns
            $('.wrapper_profile').removeClass('active');
        });

    });
    //
    var itemBox = d.querySelectorAll('.product-main'); // блок каждого товара
    // Устанавливаем обработчик события на каждую кнопку "Добавить в корзину"
        $('.item_add').on('click', addToCart);
    //Очистить корзину
    addEvent(d.querySelector('.basket_empty'),'click',empty);

    var cartData = getCartData();
    //проверка на нахождение в сторедже id товара
    for(var cart in cartData){
        checkGood(cart);
    }
    //получение цены всех товаров
    getTotal();
    //single good script
    var cartData = getCartData();
    if(!jQuery.isEmptyObject($('.single_good')[0])) {
        var id_in_cart = $('.single_good')[0].getAttribute('data-id');//берем id
        $('.single_good').on('click', single_good);//если корзина пустая то вешаем событие на домавление в корзину

        if (cartData != null && cartData != undefined) {
            for (var cartid in cartData) {
                if (id_in_cart == cartid) {
                    single_good();
                    $('.single_good').off('click', addToCart);// если совпадает id то отключаем событие добавления и вешаем редирект
                    $('.single_good').on('click', redirect);
                }
                else
                    $('.single_good').on('click', single_good);
            }
        }
    }
});
var d = document;
//Функция для кнопки в одном товаре
function single_good(){
    $('.single_good')[0].innerHTML='Already in cart';
    $('.single_good').css('background','green');
    $('.single_good').addClass('in_cart');
    $('.single_good').off('click',single_good);
}
//кнопка плюс
function cart_plus(){
    var id = this.getAttribute('data-id');
    var cartData = getCartData();
    cartData[id][2]+=1;
    setCartData(cartData);
    openBasket();
    getTotal();
}
//кнопка минус
function cart_minus(){
    var id = this.getAttribute('data-id');
    var cartData = getCartData();
    if(cartData[id][2]>1){
        cartData[id][2]-=1;
        setCartData(cartData);
        openBasket();
        getTotal();
    }
}
//очистить корзину
    function empty(){
        localStorage.removeItem('basket');
        getTotal();
        if(window.location.href==location.protocol+'//'+document.domain+'/checkout'){
            openBasket();//если это страница корзины то перегружается dom
        }
        else {
            var ok_icons = $('.button_in_cart');//смена кнопок в каталоге товаров
            if (ok_icons[0]) {
                ok_icons.removeClass('button_in_cart');
                ok_icons.addClass('button_buy');
                $('h4 a').off('click', redirect);
                $('h4 a').on('click', addToCart);
            }
            var in_cart = $('.in_cart');
            if(in_cart[0]){//смена кнопки в соло товаре и смена событий
                in_cart.off('click', redirect);
                in_cart.on('click', addToCart);
                in_cart.on('click', single_good);
                in_cart.removeClass('in_cart');
                in_cart[0].innerHTML='ADD TO CART';
                $('.single_good').css('background','black');
            }
        }
    }
//Отпределяем Всю сумму
    function getTotal() {
        var cartData = getCartData();
        itemTotal = d.querySelector('.basket_total');
        if (cartData != undefined) {
            var total = 0;
            for (var item in cartData) {
                total += (cartData[item][1] * cartData[item][2]);
            }
            itemTotal.innerHTML = '$'+total;

        }else
            itemTotal.innerHTML= '$0';
        return false;
    }
// Функция кроссбраузерной установка обработчика событий
       function addEvent(elem, type, handler){
           if(elem.addEventListener){
               elem.addEventListener(type, handler, false);
           } else {
               elem.attachEvent('on'+type, function(){ handler.call( elem ); });
           }
           return false;
       }
// Получаем данные из LocalStorage
       function getCartData(){
           return JSON.parse(localStorage.getItem('basket'));
       }
// Записываем данные в LocalStorage
       function setCartData(data){
           localStorage.setItem('basket', JSON.stringify(data));
            return false;
       }
// Добавляем товар в корзину
       function addToCart(e,price){
           this.disabled = true; // блокируем кнопку на время операции с корзиной
           var cartData = getCartData() || {}, // получаем данные корзины или создаём новый объект, если данных еще нет
               parentBox = this.parentNode.parentNode.parentNode, // родительский элемент кнопки "Добавить в корзину"
            itemId = this.getAttribute('data-id'), // ID товара
               itemName = parentBox.querySelector('.item_name').innerHTML, // название товара
               itemPrice = parentBox.querySelector('.item_price').innerHTML; // название товара

           if($(this).hasClass('single_good'))
               var itemImageLink = $('.image_link_single').attr('src');
           else
               var itemImageLink = parentBox.parentNode.querySelector('.image_link').src;


           itemAlias = $(this).attr('alias');

           // добавляем в объект
               cartData[itemId] = [itemName, itemPrice, 1,itemImageLink,itemAlias];

           if(!setCartData(cartData)){ // Обновляем данные в LocalStorage
               this.disabled = false; // разблокируем кнопку после обновления LS
           }
            getTotal();//пересчитываем всю сумму
            checkGood(itemId);// меняем кнопку на "в корзине"
           return false;
       }


// Открываем корзину со списком добавленных товаров
       function openBasket(e) {
           var cartCont = document.querySelector('.cart-items');// блок вывода данных корзины
           var cartData = getCartData(),// вытаскиваем все данные корзины
               totalPrice = 0,
               totalItems = '';
           var cart_container =  document.querySelector('.checkout');
               var check_bottom = $('.checkout_bottom');
           // если что-то в корзине уже есть, начинаем формировать данные для вывода
           if (cartData != null&&!($.isEmptyObject(cartData))) {
               totalItems = '<div class="in-check"><ul class="unit">' +
                   '<li><span>Item</span></li>' +
                   '<li><span>Product Name</span></li>' +
                   '<li><span>Unit Price</span></li>' +
                   '<li><span>Number of item</span></li>' +
                   '<li></li>' +
                   '<div class="clearfix"></div></ul>';


                   for (var items in cartData) {
                       totalItems += '<ul  data-id="' + items + '"class="cart-header delete' + items + '">' +
                           '<div class="close button_del' + items + '"></div><li class="ring-in"><a href="/single/' + cartData[items][4] + '">' +
                           '<img src="' + cartData[items][3] + '" class="img-responsive" alt=""></a></li>' +
                           '<li><span class="name">' + cartData[items][0] + '</span></li>' +
                           '<li><span class="cost">$' + cartData[items][1] + '</span></li>' +
                           '<li style="text-align: center"><a class="minus_button" data-id="'+items+'" style="font-size: 200%" href="javascript:;">-</a>' +
                           '<span style="text-align: center">' + cartData[items][2] + '</span>' +
                           '<a class="plus_button" data-id="'+items+'" style="font-size: 150%" href="javascript:;">+</a>' +
                           '</li><div class="clearfix"></div></ul>';

                       totalPrice+=(cartData[items][1]*cartData[items][2]);
                   }


                   totalItems += '</div>';
               cartCont.innerHTML = totalItems;

           if(check_bottom[0])
               check_bottom[0].remove();

           var bottom_checkout= '<div style="text-align:right" class="checkout_bottom">' +
               '<span class="cost basket_cost" >Total: $'+totalPrice+'</span>' +
               '<button  style="margin-top: -4.6%; margin-right: 90%" class="empty_cart btn btn-default"><span>Empty Cart</span></button>' +
               '<button style="margin-top:-8%;margin-right: 2%" id="pay" class="btn btn-success pay_button"><span >Pay</span></button></div>';

           cart_container.innerHTML += bottom_checkout;//basket bottom buttons
           addEvent(document.querySelector('.empty_cart'),'click',empty);//add event to empty button

               /*start of modal order*/

               $('#pay').click(function(){
                   $.ajax({
                       url: '/orderForm',
                       method: 'post',
                       headers: {
                           'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                       },
                       dataType:'Json',
                       beforeSend: function () {
                           $('#order_form p select[name="country_id"]')[0].innerHTML = '<option></option>';
                       },
                       success: function (data) {
                           var country_selector = '';
                           data.forEach(function (value,index) {
                               country_selector += '<option value="'+value.id+'">'+value.name+'</option>';
                           });

                           $('#order_form p select[name="country_id"]').append(country_selector);
                       }
                   });


                   $('#modal_order').css('display','block');
                   $('#modal_order').css('opacity','1');
                   $('#overlay').css('display','block');
               });


               $('#modal_close, #overlay').click( function(){ // лoвим клик пo крестику или пoдлoжке
                   $('#modal_order')
                       .animate({opacity: 0, top: '45%'}, 200,  // плaвнo меняем прoзрaчнoсть нa 0 и oднoвременнo двигaем oкнo вверх
                           function(){ // пoсле aнимaции
                               $(this).css('display', 'none'); // делaем ему display: none;
                               $('#overlay').fadeOut(400); // скрывaем пoдлoжку
                           }
                       );
               });
            //end modal order
               for(var item in cartData) {
                       (function (i) {
                           $('.button_del'+i).on('click', function (c) {
                               $('.delete' + i).fadeOut('slow', function (c) {
                                   $('.delete' + i).remove();
                                   basketDeleteOne(i);
                               });
                           });
                       }(item));
                   }
                $('.plus_button').on('click',cart_plus);
                $('.minus_button').on('click',cart_minus);
           }
           else
               {
                   // если в корзине пусто, то сигнализируем об этом
                   if(check_bottom[0])
                       check_bottom[0].remove();

                   cartCont.innerHTML = '<h1>Cart is empty!</h1>';
               }
               return false;
       }
       //redirect to Checkout
       function redirect(){
               window.location.replace(location.protocol+'//'+document.domain+"/checkout");
       }
       //Basket delete one Good
       function basketDeleteOne(id){
           var cartData = getCartData();
           delete cartData[id];
           setCartData(cartData);
           getTotal();
           if(window.location.href==location.protocol+'//'+document.domain+"/checkout"){
               openBasket();
           }
           return false;
       }
       //Check good in basket
       function checkGood(id){
           var a_button = $('.a_button'+id);
           a_button.removeClass('item_add');
           $('.icon'+id).removeClass('button_buy');
           $('.icon'+id).addClass('button_in_cart');
           a_button.off('click',addToCart);
           a_button.on('click',redirect);
       }

