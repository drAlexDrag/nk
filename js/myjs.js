$(document).ready(function(){
	if (($('#adm').text())!=1){
    $(".admin").remove();}
    $('[data-toggle="popover"]').popover();
    fetchData(1);
    var user=$('#login').text();
    sessionStorage.setItem("user", user);
  });
var myWindow;

function openWin() {
  myWindow = window.open("", "_blank", "MsgWindow", "resizable=yes,top=50,left=1,width=200,height=100");
  myWindow.document.write('<div class="container-fluid-xl images-tabl"><a href="#"><img src="../images/krjpg.jpg"></a></div>\
<div id="alert_message"></div>');
}

function closeWin() {
  myWindow.close();
}
function tabl() {
  // body...
  var number = $('#number').val();
  window.open('./table/table.php?number='+number);
}
function tablnumber(number) {
  // body...
  // var number = $('#number').val();
  window.open('./table/table.php?number='+number);
}
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
  // $("#modalWindowCat").load("/views/modal_cat.ejs");
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
  $("#myModalForm")[0].reset();
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
      element = document.querySelectorAll('input[data-table-id]');
      for (i = 0; i < element.length; i++) {
    element[i].setAttribute('data-table-id', '');
  }

}
function confirmInsert(){
  if($('#data').val() != '' && $('#raspred').attr('data-table-id') != '' && $("#number").val() !='' && $("#ncatalog").attr('data-table-id') != '' && $("#type").attr('data-table-id') != '')
   {
     var user = $('#login').text();
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
  var number = (insertKrossData["number"]);
  var insertKrossData = JSON.stringify(insertKrossData);
  $.ajax({
    url:"crud.php",
    method:"POST",
    data:{action:action, insertKrossData:insertKrossData, user:user},
    dataType:"html",
    success:function(data)
    {
      $('#content').html(data);
      $('#myModalCRUD').modal('hide');
      $('#searchString').val(number);
  $('#parameterSearch').val('number');
  stringSearch();
    },
    error:function(data)
    {

    }
  });}
  else
   {
     alertoverlay('<div>Данные:<br>Распредедение:<br>Телефон:<br>Имя абонента:<br>Тип:</div>\
      <div>ПОЛЯ ОБЯЗАТЕЛЬНЫ К ЗАПОЛНЕНИЮ</div>');

    // alert("Данные: Распредедение: Телефон: Имя абонента: Тип:"+'\n'+
    //   "ПОЛЯ ОБЯЗАТЕЛЬНЫ К ЗАПОЛНЕНИЮ");
   }
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
  $("#myModalForm")[0].reset();
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

$(document).on('click', '.textKrossData', function(){$('#result').remove();});
$(document).on('click', '.autoListData', function(){
  var idinput=event.target.id;
  input=event.target.id;
  var tablename = event.target.dataset.table;
  // console.log("Таблица---", tablename);
  // console.log("Инпут---", idinput);
  // console.log("Значение---", $(this).val());
  // console.log("Id Значения---", $(this).attr("data-table-id"));
  var query = $(this).val();
  var iddatatable = $(this).attr("data-table-id");
  var columnname=tablename+"_name";
  if (idinput=="number"){columnname=tablename+"_number";}
  // console.log("Имя столбца", columnname);
  idinput='#'+idinput;
  $('#result').remove();
  autoListData(tablename, idinput, query, columnname, iddatatable, input);
});
$(document).on('keyup', '.autoListData', function(){//потом переделать
  
  var idinput=event.target.id;
  input=event.target.id;
  var tablename = event.target.dataset.table;
  // console.log("onkeyup: Таблица---", tablename+'\n'+
  //   "Инпут---", idinput+'\n'+
  //   "Значение---", $(this).val()+'\n'+
  //   "Id Значения---", $(this).attr("data-table-id"));
  var query = $(this).val();
  var iddatatable = $(this).attr("data-table-id");
  var columnname=tablename+"_name";
  if (idinput=="number"){columnname=tablename+"_number";}
  // console.log("onkeyup: Имя столбца", columnname);
  idinput='#'+idinput;
  $(idinput).attr({"data-table-id":""});
  $('#result').remove();
  $(idinput).addClass('alert alert-danger');
  btnblock();
  autoListData(tablename, idinput, query, columnname, iddatatable, input);
});
function autoListData(tablename, idinput, query, columnname, iddatatable, input) {
  console.clear();
  console.log("Какой инпут посылает запрос (событие onkeyup, onclick): ", idinput+'\n'+
  "Длинна запроса: ", query.length+'\n'+
  "Поиск по таблице: ", tablename+'\n'+
  "Запрос: ", query);
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
      btnblock();
    }
    if ($("div").is("#resultreturt")){

      var idvariabl='#'+tablename+'Id';
      $(idvariabl).val('');
      btnblock();
    }
  }
