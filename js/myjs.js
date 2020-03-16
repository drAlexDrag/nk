$(document).ready(function(){
	if (($('#adm').text())!=1){
    $(".admin").remove();}
    fetchData(1);
    $('[data-toggle="popover"]').popover();

  });
function catalogOpen()
{ 
  window.open("/catalog/catalog.php");
}
function exitKross(){
  if(confirm("Вы действительно хотите завершить работу?")){
    $.ajax({
      url: "logout.php",
      cache: false,
      success: function(html){
        $("body").html(html);
      }
    });
  }
}
function usersConfig() {
  $.ajax({
    url:"/usersconfig/users_show.php",
    success:function(data){
      $('#content').html(data);
    }
  });
}
//////////////////Вывод алертов///////////////////
function alertoverlay(helpalert) {
  // body...
  document.getElementById("alertoverlay").innerHTML = helpalert;
  document.getElementById("overlay").style.display = "block";
}
function on() {
  document.getElementById("overlay").style.display = "block";
}

function off() {
  document.getElementById("alertoverlay").innerHTML = "";
  document.getElementById("overlay").style.display = "none";
}
//////////////////////////////////////////////////
//////////////////////////////////////////////////
//////////////////Проверка на кириллицу///////////
    var isCyrillic = function (text) {
      return /^[a-zA-Z0-9+-/_*]+$/i.test(text);
    }
//////////////////////////////////////////////////
//////////////////////////////////////////////////
//Pagination pagination.php
$(document).on('click', 'li.page-item > a.page-link',function(){
  var page = $(this).attr('p');
  console.log (page);
  fetchData(page);
});
//Pagination END
function fetchData(page)//Загрузка начальной страницы
{
  $("#modalWindow").load("/views/modal.ejs");
  $("#search").load("/views/search_form.ejs");
  var objArea=paramArea();
  $.ajax({
    url:"select.php",
    method:"POST",
    data:{area:objArea.name, page:page},
    dataType:"html",
    success:function(data)
    {
      $('#content').html(data);

    },
    error:function(data)
    {

    }
  });


}
//Выбор кроссового журнала
function paramArea(){
  var area = [("param_area", param_area.value), $('#param_area').find(':selected').attr('data-id')];
  var objArea = new Object();
  objArea.id=area[1];
  objArea.name=area[0];
  console.log("ID площадки (id area)", objArea.id);
  console.log("Кроссовый журнал-----", objArea.name);
  return (objArea);
}
/////
/////Поиск//////
function stringSearch() {
  var parameterSearch = $('#parameterSearch').val();
  var searchString = $('#searchString').val();
  $.ajax({
    url:"search.php",
    method:"POST",
    data:{parameterSearch:parameterSearch, searchString:searchString},
    dataType:"html",
    success:function(data)
    {
      $('#content').html(data);
    },
    error:function(data)
    {

    }
  });
};
$(document).on('click', '.data-number', function(){
  $('#searchString').val(($(this).text()).trim());
  $('#parameterSearch').val('number');
  stringSearch();
  // $('#parameterSearch').val();
});
$(document).on('click', '.data-name', function(){
  $('#searchString').val(($(this).text()).trim());
  $('#parameterSearch').val('sub_name');
  stringSearch();
  // $('#parameterSearch').val();
});
$(document).on('click', '.data-comment', function(){
  $('#searchString').val(($(this).text()).trim());
  $('#parameterSearch').val('comment');
  stringSearch();
  // $('#parameterSearch').val();
});
$(document).on('click', '.data-cabinet', function(){
  $('#searchString').val(($(this).text()).trim());
  $('#parameterSearch').val('cabinet');
  stringSearch();
  // $('#parameterSearch').val();
});
////////////////
function gogo() {
  // body...
  var go="1111";
  $.ajax({
    url:"go.php",
    method:"POST",
    data:{area:go},
    dataType:"html",
    success:function(data)
    {
      $('#content').html(data);
    },
    error:function(data)
    {

    }
  });
}
///////////////////////////Добавить данные///////////////////////////
function insertKrossData() {
  var objArea=paramArea();
  document.getElementById("myModalForm").reset();
  $('#myModalCRUDTitle').html("Добавить данные на "+objArea.name);
      $('#data').removeAttr('disabled');
      $('#confirmInsert').removeAttr('hidden');
      $('#confirmUpdate').attr('hidden', 'hidden');
      $('#clearData').attr('hidden', 'hidden');
      $('#perekross').attr('hidden', 'hidden');
      $('.perekross').attr('hidden', 'hidden');
$('#result_auto').remove();
      $(".blockbtn").show(1000);

      $('#myModalCRUD').modal('show');
  
}
function confirmInsert(){
  var action= "insertData";
  var objArea=paramArea();
  var insertKrossData = {
    // id: $('#data').attr('data-table-id'),
    data: $('#data').val(),
    raspred: $('#raspred').attr('data-table-id'),
    number: $("#number").val(),
    ncatalog: $("#ncatalog").attr('data-table-id'),
    type: $("#type").attr('data-table-id'),
    comment: $('#comment').val(),
    cabinet: $('#cabinet').val(),
    area: objArea.id
  }
  var insertKrossData = JSON.stringify(insertKrossData);
  $.ajax({
    url:"crud.php",
    method:"POST",
    data:{action:action, insertKrossData:insertKrossData},
    dataType:"html",
    success:function(data)
    {
      $('#content').html(data);
      
    },
    error:function(data)
    {

    }
  });
}
/////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////

