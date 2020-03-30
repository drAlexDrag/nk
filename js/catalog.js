$(document).ready(function(){
	loadData(1);
});
function unitCatalog(id) {
	// var unit_id = id;
	// alert (id);
	$.ajax({
		url:"/catalog/catalog_unit.php",
		method:"POST",
		data:{unit_id:id},
		success:function(data){
			$('#content').html(data);
		}
	});
}
function departmentCatalog(unitid, depid) {
  $.ajax({
    url:"/catalog/catalog_department.php",
    method:"POST",
    data:{unit_id:unitid, department_id:depid},
    success:function(data){
      $('#content').html(data);
    }
  });
}
function loadData(page){
  $.ajax({
    url:"/catalog/catalog_phone.php",
    method:"POST",
    data:{page:page},
    success:function(data){
      $('#content').html(data);
    }
  });
  // $.ajax({
  //   url: 'catalog_poisk.php',
  //   success: function(data) {
  //     $('#poisk').html(data);
  //   }
  // });
}