<?php
require "../connect.php";
$out='';
// $number=R::getCol('SELECT DISTINCT number FROM krossdata WHERE number<>"" ORDER BY id');
$number_c=R::getAll('SELECT DISTINCT number, id FROM krossdata WHERE number<>""  ORDER BY id');
foreach ($number_c as $row) {
	// $out.= ($row["number"].'--id--'.$row["id"].'<br>');
	$ppp=R::getAll('SELECT ncatalog_number FROM ncatalog WHERE ncatalog_number=?', [$row["number"]]);
	if($ppp!=null){}
		else{
			$out.= ($row["number"].'--id--'.($row["id"]).'<br>');
		}
}
// $numOfnumber = R::count( 'krossdata' );
// for ($i=0; $i < $numOfnumber; $i++) { 
// 	$ppp=R::getAll('SELECT ncatalog_number FROM ncatalog WHERE ncatalog_number=?', [$number[$i]]);
// 	if($ppp!=null){}
// 		else{
// 			$out.= ($number[$i].'--gg--'.($i+1).'<br>');
// 		}
// }
echo $out;
?>