$(document).ready(function () {

   function ajax_req(value,name,element) {
       $(window).off('click');

       var check = false;


       $('.errors').empty();

       //regulars starts
       if(name=='price'||name=='case_depth_approx_mm'||name=='case_width_approx_mm'||name=='water_resistancy_m') {
           if(!value.match(/^[0-9]+$/)){
               $('.errors').remove();
               element.parent().append(
                   '<p class="errors" style=";font-size:130%;color:red;font-weight:bold;text-decoration: underline">' +
                   'This field must be number</p>');
           }
           else
               check = true;
       }
       else if(name=='color') {
           if(!value.match(/^[a-zA-Z]+$/)){
               $('.errors').remove();
               element.parent().append(
                   '<p  class="errors" style=";font-size:130%;color:red;font-weight:bold;text-decoration: underline">' +
                   'This field must be correct</p>');
           }
           else
               check = true;
       }
       else if(name=='case_material'){
           if(!value.match(/^[a-zA-Z\s]+$/)){
               $('.errors').remove();
               element.parent().append(
                   '<p  class="errors" style=";font-size:130%;color:red;font-weight:bold;text-decoration: underline">' +
                   'This field must be string</p>');
           }
           else
               check = true;
       }
       else if(name=='MPN'){
           if(!value.match(/^([a-zA-Z0-9]+)$/)) {
               $('.errors').remove();
               element.parent().append(
                   '<p  class="errors" style=";font-size:130%;color:red;font-weight:bold;text-decoration: underline">' +
                   'This field must be correct</p>');
           }
           else
               check = true;

       }
       else if(name=='name'){
           if(!value.match(/^([a-zA-Z0-9\s]+)$/)) {
               $('.errors').remove();
               element.parent().append(
                   '<p  class="errors" style=";font-size:130%;color:red;font-weight:bold;text-decoration: underline">' +
                   'This field must be correct</p>');
           }
           else
               check = true;
       }
       else if(name=='discount_percent'){
           if(!value.match(/^[0-9]{1,2}$/)) {
               $('.errors').remove();
               element.parent().append(
                   '<p  class="errors" style=";font-size:130%;color:red;font-weight:bold;text-decoration: underline">' +
                   'This field must be correct</p>');
           }
           else
               check = true;
       }
       else{
           if(!value.match(/^([a-zA-Z0-9\s.,'-]+)$/)) {
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
               url:'/admin/'+id+'/edit',
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

   function select_change() {
       var value = $(this).val();
       var name = $(this).attr('name');

       var id = window.location.href.split('/')[5];

       $.ajax({
           url:'/admin/'+id+'/edit',
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
           }
       })
   }
   
    function delete_category() {
        var conf = confirm('Are you sure?');
        if(conf==true){
            $(this).off('click');
            $(this).parent().remove();

            var category_id = $(this).attr('data-id');
            var id = window.location.href.split('/')[5];

            $.ajax({
                url:'/admin/'+id+'/category',
                method:'post',
                headers: {
                    dataType:'json',
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    id: category_id
                },
                success: function(data){
                    $('.errors').remove();
                    if(data=='no_access'){
                        $('.item_category').append(
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
            $('#edit_image').attr('action','/admin/'+id+'/image_add');
            $('#edit_image').attr('method','post');
            form.submit();
        }

    });
    
    function delete_image() {
        var conf = confirm('Are you sure?');
        var image_id = $(this).parent().attr('data-id');
        var id = window.location.href.split('/')[5];
        var div = $(this).parent();

        if(conf==true){
            $.ajax({
                url:'/admin/'+id+'/image_delete',
                method:'post',
                headers: {
                    dataType:'json',
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data:{
                    image_id:image_id
                },
                success: function(data) {
                    if(data=='ok'){
                        div.remove();
                    }else {
                        $('.errors').remove();
                        div.parent()   .append(
                            '<p class="errors" style=";font-size:130%;color:red;font-weight:bold;text-decoration: underline">' +
                            'Users have no access to edit!</p>');
                    }
                }
            });
        }

    }

    function change_main_img() {

        var image_id = $(this).parent().parent().attr('data-id');
        var id = window.location.href.split('/')[5];
        var div = $(this).parent().parent();

        $.ajax({
            url:'/admin/'+id+'/image_main_change',
            method:'post',
            headers: {
                dataType:'json',
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data:{
                image_id:image_id
            },
            success: function(data) {
                if(data=='no_access'){
                    $('.errors').remove();
                    div.append(
                        '<p class="errors" style=";font-size:130%;color:red;font-weight:bold;text-decoration: underline">' +
                        'Users have no access to edit!</p>');
                }else {
                    $('.images_checkbox').attr('src','/images/checkbox_empty.ico');
                    $('img[data-id='+image_id+']').attr('src','/images/checkbox_ok.ico');
                }
            }
        });
    }

    $('.image_delete').on('click',delete_image);
    $('.change_main_img').on('click',change_main_img);



    //images ends


    $('.category_delete').on('click',delete_category);
    $('.select_single').on('change',select_change);
    $('.single_value').on('dblclick',area_show);

    $('.category_button').on('click',function () {


        $('#add_category_div').remove();

        var id = window.location.href.split('/')[5];

        $.ajax({
            url:'/admin/'+id+'/category_check',
            method:'get',
            headers: {
                dataType:'json',
            },
            success: function(data){

                if(data.length==0){
                    $('.errors').remove();
                    $('.item_category').append(
                        '<p class="errors" style=";font-size:130%;color:red;font-weight:bold;text-decoration: underline">' +
                        '<br>Nothing to add!</p>');
                }
                else{

                    var select = '<div id="add_category_div"><br><select class="category_add">';

                    for(var el in data){
                        select += '<option value="'+data[el].id+'">'+data[el].name+'</option>'
                    };

                    select += '</select><br><button style="margin-top:10px" id="category_add_ok">Add</button></div>';

                    $('.item_category').append(select);
                    //
                    $('#category_add_ok').click(function () {
                        $(this).prop('disabled', true);

                        var id = window.location.href.split('/')[5];

                        var category_id = $('.category_add').val();
                        $.ajax({
                            url:'/admin/'+id+'/category_add',
                            method:'post',
                            headers: {
                                dataType:'json',
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            data:{
                                id:category_id
                            },
                            success: function(data) {
                                $(this).prop('disabled', false);
                                if(data=='no_access'){
                                    $('.errors').remove();
                                    $('.item_category').append(
                                        '<p class="errors" style=";font-size:130%;color:red;font-weight:bold;text-decoration: underline">' +
                                        'Users have no access to edit!</p>');
                                }else {
                                    $('#categories_single').append(
                                        '<span style="padding: 7px; border: 1px solid black" class="single">' +
                                        data.name +
                                        '<a data-id="'+data.id+'" class="category_delete" style="padding-left: 10px;color:black" href="javascript:;">' +
                                        'x' +
                                        '</a></span>'
                                    );
                                    $('.category_delete').off('click',delete_category);
                                    $('.category_delete').on('click',delete_category);
                                    $('#add_category_div').remove();

                                }
                            }
                        });
                    })
                }
            }
        })

    });
});