<?php
$connect = mysqli_connect("localhost", "dron", "port2100", "newkross");
if(isset($_POST["id"], $_POST["table_name"]))
{
 $query = "DELETE FROM ".$_POST["table_name"]." WHERE id = ".$_POST["id"]."";
 if(mysqli_query($connect, $query))
 {
  echo 'Информация удалена';
 }
 // else { echo("Error description: " . mysqli_error($connect).'--'.mysqli_errno($connect));}
 elseif(mysqli_errno($connect)=='1451') { echo("Невозможно удалить или обновить родительскую строку: сбой ограничения внешнего ключа. На данную строку ссылается внешняя таблица");}
 else {echo("Непредвиденная ошибка");}
}
?>