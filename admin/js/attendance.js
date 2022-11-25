$(document).ready(function(){

$("#shift").change(function(){
        var shid = $(this).val();
        var sesid =$("#session").val();
        var progid =$("#program").val();
        

        $.ajax({
            url: '../others/getcourse.php',
            type: 'post',
            data: {progid:progid,sesid:sesid,shid:shid},
            dataType: 'json',
            success:function(response){

                var len = response.length;

                $("#course").empty();
                for( var i = 0; i<len; i++){
                    var id = response[i]['id'];
                    var name = response[i]['name'];
                    
                    $("#course").append("<option value='"+id+"'>"+name+"</option>");

                }
            }
        });
    });

$("#course").click(function(){
        var cid = $(this).val();
        var sid =$("#session").val();
        var pid =$("#program").val();
         var shid =$("#shift").val();
        

        $.ajax({
            url: '../others/admin-view-attendance.php',
            type: 'post',
            data: {pid:pid,sid:sid,shid:shid,cid:cid},
            dataType: 'html',
            success:function(response){

                
                    
                    $("#Search").html(response);

                
            }
        });
    });

$("#course").change(function(){
        var cid = $(this).val();
        var sid =$("#session").val();
        var pid =$("#program").val();
         var shid =$("#shift").val();
        

        $.ajax({
            url: '../others/admin-view-attendance.php',
            type: 'post',
            data: {pid:pid,sid:sid,shid:shid,cid:cid},
            dataType: 'html',
            success:function(response){

                
                    
                    $("#Search").html(response);

                
            }
        });
    });

});