    <?php
    require (__DIR__ . '/../models/database.model.php');
    include (__DIR__ . '/../dbconfig.php');

    $connectionDB = new Database(DB_HOST, DB_NAME, DB_USERNAME, DB_PASSWORD);

    $query = "SELECT t.turno,s.servicio
            FROM datos_personal dp
            JOIN servicio s ON dp.servicio = s.id_servicio
            JOIN turno t ON dp.turno = t.id_turno";

    $AllData = $connectionDB->getRows($query);

    $query_servicio = "SELECT * FROM servicio";
    $data_servicio = $connectionDB->getRows($query_servicio);

    $query_turno = "SELECT * FROM turno";
    $data_turno = $connectionDB->getRows($query_turno);

    $query_jornada = "SELECT COUNT(*) AS recuento_jornada
        FROM datos_personal dp
        JOIN turno t ON dp.turno = t.id_turno
        WHERE t.turno LIKE '%JORNADA ESPECIAL%';";
    $data_jornada = $connectionDB->getRows($query_jornada);

    $query_matutino = "SELECT COUNT(*) AS recuento_matutino
        FROM datos_personal dp
        JOIN turno t ON dp.turno = t.id_turno
        WHERE t.turno LIKE '%MATUTINO%';";
    $data_matutino = $connectionDB->getRows($query_matutino);

    $query_vespertino = "SELECT COUNT(*) AS recuento_vespertino
        FROM datos_personal dp
        JOIN turno t ON dp.turno = t.id_turno
        WHERE t.turno LIKE '%VESPERTINO%';";
    $data_vespertino = $connectionDB->getRows($query_vespertino);

    $query_nocturno = "SELECT COUNT(*) AS recuento_nocturno
        FROM datos_personal dp
        JOIN turno t ON dp.turno = t.id_turno
        WHERE t.turno LIKE '%NOCTURNO%';";
    $data_nocturno = $connectionDB->getRows($query_nocturno);

    $data_turnos = array(
        'jornada' => $data_jornada,
        'matutino' => $data_matutino,
        'vespertino' => $data_vespertino,
        'nocturno' => $data_nocturno
    );

    $data = array(
        'personal' => $AllData,
        'servicio' => $data_servicio,
        'turno' => $data_turno,
        'conteo_turnos' => $data_turnos
    );

    echo json_encode($data);
    ?>
