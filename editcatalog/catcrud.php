<?php
require '../connect.php';

$dataPost=$_POST;
$newaut=json_decode($dataPost["newaut"], true);
$id=$newaut["id"];
// $unit_id=$dataPost["unit_id"];
$authority=$newaut["authority"];
// var_dump($authority);
$ncatalog = R::load('ncatalog', $id);
// // var_dump($ncatalog);
$ncatalog->authority=$authority;
R::store($ncatalog);
echo($unit_id);
?>