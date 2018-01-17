$(document).ready(function () {

    function ajax_req(value,name,element) {
        $(window).off('click');

        var check = false;


        $('.errors').empty();

        //regulars starts

        if(name=='first_name'||name=='last_name') {
            if(!value.match(/^[a-zA-Z]+$/)){
                $('.errors').remove();
                element.parent().append(
                    '<p  class="errors" style=";font-size:130%;color:red;font-weight:bold;text-decoration: underline">' +
                    'This field must be correct</p>');
            }
            else
                check = true;
        }
        else if(name=='email'){
            if(!value.match(/^([a-z0-9_\.-]+)@([a-z0-9_\.-]+)\.([a-z\.]{2,6})$/)){
                $('.errors').remove();
                element.parent().append(
                    '<p  class="errors" style=";font-size:130%;color:red;font-weight:bold;text-decoration: underline">' +
                    'This field must be string</p>');
            }
            else
                check = true;
        }
        else if(name=='phone'){
            if(!value.match(/^([0-9]+)$/)) {
                $('.errors').remove();
                element.parent().append(
                    '<p  class="errors" style=";font-size:130%;color:red;font-weight:bold;text-decoration: underline">' +
                    'This field must be correct</p>');
            }
            else
                check = true;

        }


//regulars ends

        var id = window.location.href.split('/')[5];

        if(check == true){
            $.ajax({
                url:'/admin/user/'+id+'/edit',
                method:'post',
                headers: {
                    dataType:'json',
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    name:name,
                    value:value
                },
                success: function(data){
                    $('.errors').remove();
                    if(data=='no_access'){
                        element.parent().append(
                            '<p class="errors" style=";font-size:130%;color:red;font-weight:bold;text-decoration: underline">' +
                            'Users have no access to edit!</p>');
                    }
                    else{
                        element[0].innerHTML = data;
                    }
                }
            })
        }
    }

    function area_show(){
        var html = $(this)[0].innerHTML;
        var name = $(this).attr('name');
        var el = $(this);


        $(this)[0].innerHTML = '<textarea id="area_container" name="'+name+'">' + html +'</textarea>';

        $(this).off('dblclick');//off event for clicking inside area

        //click any place
        $(window).click(function() {

            el.off('dblclick');


            el.on('dblclick',area_show);

            ajax_req($('#area_container').val(),name,el);

            el[0].innerHTML = html;
        });

        //stops window event on clicking inside area
        $('#area_container').click(function(event){
            event.stopPropagation();
        });
    }
$('.single_value').on('click')

    function delete_role() {
        var conf = confirm('Are you sure?');
        if(conf==true){
            $(this).off('click');
            $(this).parent().remove();

            var role_id = $(this).attr('data-id');
            var id = window.location.href.split('/')[5];

            $(this).prop('disabled', true);
            $.ajax({
                url:'/admin/user/'+id+'/delete_role',
                method:'post',
                headers: {
                    dataType:'json',
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    id: role_id
                },
                success: function(data){
                    $('.errors').remove();
                    $(this).prop('disabled', false);
                    if(data=='no_access'){
                        $('.item_role').append(
                            '<p class="errors" style=";font-size:130%;color:red;font-weight:bold;text-decoration: underline">' +
                            'Users have no access to edit!</p>');

                    }
                }
            })
        }
    }



//images starts
    $('.edit_image').click(function () { //image button click
        $('.edit_image').css('display', 'none');

        $('#edit_image').css('display', 'block');
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
    var id = window.location.href.split('/')[5];
    $.validator.addMethod('file_size', function (value, element, param) {
        return this.optional(element) || (element.files[0].size <= param)
    }, 'File size must be less than {0}');

    $("#edit_image").validate({

        rules: {
            avatar: {
                required:true,
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
            $('#edit_image').attr('action','/admin/user/'+id+'/avatar_change');
            $('#edit_image').attr('method','post');
            form.submit();
        }

    });


    //images ends


    $('.role_delete').on('click',delete_role);

    $('.single_value').on('dblclick',area_show);

    $('.role_button').on('click',function () {

        $('#add_role_div').remove();

        var id = window.location.href.split('/')[5];

        $.ajax({
            url:'/admin/user/'+id+'/role_check',
            method:'get',
            headers: {
                dataType:'json',
            },
            success: function(data){
                if(data.length==0){
                    $('.errors').remove();
                    $('.item_role').append(
                        '<p class="errors" style=";font-size:130%;color:red;font-weight:bold;text-decoration: underline">' +
                        '<br>Nothing to add!</p>');
                }
                else{

                    var select = '<div id="add_role_div"><br><select class="role_add">';

                    for(var el in data){
                        select += '<option value="'+data[el].id+'">'+data[el].name+'</option>'
                    };

                    select += '</select><br><button style="margin-top:10px" id="role_add_ok">Add</button></div>';

                    $('.user_role').append(select);
                    //
                    $('#role_add_ok').click(function () {


                        var id = window.location.href.split('/')[5];

                        var role_id = $('.role_add').val();
                        $.ajax({
                            url:'/admin/user/'+id+'/role_add',
                            method:'post',
                            headers: {
                                dataType:'json',
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            data:{
                                id:role_id
                            },
                            success: function(data) {
                                if(data=='no_access'){
                                    $('.errors').remove();
                                    $('.user_role').append(
                                        '<p class="errors" style=";font-size:130%;color:red;font-weight:bold;text-decoration: underline">' +
                                        'Users have no access to edit!</p>');
                                }else {

                                    $('#roles_single').append(
                                        '<span style="padding: 7px; border: 1px solid black" class="single">' +
                                        data.name +
                                        '<a data-id="'+data.id+'" class="role_delete" style="padding-left: 10px;color:black" href="javascript:;">' +
                                        'x' +
                                        '</a></span>'
                                    );
                                    $('.role_delete').off('click',delete_role);
                                    $('.role_delete').on('click',delete_role);
                                    $('#add_role_div').remove();

                                }
                            }
                        });
                    })
                }
            }
        })

    });
});