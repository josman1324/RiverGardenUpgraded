<?php
// Función para mostrar errores dentro del layout del sitio

function mostrar_error($mensaje, $volver_url = null) {
    // Definimos título y estilo sólido para el header
    $page_title = 'Error';
    $header_style = 'solid'; 
    
    // Incluimos el header (esto debe hacerse DENTRO de la función)
    // Usamos __DIR__ para asegurar que la ruta sea correcta desde donde se llame la función
    include __DIR__ . '/header.php'; 
    
    ?>
    <main>
        <div class="error-container">
            <h2>¡Oops! Ha ocurrido un error</h2>
            <p class="error-message-display"><?php echo htmlspecialchars($mensaje); ?></p>
            
            <?php 
            // Si se proporcionó una URL para volver, muestra el enlace
            if ($volver_url): 
                // Detectar si la URL es relativa o absoluta
                $link_text = 'Volver atrás';
                if (strpos($volver_url, '.php') !== false || strpos($volver_url, '.html') !== false) {
                    // Es probable que sea una página específica (registro, login, reservas)
                    if (strpos($volver_url, 'registro') !== false) $link_text = 'Volver al Registro';
                    elseif (strpos($volver_url, 'login') !== false) $link_text = 'Volver al Login';
                    elseif (strpos($volver_url, 'reservas') !== false) $link_text = 'Volver a Reservas';
                }
            ?>
                <a href="<?php echo htmlspecialchars($volver_url); ?>" class="btn-submit" style="margin-top: 20px; text-decoration: none; display: inline-block; text-align: center;"><?php echo $link_text; ?></a>
            <?php else: 
                // Si no hay URL específica, ofrecer ir al inicio
            ?>
                 <a href="index.php" class="btn-submit" style="margin-top: 20px; text-decoration: none; display: inline-block; text-align: center;">Ir a la página de Inicio</a>
            <?php endif; ?>
        </div>
    </main>
    <?php
    
    // Incluimos el footer
    include __DIR__ . '/footer.php'; 
    
    // Detenemos la ejecución del script original
    exit; 
}

?>