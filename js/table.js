$(document).ready(function(){
  $('[data-toggle="popover"]').popover();
  $('[data-toggle="tooltip"]').tooltip();
   // $('.krossdata').tooltip({title: "Hooray!", container: ".parent"});
   var gets = (function() {
     var a = window.location.search;
     var b = new Object();
     a = a.substring(1).split("&");
     for (var i = 0; i < a.length; i++) {
       c = a[i].split("=");
       b[c[0]] = c[1];
     }
     return b;
   })();
   $("#modalWindow").load("/views/modal_cat.ejs");
   
 editNumber();
 //   if (gets['number']!=null)
 //     {var number=gets['number'];
 //       editNumber(number);
 //   // window.location.search='';
 // }
 //   else {}



 });
var user=sessionStorage.getItem('user');
// function winOpen(argument) {
//   var myWindow = window.open("", "_blank", "MsgWindow", "resizable=yes,top=50,left=50,width=200,height=100");
//   myWindow.document.write("<p>This is 'MsgWindow'. I am 200px wide and 100px tall!</p>");
// }
// $("#button").click(function(){
//         var selValue = document.getElementsByName("freebusy").checked;
//         console.log(selValue);
//     });
function getRadioVal(form, name) {
    var val;
    // get list of radio buttons with specified name
    var radios = form.elements[name];
    
    // loop through list of radio buttons
    for (var i=0, len=radios.length; i<len; i++) {
        if ( radios[i].checked ) { // radio checked?
            val = radios[i].value; // if so, hold its value in val
            break; // and break out of for loop
        }
    }
    return val; // return value of checked radio or undefined if none checked
}
var myWindow;

function openWin() {
  myWindow = window.open("", "_blank", "MsgWindow", "resizable=yes,top=50,left=1,width=200,height=100");
  myWindow.document.write('<div class="container-fluid-xl images-tabl"><a href="#"><img src="../images/krjpg.jpg"></a></div>\
<div id="alert_message"></div>');
}

