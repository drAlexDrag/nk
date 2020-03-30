<?php
//fetch.php
// require_once "../phpdebug/phpdebug.php";//вывод в консоль
// $debug = new PHPDebug();
// $debug->debug("Очень простое сообщение на консоль", null, LOG);
$connect = mysqli_connect("localhost", "dron", "port2100", "newkross");
// $columns = array('ncatalog_number', 'ncatalog_name', 'ncatalog_cabinet');
$columns = array('id', $_POST['ncatalog_number'], $_POST['ncatalog_name'], $_POST['ncatalog_cabinet']);
$table_name=$_POST['table_name'];
// var_dump($_POST['sub']);
// var_dump($table_name);
$query = "SELECT * FROM ". $_POST['table_name'];
// var_dump($query);

if(isset($_POST["search"]["value"]))
{
 $query .= '
 WHERE id LIKE "%'.$_POST["search"]["value"].'%"
 OR ncatalog_number LIKE "%'.$_POST["search"]["value"].'%" 
 OR ncatalog_name LIKE "%'.$_POST["search"]["value"].'%" 
 OR ncatalog_cabinet LIKE "%'.$_POST["search"]["value"].'%"
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
  $sub_array[] = '<div   data-id="'.$row["id"].'" data-table="'.$table_name.'" data-column="ncatalog_number">' .$row["id"]. '</div>';
 $sub_array[] = '<div  class="update krossdata" data-id="'.$row["id"].'" data-table="'.$table_name.'" data-column="ncatalog_number" name="'.$row["id"].'">' . $row["ncatalog_number"] . '</div>';
 $sub_array[] = '<div contenteditable class="update" data-id="'.$row["id"].'" data-table="'.$table_name.'" data-column="ncatalog_name">' . $row["ncatalog_name"] . '</div>';
 $sub_array[] = '<div contenteditable class="update" data-id="'.$row["id"].'" data-table="'.$table_name.'" data-column="ncatalog_cabinet">' . $row["ncatalog_cabinet"] . '</div>';
 $sub_array[] = '<button type="button" name="delete" class="btn-sm btn-danger btn-xs delete" id="'.$row["id"].'" data-table="'.$table_name.'">Удалить</button>';
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
