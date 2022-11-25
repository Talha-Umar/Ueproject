$(document).ready(function(){

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

$("#Sem").click(function(){
        var pid = $("#Prog").val();

        $.ajax({
            url: '../others/getsemesters.php',
            type: 'post',
            data: {pid:pid},
            dataType: 'json',
            success:function(response){

                var len = response.length;

                $("#Sem").empty();
                for( var i = 0; i<len; i++){
                    var id = response[i]['id'];
                    var name = response[i]['name'];
                    
                    $("#Sem").append("<option value='"+id+"'>"+name+"</option>");

                }
            }
        });
    });


// get value of id and values when action is edit and data-role=edit for updating data
$(document).on('click','a[data-role=edit]',function(){
    var id=$(this).data('id');
    var code=$('#'+id).children('td[data-target=code]').text();
    var name=$('#'+id).children('td[data-target=name]').text();
    var pid=$('#'+id).children('td[data-target=pid]').text();
    var program=$('#'+id).children('td[data-target=program]').text();
    var chid=$('#'+id).children('td[data-target=chid]').text();
    var chours=$('#'+id).children('td[data-target=chours]').text();
    var semester=$('#'+id).children('td[data-target=semester]').text();
    $('#code').val(code);
    $('#name').val(name);
    $('#program').val(pid);
    $('#program').text(program);
    $('#hour').val(chid);
    $('#hour').text(chours);
    $('#semester').val(semester);
    $('#semester').text(semester);
    $('#userid').val(id);
});
// get value of id when action is delete and data-role=delete for delete data
$(document).on('click','a[data-role=delete]',function(){
    var id=$(this).data('id');
    $('#id').val(id);
});

	});