<?php
require 'connect.php';

$updateKrossData = json_decode($_POST['updateKrossData'], true);
$krossdata = R::load( 'krossdata', $updateKrossData["id"] ); //reloads our data
$krossdata->raspred_id=$updateKrossData["raspred"];
$krossdata->number=$updateKrossData["number"];
$krossdata->ncatalog_id=$updateKrossData["ncatalog"];
$krossdata->type_id=$updateKrossData["type"];
$krossdata->comment=$updateKrossData["comment"];
$krossdata->cabinet=$updateKrossData["cabinet"];
R::store($krossdata);

$areaQuery = R::getAll('SELECT area_name FROM area');
foreach($areaQuery as $row)
{
  $area=$row['area_name'];
// $idDataKross=R::getCol('SELECT id FROM krossdata WHERE data=? AND area_id=?', [$dataKross, $areaId]);
$updatebean=R::getAll('SELECT krossdata.id, krossdata.data, raspred.raspred_name, krossdata.number, ncatalog.ncatalog_name, type.type_name, krossdata.comment, krossdata.cabinet, area.area_name
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
?>