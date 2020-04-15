
//////////////////////TEST LOAD UNIT DIV////////////////////////////
$(document).ready(function(){
	loadData(1);
});
function loadData(page){
  $.ajax({
    url:"/editcatalog/test_div.php",
    method:"POST",
    // data:{page:page},
    success:function(data){
      $('#content').html(data);
    }
  });

}
function unitCatalog(id) {
  // var unit_id = id;
  // alert (id);
  $.ajax({
    url:"/editcatalog/ecatalog_unit.php",
    method:"POST",
    data:{unit_id:id},
    success:function(data){
      $('#unitload').html(data);
sort_table();
    }
  });
}
function departmentCatalog(unitid, depid) {
  $.ajax({
    url:"/editcatalog/ecatalog_department.php",
    method:"POST",
    data:{unit_id:unitid, department_id:depid},
    success:function(data){
      $('#unitload').html(data);
      sort_table();
    }
  });
}
function sort_table() {
  $( ".row_drag" ).sortable({
        delay: 100,
        stop: function() {
            var selectedRow = new Array();

            $('.row_drag>tr').each(function() {
                selectedRow.push($(this).attr("id"));

                // console.log(selectedRow+"vis"+$(this).data("vis"));
            });
           // alert(selectedRow);
           // console.log($('.row_drag>tr').length);
           

        }
    });
}
    
    function authorityStart() {
          
      authorityRemove();
texts = document.querySelectorAll(".row_drag>tr");
           suball = texts.length;
    arrtext = Array.from(texts);
console.log(arrtext);
    var i = 0;
    for(; i < suball; i++){
        var co = i;
        // $(this).setAttribute('data-authority', i);
// $(".row_drag>tr").attr("data-authority", i);
        $(arrtext[co]).append('<td class="rem">'+co+'</td>');
        console.log(arrtext[co]);
    }
  var i = 0;  
 $('.row_drag>tr').each(function() { 
$(this).attr("data-authority", i);
console.log(i);
i++;
            }); 

}
    function authorityRemove() {
texts = document.querySelectorAll(".row_drag>tr>.rem");
           suball = texts.length;
    arrtext = Array.from(texts);
    // $('#span').append(suball);
    var i = 0;
    for(; i < suball; i++){
        var co = i;
        $(arrtext[co]).remove();
    }
}
function authorityConfirm() { 
  var unit_id = $("#unit").attr("data-unit-id");
    $('.row_drag>tr').each(function() { 
      // var aut=$(this).data.authority="asde";
      var newaut = {
    id: $(this).attr("id"),
    authority: $(this).attr("data-authority")
  }
 
  var newaut = JSON.stringify(newaut);
  // $('#content').html('');
  $.ajax({
      // url: 'dataexecute.php',
      url: '/editcatalog/catcrud.php',
      method:"POST",
      data:{newaut:newaut, unit_id:unit_id},
      dataType:"html",
      // data:$('#dataCrudForm').serialize()+'&action='+action,
      success: function(data) {
        $('#unitload').html(data);
        // unitCatalog(data);
      }
    });

            });  
    unitCatalog(unit_id);
}
////////////////////////////////////////////////////////////////////