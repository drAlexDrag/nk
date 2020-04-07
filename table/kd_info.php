<?php
require '../connect.php';
if(isset($_POST["number"])){
  $beans = R::getAll('SELECT krossdata.id, ncatalog.id AS ncid, krossdata.data, raspred.raspred_name, krossdata.number, ncatalog.ncatalog_name, ncatalog.ncatalog_cabinet, type.type_name, krossdata.comment,  area.area_name
  FROM krossdata
  INNER JOIN raspred ON krossdata.raspred_id = raspred.id
  INNER JOIN ncatalog ON krossdata.ncatalog_id = ncatalog.id
  INNER JOIN type ON krossdata.type_id = type.id
  INNER JOIN area ON krossdata.area_id = area.id
  WHERE krossdata.number=? AND raspred.id=2
  ORDER BY krossdata.data', [$_POST["number"]]);
}
$out='';
// $out='<table class="table table-bordered table-striped">
    // <thead>
    // <tr>
    // <th>Данные</th>
    // <th>Распределение</th>
    // <th>Площадка</th>
    // </tr>
    // </thead>
    // <tbody>
    // <tr>';
foreach($beans as $row){
  $data=$row['data'];
  $raspred=$row['raspred_name'];
  $area=$row['area_name'];
if ($data!=null)
  {$out.='<div style="width: 500px;">Данные: '.$data.'<br/>Распределение: '.$raspred.'<br/>Площадка: '.$area.'</div><hr>'; //('<p>Исходящие данные по Дзержинке</p><h1>'.$data.'</h1>');
}
  else {$out='Входящих данных XXXXZZZZCCCCC'; //('<h3>Исходящих данных по этому номеру/абоненту на Дзержинке нет</h3>');
}
}
// $out.='</tr>
//     </tbody>
//     </table>';
// echo ($row['data']);
  // var_dump(gettype($row['data']));
    echo $out;