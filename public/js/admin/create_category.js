$(document).ready(function () {
    jQuery.validator.addMethod("name", function(value, element) {
        return this.optional(element) || /^[a-z]+$/i.test(value);
    }, "Please write correctly");


    $("#create_category").validate({


        rules: {
            name:{
                name:true,
                required:true
            },

        },

        submitHandler: function (form) {
            $('#create_category').attr('action','/admin/create_category');
            $('#create_category').attr('method','POST');
            form.submit();
        }
    });
});
