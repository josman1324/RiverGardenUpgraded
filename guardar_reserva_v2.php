<?php
require 'db_config.php';
require 'includes/functions.php'; // <-- ¡AÑADIR ESTO!

// 2. ¡VERIFICACIÓN DE SESIÓN!
if (!isset($_SESSION['id_usuario']) || !isset($_SESSION['id_cliente'])) {
    $_SESSION['reserva_pendiente'] = $_POST;
    header("Location: login.php?mensaje=requiere_login");
    exit;
}

$id_cliente = $_SESSION['id_cliente'];

// 4. Validación de datos del formulario
$id_habitacion = (int)$_POST['habitacion'];
$fecha_entrada = $_POST['fecha_entrada'];
$fecha_salida = $_POST['fecha_salida'];

if (empty($id_habitacion) || empty($fecha_entrada) || empty($fecha_salida) || $fecha_salida <= $fecha_entrada) {
    // ANTES: die("Error...");
    mostrar_error("Las fechas o la habitación seleccionada no son válidas.", "reservas.php"); // <-- CAMBIO
}

try {
    // --- BLOQUE ANTI-OVERBOOKING ---
    $stmtCheck = $pdo->prepare(
        "SELECT COUNT(*) FROM reservas 
         WHERE id_habitacion = ? 
         AND estado_reserva != 'cancelada'
         AND NOT (fecha_salida <= ? OR fecha_entrada >= ?)"
    );
    $stmtCheck->execute([$id_habitacion, $fecha_entrada, $fecha_salida]);
    $count = $stmtCheck->fetchColumn();

    if ($count > 0) {
        // ANTES: die("Error...");
        mostrar_error("Esta habitación ya está reservada para las fechas seleccionadas. Por favor, intente con otras fechas.", "reservas.php"); // <-- CAMBIO
    }
    // --- FIN ANTI-OVERBOOKING ---

    // 5. Calculamos el precio
    $stmt = $pdo->prepare("SELECT precio_noche FROM habitaciones WHERE id_habitacion = ?");
    $stmt->execute([$id_habitacion]);
    $habitacion = $stmt->fetch();

    if (!$habitacion) {
        // ANTES: die("Error...");
        mostrar_error("La habitación seleccionada no existe.", "reservas.php"); // <-- CAMBIO
    }
    
    // ... (resto del cálculo de precios, inserción de reserva y factura) ...
    $precio_noche = $habitacion['precio_noche'];
    $date1 = new DateTime($fecha_entrada);
    $date2 = new DateTime($fecha_salida);
    $diff = $date1->diff($date2);
    $numero_noches = $diff->days;
    if ($numero_noches <= 0) $numero_noches = 1;

    $monto_total = $precio_noche * $numero_noches;
    $monto_adelanto = $monto_total * 0.50;

    // 6. Insertamos la RESERVA
    $stmt = $pdo->prepare(
        "INSERT INTO reservas (id_cliente, id_habitacion, fecha_entrada, fecha_salida, numero_noches, monto_total, monto_adelanto, estado_reserva, estado_pago)
         VALUES (?, ?, ?, ?, ?, ?, ?, 'pendiente', 'pendiente')"
    );
    $stmt->execute([$id_cliente, $id_habitacion, $fecha_entrada, $fecha_salida, $numero_noches, $monto_total, $monto_adelanto]);
    $id_reserva = $pdo->lastInsertId();

    // 7. Creamos la FACTURA
    $consecutivo = "FE-RG-" . $id_reserva; 
    $detalle_factura = "Adelanto (50%) por reserva de habitación. Noches: $numero_noches.";
    
    $stmt = $pdo->prepare(
        "INSERT INTO facturas (id_reserva, consecutivo, monto_total, detalle) 
         VALUES (?, ?, ?, ?)"
    );
    $stmt->execute([$id_reserva, $consecutivo, $monto_total, $detalle_factura]);
    $id_factura = $pdo->lastInsertId();

    // 8. Redirigimos a la pasarela de pago
    header("Location: pagar.php?factura_id=" . $id_factura);
    exit;

} catch (PDOException $e) {
    // ANTES: die("Error al procesar la reserva: " . $e->getMessage());
    mostrar_error("Error interno al procesar la reserva: " . $e->getMessage(), "reservas.php"); // <-- CAMBIO
}
?>