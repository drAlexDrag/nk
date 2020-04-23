$(document).ready(function(){
	if (($('#adm').text())!=1){
        $(".admin").remove();}
        $('[data-toggle="popover"]').popover();
    });
function loadLogKross() {
    // body...
    var content='<h1 align="center">Лог кроссовых журналов</h1>\
    <div><h4>\
    <span class="badge badge-success">Новые данные</span>\
    <span class="badge badge-primary">Обновление</span>\
    <span class="badge badge-danger">Очистка</span></h4>\
    </div>\
    <div class="table-responsive">\
    <br />\
    <table id="user_data" class="table table-bordered table-striped">\
    <thead>\
    <tr class="row_drag">\
    <th data-name-col="id">ID</th>\
    <th data-name-col="datechange">Дата</th>\
    <th data-name-col="data_id">ID Данных</th>\
    <th data-name-col="data_name">Данные</th>\
    <th data-name-col="old_raspred_name">Распределение Старое значение</th>\
    <th data-name-col="new_raspred_name">Распределение Новое значение</th>\
    <th data-name-col="old_number">Номер Старое значение</th>\
    <th data-name-col="new_number">Номер Новое значение</th>\
    <th data-name-col="old_ncatalog_name">Имя Старое значение</th>\
    <th data-name-col="new_ncatalog_name">Имя Новое значение</th>\
    <th data-name-col="old_type_name">Тип Старое значение</th>\
    <th data-name-col="new_type_name">Тип Новое значение</th>\
    <th data-name-col="old_comment">Комментарий Старое значение</th>\
    <th data-name-col="new_comment">Комментарий Новое значение</th>\
    <th data-name-col="area_name">Журнал</th>\
    <th data-name-col="user">Пользователь</th>\
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
    <div><h4>\
    <span class="badge badge-success">Новые данные</span>\
    <span class="badge badge-primary">Обновление</span>\
    <span class="badge badge-danger">Очистка</span></h4>\
    </div>\
    <div class="table-responsive">\
    <br />\
    <table id="user_data" class="table table-bordered table-striped">\
    <thead>\
    <tr class="row_drag">\
    <th data-name-col="id">ID</th>\
    <th data-name-col="datechange">Дата</th>\
    <th data-name-col="tabl">Таблица</th>\
    <th data-name-col="idval">ID Значения</th>\
    <th data-name-col="old_val">Старое значение</th>\
    <th data-name-col="new_val">Новое значение</th>\
    <th data-name-col="user">Пользователь</th>\
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
function loadLogNcatalog() {
    // body...
    var content='<h1 align="center">Лог справочника</h1>\
    <div><h4>\
    <span class="badge badge-success">Новые данные</span>\
    <span class="badge badge-primary">Обновление</span>\
    <span class="badge badge-danger">Очистка</span></h4>\
    </div>\
    <div class="table-responsive">\
    <br />\
    <table id="user_data" class="table table-bordered table-striped">\
    <thead>\
    <tr class="row_drag">\
    <th data-name-col="id">ID</th>\
    <th data-name-col="datechange">Дата</th>\
    <th data-name-col="ncatalog_id">ID в каталоге</th>\
    <th data-name-col="ncatalog_number">Номер</th>\
    <th data-name-col="old_ncatalog_name">Имя Старое значение</th>\
    <th data-name-col="new_ncatalog_name">Имя Новое значение</th>\
    <th data-name-col="old_ncatalog_cabinet">Кабинет Старое значение</th>\
    <th data-name-col="new_ncatalog_cabinet">Кабинет Новое значение</th>\
    <th data-name-col="user">Пользователь</th>\
    </tr>\
    </thead>\
    </table>\
    </div>';
    $("#content").html(content);
    var table_name="logncatalog";
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
    var colName=[];
    var i = 0;  
    $('.row_drag>th').each(function() { 
        colName.push($(this).attr("data-name-col"));
        i++;
    }); 
    return colName;
}