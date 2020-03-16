<?php
require 'connect.php';
// require 'myfunction.php';
$output = '';
$dataPost=$_POST;
$length_number=strlen($dataPost['searchString']);
$outputsearch='<div class="alert alert-info">Строка поиска: '.$dataPost['searchString'].'</div>';
echo($outputsearch);
$areaQuery = R::getAll('SELECT area_name FROM area');
foreach($areaQuery as $row)
{

  $output="";
  $area=$row['area_name'];
  switch ($dataPost['parameterSearch']) {
    case "number":
    $beans = R::getAll('SELECT krossdata.id, ncatalog.id AS ncid, krossdata.data, raspred.raspred_name, krossdata.number, ncatalog.ncatalog_name, type.type_name, krossdata.comment, ncatalog.ncatalog_cabinet, area.area_name
      FROM krossdata
      INNER JOIN ncatalog ON krossdata.ncatalog_id = ncatalog.id
      INNER JOIN type ON krossdata.type_id = type.id
      INNER JOIN area ON krossdata.area_id = area.id
      INNER JOIN raspred ON krossdata.raspred_id = raspred.id
      WHERE area.area_name=? AND  length(krossdata.number)=? 
      AND ' .$dataPost['parameterSearch'].' LIKE ? ORDER BY raspred_id', [ $area, $length_number, '%' . $dataPost['searchString'] . '%' ]);



    break;
    case "data":
    $beans = R::getAll('SELECT krossdata.id, ncatalog.id AS ncid, krossdata.data, raspred.raspred_name, krossdata.number, ncatalog.ncatalog_name, type.type_name, krossdata.comment, ncatalog.ncatalog_cabinet, area.area_name
      FROM krossdata
      INNER JOIN ncatalog ON krossdata.ncatalog_id = ncatalog.id
      INNER JOIN type ON krossdata.type_id = type.id
      INNER JOIN area ON krossdata.area_id = area.id
      INNER JOIN raspred ON krossdata.raspred_id = raspred.id
      WHERE area.area_name=? AND ' .$dataPost['parameterSearch'].' LIKE ? ORDER BY number', [ $area, '%' . $dataPost['searchString'] . '%' ]);

    break;
    case "sub_name":
    $beans = R::getAll('SELECT krossdata.id, ncatalog.id AS ncid, krossdata.data, raspred.raspred_name, krossdata.number, ncatalog.ncatalog_name, type.type_name, krossdata.comment, ncatalog.ncatalog_cabinet, area.area_name
      FROM krossdata
      INNER JOIN ncatalog ON krossdata.ncatalog_id = ncatalog.id
      INNER JOIN type ON krossdata.type_id = type.id
      INNER JOIN area ON krossdata.area_id = area.id
      INNER JOIN raspred ON krossdata.raspred_id = raspred.id
      WHERE area.area_name=? AND ncatalog.ncatalog_name LIKE ? ORDER BY number', [ $area, '%' . $dataPost['searchString'] . '%' ]);
    break;
    case "comment":
    $beans = R::getAll('SELECT krossdata.id, ncatalog.id AS ncid, krossdata.data, raspred.raspred_name, krossdata.number, ncatalog.ncatalog_name, type.type_name, krossdata.comment, ncatalog.ncatalog_cabinet, area.area_name
      FROM krossdata
      INNER JOIN ncatalog ON krossdata.ncatalog_id = ncatalog.id
      INNER JOIN type ON krossdata.type_id = type.id
      INNER JOIN area ON krossdata.area_id = area.id
      INNER JOIN raspred ON krossdata.raspred_id = raspred.id
      WHERE area.area_name=? AND ' .$dataPost['parameterSearch'].' LIKE ? ORDER BY number', [ $area, '%' . $dataPost['searchString'] . '%' ]);

    break;
        case "cabinet":
    $beans = R::getAll('SELECT krossdata.id, ncatalog.id AS ncid, krossdata.data, raspred.raspred_name, krossdata.number, ncatalog.ncatalog_name, type.type_name, krossdata.comment, ncatalog.ncatalog_cabinet, area.area_name
      FROM krossdata
      INNER JOIN ncatalog ON krossdata.ncatalog_id = ncatalog.id
      INNER JOIN type ON krossdata.type_id = type.id
      INNER JOIN area ON krossdata.area_id = area.id
      INNER JOIN raspred ON krossdata.raspred_id = raspred.id
      WHERE area.area_name=? AND  ncatalog.ncatalog_cabinet LIKE ? ORDER BY number', [ $area, '%' . $dataPost['searchString'] . '%' ]);
    break;
}


/////////////////////////Выводим информацию по каждому кроссу///////////////////////
$output .= '<div class="table-responsive table-bordered" ><h4 style="color:blue">Информация по кроссу '.$area.'</h4>';
  $output .= TheadKrossdata();
  foreach($beans as $row)
  {
    $color=ColorType($row["type_name"]);
    $output .=TbodyKrossdata($row, $color);
  }

  if ($beans==null){$output='';}
  echo $output.='</tbody> </table></div>';
}
////////////////////////////////////Работа с Каталогом/////////////////
// $outputcatalog.= '
//            <label class="text-success">Результат обработки</label>';
switch ($dataPost['parameterSearch']) {
    case "number":
$outputcatalog.= '<div class="table-responsive table-bordered" id="catalog_table"><h4>Информация по номеру в справочнике</h4>';
$outputcatalog.=OutputTheadCatalog();
$catalogbean = R::getAll('SELECT ncatalog.id, ncatalog.ncatalog_number, ncatalog.ncatalog_name, unit.unit_name, department.department_name, sector.sector_name, ncatalog.ncatalog_cabinet, ncatalog.visibility
  FROM ncatalog
  INNER JOIN unit ON ncatalog.unit_id = unit.id
  INNER JOIN department ON ncatalog.department_id = department.id
  INNER JOIN sector ON ncatalog.sector_id = sector.id
  where ncatalog.ncatalog_number=? order by ncatalog.id', [$dataPost['searchString']]);
// WHERE sub.id=? and catalog.vnutr=? ORDER BY catalog.id', [$subId, $dataNumber]);
foreach($catalogbean as $row)
{
  $outputcatalog .=OutputTbodyCatalog($row);

}
$outputcatalog.= '</tbody></table></div>';
if ($catalogbean==null){
  $outputcatalog=BeansNull($catalogbean, $dataPost['searchString']);
}
echo($outputcatalog);
    break;
}
    // var_dump($beans);
// echo ($beans);
?>