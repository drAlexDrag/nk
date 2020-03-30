<?php
require 'connect.php';
$output = '';
$area=R::getAll('SELECT * FROM raspred ORDER BY id');
$output .= '<div><select class="form-control" size="1" name="param_raspred" id="param_raspred" style="color: #000; font-size: 16px; font-weight: 900;" >';
 foreach ($area as $row ){
  $output .= '<option data-id="'.$row["id"].'" value="'.$row["raspred_name"].'" >'.$row["raspred_name"].'</option>';
 }
$output .= '</select></div><hr>';
echo $output;
?>