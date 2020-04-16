<?php
$connect = mysqli_connect("localhost", "dron", "port2100", "newkross");
$columns=json_decode($_POST['col'], true);
$table_name=$_POST['table_name'];
$query = "SELECT * FROM ". $_POST['table_name'];

if(isset($_POST["search"]["value"]))
{
	$col=json_decode($_POST['col'], true);
 $query .= ' WHERE '.array_shift($col).' LIKE "%'.$_POST["search"]["value"].'%"';
 unset($col[0]);
 foreach($col as $row)
{
$query .=' OR '.$row.' LIKE "%'.$_POST["search"]["value"].'%" ';
}
}

if(isset($_POST["order"]))
{
 $query .= 'ORDER BY '.$columns[$_POST['order']['0']['column']].' '.$_POST['order']['0']['dir'].' 
 '; //var_dump($query);
}
else
{
 $query .= 'ORDER BY id ASC ';
}

$query1 = '';

if($_POST["length"] != -1)
{
 $query1 = 'LIMIT ' . $_POST['start'] . ', ' . $_POST['length'];
}

$number_filter_row = mysqli_num_rows(mysqli_query($connect, $query));

$result = mysqli_query($connect, $query . $query1);

$data = array();
while($row = mysqli_fetch_array($result))
{
	$coun_row=count($row);
 $sub_array = array();
 for ($i = 0; $i < $coun_row; $i++) {
 	switch ($row["operation"]) {
 		case '1':
 			$sub_array[] = '<div class="text-success" id='.$row["id"].'>' . $row[$i] . '</div>';
 			break;
 		case '2':
 			$sub_array[] = '<div class="text-primary" id='.$row["id"].'>' . $row[$i] . '</div>';
 			break;
 		case '3':
 			$sub_array[] = '<div class="text-danger" id='.$row["id"].'>' . $row[$i] . '</div>';
 			break;
 		
 		default:
 			$sub_array[] = '<div id='.$row["id"].'>' . $row[$i] . '</div>';
 			break;
 	}

}
 
 $data[] = $sub_array;
}

function get_all_data($connect)
{
 $query = "SELECT * FROM ".$_POST['table_name'];
 $result = mysqli_query($connect, $query);
 return mysqli_num_rows($result);
}

$output = array(
 "draw"    => intval($_POST["draw"]),
 "recordsTotal"  =>  get_all_data($connect),
 "recordsFiltered" => $number_filter_row,
 "data"    => $data
);

echo json_encode($output);
?>

