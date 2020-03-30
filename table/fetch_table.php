<?php
//fetch.php
// require_once "../phpdebug/phpdebug.php";//вывод в консоль
// $debug = new PHPDebug();
// $debug->debug("Очень простое сообщение на консоль", null, LOG);
$connect = mysqli_connect("localhost", "dron", "port2100", "newkross");
// $columns = array('ncatalog_number', 'ncatalog_name', 'ncatalog_cabinet');
$table_col=$_POST['col'];
$table_name=$_POST['table_name'];
$columns = array($table_col[0], $table_col[1]);
// var_dump($_POST['sub']);
$query = "SELECT * FROM ".$_POST['table_name'];

if(isset($_POST["search"]["value"]))
{
 $query .= '
 WHERE '.$table_col[0].' LIKE "%'.$_POST["search"]["value"].'%" 
 OR '.$table_col[1].' LIKE "%'.$_POST["search"]["value"].'%"
 ';
}

if(isset($_POST["order"]))
{
 $query .= 'ORDER BY '.$columns[$_POST['order']['0']['column']].' '.$_POST['order']['0']['dir'].' 
 ';
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
 $sub_array = array();
 $sub_array[] = '<div  class="update" data-id="'.$row["id"].'" data-table="'.$table_name.'" data-column="'.$table_col[0].'">' . $row["id"] . '</div>';
 $sub_array[] = '<div contenteditable class="update" data-id="'.$row["id"].'" data-table="'.$table_name.'" data-column="'.$table_col[1].'">' . $row[$table_col[1]] . '</div>';
 $sub_array[] ='<button type="button" name="delete" class="btn-sm btn-danger btn-xs delete" id="'.$row["id"].'" data-table="'.$table_name.'">Удалить</button>';
 $data[] = $sub_array;
}

function get_all_data($connect)
{
	// $table_name="'".$table_name."'";
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
// echo ($table_col[0].'-------'.$table_col[1].'----'.$table_name.'-------'.$columns[0]);
?>