// });
})
 // )
// }
}
function btnblock(){

    if(!($("input").hasClass('alert-danger')))
    {
      console.log("Можно добавить данные");
      // $('#result_auto').remove();
      $(".btn-block").show(1000);
    }else{
      console.log("Нельзя добавить данные");
      $(".btn-block").hide(1000);
    }
}
function updateKrossData(updateData){
  // debugger;
  var idinput=updateData.getAttribute('data-idinput');
  if (idinput=="number"){
    var idinput="#"+idinput;
  $(idinput).attr({"data-table-id":updateData.getAttribute('data-idname')});
  $(idinput).val(updateData.getAttribute('data-value'));
  $('#ncatalog').val(updateData.getAttribute('data-name'));
  $('#ncatalog').attr({"data-table-id":updateData.getAttribute('data-idname')});
  $('#cabinet').val(updateData.getAttribute('data-cabinet'));
  $(idinput).removeClass('alert alert-danger');
  } else if(idinput=="ncatalog"){
    var idinput="#"+idinput;
  $(idinput).attr({"data-table-id":updateData.getAttribute('data-idname')});
  $(idinput).val(updateData.getAttribute('data-value'));
  $('#number').val(updateData.getAttribute('data-number'));
  $('#number').attr({"data-table-id":updateData.getAttribute('data-idname')});
  $('#cabinet').val(updateData.getAttribute('data-cabinet'));
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
btnblock();
}

function confirmUpdate() {
  var action = "updateData";
  var user = $('#login').text();
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
  var updateKrossData = JSON.stringify(updateKrossData);
  console.trace();
  // alert (updateKrossData);
  $.ajax({
    url:"crud.php",
    method:"POST",
    // data:{id:updateKrossData.id, data:updateKrossData.data, raspred:updateKrossData.raspred, number:updateKrossData.number, ncatalog:updateKrossData.ncatalog, type:updateKrossData.type, comment:updateKrossData.comment, cabinet:updateKrossData.cabinet},
    data:{updateKrossData:updateKrossData, action:action, user:user},
    dataType:"html",
    success:function(data)
    {
      $('#myModalCRUD').modal('hide');
      $('#result').remove();
      $("#myModalForm")[0].reset();
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
  var header='<div>Необходимо выбрать тип связи, который будет присвоен\
   данным после выполнения ОЧИСТКИ</div><hr>';
    var button='<div><button type="button" class="btn btn-danger btn-block"\
       onclick="confirmDataClear()">Очистить</button><button type="button"\
        class="btn btn-default btn-block" onclick="off()" >Отмена</button></div>';
  select_type(header, button);
}

function confirmDataClear() {
  // body...
  var user = $('#login').text();
  var selectTypeId=confirm_type();
  var clearKrossData = {
    id: $('#data').attr('data-table-id'),
    data: $('#data').val(),
    ncatalog: $("#ncatalog").attr('data-table-id'),
    user: user,
    selectTypeId: selectTypeId
  }
  var clearKrossData = JSON.stringify(clearKrossData);
  var action="clearData";
  $.ajax({
      // url: 'dataexecute.php',
      url: 'crud.php',
      method:"POST",
      data:{action:action, clearKrossData:clearKrossData},
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

//////////////////////////Запрос типа данных////////////////////////////////////////
function select_type(header, button) {
  // body...
   alertoverlay ();
  $("#closeAlertoverlay").hide();
  $.ajax({
    url: 'list_type.php',
    success: function(data) {
      $('#alertoverlay').html(header+data+button);
    }
  });
}
function confirm_type() {
  // body...
  var x = document.getElementById("param_type");
  var selectTypeId=(x.options[x.selectedIndex].index)+1;
  return(selectTypeId);
}
////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////
//////////////////////////Запрос распределения//////////////////////////////////////
function select_raspred(header, button) {
  // body...
   alertoverlay ();
  $("#closeAlertoverlay").hide();
  $.ajax({
    url: 'list_raspred.php',
    success: function(data) {
      $('#alertoverlay').html(header+data+button);
    }
  });
}
function confirm_raspred() {
  // body...
  var x = document.getElementById("param_raspred");
  var selectRaspredId=(x.options[x.selectedIndex].index)+1;
  return(selectRaspredId);
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
function searchData() {
  // body...
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
}

function select_typePK(pereKrossOut) {
  // body...
  var header ='<div>Необходимо выбрать тип связи, который будет присвоен\
   СТАРЫМ данным после выполнения перекроссировки</div><hr>'
  var button ='<div><button type="button" class="btn btn-danger btn-block"\
       onclick="confirmPereKross('+pereKrossOut+')">Выполнить перекроссировку</button><button type="button"\
        class="btn btn-default btn-block" onclick="off()" >Отмена</button></div>';
   select_type(header, button);
}
function confirmPereKross(pereKrossOut) {
  // body...
  var objArea=paramArea();
  var dataName=($('#pereKrossOut').val());
  var action="confirm_pereKross";
  var selectTypeId=confirm_type();
  pereKrossIn=$('#pereKrossIn').val();
  $.ajax({
    url:"crud.php",
    method:"POST",
    data: {dataName:dataName, pereKrossIn:pereKrossIn, pereKrossOut:pereKrossOut, selectTypeId:selectTypeId, action:action, areaId:objArea.id},
    success:function(data){
      off();
      $('#content').html(data);
      $('#myModalCRUD').modal('hide');
    }
  });
  // alert($('#pereKrossIn').val()+"----->>>>>"+pereKrossOut);
}
////////////////////////////////////////////////////////////////////////////////////

////////////////////////////Копирование данных//////////////////////////////////////
function select_raspredCopy(pereKrossOut) {
  // body...
  var header = '<div>Необходимо выбрать тип Распределения, который будет присвоен на новых\
   данных после выполнения КОПИРОВАНИЯ</div><hr>'
   var button ='<div><button type="button" class="btn btn-danger btn-block"\
       onclick="confirmCopy('+pereKrossOut+')">Выполнить копирование данных</button><button type="button"\
        class="btn btn-default btn-block" onclick="off()" >Отмена</button></div>';
   select_raspred(header, button);
}
function confirmCopy(pereKrossOut) {
  // body...
  var objArea=paramArea();
  var dataName=($('#pereKrossOut').val());
  var action="confirm_copy";
  var selectRaspredId=confirm_raspred();
  pereKrossIn=$('#pereKrossIn').val();
  $.ajax({
    url:"crud.php",
    method:"POST",
    data: {dataName:dataName, pereKrossIn:pereKrossIn, pereKrossOut:pereKrossOut, selectRaspredId:selectRaspredId, action:action, areaId:objArea.id},
    success:function(data){
      off();
      $('#content').html(data);
      $('#myModalCRUD').modal('hide');
     
    }
  }); 
  // alert(pereKrossOut);
}
//////////////////////Edit Catalog//////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////
// function loadData(page){///////?????????????????????????????
// edit_catalog();
//   };
// function edit_catalog() {
//   $.ajax({
//     url:"/editcatalog/ecatalog_phone.php",
//     method:"POST",
//     // data: {dataName:dataName, pereKrossIn:pereKrossIn, pereKrossOut:pereKrossOut, selectRaspredId:selectRaspredId, action:action, areaId:objArea.id},
//     success:function(data){
//       // off();
//       $('#content').html(data);
//       $('#search').html('<hr>');
     
//     }
//   }); 
// }
// function unitCatalog(id) {
//   // var unit_id = id;
//   // alert (id);
//   $.ajax({
//     url:"/editcatalog/ecatalog_unit.php",
//     method:"POST",
//     data:{unit_id:id},
//     success:function(data){
//       $('#content').html(data);
// sort_table();
//     }
//   });
// }
// function departmentCatalog(unitid, depid) {
//   $.ajax({
//     url:"/editcatalog/ecatalog_department.php",
//     method:"POST",
//     data:{unit_id:unitid, department_id:depid},
//     success:function(data){
//       $('#content').html(data);
//       sort_table();
//     }
//   });
// }
// function sort_table() {
//   $( ".row_drag" ).sortable({
//         delay: 100,
//         stop: function() {
//             var selectedRow = new Array();

//             $('.row_drag>tr').each(function() {
//                 selectedRow.push($(this).attr("id"));

//                 // console.log(selectedRow+"vis"+$(this).data("vis"));
//             });
//            // alert(selectedRow);
//            // console.log($('.row_drag>tr').length);
           

//         }
//     });
// }
    
//     function authorityStart() {
          
//       authorityRemove();
// texts = document.querySelectorAll(".row_drag>tr");
//            suball = texts.length;
//     arrtext = Array.from(texts);
// console.log(arrtext);
//     var i = 0;
//     for(; i < suball; i++){
//         var co = i;
//         // $(this).setAttribute('data-authority', i);
// // $(".row_drag>tr").attr("data-authority", i);
//         $(arrtext[co]).append('<td class="rem">'+co+'</td>');
//         console.log(arrtext[co]);
//     }
//   var i = 0;  
//  $('.row_drag>tr').each(function() { 
// $(this).attr("data-authority", i);
// console.log(i);
// i++;
//             }); 

// }
//     function authorityRemove() {
// texts = document.querySelectorAll(".row_drag>tr>.rem");
//            suball = texts.length;
//     arrtext = Array.from(texts);
//     // $('#span').append(suball);
//     var i = 0;
//     for(; i < suball; i++){
//         var co = i;
//         $(arrtext[co]).remove();
//     }
// }
// function authorityConfirm() { 
//   var unit_id = $("#unit").attr("data-unit-id");
//     $('.row_drag>tr').each(function() { 
//       // var aut=$(this).data.authority="asde";
//       var newaut = {
//     id: $(this).attr("id"),
//     authority: $(this).attr("data-authority")
//   }
 
//   var newaut = JSON.stringify(newaut);
//   // $('#content').html('');
//   $.ajax({
//       // url: 'dataexecute.php',
//       url: '/editcatalog/catcrud.php',
//       method:"POST",
//       data:{newaut:newaut, unit_id:unit_id},
//       dataType:"html",
//       // data:$('#dataCrudForm').serialize()+'&action='+action,
//       success: function(data) {
//         $('#content').html(data);
//         // unitCatalog(data);
//       }
//     });

//             });  
//     unitCatalog(unit_id);
// }
////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////
//////////////////////catalogAdd//////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////
function catalogAdd(number) {
  $("#addCatalog").modal('show');

}
////////////////////////////////////////////////////////////////////////////////////

//////////////////////////Работас журналами area raspred type unit department sector filial
function staCRUD() {
  // body...
}
///////////////////////////////////////////////////////////////////////////////////////////
////////НОМЕРа///////////
function numberCatalog() {
  // body...
  var dataTable = $('#content').DataTable({
    "processing" : true,
    "serverSide" : true,
    "order" : [],
    "ajax" : {
     url:"numbertable.php",
     type:"POST"
    }
   });
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