<?php
require 'connect.php';
// require_once "phpdebug/phpdebug.php";//вывод в консоль
// $debug = new PHPDebug();
// $debug->debug("Очень простое сообщение на консоль", null, LOG);
// $debug->debug("Очень простое сообщение на консоль2", null, LOG);
$dataPost=$_POST;
$action=$dataPost["action"];
$user=$dataPost["user"];
switch ($action) {
  case 'loadData':
        ///////////Подгружаем текущие данные в окно редактирования данных кроса////////
  $krossdata = R::load( 'krossdata', $dataPost["data_id"] );
  $krossobj = array(
    'id'=>$krossdata->id,
    'data'=>$krossdata->data,
    'number'=>$krossdata->number,
    // 'cabinet'=>$krossdata->cabinet,
    'comment'=>$krossdata->comment,
    'raspred'=>R::load('raspred', $krossdata->raspred_id),
    'ncatalog'=>R::load('ncatalog', $krossdata->ncatalog_id),
    'type'=>R::load('type', $krossdata->type_id),
    'area'=>R::load('area', $krossdata->area_id)
  );
  echo(json_encode($krossobj));
  break;
///////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////
  case 'updateData'://ПРоверка на наличие ncatalog.id
  $updateKrossData = json_decode($_POST['updateKrossData'], true);
$krossdata = R::load( 'krossdata', $updateKrossData["id"] ); //reloads our data
////////////////////////////////////////////////////////////////
$logkross=R::dispense('logkross');//логируем данные до обновления
$logkross->data_id=$updateKrossData["id"];
  $logkross->data_name=$krossdata->data;
$raspred=R::load( 'raspred', $krossdata->raspred_id);
  $logkross->old_raspred_name=$raspred->raspred_name;
  $logkross->old_number=$krossdata->number;
  $ncatalog=R::load( 'ncatalog', $krossdata->ncatalog_id);
  $logkross->old_ncatalog_name=$ncatalog->ncatalog_name;
  $type=R::load( 'type', $krossdata->type_id);
  $logkross->old_type_name=$type->type_name;
  $logkross->old_comment=$krossdata->comment;
  $area=R::load( 'area', $krossdata->area_id);
  $logkross->area_name=$area->area_name;
  // R::store($logkross);
////////////////////////////////////////////////////////////
$krossdata->raspred_id=$updateKrossData["raspred"];
$krossdata->number=$updateKrossData["number"];
$krossdata->ncatalog_id=$updateKrossData["ncatalog"];
$krossdata->type_id=$updateKrossData["type"];
$krossdata->comment=$updateKrossData["comment"];
$ncatalog_cabinet = R::load( 'ncatalog', $updateKrossData["ncatalog"]);
$ncatalog_cabinet->ncatalog_cabinet=$updateKrossData["cabinet"];
R::store($ncatalog_cabinet);
// $krossdata->cabinet=$updateKrossData["cabinet"];
R::store($krossdata);
/////////////////////ЛОГ ДАННЫХ КРОСА////////////////////
  
  $raspred=R::load( 'raspred', $updateKrossData["raspred"]);
  $logkross->new_raspred_name=$raspred->raspred_name;
  $logkross->new_number=$updateKrossData["number"];
  $ncatalog=R::load( 'ncatalog', $updateKrossData["ncatalog"]);
  $logkross->new_ncatalog_name=$ncatalog->ncatalog_name;
  $type=R::load( 'type', $updateKrossData["type"]);
  $logkross->new_type_name=$type->type_name;
  $logkross->new_comment=$updateKrossData["comment"];
  $area=R::load( 'area', $krossdata->area_id);
  $logkross->area_name=$area->area_name;
  $logkross->user=$user;
  $logkross->operation="2";
  R::store($logkross);
/////////////////////////////////////////////////////////



$areaQuery = R::getAll('SELECT area_name FROM area');
foreach($areaQuery as $row)
{
  $area=$row['area_name'];
// $idDataKross=R::getCol('SELECT id FROM krossdata WHERE data=? AND area_id=?', [$dataKross, $areaId]);
  $updatebean=R::getAll('SELECT krossdata.id, krossdata.data, raspred.raspred_name, krossdata.number, ncatalog.id AS ncid, ncatalog.ncatalog_name, type.type_name, krossdata.comment, ncatalog.ncatalog_cabinet, area.area_name
    FROM krossdata
    INNER JOIN raspred ON krossdata.raspred_id = raspred.id
    INNER JOIN ncatalog ON krossdata.ncatalog_id = ncatalog.id
    INNER JOIN type ON krossdata.type_id = type.id
    INNER JOIN area ON krossdata.area_id = area.id
    WHERE krossdata.number=? AND area.area_name=?', [$updateKrossData["number"], $area]);
  $outputUpdate='';
  //echo($updateDataKross);
  $outputUpdate .= '<div class="table-responsive table-bordered"><h3 style="color:blue">'.$headertable.''.$area.'</h3>';
  $outputUpdate .= TheadKrossdata();
  foreach($updatebean as $row){

    //$outputUpdate='<br>'.$row['number'];
    $color=ColorType($row["type_name"]);
    $outputUpdate .=TbodyKrossdata($row, $color);
  }
  $outputUpdate.='</tbody></table></div>';
  if ($updatebean==null){$outputUpdate='';}
  echo($outputUpdate);
}

////////////////////////////////////Работа с Каталогом/////////////////
// $outputcatalog.= '
//            <label class="text-success">Результат обработки</label>';
$outputcatalog.= '<div class="table-responsive table-bordered" id="catalog_table">';
$outputcatalog.=OutputTheadCatalog();
$catalogbean = R::getAll('SELECT ncatalog.id, ncatalog.ncatalog_number, ncatalog.ncatalog_name, unit.unit_name, department.department_name, sector.sector_name, ncatalog.ncatalog_cabinet, ncatalog.visibility
  FROM ncatalog
  INNER JOIN unit ON ncatalog.unit_id = unit.id
  INNER JOIN department ON ncatalog.department_id = department.id
  INNER JOIN sector ON ncatalog.sector_id = sector.id
  where ncatalog.ncatalog_number=? order by ncatalog.id', [$updateKrossData["number"]]);
// WHERE sub.id=? and catalog.vnutr=? ORDER BY catalog.id', [$subId, $dataNumber]);
foreach($catalogbean as $row)
{
  $outputcatalog .=OutputTbodyCatalog($row);

}
$outputcatalog.= '</tbody></table></div>';

echo($outputcatalog);
break;
////////////////////////////////////////////////////////////
case 'insertData':
$insertKrossData = json_decode($_POST['insertKrossData'], true);
$krossdata = R::dispense('krossdata'); //reloads our data
$krossdata->data=$insertKrossData["data"];
$krossdata->raspred_id=$insertKrossData["raspred"];
$krossdata->number=$insertKrossData["number"];
$krossdata->ncatalog_id=$insertKrossData["ncatalog"];
$krossdata->type_id=$insertKrossData["type"];
$krossdata->comment=$insertKrossData["comment"];
// $ncatalog_cabinet = R::load( 'ncatalog', $insertKrossData["ncatalog"]);
// $ncatalog_cabinet->ncatalog_cabinet=$insertKrossData["cabinet"];
// R::store($ncatalog_cabinet);
// $krossdata->cabinet=$insertKrossData["cabinet"];
$krossdata->area_id=$insertKrossData["area"];
$area = R::load('area', $krossdata->area_id);
// $debug->debug($area["area_name"], null, LOG);
R::store($krossdata);
$getinsertID=R::getinsertID();
////////////////////////////////////////
$krossdata = R::load( 'krossdata', $getinsertID );
$logkross=R::dispense('logkross');
$logkross->data_id=$krossdata->id;
$logkross->data_name=$krossdata->data;
$raspred=R::load( 'raspred', $krossdata->raspred_id);
$logkross->new_raspred_name=$raspred->raspred_name;
$logkross->new_number=$krossdata->number;
$ncatalog=R::load( 'ncatalog', $krossdata->ncatalog_id);
$logkross->new_ncatalog_name=$ncatalog->ncatalog_name;
$type=R::load( 'type', $krossdata->type_id);
$logkross->new_type_name=$type->type_name;
$logkross->new_comment=$krossdata->comment;
$area=R::load( 'area', $krossdata->area_id);
$logkross->area_name=$area->area_name;
$logkross->user=$user;
$logkross->operation="1";
R::store($logkross);
////////////////////////////////////////
$message.= '<div class="alert alert-info" role="alert">Площадка: <strong>'.$area["area_name"].'</strong><hr>Добавлены новые данные: <strong>'.$insertKrossData["data"].'</strong></div>';
echo ($message);
break;


///////////////////////////////////
case 'data_autosearch':
$output = '';
  $areaname =htmlspecialchars ($_POST["areaname"]);
  $serachString =htmlspecialchars ($_POST["serachString"]);
  $beans = R::getAll('SELECT krossdata.id, krossdata.data, raspred.raspred_name, krossdata.number, ncatalog.ncatalog_name, type.type_name, krossdata.comment, ncatalog.ncatalog_cabinet, area.area_name
    FROM krossdata
    INNER JOIN raspred ON krossdata.raspred_id = raspred.id
    INNER JOIN ncatalog ON krossdata.ncatalog_id = ncatalog.id
    INNER JOIN type ON krossdata.type_id = type.id
    INNER JOIN area ON krossdata.area_id = area.id
    WHERE krossdata.data=? AND area.area_name=?', [ $serachString, $areaname ]);
  foreach($beans as $row)
  {
    }
    if ($beans==null) {
      $output .= '<div class="alert alert-success" role="alert">Данные '.$serachString.' отсутствуют в базе '.$areaname.' и могут быть добавлены</div>';
    } else{
      $output .= '<div class="alert alert-danger" role="alert" id="dangeralert">Данные '.$serachString.' по '.$areaname.' добавить повторно невозможно. Можно изменить только в режиме редактирования</div>';
    }
    $output .= '';
    echo $output;
break;
/////////////////////////////////////
case 'clearData':
$clearKrossData = json_decode($_POST['clearKrossData'], true);
$krossdata = R::load( 'krossdata', $clearKrossData["id"] );
//////////////////////////////////////
$logkross=R::dispense('logkross');
$logkross->data_id=$clearKrossData["id"];
$logkross->data_name=$krossdata->data;
$raspred=R::load( 'raspred', $krossdata->raspred_id);
$logkross->old_raspred_name=$raspred->raspred_name;
$logkross->old_number=$krossdata->number;
$ncatalog=R::load( 'ncatalog', $krossdata->ncatalog_id);
$logkross->old_ncatalog_name=$ncatalog->ncatalog_name;
$type=R::load( 'type', $krossdata->type_id);
$logkross->old_type_name=$type->type_name;
$logkross->old_comment=$krossdata->comment;
$area=R::load( 'area', $krossdata->area_id);
$logkross->area_name=$area->area_name;
// R::store($logkross);
//////////////////////////////////////
$krossdata->raspred_id=1;
$ncatalog=R::load( 'ncatalog', 3000);
$krossdata->number=$ncatalog->ncatalog_number;
$krossdata->ncatalog_id=$ncatalog->id;
$krossdata->type_id=$clearKrossData['selectTypeId'];
// $krossdata->cabinet="";
R::store($krossdata);
/////////////////////ЛОГ ДАННЫХ КРОСА////////////////////

$raspred=R::load( 'raspred', $krossdata->raspred_id);
$logkross->new_raspred_name=$raspred->raspred_name;
$logkross->new_number=$krossdata->number;
$ncatalog=R::load( 'ncatalog', $krossdata->ncatalog_id);
$logkross->new_ncatalog_name=$ncatalog->ncatalog_name;
$type=R::load( 'type', $krossdata->type_id);
$logkross->new_type_name=$type->type_name;
$logkross->new_comment=$krossdata->comment;
$area=R::load( 'area', $krossdata->area_id);
$logkross->area_name=$area->area_name;
$logkross->user=$clearKrossData['user'];
$logkross->operation="3";
R::store($logkross);
/////////////////////////////////////////////////////////
$type=R::load( 'type', $_POST['selectTypeId'] );
$out="";
  $out.='<div class="alert alert-danger" role="alert" id="dangeralert">Даннные <strong style="font-size:25px">'.$clearKrossData["data"].'</strong> очищены и помечены как <strong style="font-size:25px">'.$type->type_name.'</strong></div>';
  echo $out;
break;
///////////////////////////////////////////Перекроссировка///////////////
case 'perekross':
$krossdata = R::load( 'krossdata', $dataPost["data_id"] );
  $krossobj = array(
    'id'=>$krossdata->id,
    'data'=>$krossdata->data,
    'number'=>$krossdata->number,
    // 'cabinet'=>$krossdata->cabinet,
    'comment'=>$krossdata->comment,
    'raspred'=>R::load('raspred', $krossdata->raspred_id),
    'ncatalog'=>R::load('ncatalog', $krossdata->ncatalog_id),
    'type'=>R::load('type', $krossdata->type_id),
    'area'=>R::load('area', $krossdata->area_id)
  );
$pereKrossIn= $krossobj['id'];
$output.='<div class="alert alert-info"><div class="input-group"><input type="text" class="form-control" id="pereKrossIn" value="'.$pereKrossIn.'" hidden><input type="text" name="pereKrossOut" id="pereKrossOut" onkeyup="searchData()" class="form-control" placeholder="На какие данные переносим или копируем?"></div>
<div id="resultSearch"></div>
</div>';
echo $output;
  // echo (json_encode($krossobj['area']));
break;
case 'search_pereKross':
$outputOut="";
$getDataId =R::getRow( 'SELECT * FROM krossdata WHERE area_id=? AND data=?', [ $_POST['areaId'], $_POST['dataName'] ]);
$dataId=$getDataId["id"];
$krossdata = R::load( 'krossdata', $dataId );
$raspred=R::load('raspred', $krossdata->raspred_id);
$ncatalog=R::load('ncatalog', $krossdata->ncatalog_id);
$type=R::load('type', $krossdata->type_id);
$area=R::load('area', $krossdata->area_id);
  $krossobj = array(
    'id'=>$krossdata->id,
    'data'=>$krossdata->data,
    'number'=>$krossdata->number,
    'cabinet'=>$ncatalog->ncatalog_cabinet,
    'comment'=>$krossdata->comment,
    'raspred'=>$raspred->raspred_name,
    'ncatalog'=>$ncatalog->ncatalog_name,
    'type'=>$type->type_name,
    'area'=>$area->area_name
    // 'raspred'=>R::load('raspred', $krossdata->raspred_id),
    // 'ncatalog'=>R::load('ncatalog', $krossdata->ncatalog_id),
    // 'type'=>R::load('type', $krossdata->type_id),
    // 'area'=>R::load('area', $krossdata->area_id)
  );
  $pereKrossOut=$krossobj['id'];
  $buttonOut.='<div class="row"><div class="mr-auto col-sm-6"><button type="button" class="btn btn-danger " onclick="select_typePK('.$pereKrossOut.')">Выполнить перекроссировку</button></div>

<div class="mr-auto col-sm-6"><button type="button" class="btn btn-warning " onclick="select_raspredCopy('.$pereKrossOut.')">Выполнить копирование данных</button></div><hr></div>';
  // var_dump($krossdata);
  if ($getDataId==null){$outputOut.='<br><div class="alert alert-info">
<strong>Info!</strong> Данные '.$_POST['dataName'].'  не найдены. Но при перекроссировании или копировании будут созданы
</div>'.$buttonOut;} else{
  $outputOut.='

<div class="table-sm" style="border-color:blue; border-style: double; margin-top: 5px; border-radius: 10px;">
<table class="table table-bordered table-hover">
<thead>
<tr>
<th>Данные</th>
<th>Распределение</th>
<th>Номер</th>
<th>Имя</th>
<th>Тип</th>
<th>Комментарии</th>
<th>Кабинет</th>
<th>Площадка</th>
</tr></thead>
<tbody>';
$color=ColorType($krossobj["type"]);
$outputOut.='<tr '.$color.'>
<td>'.$krossobj['data'].'</td>
<td>'.$krossobj['raspred'].'</td>
<td>'.$krossobj['number'].'</td>
<td>'.$krossobj['ncatalog'].'</td>
<td>'.$krossobj['type'].'</td>
<td>'.$krossobj['comment'].'</td>
<td>'.$krossobj['cabinet'].'</td>
<td>'.$krossobj['area'].'</td>
</tr></tbody></table></div>
<hr>'.$buttonOut;}
  // echo (json_encode($getDataId));
echo $outputOut;
// echo($pereKrossIn."----->>>>>".$pereKrossOut.$GLOBALS[$pereKrossIn]);
break;
case 'confirm_pereKross':///ПЕреносим информацию с данных XXX на данные YYY. Сделать проверку? на изменение типа данных XXX
$output='';
$id=$dataPost["pereKrossOut"];
$dataIn = R::load('krossdata', $dataPost["pereKrossIn"]);

if ($dataPost["pereKrossOut"]==0) {
  # code...
  $dataOut = R::dispense('krossdata');
  $id = R::getInsertID();
  $dataOut = R::load('krossdata', $id);
  $dataOut->data = $dataPost["dataName"];
  $dataOut->number = $dataIn->number;
  // $dataOut->comment = $dataIn->comment;
  $dataOut->raspred_id = $dataIn->raspred_id;
  $dataOut->ncatalog_id = $dataIn->ncatalog_id;
  $dataOut->type_id = $dataIn->type_id;
  $dataOut->area_id = $dataIn->area_id;
  R::store($dataOut);
} else{
  $dataOut = R::load('krossdata', $id);
$dataOut->number = $dataIn->number;
// $dataOut->comment = $dataIn->comment;
$dataOut->raspred_id = $dataIn->raspred_id;
$dataOut->ncatalog_id = $dataIn->ncatalog_id;
$dataOut->type_id = $dataIn->type_id;
$dataOut->area_id = $dataIn->area_id;
R::store($dataOut);
}
$dataIn->raspred_id=1;
$dataIn->number=9999999;
$dataIn->ncatalog_id=3000;
$dataIn->type_id=$_POST['selectTypeId'];
R::store($dataIn);
$output.='<div class="alert alert-danger" role="alert" id="dangeralert">Информация с данных <strong style="font-size:25px">'.$dataIn->data.'</strong> перекроссирована на данные <strong style="font-size:25px">'.$dataPost["dataName"].'</strong></div>';
echo $output;
break;
case 'confirm_copy':
$output='';
$id=$dataPost["pereKrossOut"];
$dataIn = R::load('krossdata', $dataPost["pereKrossIn"]);

// if ($dataPost["pereKrossOut"]==0) {
//   # code...
//   $dataOut = R::dispense('krossdata');
//   $id = R::getInsertID();
//   $dataOut = R::load('krossdata', $id);
//   $dataOut->data = $dataPost["dataName"];
//   $dataOut->number = $dataIn->number;
//   // $dataOut->comment = $dataIn->comment;
//   $dataOut->raspred_id = $dataIn->raspred_id;
//   $dataOut->ncatalog_id = $dataIn->ncatalog_id;
//   $dataOut->type_id = $dataIn->type_id;
//   $dataOut->area_id = $dataIn->area_id;
//   R::store($dataOut);
// } else{
  $dataOut = R::load('krossdata', $id);
$dataOut->number = $dataIn->number;
// $dataOut->comment = $dataIn->comment;
$dataOut->raspred_id = $_POST['selectRaspredId'];
$dataOut->ncatalog_id = $dataIn->ncatalog_id;
$dataOut->type_id = $dataIn->type_id;
$dataOut->area_id = $dataIn->area_id;
R::store($dataOut);
// }
// $dataIn->raspred_id=1;
// $dataIn->number=9999999;
// $dataIn->ncatalog_id=3000;
// $dataIn->type_id=$_POST['selectTypeId'];
// R::store($dataIn);
$output.='<div class="alert alert-danger" role="alert" id="dangeralert">Информация с данных <strong style="font-size:25px">'.$dataIn->data.'</strong> скопирована на данные <strong style="font-size:25px">'.$dataPost["dataName"].'</strong></div>';
echo $output;
break;
}
////////////////////////////Function////////////////////

?>