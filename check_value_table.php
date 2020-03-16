<?php
require 'connect.php';
$data=$_POST;

$query=$_POST["query"];
$tablename=$_POST["tablename"];

$columnname=$_POST["columnname"];
 $result = R::getAll( 'SELECT * FROM '.$tablename.' WHERE ncatalog_number='.$number.' AND '.$columnname.' LIKE \'%'.$query.'%\' ' );
?>