$(document).ready(function(){

// get value of id and values when action is edit and data-role=edit for updating data
$(document).on('click','a[data-role=edit]',function(){
	var id=$(this).data('id');
	var name=$('#'+id).children('td[data-target=name]').text();
	var uname=$('#'+id).children('td[data-target=uname]').text();
	var email=$('#'+id).children('td[data-target=email]').text();
	var mobile=$('#'+id).children('td[data-target=mobile]').text();
	var did=$('#'+id).children('td[data-target=did]').text();
	var department=$('#'+id).children('td[data-target=department]').text();
	
	$('#name').val(name);
	$('#uname').val(uname);
	$('#email').val(email);
	$('#mobile').val(mobile);
	$('#department').val(did);
	$('#department').text(department);
	$('#userid').val(id);
});
// get value of id when action is delete and data-role=delete for delete data
$(document).on('click','a[data-role=delete]',function(){
	var id=$(this).data('id');
	$('#id').val(id);
});

	});