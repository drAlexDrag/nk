<?php
require 'connect.php';
require_once "phpdebug/phpdebug.php";
$debug = new PHPDebug();
// for ($x=1; $x<7591; $x++) {
// $beans = R::getAll('SELECT krossdata.data, krossdata.raspred_id, raspred.raspred_name, krossdata.number, krossdata.sub_id, sub.sub_name, sub.id, type.type_name, krossdata.comment, area.area_name
// FROM krossdata
// INNER JOIN raspred ON krossdata.raspred_id = raspred.id
// INNER JOIN sub ON krossdata.sub_id = sub.id
// INNER JOIN type ON krossdata.type_id = type.id
// INNER JOIN area ON krossdata.area_id = area.id
// WHERE krossdata.id=?
//   ORDER BY krossdata.data', [$x]);
// foreach($beans as $row)
// {

//    // $output = json_encode($row);
//    $output2 ='"'. $row["sub_name"].'"';
//    $number = '"'. $row["number"].'"';
//    $number2 = $row["number"];
//    $debug->debug($number2, null, LOG);
// }
// $bean = R::getAll('SELECT * FROM percsv WHERE phone=? ', [$number2]);
// foreach($bean as $rows)
// {

//    // $output = json_encode($row);
//    $outputsub =$rows["id"];
//    $debug->debug($outputsub, null, LOG);
// }
// // echo $outputsub;
// R::exec('UPDATE catalog set new_id=$outputsub where vnutr=$number2');
// }
for ($x=1; $x<3155; $x++) {
// $x=3000;
	$outbeans = R::getAll('SELECT * FROM ncatalog WHERE id=?', [$x]);
	
	foreach($outbeans as $rows)
{
   $debug->debug($x, null, LOG);
   $debug->debug($rows["id"], null, LOG);
   $ncatalogid = $rows["id"];
   $number = $rows["ncatalog_number"];
   R::exec("UPDATE krossdata_c set ncatalog_id=$ncatalogid where number='$number'");

}
}
echo "OK";
?>