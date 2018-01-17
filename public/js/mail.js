$(document).ready(function () {
    jQuery.validator.addMethod("name", function(value, element) {
        return this.optional(element) || /^[a-z ]+$/i.test(value);
    }, "Please write correctly");


    $("#create_mail").validate({


        rules: {
            name: {
                required: true,
                name: true
            },
            message: {
                required: true,
                name: false
            },
            phone: {
                required: true,
                name: false,
                number:true,
                min:5
            },
            email:{
                required: true,
                name: false,
                email:true
            }
        },

        submitHandler: function (form) {
            $('#create_mail').attr('action','/mail');
            $('#create_mail').attr('method','POST');
            form.submit();
        }
    });


});