//////////////////////////Редактировать данные///////////////////////
function isKeyPressed(event, id) {
  if (event.altKey) {
    alert("ID Данных: "+id);
  } else {
    editData(id);
  }
}
function editData(id) {

   var data_id = id;
  var action= "loadData";
  console.log(data_id);
  document.getElementById("myModalForm").reset();
  $('#confirmInsert').attr('hidden','hidden');
  $('#confirmUpdate').removeAttr('hidden');
      $('#clearData').removeAttr('hidden');
      $('#perekross').removeAttr('hidden');
      // $('.perekr').removeAttr('hidden');
$('.perekross').attr('hidden','hidden');

$('#result_auto').remove();
      $(".blockbtn").show();
  $.ajax({
    url:"crud.php",
    method:"POST",
    data:{data_id:data_id, action:action},
    dataType:"json",
    success:function(data)
    {
      console.log(data);
      $('#myModalCRUDTitle').html("Редактируем данные №: "+data.data+" кросса "+data.area["area_name"]);
      $('#data').attr({"disabled":'disabled'});
      $('#data').attr({"data-table-id":data.id});
      $('#data').val(data.data);

      $('#raspred').attr({"data-table-id":data.raspred["id"]});
      $('#raspred').val(data.raspred["raspred_name"]);

      $('#number').attr({"data-table-id":data.ncatalog["id"]});
      $('#number').val(data.ncatalog["ncatalog_number"]);
      // $('#number').val(data.number);

      $('#ncatalog').attr({"data-table-id":data.ncatalog["id"]});
      $('#ncatalog').val(data.ncatalog["ncatalog_name"]);

      $('#type').attr({"data-table-id":data.type["id"]});
      $('#type').val(data.type["type_name"]);

      $('#comment').val(data.comment);
      $('#cabinet').val(data.ncatalog["ncatalog_cabinet"]);
      $('#myModalCRUD').modal('show');
    },
    error:function(data)
    {

    }
  });
}
// $(document).on('click', '.edit_data', function(){
//   var data_id = $(this).data("id");
//   var action= "loadData";
//   console.log(data_id);
//   document.getElementById("myModalForm").reset();
//   $('#confirmInsert').attr('hidden','hidden');
//   $('.perekross').attr('hidden','hidden');
//   $('#confirmUpdate').removeAttr('hidden');
//       $('#clearData').removeAttr('hidden');
//       $('#pereKross').removeAttr('hidden');
//   $.ajax({
//     url:"crud.php",
//     method:"POST",
//     data:{data_id:data_id, action:action},
//     dataType:"json",
//     success:function(data)
//     {
//       console.log(data);
//       $('#myModalCRUDTitle').html("Редактируем данные №: "+data.data+" кросса "+data.area["area_name"]);
//       $('#data').attr({"disabled":'disabled'});
//       $('#data').attr({"data-table-id":data.id});
//       $('#data').val(data.data);

//       $('#raspred').attr({"data-table-id":data.raspred["id"]});
//       $('#raspred').val(data.raspred["raspred_name"]);

//       $('#number').attr({"data-table-id":data.ncatalog["id"]});
//       $('#number').val(data.ncatalog["ncatalog_number"]);
//       // $('#number').val(data.number);

//       $('#ncatalog').attr({"data-table-id":data.ncatalog["id"]});
//       $('#ncatalog').val(data.ncatalog["ncatalog_name"]);

//       $('#type').attr({"data-table-id":data.type["id"]});
//       $('#type').val(data.type["type_name"]);

//       $('#comment').val(data.comment);
//       $('#cabinet').val(data.ncatalog["ncatalog_cabinet"]);
//       $('#myModalCRUD').modal('show');
//     },
//     error:function(data)
//     {

//     }
//   });
// });


