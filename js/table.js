$(document).ready(function(){
   $('[data-toggle="popover"]').popover();
   $('[data-toggle="tooltip"]').tooltip();
   // $('.krossdata').tooltip({title: "Hooray!", container: ".parent"});
   });

  fetch_data();
// function krossData() {
//   var id = $(this).attr("id");
//   alert(id);
// }
  $(document).on('click', '.krossdata', function(){
    var value = $(this).text();
    var id = $(this).data("id");
    var selector='[name="'+id+'"]';
    console.log(selector);
  $.ajax({
     url:"kd_info.php",
     method:"POST",
     data:{id:id},
     success:function(data)
     {

      // $('#alert_message').html(data);
      // alert(id);
      // $(selector).attr('data-toggle', 'tooltip');
      $(selector).tooltip({title: '<h1>'+data+'</h1>', html: true, placement: "bottom"});;//attr('title', "Исходящие Дзержинка: "+data);
     }
    });

  // $(this).text(data);
});
  function editRaspred() {
    var content='<h1 align="center">Таблица распределений</h1>\
   <div class="table-responsive">\
    <div align="right">\
     <button type="button" name="add" id="add" class="btn-sm btn-info" data-table="raspred">Добавить распределение</button>\
    </div>\
    <br />\
    <table id="user_data" class="table table-bordered table-striped">\
     <thead>\
      <tr>\
       <th>ID</th>\
       <th>Распределение</th>\
       <th></th>\
      </tr>\
     </thead>\
    </table>\
   </div>';
   var col=["id", "raspred_name"];
   var table_name="raspred";
   fetch_table(content, table_name, col);
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
      <tr>\
       <th>ID</th>\
       <th>Тип линии</th>\
       <th></th>\
      </tr>\
     </thead>\
    </table>\
   </div>';
   var col=["id", "type_name"];
   var table_name="type";
   fetch_table(content, table_name, col);
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
      <tr>\
       <th>ID</th>\
       <th>Управление</th>\
       <th></th>\
      </tr>\
     </thead>\
    </table>\
   </div>';
   var col=["id", "unit_name"];
   var table_name="unit";
   fetch_table(content, table_name, col);
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
      <tr>\
       <th>ID</th>\
       <th>Отделы/бюро</th>\
       <th></th>\
      </tr>\
     </thead>\
    </table>\
   </div>';
   var col=["id", "department_name"];
   var table_name="department";
   fetch_table(content, table_name, col);
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
      <tr>\
       <th>ID</th>\
       <th>Сектор</th>\
       <th></th>\
      </tr>\
     </thead>\
    </table>\
   </div>';
   var col=["id", "sector_name"];
   var table_name="sector";
   fetch_table(content, table_name, col);
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
      <tr>\
       <th>ID</th>\
       <th>Филиал</th>\
       <th></th>\
      </tr>\
     </thead>\
    </table>\
   </div>';
   var col=["id", "filial_name"];
   var table_name="filial";
   fetch_table(content, table_name, col);
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
      <tr>\
       <th>ID</th>\
       <th>Площадка</th>\
       <th></th>\
      </tr>\
     </thead>\
    </table>\
   </div>';
   var col=["id", "area_name"];
   var table_name="area";
   fetch_table(content, table_name, col);
}
function fetch_table(content, table_name, col){
  $("#content").html(content);
   var dataTable = $('#user_data').DataTable({
    "processing" : true,
    "serverSide" : true,
    "info": true,
    "language": {
                "search": "Поиск:",
                "paginate": {
                     "previous": "Предыдущая",
                     "next": "Следующая",
                   }
              },
    "order" : [],
    "lengthMenu": [[20, 50, 100, -1], [20, 50, 100, "All"]],
    "ajax" : {
     url:"fetch_table.php",
     data:{table_name:table_name, col:col},
     type:"POST"
    }
   });
  }
  function editNumber() {
    // body...
    var content='<h1 align="center">Таблица абонентов</h1>\
   <div class="table-responsive">\
    <div align="right">\
     <button type="button" name="add" id="add" class="btn-sm btn-info" data-table="ncatalog">Добавить номер</button>\
    </div>\
    <br />\
    <table id="user_data" class="table table-bordered table-striped">\
     <thead>\
      <tr>\
      <th>ID абонента</th>\
       <th>Номер</th>\
       <th>Имя абонента</th>\
       <th>Кабинет</th>\
       <th></th>\
      </tr>\
     </thead>\
    </table>\
   </div>';
  var col=["ncatalog_number", "ncatalog_name", "ncatalog_cabinet"];
  var table_name="ncatalog";
    fetch_data(content, table_name);
  }

  function fetch_data(content, table_name)
  {
    $("#content").html(content);
    var ncatalog_number="ncatalog_number";
    var ncatalog_name="ncatalog_name";
    var ncatalog_cabinet="ncatalog_cabinet";
   var dataTable = $('#user_data').DataTable({
    "processing" : true,
    "serverSide" : true,
    "info": true,
    "searching": true,
    "language": {
                "search": "Поиск:",
                "paginate": {
                     "previous": "Предыдущая",
                     "next": "Следующая",
                   }
              },
    "order" : [],
    "lengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]],
    "ajax" : {
     url:"fetch.php",
     data:{ncatalog_number:ncatalog_number, ncatalog_name:ncatalog_name, ncatalog_cabinet:ncatalog_cabinet, table_name:table_name},
     type:"POST"
    }
   });
  }
  
  function update_data(id, column_name, value, table_name)
  {
   $.ajax({
    url:"update.php",
    method:"POST",
    data:{id:id, column_name:column_name, value:value, table_name:table_name},
    success:function(data)
    {
     $('#alert_message').html('<div class="alert alert-success">'+data+'</div>');
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
  // $('#add').click(function(){
  //   alert ('#add');
  //  var html = '<tr>';
  //  html += '<td contenteditable id="data1"></td>';
  //  html += '<td contenteditable id="data2"></td>';
  //  html += '<td><button type="button" name="insert" id="insert" class="btn btn-success btn-xs">Insert</button></td>';
  //  html += '</tr>';
  //  $('#user_data tbody').prepend(html);
  // });
  
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
     data:{ncatalog_number:ncatalog_number, ncatalog_name:ncatalog_name, ncatalog_cabinet:ncatalog_cabinet},
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
     data:{table_name:table_name, name:name},
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
    alert("Both Fields is required");
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
     data:{id:id, table_name:table_name},
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
 // });