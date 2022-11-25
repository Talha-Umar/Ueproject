$(document).ready(function(){

$("#shift").change(function(){
        var shid = $(this).val();
        var tid = $("#teacher").val();

        $.ajax({
            url: '../others/getteachercourses.php',
            type: 'post',
            data: {shid:shid,tid:tid},
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
        var shid = $("#shift").val();

        $.ajax({
            url: '../others/teacher-view-allattendance.php',
            type: 'post',
            data: {cid:cid,shid:shid},
            dataType: 'html',
            success:function(response){

                $("#Search").html(response);
                
            }
        });
    });


	});