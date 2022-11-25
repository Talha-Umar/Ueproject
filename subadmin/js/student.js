$(document).ready(function(){



// get value of id and values when action is edit and data-role=edit for updating data
$(document).on('click','a[data-role=edit]',function(){
    var id=$(this).data('id');
    var rollno=$('#'+id).children('td[data-target=rollno]').text();
    var name=$('#'+id).children('td[data-target=name]').text();
    var cnic=$('#'+id).children('td[data-target=cnic]').text();
    var email=$('#'+id).children('td[data-target=email]').text();
    var contact=$('#'+id).children('td[data-target=contact]').text();
    var address=$('#'+id).children('td[data-target=address]').text();
     var pgid=$('#'+id).children('td[data-target=pgid]').text();
     var program=$('#'+id).children('td[data-target=program]').text();
     var ssid=$('#'+id).children('td[data-target=ssid]').text();
     var session=$('#'+id).children('td[data-target=session]').text();
     var smid=$('#'+id).children('td[data-target=smid]').text();
     var semester=$('#'+id).children('td[data-target=semester]').text();
      var shid=$('#'+id).children('td[data-target=shid]').text();
      var shift=$('#'+id).children('td[data-target=shift]').text();
    
    $('#name').val(name);
    $('#rollno').val(rollno);
    $('#cnic').val(cnic);
    $('#email').val(email);
    $('#contact').val(contact);
    $('#address').val(address);
    $('#program').val(pgid);
    $('#program').text(program);
    $('#session').val(ssid);
    $('#session').text(session);
    $('#shift').val(shid);
    $('#shift').text(shift);


    $('#userid').val(id);
});
// get value of id when action is delete and data-role=delete for delete data
$(document).on('click','a[data-role=delete]',function(){
    var id=$(this).data('id');
    $('#id').val(id);
});

	});