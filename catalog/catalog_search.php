<?php
require_once '../connect.php';
if (isset($_POST)){
  $searchString=$_POST["searchString"];
  $visibility="0";
	$beans=R::getAll("SELECT ncatalog.id, ncatalog.ncatalog_name, ncatalog.ncatalog_number, ncatalog.ncatalog_cabinet, ncatalog.authority, ncatalog.unit_id, ncatalog.department_id, ncatalog.sector_id, unit.unit_name, department.department_name, sector.sector_name, ncatalog.visibility
    FROM ncatalog
    INNER JOIN unit ON ncatalog.unit_id = unit.id
    INNER JOIN department ON ncatalog.department_id = department.id
    INNER JOIN sector ON ncatalog.sector_id = sector.id
 WHERE ncatalog.ncatalog_number LIKE ? 
 OR ncatalog.ncatalog_name LIKE ? 
 OR ncatalog.ncatalog_cabinet LIKE ? AND ncatalog.visibility NOT IN (?)", ['%'.$searchString.'%', '%'.$searchString.'%', '%'.$searchString.'%', $visibility]);

  $output .= '
  
  <div class="table-responsive">
  <table class="table table-bordered table-hover">
  <tr>
  <th>Абонент</th>
  <th>Телефон</th>
  <th>Управление</th>
  <th>Отдел/Бюро</th>
  <th>Кабинет</th>
  </tr>';
  foreach($beans as $row)
  {
   $output .= '
   <tr>
   <td class="info">'.$row["ncatalog_name"].'</td>
   <td>'.$row["ncatalog_number"].'</td>
   <td>'.$row["unit_name"].'</td>
   <td>'.$row["department_name"].'</td>
   <td>'.$row["ncatalog_cabinet"].'</td>
   </tr>
   ';

 }
 if ($beans!=null) {
   $output .= '</table></div>';
 } else {
   $output= '<div class="alert alert-danger">'.$searchString.'- не найдено</div>';
 }
}
echo  $output;
// WHERE ncatalog_number LIKE \"%".$_POST['searchString']."%\" OR ncatalog_name LIKE \"%".$_POST['searchString']."%\" OR ncatalog_cabinet LIKE \"%".$_POST['searchString']."%\" AND visibility NOT IN ('0')");
// WHERE ncatalog_number LIKE ? OR ncatalog_name LIKE ? OR ncatalog_cabinet LIKE ? AND visibility IN ("1")', [ '%' . //$_POST['searchString'] . '%', '%' . $_POST['searchString'] . '%', '%' . $_POST['searchString'] . '%' ]);
// var_dump($beans);
?>