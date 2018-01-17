$(document).ready(function () {
   $('select[name="active"]').on('change',function () {

       var id = window.location.href.split('/')[5];
       var url = '/admin/active_change/'+id;

       $.ajax({
           url:url,
           method:'post',
           headers: {
               dataType:'json',
               'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
           },
           data:{
               'active':$('select[name="active"]').val()
           },
           success: function(data){
               if(data=='no access'){
                   $('.single-error').append('<h3 style="color:red">Users have no access to edit</h3>')
               }
           }
       })
   })
});
