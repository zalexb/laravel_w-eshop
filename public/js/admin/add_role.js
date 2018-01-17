$(document).ready(function () {
    jQuery.validator.addMethod("name", function(value, element) {
        return this.optional(element) || /^[a-z]+$/i.test(value);
    }, "Please write correctly");


    $("#add_role").validate({


        rules: {
            name:{
                name:true,
                required:true
            },
            slug:{
                name:true,
                required:true
            }

        },

        submitHandler: function (form) {
            $('#add_role').attr('action','/admin/add_role');
            $('#add_role').attr('method','POST');
            form.submit();
        }
    });
});
