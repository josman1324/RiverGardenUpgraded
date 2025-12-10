<?php
require 'db_config.php';
$page_title = 'Panel de Administración';
$header_style = 'solid'; // <-- Menú sólido
include 'includes/header.php';

// Protección de la página (¡Doble!)
if (!isset($_SESSION['id_usuario'])) {
    header('Location: login.php'); // <-- CORREGIDO
    exit;
}
if ($_SESSION['rol'] != 'admin' && $_SESSION['rol'] != 'recepcionista') {
    die("Acceso Denegado. No tienes permisos de administrador.");
}
?>
<main>
    <div class="reservation-form" style="max-width: 900px;">
        <h2>Panel de Administración</h2>
        <p>Bienvenido, <strong><?php echo htmlspecialchars($_SESSION['nombre']); ?> (<?php echo $_SESSION['rol']; ?>)</strong>.</p>
        <p>Aquí puedes ver todas las reservas confirmadas del hotel.</p>
        
        <table style="width:100%; margin-top: 20px; border-collapse: collapse;">
            <thead>
                <tr style="background-color: #eaf4ff;">
                    <th style="padding:10px; border: 1px solid #ccc;">ID Reserva</th>
                    <th style="padding:10px; border: 1px solid #ccc;">Cliente (ID)</th>
                    <th style="padding:10px; border: 1px solid #ccc;">Hab (ID)</th>
                    <th style="padding:10px; border: 1px solid #ccc;">Check-in</th>
                    <th style="padding:10px; border: 1px solid #ccc;">Check-out</th>
                    <th style="padding:10px; border: 1px solid #ccc;">Estado</th>
                    <th style="padding:10px; border: 1px solid #ccc;">Pago</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Consultamos TODAS las reservas (ordenadas por las más nuevas)
                $stmt = $pdo->prepare("SELECT * FROM reservas WHERE estado_reserva = 'confirmada' ORDER BY fecha_creacion DESC");
                $stmt->execute();
                $reservas = $stmt->fetchAll();
                
                foreach ($reservas as $res):
                ?>
                <tr>
                    <td style="padding:10px; border: 1px solid #ccc; text-align:center;"><?php echo $res['id_reserva']; ?></td>
                    <td style="padding:10px; border: 1px solid #ccc; text-align:center;"><?php echo $res['id_cliente']; ?></td>
                    <td style="padding:10px; border: 1px solid #ccc; text-align:center;"><?php echo $res['id_habitacion']; ?></td>
                    <td style="padding:10px; border: 1px solid #ccc;"><?php echo $res['fecha_entrada']; ?></td>
                    <td style="padding:10px; border: 1px solid #ccc;"><?php echo $res['fecha_salida']; ?></td>
                    <td style="padding:10px; border: 1px solid #ccc;"><?php echo $res['estado_reserva']; ?></td>
                    <td style="padding:10px; border: 1px solid #ccc;"><?php echo $res['estado_pago']; ?></td>
                </tr>
                <?php endforeach; ?>
                
                <?php if (count($reservas) == 0): ?>
                <tr>
                    <td colspan="7" style="padding:10px; text-align:center;">No hay reservas confirmadas por el momento.</td>
                </tr>
                <?php endif; ?>
            </tbody>
        </table>

        <a href="logout.php" style="margin-top: 20px; display:inline-block; color: #D32F2F;">Cerrar Sesión</a>
    </div>
</main>
<?php
include 'includes/footer.php';
?>