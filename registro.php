<?php
// Definimos el título
$page_title = 'Crear Cuenta - River Garden Hotel';
$header_style = 'solid'; // <-- Menú sólido
// Incluimos la cabecera
include 'includes/header.php';
?>

<main>
  <div class="reservation-form">
      <h2>Crear una Cuenta</h2>
      <form action="proceso_registro.php" method="POST" class="form-container">
          <div class="form-group">
              <label for="nombre">Nombre Completo:</label>
              <input type="text" id="nombre" name="nombre" required>
          </div>
          <div class="form-group">
              <label for="email">Correo Electrónico:</label>
              <input type="email" id="email" name="email" required>
          </div>
          <div class="form-group">
              <label for="password">Contraseña:</label>
              <input type="password" id="password" name="password" required>
          </div>
          <button type="submit" class="btn-submit">Registrarme</button>
          <p style="text-align:center; margin-top:15px;">¿Ya tienes cuenta? <a href="login.php">Inicia Sesión</a></p>
      </form>
  </div>
</main>
<?php
// Incluimos el pie de página
include 'includes/footer.php';
?>