$(document).ready(function(){
	if (($('#adm').text())!=1){
    $(".admin").remove();}
    $('[data-toggle="popover"]').popover();
  });
 function loadLogKross() {
    // body...
    var content='<h1 align="center">Лог кроссовых журналов</h1>\
    <div class="table-responsive">\
    <br />\
    <table id="user_data" class="table table-bordered table-striped">\
    <thead>\
    <tr class="row_drag">\
    <th data-name-col="id">ID</th>\
    <th data-name-col="datechange">Дата</th>\
    <th data-name-col="data_id">ID Данных</th>\
    <th data-name-col="data_name">Данные</th>\
    <th data-name-col="old_raspred_name">Распределение old</th>\
    <th data-name-col="new_raspred_name">Распределение new</th>\
    <th data-name-col="old_number">Номер old</th>\
    <th data-name-col="new_number">Номер new</th>\
    <th data-name-col="old_ncatalog_name">Имя old</th>\
    <th data-name-col="new_ncatalog_name">Имя new</th>\
    <th data-name-col="old_type_name">Тип old</th>\
    <th data-name-col="new_type_name">Тип new</th>\
    <th data-name-col="old_comment">Комментарий old</th>\
    <th data-name-col="new_comment">Комментарий new</th>\
    <th data-name-col="area_name">Журнал</th>\
    <th data-name-col="user">Пользователь</th>\
    <th data-name-col="operation">Операция</th>\
    </tr>\
    </thead>\
    </table>\
    </div>';
    $("#content").html(content);
    var table_name="logkross";
    var col=getAllColName();
    col=JSON.stringify(col);
    loadLog(table_name, col);
}
function loadLogTables() {
    // body...
    var content='<h1 align="center">Лог таблиц</h1>\
    <div class="table-responsive">\
    <br />\
    <table id="user_data" class="table table-bordered table-striped">\
    <thead>\
    <tr class="row_drag">\
    <th data-name-col="id">ID</th>\
    <th data-name-col="datechange">Дата</th>\
    <th data-name-col="tabl">Таблица</th>\
    <th data-name-col="idval">ID Значения</th>\
    <th data-name-col="old_val">old Значение</th>\
    <th data-name-col="new_val">new Значение</th>\
    <th data-name-col="user">Пользователь</th>\
    <th data-name-col="operation">Операция</th>\
    </tr>\
    </thead>\
    </table>\
    </div>';
    $("#content").html(content);
    var table_name="logtable";
    var col=getAllColName();
    col=JSON.stringify(col);
    loadLog(table_name, col);
}
    function loadLog(table_name, col){
    var dataTable = $('#user_data').DataTable({
      "processing" : true,
      "serverSide" : true,
      "info": true,
      "searching": true,
      "language": {
        "info": "Показана страница _PAGE_ из _PAGES_ страниц",
        "lengthMenu": "Показать _MENU_ строк на страницу",
        "infoFiltered": " - отфильтровано из _MAX_ записей",
        "zeroRecords": "Ничего похожего не найдено",
        "infoEmpty": "Нет записей для показа",
        "loadingRecords": "Пожалуйста, подождите - идет загрузка ...",
        "processing": "Обработка ...",
        "search": "Поиск:",
        "paginate": {
          "previous": "Предыдущая",
          "next": "Следующая",
        }
      },
      "order" : [[0,'desc']],
    // "deferLoading": [ 57, 100 ],
    // "search": {
    //   "search": 0000
    // },
    "lengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]],
    "ajax" : {
      url:"loadlog.php",
      data:{table_name:table_name, col:col},
      type:"POST"
    }
  });
  }
  function getAllColName() {
// texts = document.querySelectorAll(".row_drag>th");
//            suball = texts.length;
//     arrtext = Array.from(texts);
// console.log(arrtext);
//     var i = 0;
//     for(; i < suball; i++){
//         var co = i;
//         console.log(arrtext[co]);
//     }
var colName=[];
var i = 0;  
$('.row_drag>th').each(function() { 
// $(this).attr("data-name-col", i);
colName.push($(this).attr("data-name-col"));
// console.log(colName);
i++;
            }); 
return colName;

}