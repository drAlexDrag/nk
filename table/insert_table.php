<?php
// $connect = mysqli_connect("localhost", "dron", "port2100", "newkross");
require_once '../connect.php';
if(isset($_POST["name"]))
{
 // $ncatalog_number = mysqli_real_escape_string($connect, $_POST["ncatalog_number"]);
 // $name = mysqli_real_escape_string($connect, $_POST["name"]);
	$query = "INSERT INTO ".$_POST["table_name"]."(".$_POST["table_name"]."_name) VALUES('".$_POST["name"]."')";
 // if(mysqli_query($connect, $query))
 // {
 //  echo 'Информация добавлена';
 // }
	try {
		R::exec($query);
		$getinsertID=R::getinsertID();
		// if($_POST["table_name"]=="ncatalog"){
		// 	// $ncatalog=
		// 	$logncatalog=R::dispense('logncatalog');
		// 	$logncatalog=
		// }
		// 	else
		// 	{
				$name_col=$_POST["table_name"]."_name";
				$logtable=R::dispense('logtable');
				$logtable->tabl=$_POST["table_name"];
				$logtable->idval=$getinsertID;
				$logtable->old_val="";
				$logtable->new_val=$_POST["name"];
				$logtable->user=$_POST["user"];
				$logtable->operation="1";
				R::store($logtable);
			// }

			echo 'Информация добавлена: '.$_POST["name"];;
		} catch (RedBeanPHP\RedException\SQL $e) {

			echo $e->getMessage();
		}
	}
	?>