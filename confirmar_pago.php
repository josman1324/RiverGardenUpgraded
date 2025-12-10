<?php
require 'db_config.php';

// Esto normalmente lo llama la pasarela de pago (Stripe, PayU)
$id_factura = (int)$_GET['factura_id'];
$id_transaccion = htmlspecialchars($_GET['transaccion']);

try {
    // 1. Buscamos la factura y el monto del adelanto
    $stmt = $pdo->prepare("SELECT f.id_reserva, r.monto_adelanto, c.email, c.nombre 
                           FROM facturas f
                           JOIN reservas r ON f.id_reserva = r.id_reserva
                           JOIN clientes c ON r.id_cliente = c.id_cliente
                           WHERE f.id_factura = ?");
    $stmt->execute([$id_factura]);
    $datos = $stmt->fetch();

    if (!$datos) die("Error de confirmación.");

    $id_reserva = $datos['id_reserva'];
    $monto_pagado = $datos['monto_adelanto'];
    $email_cliente = $datos['email'];
    $nombre_cliente = $datos['nombre'];

    // 2. Actualizamos las tablas (Usamos transacción)
    $pdo->beginTransaction();

    // 2a. Insertamos el pago
    $stmt = $pdo->prepare("INSERT INTO pagos (id_factura, metodo_pago, id_transaccion, monto, estado) 
                           VALUES (?, 'Simulado (Stripe)', ?, ?, 'exitoso')");
    $stmt->execute([$id_factura, $id_transaccion, $monto_pagado]);

    // 2b. Actualizamos la RESERVA a 'confirmada' y 'pagado'
    $stmt = $pdo->prepare("UPDATE reservas 
                           SET estado_reserva = 'confirmada', estado_pago = 'pagado' 
                           WHERE id_reserva = ?");
    $stmt->execute([$id_reserva]);
    
    $pdo->commit();

    // 3. ENVIAMOS EMAIL DE CONFIRMACIÓN (Punto 4)
    $asunto = "¡Tu reserva en River Garden está Confirmada! (ID: $id_reserva)";
    $mensaje = "
        Hola $nombre_cliente,
        Hemos recibido tu pago de $".number_format($monto_pagado)." y tu reserva está CONFIRMADA.
        ID de Reserva: #$id_reserva
        ID de Transacción: $id_transaccion
        Te esperamos pronto.
        - Equipo de River Garden Hotel
    ";
    $headers = "From: no-reply@rivergarden.com";
    // mail($email_cliente, $asunto, $mensaje, $headers); // Descomenta en producción

} catch (PDOException $e) {
    $pdo->rollBack();
    die("Error al confirmar el pago: " . $e->getMessage());
}

// 4. Mostramos la confirmación final (con header y footer)
$page_title = 'Pago Exitoso';
$header_style = 'solid';
include 'includes/header.php';
?>
<main>
    <div style='font-family: Poppins, sans-serif; text-align: center; margin-top: 50px; padding: 40px; border: 1px solid #ccc; max-width: 600px; margin: 0 auto; border-radius: 12px; box-shadow: 0 4px 12px rgba(0,0,0,0.1); background: #fff;'>
        <h2>¡Pago Exitoso!</h2>
        <p>Gracias, <strong><?php echo $nombre_cliente; ?></strong>. Tu reserva <strong>#<?php echo $id_reserva; ?></strong> está confirmada.</p>
        <p>Hemos enviado un correo de confirmación a <strong><?php echo $email_cliente; ?></strong>.</p>
        
        <a href='dashboard_cliente.php' style='display: inline-block; margin-top: 20px; padding: 12px 20px; background-color: #2196f3; color: white; text-decoration: none; border-radius: 8px;'>
            Ver Mis Reservas
        </a>
        <a href='generar_factura_pdf.php?factura_id=<?php echo $id_factura; ?>' target='_blank' style='display: inline-block; margin-top: 10px; padding: 12px 20px; background-color: #0d47a1; color: white; text-decoration: none; border-radius: 8px;'>
            Descargar Factura (PDF)
        </a>
    </div>
</main>
<?php
include 'includes/footer.php';
?>