function closeWin() {
  myWindow.close();
}
function get_number(id, number) {
  // var ssel = "#"+id;
      // var value = $(ssel).text();
    // var id = $(this).data("id");
    var selector='[name="'+id+'"]';
    console.log(selector);
    $.ajax({
      url:"kd_info.php",
      method:"POST",
      data:{id:id, number:number},
      datatype:"html",
      success:function(data, textStatus)
      {

        $(selector).removeAttr("title");
        $(selector).tooltip({title: data, html: true, placement: "bottom", trigger: "click"});
      }
    });
  }
  function editRaspred() {
    var content='<h1 align="center">Таблица распределений</h1>\
    <div class="table-responsive">\
    <div align="right">\
    <button type="button" name="add" id="add" class="btn-sm btn-info" data-table="raspred">Добавить распределение</button>\
    </div>\
    <br />\
    <table id="user_data" class="table table-bordered table-striped">\
    <thead>\
    <tr class="row_drag">\
    <th class="row_drag" data-name-col="id">ID</th>\
    <th class="row_drag" data-name-col="raspred_name">Распределение</th>\
    <th></th>\
    </tr>\
    </thead>\
    </table>\
    </div>';
    // var col=["id", "raspred_name"];
    // var table_name="raspred";
    // fetch_table(content, table_name, col);
    $("#content").html(content);
    var table_name="raspred";
    var col=getAllColName();
    col=JSON.stringify(col);
    fetch_data(table_name, col);
  }
  function editType() {
    var content='<h1 align="center">Таблица типов</h1>\
    <div class="table-responsive">\
    <div align="right">\
    <button type="button" name="add" id="add" class="btn-sm btn-info" data-table="type">Добавить тип</button>\
    </div>\
    <br />\
    <table id="user_data" class="table table-bordered table-striped">\
    <thead>\
    <tr class="row_drag">\
    <th class="row_drag" data-name-col="id">ID</th>\
    <th class="row_drag" data-name-col="type_name">Тип линии</th>\
    <th></th>\
    </tr>\
    </thead>\
    </table>\
    </div>';
    $("#content").html(content);
    var table_name="type";
    var col=getAllColName();
    col=JSON.stringify(col);
    fetch_data(table_name, col);
  }
  function editUnit() {
    var content='<h1 align="center">Таблица управлений</h1>\
    <div class="table-responsive">\
    <div align="right">\
    <button type="button" name="add" id="add" class="btn-sm btn-info" data-table="unit">Добавить управление</button>\
    </div>\
    <br />\
    <table id="user_data" class="table table-bordered table-striped">\
    <thead>\
    <tr class="row_drag">\
    <th class="row_drag" data-name-col="id">ID</th>\
    <th class="row_drag" data-name-col="unit_name">Управление</th>\
    <th></th>\
    </tr>\
    </thead>\
    </table>\
    </div>';
    $("#content").html(content);
    var table_name="unit";
    var col=getAllColName();
    col=JSON.stringify(col);
    fetch_data(table_name, col);
  }
  function editDepartment() {
    var content='<h1 align="center">Таблица отделы/бюро</h1>\
    <div class="table-responsive">\
    <div align="right">\
    <button type="button" name="add" id="add" class="btn-sm btn-info" data-table="department">Добавить отделы/бюро</button>\
    </div>\
    <br />\
    <table id="user_data" class="table table-bordered table-striped">\
    <thead>\
    <tr class="row_drag">\
    <th class="row_drag" data-name-col="id">ID</th>\
    <th class="row_drag" data-name-col="department_name">Отделы/Бюро</th>\
    <th></th>\
    </tr>\
    </thead>\
    </table>\
    </div>';
    $("#content").html(content);
    var table_name="department";
    var col=getAllColName();
    col=JSON.stringify(col);
    fetch_data(table_name, col);
  }
  function editSector() {
    var content='<h1 align="center">Таблица сектор</h1>\
    <div class="table-responsive">\
    <div align="right">\
    <button type="button" name="add" id="add" class="btn-sm btn-info" data-table="sector">Добавить сектор</button>\
    </div>\
    <br />\
    <table id="user_data" class="table table-bordered table-striped">\
    <thead>\
    <tr class="row_drag">\
    <th class="row_drag" data-name-col="id">ID</th>\
    <th class="row_drag" data-name-col="sector_name">Сектор</th>\
    <th></th>\
    </tr>\
    </thead>\
    </table>\
    </div>';
    $("#content").html(content);
    var table_name="sector";
    var col=getAllColName();
    col=JSON.stringify(col);
    fetch_data(table_name, col);
  }
  function editFilial() {
    var content='<h1 align="center">Таблица филиалы</h1>\
    <div class="table-responsive">\
    <div align="right">\
    <button type="button" name="add" id="add" class="btn-sm btn-info" data-table="filial">Добавить филиал</button>\
    </div>\
    <br />\
    <table id="user_data" class="table table-bordered table-striped">\
    <thead>\
    <tr class="row_drag">\
    <th class="row_drag" data-name-col="id">ID</th>\
    <th class="row_drag" data-name-col="filial_name">Филиал</th>\
    <th></th>\
    </tr>\
    </thead>\
    </table>\
    </div>';
    $("#content").html(content);
    var table_name="filial";
    var col=getAllColName();
    col=JSON.stringify(col);
    fetch_data(table_name, col);
  }
  function editArea() {
    var content='<h1 align="center">Таблица площадка</h1>\
    <div class="table-responsive">\
    <div align="right">\
    <button type="button" name="add" id="add" class="btn-sm btn-info" data-table="area">Добавить площадку</button>\
    </div>\
    <br />\
    <table id="user_data" class="table table-bordered table-striped">\
    <thead>\
    <tr class="row_drag">\
    <th class="row_drag" data-name-col="id">ID</th>\
    <th class="row_drag" data-name-col="area_name">Площадка</th>\
    <th></th>\
    </tr>\
    </thead>\
    </table>\
    </div>';
    $("#content").html(content);
    var table_name="area";
    var col=getAllColName();
    col=JSON.stringify(col);
    fetch_data(table_name, col);
  }
  function editNumber(number) {
    // body...
    var content='<h1 align="center">Таблица абонентов</h1>\
    <div class="table-responsive">\
    <div align="right">\
    <button type="button" name="add" id="add" class="btn-sm btn-info" data-table="ncatalog">Добавить номер</button>\
    </div>\
    <br />\
    <table id="user_data" class="table table-bordered table-striped">\
    <thead>\
    <tr class="row_drag">\
    <th class="row_drag" data-name-col="id">ID абонента</th>\
    <th class="row_drag" data-name-col="ncatalog_number">Номер</th>\
    <th class="row_drag" data-name-col="ncatalog_name">Имя абонента</th>\
    <th class="row_drag" data-name-col="ncatalog_cabinet">Кабинет</th>\
    <th></th>\
    </tr>\
    </thead>\
    </table>\
    </div>';
    $("#content").html(content);
    var table_name="ncatalog";
    var col=getAllColName();
    col=JSON.stringify(col);
    fetch_data(table_name, col, number);
  }

  function fetch_data(table_name, col, number)
  {
    var dataTable = $('#user_data').DataTable({
      "processing" : true,
      "serverSide" : true,
      "info": true,
      "searching": true,
      // "dom": '<"toolbar">frtip',
      "language": {
        "processing": "Подождите...",
        "search": "Поиск:",
        "lengthMenu": "Показать _MENU_ записей",
        "info": "Записи с _START_ до _END_ из _TOTAL_ записей",
        "infoEmpty": "Записи с 0 до 0 из 0 записей",
        "infoFiltered": "(отфильтровано из _MAX_ записей)",
        "infoPostFix": "",
        "loadingRecords": "Загрузка записей...",
        "zeroRecords": "Записи отсутствуют.",
        "emptyTable": "В таблице отсутствуют данные",
        "paginate": {
          "first": "Первая",
          "previous": "Предыдущая",
          "next": "Следующая",
          "last": "Последняя"
        },
        "aria": {
          "sortAscending": ": активировать для сортировки столбца по возрастанию",
          "sortDescending": ": активировать для сортировки столбца по убыванию"
        },
        "select": {
          "rows": {
            "_": "Выбрано записей: %d",
            "0": "Кликните по записи для выбора",
            "1": "Выбрана одна запись"
          }
        }
      },
      stateSave: true,
      "order" : [0],
    // "deferLoading": [ 57, 100 ],
    // "search": {
    //   "search": number
    // },
    "lengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]],
    "ajax" : {
      url:"fetch.php",
      data:{table_name:table_name, col:col},
      type:"POST"
    }
  });
    // $("div.toolbar").html('<b>Custom tool bar! Text/images etc.</b>');
    // if (table_name=="ncatalog"){
    //   dataTable.columns( [4] ).visible( false );
    // }
  }
  //собираем все столбцы таблицы
  function getAllColName() {
    var colName=[];
    var i = 0;  
    $('.row_drag>th.row_drag').each(function() { 
        colName.push($(this).attr("data-name-col"));
        i++;
    }); 
    return colName;
}
  function update_data(id, column_name, value, table_name)
  {
    $.ajax({
      url:"update.php",
      method:"POST",
      data:{id:id, column_name:column_name, value:value, table_name:table_name, user:user},
      success:function(data)
      {
        $('#alert_message').html('<div class="container-fluid alert alert-success">'+data+'</div>');
        $('#user_data').DataTable().destroy();
        if (table_name=="ncatalog"){
          editNumber();
        } else if(table_name=="raspred"){
          editRaspred();
        } else if(table_name=="type"){
          editType();
        } else if(table_name=="unit"){
          editUnit();
        } else if(table_name=="department"){
          editDepartment();
        } else if(table_name=="sector"){
          editSector();
        } else if(table_name=="filial"){
          editFilial();
        } else if(table_name=="area"){
          editArea();
        }
      }
    });
    setInterval(function(){
      $('#alert_message').html('');
    // alert("xxx");
  }, 10000);
  }

  $(document).on('blur', '.update', function(){
    var id = $(this).data("id");
    var column_name = $(this).data("column");
    var value = $(this).text();
    var table_name = $(this).data("table");
    update_data(id, column_name, value, table_name);
  });
  $(document).on('click', '#add', function(){
    var table_name = $(this).data("table");
    if (table_name=="ncatalog"){
      var html = '<tr>';
      html += '<td id="data1"></td>';
      html += '<td contenteditable id="data2"></td>';
      html += '<td contenteditable id="data3"></td>';
      html += '<td contenteditable id="data4"></td>';
      html += '<td><button type="button" name="insert" id="insert" class="btn btn-success btn-xs">Insert</button></td>';
      html += '</tr>';
      $('#user_data tbody').prepend(html);
    } else{
      var html = '<tr>';
      html += '<td id="data1"></td>';
      html += '<td contenteditable id="data2"></td>';
      html += '<td><button type="button" name="insert" id="insert_table" class="btn btn-success btn-xs" data-table="'+table_name+'">Insert</button></td>';
      html += '</tr>';
      $('#user_data tbody').prepend(html);}
    });
  
  $(document).on('click', '#insert', function(){
   // var id = $('#data1').text();
   var ncatalog_number = $('#data2').text();
   var ncatalog_name = $('#data3').text();
   var ncatalog_cabinet = $('#data4').text();
   if(ncatalog_number != '' && ncatalog_name != '')
   {
     $.ajax({
       url:"insert.php",
       method:"POST",
       data:{ncatalog_number:ncatalog_number, ncatalog_name:ncatalog_name, ncatalog_cabinet:ncatalog_cabinet, user:user},
       success:function(data)
       {
         var alert='<div class="alert alert-warning alert-dismissible" id="alert_message">\
         <button type="button" class="close" data-dismiss="alert">&times;</button>\
         <div class="alert alert-success">'+data+'</div>\
         </div>';
         $('#alert_message').prepend(alert);
      // $('#alert_message').html('<div class="alert alert-success">'+data+'</div>');
      $('#user_data').DataTable().destroy();
      editNumber();
    }
  });
     setInterval(function(){
       $('#alert_message').html('');
     }, 10000);
   }
   else
   {
     alert("Все поля обязательны к заполнению");
   }
 });
  $(document).on('click', '#insert_table', function(){
    var table_name = $(this).data("table");
   // var ncatalog_number = $('#data1').text();
   // alert (table_name);
   var name = $('#data2').text();
   if(name != '')
   {
     $.ajax({
       url:"insert_table.php",
       method:"POST",
       data:{table_name:table_name, name:name, user:user},
       success:function(data)
       {var alert='<div class="alert alert-warning alert-dismissible" id="alert_message">\
       <button type="button" class="close" data-dismiss="alert">&times;</button>\
       <div class="alert alert-success">'+data+'</div>\
       </div>';
       $('#alert_message').prepend(alert);
      // $('#alert_message').html('<div class="alert alert-success">'+data+'</div>');
      $('#user_data').DataTable().destroy();
      if (table_name=="ncatalog"){
        editNumber();
      } else if(table_name=="raspred"){
        editRaspred();
      } else if(table_name=="type"){
        editType();
      } else if(table_name=="unit"){
        editUnit();
      } else if(table_name=="department"){
        editDepartment();
      } else if(table_name=="sector"){
        editSector();
      } else if(table_name=="filial"){
        editFilial();
      } else if(table_name=="area"){
        editArea();
      }

    }
  });
     setInterval(function(){
       $('#alert_message').html('');
     }, 10000);
   }
   else
   {
     alert("Все поля обязательны к заполнению");
   }
 });
  $(document).on('click', '.delete', function(){
    var id = $(this).attr("id");
    var table_name = $(this).data("table");
    if(confirm("Вы серьезно хотите это удалить?"))
    {
      $.ajax({
        url:"delete.php",
        method:"POST",
        data:{id:id, table_name:table_name, user:user},
        success:function(data){
      // $('#alert_message').html('<div class="alert alert-success">'+data+'</div>');
      var alert='<div class="alert alert-danger alert-dismissible" id="alert_message">\
      <button type="button" class="close" data-dismiss="alert">&times;</button>\
      <div class="alert alert-danger alert-success">'+data+'</div>\
      </div>';
      $('#alert_message').prepend(alert);
      $('#user_data').DataTable().destroy();
      if (table_name=="ncatalog"){
        editNumber();
      } else if(table_name=="raspred"){
        editRaspred();
      } else if(table_name=="type"){
        editType();
      } else if(table_name=="unit"){
        editUnit();
      } else if(table_name=="department"){
        editDepartment();
      } else if(table_name=="sector"){
        editSector();
      } else if(table_name=="filial"){
        editFilial();
      } else if(table_name=="area"){
        editArea();
      }

    }
  });
      setInterval(function(){
        $('#alert_message').html('');
      }, 10000);
    }
  });

  function editSub(id) {
  // body...
  $("#editSub").modal("show");
  var updatedata={
    action: "load",
    id:id
  };
  updatedata = JSON.stringify(updatedata);
  $.ajax({
    url: 'table_crud.php',
    type: 'POST',
    dataType: 'json',
    data: {updatedata:updatedata},
    success:function(data){
      $('#ncatalog').attr({"data-table-id":data.id});
      $('#number').val(data.ncatalog_number);
      $('#ncatalog').val(data.ncatalog_name);
      $('#unit').val(data.unit_name);
      $('#unit').attr({"data-table-id":data.unit});
      $('#department').val(data.department_name);
      $('#department').attr({"data-table-id":data.department});
      $('#sector').val(data.sector_name);
      $('#sector').attr({"data-table-id":data.sector});
      $('#visibility').val(data.visibility);
      $('#free').val(data.free);
    }
})
  .done(function() {
    console.log("success");
  })
  .fail(function() {
    console.log("error");
  })
  .always(function() {
    console.log("complete");
  });
  
}
$(document).on('click', '.autoListNcatalog', function(){
  var idinput=event.target.id;
  input=event.target.id;
  var tablename = event.target.dataset.table;
  var query = $(this).val();
  var iddatatable = $(this).attr("data-table-id");
  var columnname=tablename+"_name";
  if (idinput=="number"){columnname=tablename+"_number";}
  // console.log("Имя столбца", columnname);
  idinput='#'+idinput;
  $('#result').remove();
  autoListNcatalog(tablename, idinput, query, columnname, iddatatable, input);
});
$(document).on('keyup', '.autoListNcatalog', function(){//потом переделать

  var idinput=event.target.id;
  input=event.target.id;
  var tablename = event.target.dataset.table;
  var query = $(this).val();
  var iddatatable = $(this).attr("data-table-id");
  var columnname=tablename+"_name";
  idinput='#'+idinput;
  $(idinput).attr({"data-table-id":"1"});
  $('#result').remove();
  autoListNcatalog(tablename, idinput, query, columnname, iddatatable, input);
});
function autoListNcatalog(tablename, idinput, query, columnname, iddatatable, input) {
  console.clear();
  console.log("Какой инпут посылает запрос (событие onkeyup, onclick): ", idinput+'\n'+
    "Длинна запроса: ", query.length+'\n'+
    "Поиск по таблице: ", tablename+'\n'+
    "Запрос: ", query);
  number=$('#number').val();

  if(!$("div").is("#result")){
    $("<div id='result' style='height:300px;overflow-y:scroll;'></div>").insertAfter(idinput);
  }

  $.ajax({
    url:"../loadtable.php",
    method:"POST",
    data:{input:input, idinput:idinput, query:query, tablename:tablename, columnname:columnname, iddatatable:iddatatable, number:number},
    success:function(data)
    {
      $('#result').html(data);
      if ($("div").is("#alertInfo")){

        var idvariable='#'+tablename+'Id';
        $(idvariable).val('');
        // btnblock();
      }
      if ($("div").is("#resultreturt")){

        var idvariabl='#'+tablename+'Id';
        $(idvariabl).val('');
        // btnblock();
      }
    }
  })
}
function updateKrossData(updateData){
  var idinput=updateData.getAttribute('data-idinput');
  console.log('data-idinput-----------------', idinput);
  var idinput="#"+idinput;
  $(idinput).attr({"data-table-id":updateData.getAttribute('data-idname')});
  $(idinput).val(updateData.getAttribute('data-value'));
  $(idinput).removeClass('alert alert-danger');
  $('#result').remove();
}
function btnblock(){

  if(!($("input").hasClass('alert-danger')))
  {
    console.log("Можно добавить данные");
      $(".btn-block").show(1000);
    }else{
      console.log("Нельзя добавить данные");
      $(".btn-block").hide(1000);
    }
  }
  function updateSub() {
    var href="http://newkross/table/table.php";
    var id=$('#ncatalog').attr("data-table-id");
    var action="update";
    var unit_id=$('#unit').attr("data-table-id");
    var department_id=$('#department').attr("data-table-id");
    var sector_id=$('#sector').attr("data-table-id");
    var free=$('#free').val();
    var visibility=$('#visibility').val();
   var updatedata={
      action: "update",
      id: id,
      unit_id: unit_id,
      department_id: department_id,
      sector_id: sector_id,
      visibility: visibility,
      free:free
    };
    updatedata = JSON.stringify(updatedata);
    if(unit_id==''){unit_id='1'}
      if(department_id==''){department_id='1'}
        if(sector_id==''){sector_id='1'}
          $.ajax({
            url: 'table_crud.php',
            method: 'POST',
            dataType: 'json',
            data: {updatedata:updatedata},
            success:function(data)
            {
              // alert(data);
              // // $('#content').html(data);
              $('#result').remove();
              $("#editSub").modal("hide");
              $("#myModalForm")[0].reset();

            }
          })
        .done(function() {
          console.log("success");
        })
        .fail(function() {
          console.log("error");
        })
        .always(function() {
          console.log("complete");
        });
         // var load_number=href+'?number='+$('#number').val();
         // location.replace(load_number);
      }
 // });