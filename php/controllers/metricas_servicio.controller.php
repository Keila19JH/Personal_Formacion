<?php
require (__DIR__ . '/../models/database.model.php');
include (__DIR__ . '/../dbconfig.php');

$connectionDB = new Database(DB_HOST, DB_NAME, DB_USERNAME, DB_PASSWORD);

$query_jornadas = "SELECT 
    s.servicio,
    SUM(CASE WHEN dl.lunes != '' THEN 1 ELSE 0 END) AS total_lunes,
    SUM(CASE WHEN dl.martes != '' THEN 1 ELSE 0 END) AS total_martes,
    SUM(CASE WHEN dl.miercoles != '' THEN 1 ELSE 0 END) AS total_miercoles,
    SUM(CASE WHEN dl.jueves != '' THEN 1 ELSE 0 END) AS total_jueves,
    SUM(CASE WHEN dl.viernes != '' THEN 1 ELSE 0 END) AS total_viernes,
    SUM(CASE WHEN dl.sabado != '' THEN 1 ELSE 0 END) AS total_sabado,
    SUM(CASE WHEN dl.domingo != '' THEN 1 ELSE 0 END) AS total_domingo
FROM 
    contrato ctr
JOIN 
    dias_laborales dl ON ctr.dias_laborables = dl.id_dias_laborables
JOIN 
    servicio s ON ctr.servicio = s.id_servicio
GROUP BY 
    s.servicio;";
$data_jornadas = $connectionDB->getRows($query_jornadas);

$data = array(
    'conteo_turnos' => $data_jornadas
);

echo json_encode($data);
?>