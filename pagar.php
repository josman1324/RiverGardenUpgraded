<?php
require 'db_config.php';

$page_title = 'Confirmar Pago';
$header_style = 'solid'; // <-- Menú sólido
include 'includes/header.php';

if (!isset($_GET['factura_id'])) {
    die("Factura no encontrada.");
}
$id_factura = (int)$_GET['factura_id'];

// Buscamos los datos de la factura y la reserva para mostrarlos
$stmt = $pdo->prepare(
    "SELECT f.*, r.monto_total, r.monto_adelanto, r.fecha_entrada, r.fecha_salida, h.tipo 
     FROM facturas f
     JOIN reservas r ON f.id_reserva = r.id_reserva
     JOIN habitaciones h ON r.id_habitacion = h.id_habitacion
     WHERE f.id_factura = ?"
);
$stmt->execute([$id_factura]);
$factura = $stmt->fetch();

if (!$factura) {
    die("Factura no válida.");
}
?>
<main>
    <div class="reservation-form">
        <h2>Confirmación de Pago</h2>
        <div class="form-container">
            <p><strong>Hola, <?php echo htmlspecialchars($_SESSION['nombre']); ?>.</strong></p>
            <p>Estás a punto de pagar el adelanto (50%) de tu reserva:</p>
            <ul style="list-style: none; padding-left: 0; font-size: 1.1rem; line-height: 1.8;">
                <li><strong>Factura:</strong> <?php echo htmlspecialchars($factura['consecutivo']); ?></li>
                <li><strong>Habitación:</strong> <?php echo htmlspecialchars($factura['tipo']); ?></li>
                <li><strong>Check-in:</strong> <?php echo $factura['fecha_entrada']; ?></li>
                <li><strong>Check-out:</strong> <?php echo $factura['fecha_salida']; ?></li>
                <li><strong>Monto Total Reserva:</strong> $<?php echo number_format($factura['monto_total'], 0); ?> COP</li>
            </ul>
            <h3 style="color: #0d47a1; text-align:center; font-size: 2rem; margin-top: 10px;">
                Total a Pagar (50%): $<?php echo number_format($factura['monto_adelanto'], 0); ?> COP
            </h3>
            
            <p style="text-align:center; margin-top: 20px;">
                (Aquí iría el formulario de tarjeta de crédito de PayU, Stripe, etc.)
            </p>
            
            <a href="confirmar_pago.php?factura_id=<?php echo $id_factura; ?>&transaccion=SIMULADA123" 
               class="btn-submit" 
               style="text-align:center; text-decoration:none; display:block; padding: 15px;">
               Simular Pago Exitoso
            </a>
        </div>
    </div>
</main>
<?php
include 'includes/footer.php';
?>