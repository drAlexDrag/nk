<?php
require_once '../connect.php';
if (isset($_POST)){
	$beans=R::getAll('SELECT ncatalog.id, ncatalog.ncatalog_name, ncatalog.ncatalog_number, ncatalog.ncatalog_cabinet, ncatalog.authority
    FROM ncatalog
 WHERE  ncatalog_number LIKE "%'.$_POST["searchString"].'%" 
 OR ncatalog_name LIKE "%'.$_POST["searchString"].'%" 
 OR ncatalog_cabinet LIKE "%'.$_POST["searchString"].'%"
 ');

  $output .= '
  
  <div class="table-responsive">
  <table class="table table-bordered table-hover">
  <tr>
  <th>Абонент</th>
  <th>Телефон</th>
  <th>Кабинет</th>
  </tr>';
  foreach($beans as $row)
  {
   $output .= '
   <tr>
   <td class="info">'.$row["ncatalog_name"].'</td>
   <td>'.$row["ncatalog_number"].'</td>
   <td>'.$row["ncatalog_cabinet"].'</td>
   </tr>
   ';

 }
 if ($beans!=null) {
   $output .= '</table></div>';
 } else {
   $output= '<div class="alert alert-danger">'.$_POST["searchString"].'- не найдено</div>';
 }
}
echo  $output;
?>