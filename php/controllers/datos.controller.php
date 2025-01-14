<?php
require (__DIR__ . '/../models/database.model.php');
include (__DIR__ . '/../dbconfig.php');


$connectionDB = new Database(DB_HOST, DB_NAME, DB_USERNAME, DB_PASSWORD);


$query_puesto = "SELECT * FROM puesto";
$data_puesto = $connectionDB->getRows($query_puesto);

$query_servicio = "SELECT * FROM servicio";
$data_servicio = $connectionDB->getRows($query_servicio);


?>