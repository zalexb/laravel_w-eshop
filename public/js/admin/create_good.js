$(document).ready(function () {
    jQuery.validator.addMethod("name", function(value, element) {
        return this.optional(element) || /^[a-z ]+$/i.test(value);
    }, "Please write correctly");

    $.validator.addMethod('file_size', function (value, element, param) {
        return this.optional(element) || (element.files[0].size <= param)
    }, 'File size must be less than {0}');

    $("#create_good").validate({


        rules: {
            'images[]':{
                required:true,
                name: false,
                extension: "jpg|jpeg|png",
                file_size: 300000,
            },
            categories:{
                required:true,
                name: false,
            },
            description:{
                name:false,
                required:true
            },
            name: {
                required: true,
                name:false
            },
            price: {
                required: true,
                number: true,
                name:false
            },
            brand: {
                required: true,
                name:false
            },
            guarantee: {
                required: true,
                name:false
            },
            case_depth_approx_mm: {
                required: true,
                number:true,
                name:false
            },
            case_width_approx_mm:{
                required: true,
                number:true,
                name:false
            },
            color:{
                required: true,
                name:true
            },
            water_resistancy_m:{
                required: true,
                number:true,
                name:false
            },
            case_material:{
                required:true,
                name:true
            },
            discount_percent:{
                number:true,
                name:false,
                max:90,
                min:0
            },
            public:{
                required:true,
                name:false
            },
            stock:{
                required:true,
                name:false
            },
            MPN:{
                required:true,
                name:false
            }

        },

        submitHandler: function (form) {
            $('#create_good').attr('action','/admin/create_good');
            $('#create_good').attr('method','POST');
            form.submit();
        }
    });



    $('#fileToUpload').change(function () {
        var file = document.getElementById('fileToUpload').files[0];
        if (file) {
            var fileSize = 0;
            if (file.size > 1024 * 1024)
                fileSize = (Math.round(file.size * 100 / (1024 * 1024)) / 100).toString() + 'MB';
            else
                fileSize = (Math.round(file.size * 100 / 1024) / 100).toString() + 'KB';

            document.getElementById('fileName').innerHTML = 'Name: ' + file.name;
            document.getElementById('fileSize').innerHTML = 'Size: ' + fileSize;
            document.getElementById('fileType').innerHTML = 'Type: ' + file.type;
        }
    });

});
