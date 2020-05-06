<?php
require "../libs/rb.php";
R::setup( 'mysql:host=localhost;dbname=kross', 'dron', 'port2100' ); //for localhost
// R::setup( 'mysql:host=192.168.50.37;dbname=kross', 'dron', 'port2100' );
if ( !R::testConnection() )
{
        exit ('Нет соединения с базой данных');
}
$ncatalog_number=$_POST["number"];
$getSubName=R::getAll('SELECT DISTINCT krossdata.id, krossdata.data, krossdata.sub_id,  sub.sub_name, krossdata.comment FROM krossdata
	INNER JOIN sub ON krossdata.sub_id = sub.id
	WHERE number=?', [$ncatalog_number]);
foreach ($getSubName as $row) {
	$ncatalog_name=$row["sub_name"];
	$ncatalog_cabinet=$row["comment"];
}
// R::close();
// R::setup( 'mysql:host=localhost;dbname=newkross', 'dron', 'port2100' );
 R::addDatabase('NK','mysql:host=localhost;dbname=newkross', 'dron', 'port2100');
  R::selectDatabase('NK');
if ( !R::testConnection() )
{
        exit ('Нет соединения с базой данных');
}
$addNumber=R::dispense('ncatalog');
$addNumber->ncatalog_number=$ncatalog_number;
$addNumber->ncatalog_name=$ncatalog_name;
$addNumber->ncatalog_cabinet=$ncatalog_cabinet;
$addNumber->visibility=1;
R::store($addNumber);
$id=R::getinsertID();
$query = 'UPDATE krossdata SET ncatalog_id='.$id.' WHERE number='.$ncatalog_number;
R::exec($query);
echo ('Запись добавлена в каталог и обновлена в кроссовых журналах. Id:'.$id);
?>