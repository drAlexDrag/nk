<?php
 //Выводим список площадок
 require_once '../connect.php';
 $output = '';
 $beans = R::getAll('SELECT * FROM unit WHERE unit_name IS NOT NULL AND id<>1 ORDER BY unit_name');
 $output.='<ul>';
  foreach($beans as $row)
 {
 	 $output .='<li><a class="unitcatalog" style="color: blue; cursor: pointer;" data-name="'.$row["unit_name"].'" onclick="unitCatalog('.$row["id"].')">'.$row["unit_name"].'</li></a>';
 	}
 $output.='</ul>';
 echo $output;
 ?>