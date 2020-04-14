<?php
// $connect = mysqli_connect("localhost", "dron", "port2100", "newkross");
// if(isset($_POST["id"], $_POST["table_name"]))
// {
//  $query = "DELETE FROM ".$_POST["table_name"]." WHERE id = ".$_POST["id"]."";
//  if(mysqli_query($connect, $query))
//  {
//   echo 'Информация удалена';
//  }
//  // else { echo("Error description: " . mysqli_error($connect).'--'.mysqli_errno($connect));}
//  elseif(mysqli_errno($connect)=='1451') { echo("Невозможно удалить или обновить родительскую строку: сбой ограничения внешнего ключа. На данную строку ссылается внешняя таблица");}
//  else {echo("Непредвиденная ошибка");}
// }
require_once '../connect.php';
if(isset($_POST["id"], $_POST["table_name"]))
{
	// R::debug( TRUE );
 // $query = "DELETE FROM ".$_POST["table_name"]." WHERE id = ".$_POST["id"]."";
	$delet=R::load($_POST["table_name"], $_POST["id"]);
	
 try {
    // R::exec($query);
    R::trash($delet);
    if($_POST["table_name"]=="ncatalog"){
			// $ncatalog=
			$logncatalog=R::dispense('logncatalog');
			$logncatalog->ncatalog_id=$delet->id;
			$logncatalog->ncatalog_number=$delet->ncatalog_number;
			$logncatalog->old_ncatalog_name=$delet->ncatalog_name;
			$logncatalog->old_ncatalog_cabinet=$delet->ncatalog_cabinet;
			$logncatalog->user=$_POST["user"];
			$logncatalog->operation="3";
			R::store($logncatalog);
		}
			else
			{
	$name_col=$_POST["table_name"]."_name";
	$logtable=R::dispense('logtable');//логируем данные до обновления
	$logtable->tabl=$_POST["table_name"];
	$logtable->idval=$_POST["id"];
	$logtable->old_val=$delet->$name_col;
	$logtable->new_val="";
	$logtable->user=$_POST["user"];
	$logtable->operation="3";
	R::store($logtable);
}
    echo 'Информация удалена';
} catch (RedBeanPHP\RedException\SQL $e) {
	// echo "Непредвиденная ошибка:   ";
    echo $e->getMessage();
}
 // if(!R::exec($query))
 // {
 //  echo 'Информация удалена';
 // }
 // else { echo("Error description: " . mysqli_error($connect).'--'.mysqli_errno($connect));}
 // elseif(mysqli_errno($connect)=='1451') { echo("Невозможно удалить или обновить родительскую строку: сбой ограничения внешнего ключа. На данную строку ссылается внешняя таблица");}
 // else {echo("Непредвиденная ошибка");}
}
?>