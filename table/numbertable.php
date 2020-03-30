<?php
require '../connect.php';
$output="";
$numberlist = R::getAll( 'SELECT ncatalog.id, ncatalog.ncatalog_number, ncatalog.ncatalog_name  FROM ncatalog' );
echo($output);
?>