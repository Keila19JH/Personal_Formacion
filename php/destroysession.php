<?php
// Inicia la sesión
session_start();

// Destruye todas las variables de sesión
session_unset();

// Destruye la sesión
session_destroy();

// Redirige al formulario de inicio de sesión o a la página de inicio
header("Location: ../login/index.php");
exit();
?>