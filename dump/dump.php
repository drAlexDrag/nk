<?php
//%progdir%\modules\php\%phpdriver%\php-win.exe -c %progdir%\userdata\temp\config\php.ini -q -f %sitedir%\newkross\dump\dump.php// for cron
date_default_timezone_set('Europe/Minsk');
$out="";
$dump_dir_if = "D:/DUMP/NKROSS/";
$dump_dir_if_remote = "//192.168.2.141/d/NKROSS/";
$file = "nkross_".date("Ymd_Hi"); // Имя архива
$delay_delete = 180 * 24 * 3600; // Время в секундах, через которое архивы будут удаляться
  if (file_exists($dump_dir_if)) {
   // echo "Существует";
   $dump_dir = "D:/DUMP/NKROSS/";
} else {
   mkdir($dump_dir_if, 0700, true);
   $dump_dir = "D:/DUMP/NKROSS/";
}
///////////////////////////////////remote//////////////////////
exec("ping -n 2 192.168.2.141", $output, $status);
if($status==0){
	if (file_exists($dump_dir_if_remote)) {
   // echo "Существует";
  	$dump_dir = "//192.168.2.141/d/NKROSS/";
} else {

	mkdir($dump_dir_if_remote, 0700, true);
	$dump_dir = "//192.168.2.141/d/NKROSS/";
}
exec("mysqldump --user=dron --password=port2100 --host=localhost newkross > //192.168.2.141/d/NKROSS/".$file.".sql", $output, $return);
if(!$return)
{$out.= ('<div class="container-fluid alert alert-success">Создана копия на удаленной машине: //192.168.2.141/d/NKROSS/'.$file.'.sql</div>');}
else { echo '<div class="container-fluid alert alert-danger">Ошибка копирования на удаленную машину</div>';}

} else {
	$out.=('<div class="container-fluid alert alert-danger">Нет соединения с удаленной машиной. Будет создана копия только на локальной машине</div>');
}
//////////////////////////////////////////////////////////////////

/////////////////////////localhost////////////////////////////////
exec("mysqldump --user=dron --password=port2100 --host=localhost newkross > D:/DUMP/NKROSS/".$file.".sql", $output, $return);
if(!$return)
{$out.= ('<div class="container-fluid alert alert-success">Создана копия на локальной машине: D:/DUMP/NKROSS/'.$file.'.sql</div><hr>');}
else { echo '<div class="container-fluid alert alert-danger">Ошибка копирования на локальную машину</div><hr>';}

echo ($out);
?>