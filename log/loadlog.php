<?php
$connect = mysqli_connect("localhost", "dron", "port2100", "newkross");
$columns=json_decode($_POST['col'], true);
// var_dump($col);
// $columns_set='';
// $coun_col=count($col);
// $i=0;
// foreach($col as $row)
// {
// 	// $columns_set=$row;
// 	// if($i<$coun_col){
// 	$columns_set.=$row.', ';//}
// 		// else{$columns_set.=$row;}
// }
// $columns_set=substr($columns_set, 0, -2);
// var_dump($columns_set);
// $columns = $col;

// $columns = array('id', 'datechange');
$table_name=$_POST['table_name'];
$query = "SELECT * FROM ". $_POST['table_name'];

// if(isset($_POST["search"]["value"]))
// {
//  $query .= '
//  WHERE id LIKE "%'.$_POST["search"]["value"].'%"
//  OR data_name LIKE "%'.$_POST["search"]["value"].'%"
//  OR user LIKE "%'.$_POST["search"]["value"].'%" 
//  ';
// }


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


// $row = mysqli_fetch_array($result);
// foreach($row as $col){
//   $sub_array[] = '<div>' . $col . '</div>';
// }
// $data[] = $sub_array;

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
    // $sub_array[] = '<div id='.$row["id"].'>' . $row[$i] . '</div>';
}
 // var_dump($row);
 // $sub_array[] = '<div data-id="'.$row["id"].'" data-table="'.$_POST['table_name'].'" data-column="id" data-name="'.$row["id"].'">' . $row['id'] . '</div>';
 // $sub_array[] = '<div data-id="'.$row["id"].'" data-table="'.$_POST['table_name'].'" data-column="id" data-name="'.$row["id"].'">' . $row["datechange"] . '</div>';
 // $sub_array[] = '<div data-id="'.$row["id"].'" data-table="'.$_POST['table_name'].'" data-column="id" data-name="'.$row["id"].'">' . $row["data_id"] . '</div>';
 // $sub_array[] = '<div data-id="'.$row["id"].'" data-table="'.$_POST['table_name'].'" data-column="id" data-name="'.$row["id"].'">' . $row["data_name"] . '</div>';
 // $sub_array[] = '<div data-id="'.$row["id"].'" data-table="'.$_POST['table_name'].'" data-column="id" data-name="'.$row["id"].'">' . $row["old_raspred_name"] . '</div>';
 // $sub_array[] = '<div data-id="'.$row["id"].'" data-table="'.$_POST['table_name'].'" data-column="id" data-name="'.$row["id"].'">' . $row["new_raspred_name"] . '</div>';
 // $sub_array[] = '<div data-id="'.$row["id"].'" data-table="'.$_POST['table_name'].'" data-column="id" data-name="'.$row["id"].'">' . $row["old_number"] . '</div>';
 // $sub_array[] = '<div data-id="'.$row["id"].'" data-table="'.$_POST['table_name'].'" data-column="id" data-name="'.$row["id"].'">' . $row["new_number"] . '</div>';
 // $sub_array[] = '<div data-id="'.$row["id"].'" data-table="'.$_POST['table_name'].'" data-column="id" data-name="'.$row["id"].'">' . $row["old_ncatalog_name"] . '</div>';
 // $sub_array[] = '<div data-id="'.$row["id"].'" data-table="'.$_POST['table_name'].'" data-column="id" data-name="'.$row["id"].'">' . $row["new_ncatalog_name"] . '</div>';
 // $sub_array[] = '<div data-id="'.$row["id"].'" data-table="'.$_POST['table_name'].'" data-column="id" data-name="'.$row["id"].'">' . $row["old_type_name"] . '</div>';
 // $sub_array[] = '<div data-id="'.$row["id"].'" data-table="'.$_POST['table_name'].'" data-column="id" data-name="'.$row["id"].'">' . $row["new_type_name"] . '</div>';
 // $sub_array[] = '<div data-id="'.$row["id"].'" data-table="'.$_POST['table_name'].'" data-column="id" data-name="'.$row["id"].'">' . $row["old_comment"] . '</div>';
 // $sub_array[] = '<div data-id="'.$row["id"].'" data-table="'.$_POST['table_name'].'" data-column="id" data-name="'.$row["id"].'">' . $row["new_comment"] . '</div>';
 // $sub_array[] = '<div data-id="'.$row["id"].'" data-table="'.$_POST['table_name'].'" data-column="id" data-name="'.$row["id"].'">' . $row["area_name"] . '</div>';
 // $sub_array[] = '<div data-id="'.$row["id"].'" data-table="'.$_POST['table_name'].'" data-column="id" data-name="'.$row["id"].'">' . $row["user"] . '</div>';
 // $sub_array[] = '<div data-id="'.$row["id"].'" data-table="'.$_POST['table_name'].'" data-column="id" data-name="'.$row["id"].'">' . $row["operation"] . '</div>';
 // $sub_array[] = '<button type="button" name="delete" class="btn-sm btn-danger btn-xs delete" id="'.$row["id"].'" data-table="'.$table_name.'">Удалить</button>';
 $data[] = $sub_array;
}

function get_all_data($connect)
{
 $query = "SELECT * FROM ".$_POST['table_name'];
 // var_dump($query);
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
// echo $_POST['sub'];
?>

