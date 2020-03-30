<?php
require_once '../connect.php';
require_once "../phpdebug/phpdebug.php";//вывод в консоль
$dataPost=$_POST;
$unit_id=$dataPost["unit_id"];
$department_id=$dataPost["department_id"];
$unit=R::findOne( 'unit', ' id = ? ', [ $unit_id ] );
$unit_name=$unit->unit_name;
$department=R::findOne( 'department', ' id = ? ', [ $department_id ] );
$department_name=$department->department_name;
if(isset($_POST["department_id"]))
 {
 
 $output_department = '';
 $output = '';
 $output_nav = '';

$beans=R::getAll('SELECT ncatalog.id, ncatalog.ncatalog_name, ncatalog.ncatalog_number, ncatalog.ncatalog_cabinet, ncatalog.unit_id, ncatalog.department_id, ncatalog.authority
    FROM ncatalog
    WHERE ncatalog.unit_id=? AND ncatalog.department_id=? AND visibility NOT IN ("0") ORDER BY ncatalog.authority', [$unit_id, $department_id]);
 $output_nav .= '
 <div class="sector"><a href="#" onclick="loadData(1)">Справочник телефонов </a><span class="icon-wite">=</span><a  href="#" onclick="unitCatalog('.$unit_id.')">'.$unit_name.'</a><span class="icon-wite">=</span><a href="#" class=" alert alert-info" style="color:blue; pointer-events: none">'.$department_name.'</a></div><hr>';
  $output_department .= '<div class="table-responsive" >
           <table class="table table-bordered table-hover">
                <tr>
                     <th>Абонент</th>
                     <th>Телефон</th>
                     <th>Кабинет</th>
                </tr>';
foreach($beans as $row)
 {
           $output_department .= '
                <tr>
                     <td class="info">'.$row["ncatalog_name"].'</td>
                     <td>'.$row["ncatalog_number"].'</td>
                     <td>'.$row["ncatalog_cabinet"].'</td>';

}
 $output_department .= '</table></div>';

}

// $output_nav .=$output_department;
// $output_department=$output_nav;
// echo  $output_department;



// SECTOR LOAD подгрузка секторов, бюро и групп
$beans = R::getAll('SELECT DISTINCT ncatalog.unit_id, ncatalog.department_id, ncatalog.sector_id, unit.id, unit.unit_name, department.id, department.department_name, sector.id, sector.sector_name
  FROM ncatalog
  INNER JOIN unit ON ncatalog.unit_id = unit.id
  INNER JOIN department ON ncatalog.department_id = department.id
  INNER JOIN sector ON ncatalog.sector_id = sector.id
  WHERE unit.id=? AND department.id=? AND sector.id<>1 AND visibility NOT IN ("0")', [$unit_id, $department_id]);
 // $output.='<div class="col-sm-6" style="background-color: black;"><ul>';
 if ($beans!=null){
  // $output.='<!--h3 style="color:blue">'.$unit_name.fdfdfdf'</h3-->';
  $output.= '<div class="row"><div class="col-sm-8">'.$output_department.'</div>';
  // $output .= '</div></div>';
   $output.='<div class="col-sm-4 well"><ul>';
} else {
  $output.= '<div class="row"><div class="col-sm-12">'.$output_department.'</div></div>';

  //$output .= '</div><div>';
   //$output.='<div class="col-sm-6" style="background-color: blue;"><ul>';
  
}

foreach($beans as $row)
{

  if ($row["sector_name"]==NULL) {
    $output.='';
  } else{
   $output.='<li><a class="sectorcatalog" style="color:blue; cursor: pointer;" data-id="'.$row["sector_id"].'" data-name="'.$row["sector_name"].'" data-depid="'.$row["department_id"].'" data-depname="'.$row["department_name"].'" data-unitname="'.$row["unit_name"].'" data-unitid="'.$row["unit_id"].'">'.$row["sector_name"].'</li></a>';
 }

}


$output.='</ul></div></div>';



$output_department.='</div>';
$output_nav.=$output;
$output=$output_nav;
echo  $output;
?>