$(document).on('click', '.textKrossData', function(){$('#result').remove();});
$(document).on('click', '.autoListData', function(){
  var idinput=event.target.id;
  input=event.target.id;
  var tablename = event.target.dataset.table;
  console.log("Таблица---", tablename);
  console.log("Инпут---", idinput);
  console.log("Значение---", $(this).val());
  console.log("Id Значения---", $(this).attr("data-table-id"));
  var query = $(this).val();
  var iddatatable = $(this).attr("data-table-id");
  var columnname=tablename+"_name";
  if (idinput=="number"){columnname=tablename+"_number";}
  console.log("Имя столбца", columnname);
  idinput='#'+idinput;
  $('#result').remove();
  autoListData(tablename, idinput, query, columnname, iddatatable, input);
});
$(document).on('keyup', '.autoListData', function(){//потом переделать
  
  var idinput=event.target.id;
  input=event.target.id;
  var tablename = event.target.dataset.table;
  console.log("Таблица---", tablename);
  console.log("Инпут---", idinput);
  console.log("Значение---", $(this).val());
  console.log("Id Значения---", $(this).attr("data-table-id"));
  var query = $(this).val();
  var iddatatable = $(this).attr("data-table-id");
  var columnname=tablename+"_name";
  if (idinput=="number"){columnname=tablename+"_number";}
  console.log("Имя столбца", columnname);
  idinput='#'+idinput;
  $(idinput).attr({"data-table-id":""});
  $('#result').remove();
  $(idinput).addClass('alert alert-danger');
  autoListData(tablename, idinput, query, columnname, iddatatable, input);
});
function autoListData(tablename, idinput, query, columnname, iddatatable, input) {
  console.log("Какой инпут посылает запрос (событие onkeyup): ", idinput);
  console.log("Длинна запроса: ", query.length);
  // console.log("Атрибут data-table после click: ", document.getElementById("staAutoList").getAttribute("data-table"));
  console.log("Поиск по таблице: ", tablename);
  console.log("Запрос: ", query);
  // console.log("nomer: ", $('#number').val());
  number=$('#number').val();
  // debugger;
  if(!$("div").is("#result")){
    $("<div id='result' style='height:300px;overflow-y:scroll;'></div>").insertAfter(idinput);
  }
  // if((query.length)!=0){
//     console.log("Пустой запрос");
// $('#result').html("Пустой запрос");
  // }
  // else(
  $.ajax({
   url:"loadtable.php",
   method:"POST",
   data:{input:input, idinput:idinput, query:query, tablename:tablename, columnname:columnname, iddatatable:iddatatable, number:number},
   success:function(data)
   {
    $('#result').html(data);
    if ($("div").is("#alertInfo")){

      var idvariable='#'+tablename+'Id';
      $(idvariable).val('');
    }
    if ($("div").is("#resultreturt")){

      var idvariabl='#'+tablename+'Id';
      $(idvariabl).val('');
    }
  }
// });
})
 // )
// }
}
function updateKrossData(updateData){
  var idinput=updateData.getAttribute('data-idinput');
  if (idinput=="number"){
    var idinput="#"+idinput;
  $(idinput).attr({"data-table-id":updateData.getAttribute('data-idname')});
  $(idinput).val(updateData.getAttribute('data-value'));
  $('#ncatalog').val(updateData.getAttribute('data-name'));
  $('#ncatalog').attr({"data-table-id":updateData.getAttribute('data-idname')});
  $(idinput).removeClass('alert alert-danger');
  } else if(idinput=="ncatalog"){
    var idinput="#"+idinput;
  $(idinput).attr({"data-table-id":updateData.getAttribute('data-idname')});
  $(idinput).val(updateData.getAttribute('data-value'));
  $('#number').val(updateData.getAttribute('data-number'));
  $('#number').attr({"data-table-id":updateData.getAttribute('data-idname')});
  $(idinput).removeClass('alert alert-danger');
  }
    else{
      console.log('data-idinput-----------------', idinput);
  var idinput="#"+idinput;
  $(idinput).attr({"data-table-id":updateData.getAttribute('data-idname')});
  $(idinput).val(updateData.getAttribute('data-value'));
  $(idinput).removeClass('alert alert-danger');
  }
$('#result').remove();
}

