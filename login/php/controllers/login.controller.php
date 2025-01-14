<?php 

require_once('../models/database.model.php');
include('../dbconfig_users.php');

session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user = $_POST['username'];
    $password = $_POST['password'];

    // Crear una conexión segura usando PDO
    try {
        $dsn = "mysql:host=".DB_HOST.";dbname=".DB_NAME.";charset=utf8";
        $options = [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES   => false,
        ];
        $pdo = new PDO($dsn, DB_USERNAME, DB_PASSWORD, $options);
    } catch (PDOException $e) {
        echo 'Connection failed: ' . $e->getMessage();
        exit;
    }

    // Usar consultas preparadas para prevenir inyección SQL
    $query = "SELECT nombre_usuario, usuario, rol,sistema FROM usuarios WHERE usuario = :username AND password = :password";
    $stmt = $pdo->prepare($query);

    // Vincular parámetros y ejecutar la consulta
    $stmt->bindParam(':username', $user, PDO::PARAM_STR);
    $stmt->bindParam(':password', $password, PDO::PARAM_STR);
    $stmt->execute();

    $data = $stmt->fetchAll();
    

    if (count($data) == 0) {
        echo 0;
    } else {
        $_SESSION['valid_user'] = $user;
        $_SESSION['system_type'] = $data[0]['sistema']; // Registrar el tipo de sistema en la sesión
        $_SESSION['last_login_time'] = time(); // Registrar la hora del login
        echo json_encode($data);
    }
}

// Función para manejar el cambio de sistema
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['logout'])) {
    session_destroy();
    header("Location: ../login/index.php"); 
    exit;
}

?>