<?php
$mysqli = new mysqli("localhost", "dron", "port2100", "newkross");
if ($mysqli->connect_errno) {
    echo "Не удалось подключиться к MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
} else echo "Connection to MySQL". "</br>";
$res = $mysqli->query("SELECT * FROM ncatalog WHERE id=2436");

while ($row = $res->fetch_assoc()) {
    echo " id = " . $row['id'] . "</br>";
    echo " number = " . $row['number'] . "</br>";
    echo " name = " . $row['name'] . "</br>";
}
$res = $mysqli->query("SELECT * FROM krossdata WHERE where vnutr=6931");
while ($row = $res->fetch_assoc()) {
    echo " id = " . $row['id'] . "</br>";
    echo " number = " . $row['number'] . "</br>";
    echo " name = " . $row['name'] . "</br>";
}
$mysqli->query("SELECT * FROM ncatalog WHERE id=2436");
  // var_dump($res);
?>