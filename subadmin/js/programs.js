$(document).ready(function(){

// get value of id and values when action is edit and data-role=edit for updating data
$(document).on('click','a[data-role=edit]',function(){
	var id=$(this).data('id');
	var code=$('#'+id).children('td[data-target=code]').text();
	var name=$('#'+id).children('td[data-target=name]').text();
	var did=$('#'+id).children('td[data-target=did]').text();
	var department=$('#'+id).children('td[data-target=department]').text();
	var nsemester=$('#'+id).children('td[data-target=nsemester]').text();
	
	$('#code').val(code);
	$('#name').val(name);
	$('#department').val(did);
	$('#department').text(department);
	$('#nsemester').val(nsemester);

	$('#userid').val(id);
});
// get value of id when action is delete and data-role=delete for delete data
$(document).on('click','a[data-role=delete]',function(){
	var id=$(this).data('id');
	$('#id').val(id);
});

	});