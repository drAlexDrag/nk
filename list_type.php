<?php
require 'connect.php';
$output = '';
$area=R::getAll('SELECT * FROM type ORDER BY id');
$output .= '<div><select class="form-control" size="1" name="param_type" id="param_type" style="color: #000; font-size: 16px; font-weight: 900;" >';
 foreach ($area as $row ){
  $output .= '<option data-id="'.$row["id"].'" value="'.$row["type_name"].'" >'.$row["type_name"].'</option>';
 }
$output .= '</select></div><hr>';
echo $output;
?>