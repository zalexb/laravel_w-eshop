$(document).ready(function () {
    jQuery.validator.addMethod("name", function(value, element) {
        return this.optional(element) || /^[a-z]+$/i.test(value);
    }, "Please write correctly");


    $("#add_country").validate({


        rules: {
            name:{
                name:true,
                required:true
            },

        },

        submitHandler: function (form) {
            $('#add_country').attr('action','/admin/add_country');
            $('#add_country').attr('method','POST');
            form.submit();
        }
    });
});
