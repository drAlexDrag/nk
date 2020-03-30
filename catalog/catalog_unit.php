<?php
require_once '../connect.php';
require_once "../phpdebug/phpdebug.php";//вывод в консоль
$dataPost=$_POST;
$unit_id=$dataPost["unit_id"];
$unit=R::findOne( 'unit', ' id = ? ', [ $unit_id ] );
$unit_name=$unit->unit_name;
if(isset($_POST["unit_id"]))
{
  // $unit_name=$_POST["unit_name"];
  // $unit_id=R::getCol('select id from unit where unit_name=?', [$_POST["unit_name"]]);
  // $unit_id=$unit_id[0];
$debug = new PHPDebug();
$debug->debug($unit_name, null, LOG);  

$output = '';
$output_nav = '';
$output_unit = '';
// $beans = R::getAll('SELECT ncatalog.id, ncatalog.ncatalog_name, 
//   ncatalog.ncatalog_number, ncatalog.ncatalog_cabinet, ncatalog.unit_id 
//   FROM ncatalog WHERE ncatalog.unit_id=? ORDER BY ncatalog.ncatalog_cabinet', [$dataPost["unit_id"]]);
$beans=R::getAll('SELECT ncatalog.id, ncatalog.ncatalog_name, ncatalog.ncatalog_number, ncatalog.ncatalog_cabinet, ncatalog.unit_id, ncatalog.authority
    FROM ncatalog
    WHERE ncatalog.unit_id=? AND ncatalog.department_id=1 AND visibility NOT IN ("0") ORDER BY ncatalog.authority', [$unit_id]);

  $output_nav .='<div class="sector"><a href="#" onclick="loadData(1)">Справочник телефонов</a><span class="icon-wite">=</span><a href="#" class="alert alert-info" style="color:blue; pointer-events: none">'.$unit_name.'</a></div><hr>';
  $output_unit .= '
  
  <div class="table-responsive">
  <table class="table table-bordered table-hover">
  <tr>
  <th>Абонент</th>
  <th>Телефон</th>
  <th>Кабинет</th>
  </tr>';
  foreach($beans as $row)
  {
   $output_unit .= '
   <tr>
   <td class="info">'.$row["ncatalog_name"].'</td>
   <td>'.$row["ncatalog_number"].'</td>
   <td>'.$row["ncatalog_cabinet"].'</td>
   </tr>
   ';

 }
 if ($beans!=null) {
   $output_unit .= '</table></div>';
 } else {
   $output_unit= '<div class="alert alert-danger">Информация по подразделению отсутствует</div>';
 }
 


 $beans = R::getAll('SELECT DISTINCT ncatalog.unit_id, ncatalog.department_id, unit.id, unit.unit_name, department.id, department.department_name
  FROM ncatalog
  INNER JOIN unit ON ncatalog.unit_id = unit.id
  INNER JOIN department ON ncatalog.department_id = department.id
  WHERE unit.id=? AND department.id<>1 AND visibility NOT IN ("0")', [$unit_id]);

 // $output.='<div class="col-sm-6" style="background-color: black;"><ul>';
 if ($beans!=null){
  // $output.='<!--h3 style="color:blue">'.$unit_name.fdfdfdf'</h3-->';
  $output .= '<div class="row"><div class="col-sm-8">'.$output_unit.'</div>';
  // $output.='<h5>Доступные подразделения : </h5><div class="col-sm-6 well"><ul>';
  // $output .= '</div></div>';
   $output.='<div class="col-sm-4 well"><ul>';
} else {
  $output .= '<div class="row"><div class="col-sm-12">'.$output_unit.'</div></div>';

  //$output .= '</div><div>';
   //$output.='<div class="col-sm-6" style="background-color: blue;"><ul>';
  
}

foreach($beans as $row)
{

  if ($row["department_name"]==NULL) {
    $output .='';
  } else{
   $output .='<li><a style="color:blue; cursor: pointer;" onclick="departmentCatalog('.$unit_id.','.$row["department_id"].')"">'.$row["department_name"].'</li></a>';//'<li><a style="color:blue; cursor: pointer;" onclick="departmentCatalog('.$row["unit_id"].','.$row["department_id"].')>'.$row["department_name"].'</li></a>';
 }

}


$output.='</ul></div></div>';


}
$output.='</div>';
$output_nav.=$output;
$output=$output_nav;
echo  $output;

?>