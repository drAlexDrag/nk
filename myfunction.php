<?php
// маркировка типов данных по цветам
function ColorType($type)
{
	switch ($type) {
		case 'Прямая':
		$color='class="table-primary"';
		break;
		case 'Сигнализация':
		$color='class="w3-blue"';
		break;
		case 'Часы':
		$color='class="w3-violet"';
		break;
		case 'Телефон':
		$color='class="table-success"';
		break;
		case 'Земля':
		$color='class="table-dark"';
		break;
		case 'Обрыв':
		$color='class="table-danger"';
		break;
		case 'Свободный':
		$color='class="table-warning"';
		break;
		case 'Сирена':
		$color='class="w3-navy"';
		break;
		default:
		$color='';
		break;
	}
	return $color;
}

//Шапка таблиц по krossdata
function TheadPanasonic()
{
	$output='';
	$output.='
	<table class="table table-bordered table-hover">
	<thead>
	<tr>
	<th>Бокс/Абонент</th>
	<th>Распределение</th>
	<th>Номер <span class="icon">b</span></th>
	<th>Имя абонента <span class="icon">b</span></th>
	<th>Тип</th>
	<th>Комментарии <span class="icon">b</span></th>
	<th>Кабинет <span class="icon">b</span></th>
	<th>Кросс</th>
	</tr>
	</thead>
	<tbody id="myTable">';
	return $output;
}
function TheadKrossdata()
{
	$output='';
	$output.='
	<table class="table table-bordered table-hover">
	<thead>
	<tr>
	<th>Данные</th>
	<th>Распределение</th>
	<th>Номер <span class="icon">b</span></th>
	<th>Имя абонента <span class="icon">b</span></th>
	<th>Тип</th>
	<th>Комментарии <span class="icon">b</span></th>
	<th>Кабинет <span class="icon">b</span></th>
	<th>Кросс</th>
	</tr>
	</thead>
	<tbody id="myTable">';
	return $output;
}
// data-target="#myModalCRUD"
// function TbodyKrossdata($row, $color)
// {
// 	$output='';
// 	$output .= '<tr '.$color.'>
// 	<td  class="edit_data" data-id="'.$row["id"].'"  data-ncatalogid="'.$row["ncatalog_id"].'" data-idxxx="'.$row["data"].'" data-idarea="'.$row["area_name"].'" title="Редактировать?" data-toggle="modal" ><b>'.$row["data"].' </b></td>
// 	<td>'.$row["raspred_name"].'</td>
// 	<td class="data-number" data-number="'.$row["data"].'" data-idnumber="'.$row["number"].'" title="Быстрый поиск по номеру: '.$row["number"].'">'.$row["number"].' <span class="glyphicon glyphicon-search"></span></td>
// 	<td class="data-name" data-ncatalog="'.$row["ncatalog_name"].'" data-name="'.$row["data"].'" title="ID абонента-'.$row["ncatalog_id"].'" data-idname="'.$row["ncatalog_name"].'">'.$row["ncatalog_name"].'</td>
// 	<td data-type="'.$row["data"].'" >'.$row["type_name"].'</td>
// 	<td>'.$row["comment"].'</td>
// 	<td>'.$row["area_name"].'</td>
// 	</tr>';
// 	return $output;
// }
function TbodyKrossdata($row, $color)
{
	$output='';
	$output .= '<tr style="cursor: default" '.$color.'>
	<td class="edit_daxta" data-id="'.$row["id"].'" data-area-name="'.$row["area_name"].'"   onmousedown="isKeyPressed(event, '.$row["id"].')"><b>'.$row["data"].' </b><span class="icon">?</span></td>
	<td>'.$row["raspred_name"].'</td>
	<td class="data-number" title="Быстрый поиск по номеру: '.$row["number"].'">'.$row["number"].' </td>
	<td class="data-name" title="ID абонента-'.$row["ncid"].'">'.$row["ncatalog_name"].'</td>
	<td data-type="'.$row["data"].'" >'.$row["type_name"].'</td>
	<td class="data-comment">'.$row["comment"].'</td>
	<td class="data-cabinet">'.$row["ncatalog_cabinet"].'</td>
	<td>'.$row["area_name"].'</td>
	</tr>';
	return $output;
}


function OutputTheadCatalog()
{
  # code...
	$outputThead="";//Шапка справочника
	$outputThead='
	<table class="table table-bordered table-hover"> 
	<thead><tr>
	<th>ID</th>
	<th>Абонент</th>
	<th>Номер</th>
	<th>Управление</th>
	<th>Отдел/Бюро</th>
	<th>Кабинет</th>
	
	</tr></thead>';//<th>Филиал</th>
	return $outputThead;
}
function OutputTbodyCatalog($row){
	$outputTbody='';
	$outputTbody .='<tbody>';
	if (($row["visibility"])=="1"){
		$outputTbody .='<tr>';
	}
	else {
		$outputTbody .='<tr style="background:  #FF4500">';
	}
	$outputTbody .='<td class="red_modal" data-ncatalog="'.$row["ncatalog_name"].'" data-id="'.$row["id"].'" onclick="tablnumber('.$row["ncatalog_number"].')">'.$row["id"].'<span class="glyphicon glyphicon-edit"></span></td>
	<td class="data-name" title="ID абонента-'.$row["id"].'">'.$row["ncatalog_name"].'</td>
	<td class="data-number">'.$row["ncatalog_number"].'</td>
	<td>'.$row["unit_name"].'</td>
	<td>'.$row["department_name"].'</td>
	<td>'.$row["ncatalog_cabinet"].'</td>
	
	</tr>';//<td>'.$row["filial_name"].'</td>
	return $outputTbody;
}
function BeansNull($catalogBeans, $searchString){
	$output='';
	$output='<br><div class="alert alert-danger">
	Информация по : <strong>'.$searchString.'</strong><br>Отсутствует в справочнике<hr><button type="button" class="btn btn-primary" onclick="catalogAdd('.$searchString.')">Добавить абонента в справочник</button></div>';
	return $output;
}
?>