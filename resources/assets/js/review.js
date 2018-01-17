$(document).ready(function(){
jQuery.validator.addMethod("name", function(value, element) {
    return this.optional(element) || /^[a-z ,.'-]+$/i.test(value);
}, "Please write correctly");

    var getUrlParameter = function getUrlParameter(sParam) {
        var sPageURL = decodeURIComponent(window.location.search.substring(1)),
            sURLVariables = sPageURL.split('&'),
            sParameterName,
            i;

        for (i = 0; i < sURLVariables.length; i++) {
            sParameterName = sURLVariables[i].split('=');

            if (sParameterName[0] === sParam) {
                return sParameterName[1] === undefined ? true : sParameterName[1];
            }
        }
    };


    $("#review_form").validate({

        rules: {
            message: {
                required: true,
                minlength: 15,
                maxlength: 5000,
                name: false
            },
            /* first_name: {
                 required: true,
                 name: true
             },
             last_name: {
                 required: true,
                 name: true
             },*/
        },
        messages: {
            /*  first_name: {
                  required: "Please specify your name",
                  name: "Please write correct name"
              },
              last_name: {
                  required: "Please specify your last name",
                  name: "Please write correct last name"
              },*/
        },
        submitHandler: function (form) {
            $.ajax({
                url: '/review_create',
                method: 'post',
                headers: {
                    dataType: 'json',
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    content: $('textarea[name=content]').val(),
                    alias: (function() {
                            if(getUrlParameter('page'))
                                return window.location.href.substr(window.location.href.lastIndexOf('/') + 1).indexOf('?');

                            return window.location.href.substr(window.location.href.lastIndexOf('/') + 1);

                             })()
                },
                beforeSend: function () {
                    $('body').loadingModal({text: 'Loading...'});
                },
                success: function (data) {
                    $('body').loadingModal('hide');
                    $('body').loadingModal('destroy');

                    location.reload();
                }
            })
        }
    })
})


