<?php
require '../connect.php';
if(isset($_POST["id"])){
	$beans = R::getAll('SELECT krossdata.id, ncatalog.id AS ncid, krossdata.data, raspred.raspred_name, krossdata.number, ncatalog.ncatalog_name, ncatalog.ncatalog_cabinet, type.type_name, krossdata.comment,  area.area_name
  FROM krossdata
  INNER JOIN raspred ON krossdata.raspred_id = raspred.id
  INNER JOIN ncatalog ON krossdata.ncatalog_id = ncatalog.id
  INNER JOIN type ON krossdata.type_id = type.id
  INNER JOIN area ON krossdata.area_id = area.id
  WHERE area.id=2 AND ncatalog.id=? AND raspred.id=3
  ORDER BY krossdata.data', [$_POST["id"]]);
}
foreach($beans as $row)
echo ($row['data']);
?>