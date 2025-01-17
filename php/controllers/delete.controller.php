
<?php

require(__DIR__ . '/../models/database.model.php');
include(__DIR__ . '/../dbconfig.php');

$connectionDB = new Database(DB_HOST, DB_NAME, DB_USERNAME, DB_PASSWORD);


if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $deleteId = isset($_POST['id_enfermero']) ? $_POST['id_enfermero'] : null;

    // Validar que el ID no esté vacío
    if (empty($deleteId)) {
        echo json_encode([
            "status" => "error",
            "message" => "El ID es obligatorio para eliminar registros."
        ]);
        exit;
    }

    // Arrays de tablas e IDs asociados
    $tables_db = array(
        $table_informacion_academica = 'informacion_academica',
        $table_dias_laborales = 'dias_laborales',
        $table_contrato = 'contrato',
        $table_capacitacion = 'capacitacion',
        $table_cursos_obligatorios = 'cursos_obligatorios',
        $table_datos_personal = 'datos_personal'
    );

    $deleteColumns = array(
        $deleteColum_ia = 'id',
        $deleteColum_dl = 'id_dias_laborables',
        $deleteColum_contrato = 'id_contrato',
        $deleteColum_capacitacion = 'id_capacitacion',
        $deleteColum_cursos_obligatorios = 'id_cursos_obligatorios',
        $deleteColum = 'id_enfermero'
    );

    // Variables para gestionar el resultado
    $errors = [];
    $successCount = 0;

    // Iterar sobre las tablas y sus columnas correspondientes
    foreach ($tables_db as $key => $table) {
        $column = $deleteColumns[$key];
        $result = $connectionDB->deleteData($table, $column, $deleteId);

        if (is_numeric($result) && $result > 0) {
            $successCount++;
        } else {
            $errors[] = "Error al eliminar en la tabla $table: $result";
        }
    }

    // Responder según los resultados
    if ($successCount > 0 && empty($errors)) {
        echo json_encode([
            "status" => "success",
            "message" => "Se eliminaron correctamente los registros relacionados."
        ]);
    } else {
        echo json_encode([
            "status" => "error",
            "message" => "Ocurrieron errores durante la eliminación.",
            "details" => $errors
        ]);
    }
}

?>