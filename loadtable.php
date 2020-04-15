<?php
require 'connect.php';
// require_once "phpdebug/phpdebug.php";//вывод в консоль
$data=$_POST;
$idinput=$_POST["input"];
$query=$_POST["query"];
$tablename=$_POST["tablename"];
$tablename2=$tablename.'_id';
$columnname=$_POST["columnname"];
$iddatatable=$_POST["iddatatable"];
$number = $_POST['number'];
$name = $_POST['name'];
$output = '';
// $debug = new PHPDebug();
// $debug->debug("Очень простое сообщение на консоль", null, LOG);
// $debug->debug("Очень простое сообщение на консоль2", null, LOG);
// if(($_POST["query"])!=="start")
// {

  
  // $resultreturt = R::getAll( 'SELECT '.$columnname.' FROM '.$tablename.' WHERE '.$columnname.'="'.$query.'" ' );
// else
// {
// // $debug->debug("STARTLIST", null, LOG);
//   // $result=R::getAll( 'SELECT * FROM '.$tablename.' ORDER BY id LIMIT 200');
//   $result=R::getAll( 'SELECT * FROM '.$tablename.' ORDER BY id');//Без лимитов
//   $count=R::count($tablename);
// }
if ($tablename=="ncatalog") {
  if ($columnname=="ncatalog_name") {
    # code...
    if(is_numeric($query))
      {$result = R::getAll( 'SELECT * FROM '.$tablename.' WHERE id LIKE \'%'.$query.'%\' ' );}

    else
      {$result = R::getAll( 'SELECT * FROM '.$tablename.' WHERE ncatalog_number='.$number.' AND '.$columnname.' LIKE \'%'.$query.'%\' ' );}




  } else {
    # code...
    $result = R::getAll( 'SELECT * FROM '.$tablename.' WHERE '.$columnname.' LIKE \'%'.$query.'%\' ' );
  }
  
  // $columnname=$tablename+"_"
  
  $output .= '
  <div class="table-responsive">
  
   <table class="table table bordered">
    <tr>
     <th>ID</th>
     <th>Телефон</th>
     <th>Name</th>
    </tr>
 ';
 foreach ($result as $row) {
   if ($columnname=="ncatalog_name"){
$output .= '
   <tr class="w3-red" title="Значение нигде не задействовано">
    <td>'.$row["id"].'</td>
    <td>'.$row["ncatalog_number"].'</td>
    <td><a href="#" onclick="updateKrossData(this)" data-nametable="'.$tablename.'" data-idname="'.$row['id'].'" data-value="'.$row[$columnname].'" data-idinput="'.$idinput.'" class="tablecolumn" data-number="'.$row["ncatalog_number"].'" data-cabinet="'.$row["ncatalog_cabinet"].'">'.$row["ncatalog_name"].'</a></td>
   </tr>
  ';
   }else{
    $output .= '
   <tr class="w3-red" title="Значение нигде не задействовано">
    <td>'.$row["id"].'</td>
    <td><a href="#" onclick="updateKrossData(this)" data-nametable="'.$tablename.'" data-idname="'.$row['id'].'" data-value="'.$row[$columnname].'" data-idinput="'.$idinput.'" class="tablecolumn" data-name="'.$row["ncatalog_name"].'" data-cabinet="'.$row["ncatalog_cabinet"].'">'.$row["ncatalog_number"].'</a></td>
    <td>'.$row["ncatalog_name"].'</td>
   </tr>
  ';
   }
  
 }
  echo ($output);
} else {
  $result = R::getAll( 'SELECT * FROM '.$tablename.' WHERE '.$columnname.' LIKE \'%'.$query.'%\' ' );
  # code...


 $output .= '
  <div class="table-responsive">
  
   <table class="table table bordered">
    <tr>
     <th>ID_Name</th>
     <th>Name</th>
    </tr>
 ';
foreach ($result as $row) {
  $colorbeanscatalog=R::getAll( 'SELECT * FROM ncatalog WHERE '.$tablename2.'='.$row["id"].' ');
  $colorbeanskrossdata=R::getAll( 'SELECT * FROM krossdata WHERE '.$tablename2.'='.$row["id"].' ');
  if ($colorbeanscatalog==null & $colorbeanskrossdata==null){
  $output .= '
   <tr class="w3-red" title="Значение нигде не задействовано">
    <td>'.$row["id"].'</td>
    <td><a href="#" onclick="updateKrossData(this)" data-nametable="'.$tablename.'" data-idname="'.$row['id'].'" data-value="'.$row[$columnname].'" data-idinput="'.$idinput.'" class="tablecolumn">'.$row[$columnname].'</a></td>
   </tr>
  ';
} 
elseif ($colorbeanscatalog==null) { 
    $output .= '
   <tr class="w3-orange" title="Значение задействовано в Кроссовом журнале. По Каталогу значение не задействовано">
    <td>'.$row["id"].'</td>
    <td><a href="#" onclick="updateKrossData(this)" data-nametable="'.$tablename.'" data-idname="'.$row['id'].'" data-value="'.$row[$columnname].'" data-idinput="'.$idinput.'" class="tablecolumn">'.$row[$columnname].'</a></td>
   </tr>
  ';
  }
  elseif ($colorbeanskrossdata==null) {
   $output .= '
   <tr class="w3-khaki" title="Значение задействовано в Каталоге. По Кроссовому журналу значение не задействовано">
    <td>'.$row["id"].'</td>
    <td><a href="#" onclick="updateKrossData(this)" data-nametable="'.$tablename.'" data-idname="'.$row['id'].'" data-value="'.$row[$columnname].'" data-idinput="'.$idinput.'" class="tablecolumn">'.$row[$columnname].'</a></td>
   </tr>
  ';
  }
  else{
   $output .= '
   <tr title="Значение задействовано в Кроссовом журнале и Каталоге">
    <td>'.$row["id"].'</td>
    <td><a href="#" onclick="updateKrossData(this)" data-nametable="'.$tablename.'" data-idname="'.$row['id'].'" data-value="'.$row[$columnname].'" data-idinput="'.$idinput.'" class="tablecolumn">'.$row[$columnname].'</a></td>
   </tr>
  ';
  }
}
 
if ($result==null){$output=''; $output="<br><div class='alert alert-danger' id='alertInfo' name='alertInfo'>
  <strong>Alert!</strong> Совпадений не найдено. Добавте новое значение через меню БД</div>";
  echo $output;
} else {
  if ($resultreturt==null) {
    # code...
    $output2='<div id="resultreturt" hidden>Точного совпадения нет</div>';
  }
  $output.=$count;
  echo $output;
  echo $output2;
  $output2="";
}}
?>
