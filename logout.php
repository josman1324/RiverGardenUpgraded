<?php
// Siempre iniciar sesión para poder destruirla
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Limpiar todas las variables de sesión
$_SESSION = array();

// Destruir la sesión
session_destroy();

// Redirigir al inicio
header("Location: index.php"); // <-- CORREGIDO
exit;
?>