<?php
// $connect = mysqli_connect("localhost", "dron", "port2100", "newkross");
// if(isset($_POST["id"]))
// {
//  $value = mysqli_real_escape_string($connect, $_POST["value"]);
//  $query = "UPDATE ".$_POST["table_name"]." SET ".$_POST["column_name"]."='".$value."' WHERE id = '".$_POST["id"]."'";
//  if(mysqli_query($connect, $query))
//  {
//   echo 'Информация обновлена';
//  }
// }


require_once '../connect.php';
if(isset($_POST["id"]))
{
	$value = $_POST["value"];
	$query = "UPDATE ".$_POST["table_name"]." SET ".$_POST["column_name"]."='".$value."' WHERE id = '".$_POST["id"]."'";
	if(R::exec($query))
	{
		echo 'Информация обновлена';
	}
}
?>