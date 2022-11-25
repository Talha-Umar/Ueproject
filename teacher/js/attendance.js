$(document).ready(function(){

$("#Shift").change(function(){
        var shid = $(this).val();
        var tid = $("#teacher").val();

        $.ajax({
            url: '../others/getteachercourses.php',
            type: 'post',
            data: {shid:shid,tid:tid},
            dataType: 'json',
            success:function(response){

                var len = response.length;

                $("#Course").empty();
                for( var i = 0; i<len; i++){
                    var id = response[i]['id'];
                    var name = response[i]['name'];
                    
                    $("#Course").append("<option value='"+id+"'>"+name+"</option>");

                }
            }
        });
    });

$("#Course").click(function(){
        var cid = $(this).val();
        var shid = $("#Shift").val();

        $.ajax({
            url: '../others/searchstudents.php',
            type: 'post',
            data: {cid:cid,shid:shid},
            dataType: 'html',
            success:function(response){

                $("#searchdata").html(response);

                
            }
        });
    });

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
        var date = $("#date").val();
        $.ajax({
            url: '../others/teacher-view-attendance.php',
            type: 'post',
            data: {cid:cid,shid:shid,date:date},
            dataType: 'html',
            success:function(response){

                $("#Search").html(response);

                
            }
        });
    });
$("#course").change(function(){
        var cid = $(this).val();
        var shid = $("#shift").val();
        var date = $("#date").val();
        $.ajax({
            url: '../others/teacher-view-attendance.php',
            type: 'post',
            data: {cid:cid,shid:shid,date:date},
            dataType: 'html',
            success:function(response){

                $("#Search").html(response);

                
            }
        });
    });

$("#date").change(function(){
        var cid = $("#course").val();
        var shid = $("#shift").val();
        var date = $(this).val();
        $.ajax({
            url: '../others/teacher-view-attendance.php',
            type: 'post',
            data: {cid:cid,shid:shid,date:date},
            dataType: 'html',
            success:function(response){

                $("#Search").html(response);

                
            }
        });
    });






	});