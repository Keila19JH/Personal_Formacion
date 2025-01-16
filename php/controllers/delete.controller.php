

<?php

require(__DIR__ . '/../models/database.model.php');
include(__DIR__ . '/../dbconfig.php');

$connectionDB = new Database(DB_HOST, DB_NAME, DB_USERNAME, DB_PASSWORD);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Verifica si el ID fue enviado
    if (!isset($_POST['id'])) {
        echo json_encode(['status' => 'error', 'message' => 'ID no enviado']);
        exit;
    }

    // Obtén el ID de la solicitud
    $id = intval($_POST['id']);

    // Depuración: Log del valor recibido
    file_put_contents('debug.log', "ID recibido: $id\n", FILE_APPEND);  // Registra el valor en debug.log

    if ($id <= 0) {
        echo json_encode(['status' => 'error', 'message' => 'ID inválido recibido']);
        exit;
    }

    try {
        // Inicia la transacción
        $connectionDB->begin_transaction();

        // Prepara la consulta
        $stmt = $connectionDB->prepare("DELETE FROM datos_personal WHERE id_enfermero = ?");
        if (!$stmt) {
            echo json_encode(['status' => 'error', 'message' => 'Error al preparar la consulta: ' . $connectionDB->error]);
            $connectionDB->rollback();
            exit;
        }

        $stmt->bind_param("i", $id);
        $stmt->execute();

        // Verifica si se eliminó el registro
        if ($stmt->affected_rows > 0) {
            // Confirma la transacción
            $connectionDB->commit();
            echo json_encode(['status' => 'success', 'message' => 'Registro eliminado exitosamente']);
        } else {
            // Sin registros afectados
            $connectionDB->rollback();
            echo json_encode(['status' => 'error', 'message' => 'No se encontró un registro con ese ID']);
        }

        $stmt->close();
    } catch (Exception $e) {
        // En caso de error, deshacer la transacción
        $connectionDB->rollback();
        echo json_encode(['status' => 'error', 'message' => 'Error al eliminar el registro: ' . $e->getMessage()]);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'Método no permitido']);
}
?>

