<?php
$connect = mysqli_connect("localhost", "dron", "port2100", "newkross");
$columns=json_decode($_POST['col'], true);
// var_dump($columns);
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
 $query .= 'ORDER BY '.$columns[$_POST['order']['0']['column']].' '.$_POST['order']['0']['dir'].''; 
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
	// var_dump($row);
	$sub_array = array();
	switch ($table_name) {
		case 'ncatalog':
			# code...
		for ($i = 0; $i < $coun_row; $i++) {
		if($i==($coun_row-18))
			{$sub_array[] ='<button type="button" name="delete" class="btn-sm btn-danger btn-xs delete" id="'.$row["id"].'" data-table="'.$table_name.'">Удалить</button>';}
		elseif($i==0)
		{$sub_array[] = '<div class="update" onclick="editSub(' .$row["id"]. ')" data-id="'.$row["id"].'" data-table="'.$table_name.'" data-column="'.$columns[$i].'">' . $row[$i] . '<span class="icon">Ü</span></div>';}
		elseif($i==1)
		{
			if($row["free"]=="0"){$sub_array[] = '<div style="color:blue;" class="update krossdata" data-id="'.$row["id"].'" data-table="'.$table_name.'" data-column="'.$columns[$i].'" name="'.$row["id"].'" title="Двойной клик для просмотра исходящих данных по Дзержинке" onclick="get_number('.$row["id"].', '. $row["ncatalog_number"] .')">' . $row[$i] . '</div>';}
			else{$sub_array[] = '<div style="color:red;" class="update krossdata" data-id="'.$row["id"].'" data-table="'.$table_name.'" data-column="'.$columns[$i].'" name="'.$row["id"].'" title="Двойной клик для просмотра исходящих данных по Дзержинке" onclick="get_number('.$row["id"].', '. $row["ncatalog_number"] .')">' . $row[$i] . '</div>';}
		}
		elseif($i==2)
		{
			if($row["visibility"]=="0"){$sub_array[] = '<div style="color:red;" contenteditable class="update" data-id="'.$row["id"].'" data-table="'.$table_name.'" data-column="ncatalog_name" title="Не доступен для просмотра в справочнике"> ' . $row[$i] . '</div>';}
			else{$sub_array[] = '<div style="color:blue;" contenteditable class="update" data-id="'.$row["id"].'" data-table="'.$table_name.'" data-column="ncatalog_name" title="Доступен для просмотра в справочнике"> ' . $row[$i] . '</div>';}
		}
		else{$sub_array[] = '<div contenteditable  class="update" data-id="'.$row["id"].'" data-table="'.$table_name.'" data-column="'.$columns[$i].'">' . $row[$i] . '</div>';}
	}
			break;
		
		default:
			# code...
		for ($i = 0; $i < $coun_row; $i++) {
		if($i==($coun_row-4))
		{$sub_array[] ='<button type="button" name="delete" class="btn-sm btn-danger btn-xs delete" id="'.$row["id"].'" data-table="'.$table_name.'">Удалить</button>';}
	elseif($i==0)
		{$sub_array[] = '<div class="update" data-id="'.$row["id"].'" data-table="'.$table_name.'" data-column="'.$columns[$i].'">' . $row[$i] . '</div>';}
		else
			{$sub_array[] = '<div contenteditable  class="update" data-id="'.$row["id"].'" data-table="'.$table_name.'" data-column="'.$columns[$i].'">' . $row[$i] . '</div>';}
	}
			break;
	}
	
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