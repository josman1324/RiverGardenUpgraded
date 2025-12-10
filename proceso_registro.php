<?php
require 'db_config.php';
require 'includes/functions.php'; // <-- ¡AÑADIR ESTO!

// 2. Recibimos y validamos datos
$nombre = trim($_POST['nombre']);
$email = trim($_POST['email']);
$password = $_POST['password'];

// --- Validación Estricta ---
if (!preg_match("/^[a-zA-Z\s]+$/", $nombre)) {
    // ANTES: die("Error...");
    mostrar_error("El nombre solo puede contener letras y espacios.", "registro.php"); // <-- CAMBIO
}
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    // ANTES: die("Error...");
    mostrar_error("El correo electrónico no es válido.", "registro.php"); // <-- CAMBIO
}
if (strlen($password) < 6) {
    // ANTES: die("Error...");
    mostrar_error("La contraseña debe tener al menos 6 caracteres.", "registro.php"); // <-- CAMBIO
}
// --- Fin Validación ---

// 3. Hasheamos la contraseña
$password_hash = password_hash($password, PASSWORD_DEFAULT);

try {
    // 4. Verificamos si el email ya existe
    $stmt = $pdo->prepare("SELECT id_usuario FROM usuarios WHERE email = ?");
    $stmt->execute([$email]);
    if ($stmt->fetch()) {
        // ANTES: die("Error...");
        mostrar_error("El correo electrónico ya está registrado. Intenta iniciar sesión.", "login.php"); // <-- CAMBIO (redirige a login)
    }

    $pdo->beginTransaction();

    // 5. Insertamos en `usuarios`
    $stmt = $pdo->prepare("INSERT INTO usuarios (nombre, email, password, rol) VALUES (?, ?, ?, 'cliente')");
    $stmt->execute([$nombre, $email, $password_hash]);
    $id_usuario = $pdo->lastInsertId();

    // 6. Insertamos en `clientes`
    $stmt = $pdo->prepare("INSERT INTO clientes (id_usuario, nombre, email) VALUES (?, ?, ?)");
    $stmt->execute([$id_usuario, $nombre, $email]);
    $id_cliente = $pdo->lastInsertId();

    $pdo->commit();

    // 7. Iniciamos sesión
    $_SESSION['id_usuario'] = $id_usuario;
    $_SESSION['id_cliente'] = $id_cliente;
    $_SESSION['nombre'] = $nombre;
    $_SESSION['rol'] = 'cliente';

    // 8. Redirigimos
    header("Location: dashboard_cliente.php");
    exit;

} catch (PDOException $e) {
    $pdo->rollBack();
    // ANTES: die("Error en el registro: " . $e->getMessage() . " <a href='registro.php'>Volver</a>");
    mostrar_error("Error interno al procesar el registro: " . $e->getMessage(), "registro.php"); // <-- CAMBIO (mostramos error técnico)
}
?>