function confirmUpdate() {
  var action = "updateData";
  var updateKrossData = {
    id: $('#data').attr('data-table-id'),
    data: $('#data').val(),
    raspred: $('#raspred').attr('data-table-id'),
    number: $("#number").val(),
    ncatalog: $("#ncatalog").attr('data-table-id'),
    type: $("#type").attr('data-table-id'),
    comment: $('#comment').val(),
    cabinet: $('#cabinet').val()
  }
  var updateKrossData = JSON.stringify(updateKrossData);console.trace();
  // alert (updateKrossData);
  $.ajax({
    url:"crud.php",
    method:"POST",
    // data:{id:updateKrossData.id, data:updateKrossData.data, raspred:updateKrossData.raspred, number:updateKrossData.number, ncatalog:updateKrossData.ncatalog, type:updateKrossData.type, comment:updateKrossData.comment, cabinet:updateKrossData.cabinet},
    data:{updateKrossData:updateKrossData, action:action},
    dataType:"html",
    success:function(data)
    {
      $('#myModalCRUD').modal('hide');
      $('#result').remove();
      document.getElementById("myModalForm").reset();
      $('#content').html(data);
    },
    error:function(data)
    {

    }
  });
}
/////////////////////Проверка наличия добавляемых данных на дубль///////////////////
$(document).on('keyup', '#data', function(){
 var idinput="#"+$(this).attr('id');
 var serachString=$(this).val();
 objArea=paramArea();
 
 if($(this).val().length>=3)
 {
if(!isCyrillic($(this).val())){
    alertoverlay("Переключите язык ввода на Английский");
  }
  
  // $("#closeAlertoverlay").show();
  var action="data_autosearch";
$.ajax({
    url:"crud.php",
    method:"POST",
    data:{areaname:objArea.name, action:action, serachString:serachString},
    dataType:"html",
    success:function(data)
    {
      if(!$("div").is("#result_auto")){
    $("<div id='result_auto' style='height:auto;'></div>").insertAfter(idinput);
  }
  $('#result_auto').html(data);
dangeralert();
    },
    error:function(data)
    {

    }
  });


// else{
//   $('#dataList').html("");
}
});
function dangeralert(){
  var element=document.getElementById('dangeralert');
    if(!element)
    {
      console.log("Можно добавить данные");
      $('#result_auto').remove();
      $(".blockbtn").show(1000);
    }else{
      console.log("Нельзя добавить данные");
      $(".blockbtn").hide(1000);
    }
}
////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////
//////////////////////////Очистка данных////////////////////////////////////////////
function clearData(){
  alertoverlay ();
  $("#closeAlertoverlay").hide();
  $.ajax({
    url: 'list_type.php',
    success: function(data) {
      $('#alertoverlay').html(data);
    }
  });
}
function confirmDataClear() {
  // body...
  var clearKrossData = {
    id: $('#data').attr('data-table-id'),
    data: $('#data').val(),
    ncatalog: $("#ncatalog").attr('data-table-id')
  }
  var clearKrossData = JSON.stringify(clearKrossData);
  var x = document.getElementById("param_type");
  var selectTypeId=(x.options[x.selectedIndex].index)+1;
  var action="clearData";
  $.ajax({
      // url: 'dataexecute.php',
      url: 'crud.php',
      method:"POST",
      data:{action:action, selectTypeId:selectTypeId, clearKrossData:clearKrossData},
      dataType:"html",
      // data:$('#dataCrudForm').serialize()+'&action='+action,
      success: function(data) {
        off();
        $('#content').html(data);
        $('#myModalCRUD').modal('hide');
      }
    });
}
////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////

//Перекроссировка. Перенос номера с одних данных на другие//////////////////////////
function pereKross() {
// $('#perekross').attr('attribute', 'value');
// $('#confirmInsert').attr('hidden','hidden');
  $('.perekross').removeAttr('hidden');
  var action="perekross";
  var data_id=$('#data').attr('data-table-id');
  // $('#dataCrudModal').modal('hide');
  $.ajax({
    url:"crud.php",
    method:"POST",
    data:{action:action, data_id:data_id},
    success:function(data){
      $('#winperekross').html(data);
    }
  });

}
$(document).on('keyup', '#pereKrossOut', function(){
  var action="search_pereKross";
  var objArea=paramArea();
  $.ajax({
    url:"crud.php",
    method:"POST",
    data: {dataName:$('#pereKrossOut').val(), action:action, areaId:objArea.id},
    success:function(data){
      $('#resultSearch').html(data);
    }
  });
});
function confirmPereKross(pereKrossOut) {
  // body...
  var objArea=paramArea();
  var action="confirm_pereKross";
  pereKrossIn=$('#pereKrossIn').val();
  $.ajax({
    url:"crud.php",
    method:"POST",
    data: {pereKrossIn:pereKrossIn, pereKrossOut:pereKrossOut, action:action, areaId:objArea.id},
    success:function(data){
      $('#resultSearch').html(data);
    }
  });
  alert($('#pereKrossIn').val()+"----->>>>>"+pereKrossOut);
}
////////////////////////////////////////////////////////////////////////////////////
/**
             * Функция для отправки формы средствами Ajax
             * @author Дизайн студия ox2.ru
             **/
// function AjaxFormRequest(result_id,form_id,url) {
//   jQuery.ajax({
//                     url:     url, //Адрес подгружаемой страницы
//                     type:     "POST", //Тип запроса
//                     dataType: "html", //Тип данных
//                     data: jQuery("#"+form_id).serialize(),
//                     success: function(response) { //Если все нормально
//                       document.getElementById(result_id).innerHTML = response;
//                     },
//                 error: function(response) { //Если ошибка
//                   document.getElementById(result_id).innerHTML = "Ошибка при отправке формы";
//                 }

//               });
// }