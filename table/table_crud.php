<?php
require_once '../connect.php';
// $dataPost=$_POST;
// $action=$dataPost["action"];
// $id=$dataPost["id"];
// $table=$dataPost["table"];
$updatedata=json_decode($_POST['updatedata'], true);
switch ($updatedata['action']) {
	case 'load':
		  $result = R::load( 'ncatalog', $updatedata["id"] );
		  $unit=R::load( 'unit', $result->unit_id );
		  $unit_name=$unit->unit_name;
		  $department=R::load( 'department', $result->department_id );
		  $department_name=$department->department_name;
		  $sector=R::load( 'sector', $result->sector_id );
		  $sector_name=$sector->sector_name;
  $ncatalog = array(
    'id'=>$result->id,
    'ncatalog_number'=>$result->ncatalog_number,
    'ncatalog_name'=>$result->ncatalog_name,
    'unit'=>$result->unit_id,
    'department'=>$result->department_id,
    'sector'=>$result->sector_id,
    'unit_name'=>$unit_name,
    'department_name'=>$department_name,
    'sector_name'=>$sector_name,
    'visibility'=>$result->visibility,
    'free'=>$result->free
  );
  echo(json_encode($ncatalog));
		
		break;
	
	case 'update':
		$result = R::load( 'ncatalog', $updatedata["id"] );
		$result->unit_id=$updatedata["unit_id"];
		$result->department_id=$updatedata["department_id"];
		$result->sector_id=$updatedata["sector_id"];
		$result->visibility=$updatedata["visibility"];
		$result->free=$updatedata["free"];
		R::store($result);
		echo(json_encode($result));
		break;
}
?>