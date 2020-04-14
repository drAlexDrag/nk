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
	$value = trim($_POST["value"]);
	$query = "UPDATE ".$_POST["table_name"]." SET ".$_POST["column_name"]."='".$value."' WHERE id = '".$_POST["id"]."'";
	// if(R::exec($query))
	// {
	// 	echo 'Информация обновлена';
	// }
	$old="old_".$_POST["column_name"];
	$new="new_".$_POST["column_name"];
	$col_name=$_POST["column_name"];
	$update=R::load($_POST["table_name"], $_POST["id"]);
	try {
    R::exec($query);
    		if($_POST["table_name"]=="ncatalog"){
			// $ncatalog=
			$logncatalog=R::dispense('logncatalog');
			$logncatalog->ncatalog_id=$update->id;
			$logncatalog->ncatalog_number=$update->ncatalog_number;
			$logncatalog->$old=$update->$col_name;
			$logncatalog->$new=$_POST["value"];
			$logncatalog->user=$_POST["user"];
			$logncatalog->operation="2";
			R::store($logncatalog);
		}
			else
			{
    $name_col=$_POST["table_name"]."_name";
	$logtable=R::dispense('logtable');
	$logtable->tabl=$_POST["table_name"];
	$logtable->idval=$_POST["id"];
	$logtable->old_val=$update->$name_col;
	$logtable->new_val=$_POST["value"];
	$logtable->user=$_POST["user"];
	$logtable->operation="2";
	R::store($logtable);
	print_r( $logtable->getMeta( 'type' ));
}

    // echo 'Информация обновлена';
} catch (RedBeanPHP\RedException\SQL $e) {

    echo $e->getMessage();
}
}
?>