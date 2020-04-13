<?php
require 'connect.php';
// require 'myfunction.php';
$output = '';
if($_POST['page'])
{
  $area=$_POST["area"];
  $page = $_POST['page'];
  $cur_page = $page;
  $page =intval($page)-1;
  $per_page = 25; // Per page
  $previous_btn = true;
  $next_btn = true;
  $first_btn = true;
  $last_btn = true;
  $start = $page * $per_page;

/* Total Count */
$areaid=R::findOne( 'area', ' area_name = ? ', [ $area ] );
$count=R::count('krossdata', ' area_id = ? ', array($areaid->id));

$no_of_paginations = ceil($count / $per_page);
/* ---------------Calculating the starting and endign values for the loop----------------------------------- */
if ($cur_page >= 7) {
  $start_loop = $cur_page - 3;
  if ($no_of_paginations > $cur_page + 3)
    $end_loop = $cur_page + 3;
  else if ($cur_page <= $no_of_paginations && $cur_page > $no_of_paginations - 6) {
    $start_loop = $no_of_paginations - 6;
    $end_loop = $no_of_paginations;
  } else {
    $end_loop = $no_of_paginations;
  }
} else {
  $start_loop = 1;
  if ($no_of_paginations > 7)
    $end_loop = 7;
  else
    $end_loop = $no_of_paginations;
}
/* ----------------------------------------------------------------------------------------------------------- */

$beans = R::getAll('SELECT krossdata.id, ncatalog.id AS ncid, krossdata.data, raspred.raspred_name, krossdata.number, ncatalog.ncatalog_name, ncatalog.ncatalog_cabinet, type.type_name, krossdata.comment,  area.area_name
  FROM krossdata
  INNER JOIN raspred ON krossdata.raspred_id = raspred.id
  INNER JOIN ncatalog ON krossdata.ncatalog_id = ncatalog.id
  INNER JOIN type ON krossdata.type_id = type.id
  INNER JOIN area ON krossdata.area_id = area.id
  WHERE area.area_name=?
  ORDER BY krossdata.data ASC LIMIT ?, ?', [ $area, $start, $per_page ]);
// var_dump($beans);
// $file = file_get_contents('json/data1.json');
// var_dump($file);
file_put_contents('json/data.json',json_encode($beans));
$output .= '<div class="bootstrap-table bootstrap4">';
include('pagination.php');// Постраничный просмотр
if ($areaid->id=='12'){$output .=TheadPanasonic();}
else {$output .=TheadKrossdata();}
// var_dump($beans);
foreach($beans as $row)
{
  $color=ColorType($row["type_name"]);
  $output .= TbodyKrossdata($row, $color);
}

$output .= '</tbody></table></div>';
if ($beans==null){$output=''; $output='<br><div class="alert alert-info">
<strong>Info!</strong> Данные по '.$area.' не найдены.
</div>';}
echo $output;
}
?>