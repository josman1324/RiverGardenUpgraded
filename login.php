<?php
// Definimos el título
$page_title = 'Iniciar Sesión';
$header_style = 'solid'; // <-- Menú sólido
// Incluimos la cabecera
include 'includes/header.php';
?>

<main>
  <div class="reservation-form">
      <h2>Iniciar Sesión</h2>
      
      <form action="proceso_login.php" method="POST" class="form-container">
          <div class="form-group">
              <label for="email">Correo Electrónico:</label>
              <input type="email" id="email" name="email" required>
          </div>
          <div class="form-group">
              <label for="password">Contraseña:</label>
              <input type="password" id="password" name="password" required>
          </div>
          <button type="submit" class="btn-submit">Entrar</button>
          <p style="text-align:center; margin-top:15px;">¿No tienes cuenta? <a href="registro.php">Regístrate</a></p>
      </form>
  </div>
</main>
<?php
// Incluimos el pie de página
include 'includes/footer.php';
?>