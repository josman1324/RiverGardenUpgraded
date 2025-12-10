<?php
require 'db_config.php';
$page_title = 'Mis Reservas';
$header_style = 'solid'; // <-- Menú sólido
include 'includes/header.php';

// Protección de la página:
if (!isset($_SESSION['id_usuario'])) {
    header('Location: login.php'); // <-- CORREGIDO
    exit;
}

$id_cliente = $_SESSION['id_cliente'];
?>
<main>
    <div class="reservation-form" style="max-width: 800px;">
        <h2>Mis Reservas (Cliente)</h2>
        <p>Hola, <strong><?php echo htmlspecialchars($_SESSION['nombre']); ?></strong>.</p>
        
        <table style="width:100%; margin-top: 20px; border-collapse: collapse;">
            <thead>
                <tr style="background-color: #eaf4ff;">
                    <th style="padding:10px; border: 1px solid #ccc;">Reserva ID</th>
                    <th style="padding:10px; border: 1px solid #ccc;">Check-in</th>
                    <th style="padding:10px; border: 1px solid #ccc;">Check-out</th>
                    <th style="padding:10px; border: 1px solid #ccc;">Estado</th>
                    <th style="padding:10px; border: 1px solid #ccc;">Pago</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $stmt = $pdo->prepare("SELECT * FROM reservas WHERE id_cliente = ? ORDER BY fecha_entrada DESC");
                $stmt->execute([$id_cliente]);
                $reservas = $stmt->fetchAll();
                
                foreach ($reservas as $res):
                ?>
                <tr>
                    <td style="padding:10px; border: 1px solid #ccc; text-align:center;"><?php echo $res['id_reserva']; ?></td>
                    <td style="padding:10px; border: 1px solid #ccc;"><?php echo $res['fecha_entrada']; ?></td>
                    <td style="padding:10px; border: 1px solid #ccc;"><?php echo $res['fecha_salida']; ?></td>
                    <td style="padding:10px; border: 1px solid #ccc;"><?php echo $res['estado_reserva']; ?></td>
                    <td style="padding:10px; border: 1px solid #ccc;"><?php echo $res['estado_pago']; ?></td>
                </tr>
                <?php endforeach; ?>
                
                <?php if (count($reservas) == 0): ?>
                <tr>
                    <td colspan="5" style="padding:10px; text-align:center;">No tienes reservas aún.</td>
                </tr>
                <?php endif; ?>
            </tbody>
        </table>
        <a href="index.php" style="margin-top: 20px; display:inline-block; margin-right: 15px;">Ir al Inicio</a> <a href="logout.php" style="margin-top: 20px; display:inline-block; color: #D32F2F;">Cerrar Sesión</a>
    </div>
</main>
<?php
include 'includes/footer.php';
?>