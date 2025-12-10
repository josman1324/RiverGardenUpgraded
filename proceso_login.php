<?php
require 'db_config.php';
require 'includes/functions.php'; // <-- ¡AÑADIR ESTO!

$email = trim($_POST['email']);
$password = $_POST['password'];

if (!filter_var($email, FILTER_VALIDATE_EMAIL) || empty($password)) {
    // ANTES: die("Error...");
    mostrar_error("Por favor, introduce un correo y contraseña válidos.", "login.php"); // <-- CAMBIO
}

try {
    // Buscamos al usuario por email
    $stmt = $pdo->prepare("SELECT u.*, c.id_cliente FROM usuarios u 
                           LEFT JOIN clientes c ON u.id_usuario = c.id_usuario 
                           WHERE u.email = ?");
    $stmt->execute([$email]);
    $usuario = $stmt->fetch();

    // Verificamos la contraseña
    if ($usuario && password_verify($password, $usuario['password'])) {
        
        // ¡Éxito! Guardamos los datos en la SESIÓN
        $_SESSION['id_usuario'] = $usuario['id_usuario'];
        $_SESSION['id_cliente'] = $usuario['id_cliente']; // Puede ser NULL si es admin/recep sin cliente asociado
        $_SESSION['nombre'] = $usuario['nombre'];
        $_SESSION['rol'] = $usuario['rol'];

        // Redirigimos según el ROL
        if ($usuario['rol'] == 'admin' || $usuario['rol'] == 'recepcionista') {
            header("Location: dashboard_admin.php");
        } else {
            // Aseguramos que el cliente tenga un id_cliente, si no, lo creamos (caso raro)
            if (empty($usuario['id_cliente'])) {
                $stmtCliente = $pdo->prepare("INSERT INTO clientes (id_usuario, nombre, email) VALUES (?, ?, ?)");
                $stmtCliente->execute([$usuario['id_usuario'], $usuario['nombre'], $usuario['email']]);
                $_SESSION['id_cliente'] = $pdo->lastInsertId();
            }
            header("Location: dashboard_cliente.php");
        }
        exit;

    } else {
        // ANTES: die("Error...");
        mostrar_error("Correo o contraseña incorrectos.", "login.php"); // <-- CAMBIO
    }

} catch (PDOException $e) {
    // ANTES: die("Error en el login: " . $e->getMessage());
    mostrar_error("Error interno al intentar iniciar sesión: " . $e->getMessage(), "login.php"); // <-- CAMBIO
}
?>