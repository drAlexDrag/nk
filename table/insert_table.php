<?php
$connect = mysqli_connect("localhost", "dron", "port2100", "newkross");
if(isset($_POST["name"]))
{
 // $ncatalog_number = mysqli_real_escape_string($connect, $_POST["ncatalog_number"]);
 $name = mysqli_real_escape_string($connect, $_POST["name"]);
 $query = "INSERT INTO ".$_POST["table_name"]."(".$_POST["table_name"]."_name) VALUES('".$name."')";
 if(mysqli_query($connect, $query))
 {
  echo 'Информация добавлена';
 }
}
?>