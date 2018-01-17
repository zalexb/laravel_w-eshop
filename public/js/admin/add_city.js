$(document).ready(function () {
    jQuery.validator.addMethod("name", function(value, element) {
        return this.optional(element) || /^[a-z]+$/i.test(value);
    }, "Please write correctly");


    $("#add_city").validate({


        rules: {
            name:{
                name:true,
                required:true
            },
            country:{
                required:true,
                name:false
            }

        },

        submitHandler: function (form) {
            $('#add_city').attr('action','/admin/add_city');
            $('#add_city').attr('method','POST');
            form.submit();
        }
    });
});
