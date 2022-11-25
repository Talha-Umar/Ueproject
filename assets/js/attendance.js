$(document).ready(function(){

// get value of id and values when action is edit and data-role=edit for updating data
$(document).on('click','a[data-role=edit]',function(){
	var id=$(this).data('id');
	var name=$('#'+id).children('td[data-target=name]').text();
	var timein=$('#'+id).children('td[data-target=timein]').text();
	var date=$('#'+id).children('td[data-target=date]').text();
	$('#name').val(name);
	$('#timein').val(timein);
	$('#date').val(date);
	$('#userid').val(id);
});

 

	});