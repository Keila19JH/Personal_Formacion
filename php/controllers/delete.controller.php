
<?php

require(__DIR__ . '/../models/database.model.php');
include(__DIR__ . '/../dbconfig.php');

$connectionDB = new Database(DB_HOST, DB_NAME, DB_USERNAME, DB_PASSWORD);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $tables_db = array(
        'informacion_academica',
        'dias_laborales',
        'contrato',
        'capacitacion',
        'cursos_obligatorios',
        'datos_personal'
    );
    
    $id_tables = array(
        'id',
        'id_dias_laborables',
        'id_contrato',
        'id_capacitacion',
        'id_cursos_obligatorios',
        'id_enfermero'
    );

    $deleteId = $_POST[ 'id_enfermero' ];


    $result = $connectionDB->deleteData( $tables_db[0], $id_colum[0], $deleteId );

    if( $result ){
        echo 'success';
    }else{
        echo "Error al eliminar en la tabla";
        exit;
    }
}

?>