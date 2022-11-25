$(document).ready(function(){

$("#department").change(function(){
        var did = $(this).val();

        $.ajax({
            url: '../others/getteachers.php',
            type: 'post',
            data: {did:did},
            dataType: 'json',
            success:function(response){

                var len = response.length;

                $("#teacher").empty();
                for( var i = 0; i<len; i++){
                    var id = response[i]['id'];
                    var name = response[i]['name'];
                    
                    $("#teacher").append("<option value='"+id+"'>"+name+"</option>");

                }
            }
        });
    });

$("#program").change(function(){
        var pid = $(this).val();

        $.ajax({
            url: '../others/getsemesters.php',
            type: 'post',
            data: {pid:pid},
            dataType: 'json',
            success:function(response){

                var len = response.length;

                $("#semester").empty();
                for( var i = 0; i<len; i++){
                    var id = response[i]['id'];
                    var name = response[i]['name'];
                    
                    $("#semester").append("<option value='"+id+"'>"+name+"</option>");

                }
            }
        });
    });
$("#semester").change(function(){
        var sid = $(this).val();

        var pid = $("#program").val();

        $.ajax({
            url: '../others/getcourses.php',
            type: 'post',
            data: {pid:pid, sid:sid},
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

$("#Department").change(function(){
        var did = $(this).val();

        $.ajax({
            url: '../others/getteachers.php',
            type: 'post',
            data: {did:did},
            dataType: 'json',
            success:function(response){

                var len = response.length;

                $("#Teacher").empty();
                for( var i = 0; i<len; i++){
                    var id = response[i]['id'];
                    var name = response[i]['name'];
                    
                    $("#Teacher").append("<option value='"+id+"'>"+name+"</option>");

                }
            }
        });
    });

$("#Program").change(function(){
        var pid = $(this).val();

        $.ajax({
            url: '../others/getsemesters.php',
            type: 'post',
            data: {pid:pid},
            dataType: 'json',
            success:function(response){

                var len = response.length;

                $("#Semester").empty();
                for( var i = 0; i<len; i++){
                    var id = response[i]['id'];
                    var name = response[i]['name'];
                    
                    $("#Semester").append("<option value='"+id+"'>"+name+"</option>");

                }
            }
        });
    });
$("#Semester").change(function(){
        var sid = $(this).val();

        var pid = $("#Program").val();

        $.ajax({
            url: '../others/getcourses.php',
            type: 'post',
            data: {pid:pid, sid:sid},
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

// get value of id and values when action is edit and data-role=edit for updating data
$(document).on('click','a[data-role=edit]',function(){
    var id=$(this).data('id');
    var tid=$('#'+id).children('td[data-target=tid]').text();
    var teacher=$('#'+id).children('td[data-target=teacher]').text();
    var did=$('#'+id).children('td[data-target=did]').text();
    var department=$('#'+id).children('td[data-target=department]').text();
    var pid=$('#'+id).children('td[data-target=pid]').text();
    var program=$('#'+id).children('td[data-target=program]').text();
    var cid=$('#'+id).children('td[data-target=cid]').text();
    var course=$('#'+id).children('td[data-target=course]').text();
    var ssid=$('#'+id).children('td[data-target=ssid]').text();
    var session=$('#'+id).children('td[data-target=session]').text();
    var semester=$('#'+id).children('td[data-target=semester]').text();
    var shid=$('#'+id).children('td[data-target=shid]').text();
    var shift=$('#'+id).children('td[data-target=shift]').text();
    
    $('#depart').val(did);
    $('#depart').text(department);

    $('#teach').val(tid);
    $('#teach').text(teacher);

    $('#prog').val(pid);
    $('#prog').text(program);

    $('#sems').val(semester);
    $('#sems').text(semester);
    
    $('#cours').val(cid);
    $('#cours').text(course);

    $('#ses').val(ssid);
    $('#ses').text(session);

    $('#shif').val(shid);
    $('#shif').text(shift);

    $('#userid').val(id);
});
// get value of id when action is delete and data-role=delete for delete data
$(document).on('click','a[data-role=delete]',function(){
    var id=$(this).data('id');
    $('#id').val(id);
});

	});