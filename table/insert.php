<?php
$connect = mysqli_connect("localhost", "dron", "port2100", "newkross");
if(isset($_POST["ncatalog_number"], $_POST["ncatalog_name"], $_POST["ncatalog_cabinet"]))
{
 $ncatalog_number = mysqli_real_escape_string($connect, $_POST["ncatalog_number"]);
 $ncatalog_name = mysqli_real_escape_string($connect, $_POST["ncatalog_name"]);
 $ncatalog_cabinet = mysqli_real_escape_string($connect, $_POST["ncatalog_cabinet"]);
 $query = "INSERT INTO ncatalog(ncatalog_number, ncatalog_name, ncatalog_cabinet) VALUES('$ncatalog_number', '$ncatalog_name', '$ncatalog_cabinet')";
 if(mysqli_query($connect, $query))
 {
  echo 'Добавил аббонента: телефон: '.$ncatalog_number.', имя: '.$ncatalog_name.', помещение: '.$ncatalog_cabinet;
 }
}
?>