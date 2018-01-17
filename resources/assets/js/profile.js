$(document).ready(function () {
//edit_image starts
    var url = window.location.pathname;
    var url_parse = url.split('/');
    var id =  url_parse[1];
    //after adding file in input
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

    $('.edit_image').click(function () { //image button click
        $('.edit_image').css('display', 'none');

        $('#edit_image').css('display', 'block');
    });

    $.validator.addMethod('file_size', function (value, element, param) {
        return this.optional(element) || (element.files[0].size <= param)
    }, 'File size must be less than {0}');

    $.validator.addMethod("name", function(value, element) {
        return this.optional(element) || /^[a-z ,.'-]+$/i.test(value);
    }, "Please write correctly");

    $("#edit_image").validate({

        rules: {
            avatar: {
                required:true,
                name: false,
                extension: "jpg|jpeg|png",
                file_size: 300000,
            },
        },
        messages:{
            avatar:{
                file_size: 'File size must be less than 300KB',
                extension: 'Extension must be jpg, jpeg or png'
            }
        },
        submitHandler: function(form) {
            $('#edit_image').attr('action','/'+id+'/edit');
            $('#edit_image').attr('method','post');
            form.submit();
        }

    });
//edit image ends
    /*edit form starts*/
    var edit = function () {

        $('#edit .edit_button').css('display', 'none');

        $('#edit_form').css('display', 'block');
    };

    $('#edit .edit_button').click(edit);// edit profile click


    if (window.location.href.includes('edit')){ //auto open edit div
        edit();
    }





    $("#edit_form").validate({

        rules: {
            phone: {
                number: true,
                minlength: 6,
                maxlength: 20,
                name: false
            },
            first_name: {
                name: true
            },
            last_name: {
                name: true
            },
            email: {
                email: true,
                name: false,
                remote: {
                    url: "/email/check",
                    type: "post",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: {
                        username: function () {
                            return $("#edit_form input[name=email]").val();
                        }
                    },
                    dataFilter: function(data){
                        if(data=='Ok')
                            return true;
                        return false;
                    },
                    dataType: 'text'
                }
            },
            password: {
                minlength: 5,
                name: false
            },
            confirm_password: {
                minlength: 5,
                equalTo: "input[name='password']",
                name: false
            }
        },
        messages: {
            phone:{
                number: 'This field must be in format of 380964477115',
                minlength: 'This field must be in format of 380964477115',
                maxlength: 'This field must be in format of 380964477115'
            },
            first_name: {
                name: "Please write correct name"
            },
            last_name: {
                name: "Please write correct last name"
            },
            email: {
                email: "Your email address must be in the format of name@domain.com",
                remote: 'This email is already in use!'
            },
            confirm_password:{
                equalTo: 'Please enter the same password'
            }

        },
        submitHandler: function(form) {
            var data_update = {};

            if($.trim($('#edit_form input[name=first_name]').val())!="")
                data_update.first_name = $('#edit_form input[name=first_name]').val();

            if($.trim($('#edit_form input[name=last_name]').val())!="")
                data_update.last_name = $('#edit_form input[name=last_name]').val();

            if($.trim($('#edit_form input[name=email]').val())!="")
                data_update.email = $('#edit_form input[name=email]').val();

            if($.trim($('#edit_form input[name=phone]').val())!="")
                data_update.phone = $('#edit_form input[name=phone]').val();

            if($.trim($('#edit_form input[name=password]').val())!="")
                data_update.password = $('#edit_form input[name=password]').val();

            $.ajax({
                url:'/'+id+'/edit',
                method:'post',
                headers: {
                    dataType:'json',
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: data_update,
                beforeSend:function(){
                    $('body').loadingModal({text: 'Loading...'});
                    $('#edit_form').empty();
                },
                success: function(data){
                    $('body').loadingModal('hide');
                    $('body').loadingModal('destroy');

                    if(data=="Ok")
                        location.reload();
                }
            })
        }
    })
//edit form ends
    //order starts
});