<?php
// Iniciamos la sesión
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
// Establecemos la clase del header (transparente o sólido)
// Esta variable $header_style la defines en cada página (ej: index.php)
$header_class = (isset($header_style) && $header_style == 'transparent') ? 'navbar-centered-transparent' : 'navbar-centered-solid';
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title><?php echo isset($page_title) ? $page_title : 'River Garden Hotel'; ?></title>
  
  <link rel="stylesheet" href="Styles_Hotel.css?v=4.0" />
  
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link href="https://fonts.googleapis.com/css2?family=Lora:wght@400;700&family=Poppins:wght@400;600&display=swap" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
</head>
<body>

<header>
  <div class="navbar-centered <?php echo $header_class; ?>">
    
    <ul class="nav-group left">
      <li><a href="index.php">INICIO</a></li>
      <li><a href="servicios.php">SERVICIOS</a></li>
      <li><a href="index.php#actividades">ACTIVIDADES</a></li>
    </ul>

    <a href="index.php" class="logo-centered">
      <img src="img/logo3.png" alt="River Garden logo">
    </a>

    <ul class="nav-group right">
      <li><a href="reservas.php">RESERVAS</a></li>
      <li><a href="contacto.php">CONTACTO</a></li>
      
      <li class="user-menu-item">
        <?php if (isset($_SESSION['id_usuario'])): ?>
          <a href="dashboard_cliente.php" class="user-btn-link">
            <i class="fas fa-user"></i> MI CUENTA
          </a>
        <?php else: ?>
          <a href="login.php" class="user-btn-link">
            <i class="fas fa-user"></i> LOGIN
          </a>
        <?php endif; ?>
      </li>
    </ul>
  </div>
</header>