<footer class="main-footer">
  <div class="footer-container">
    <div class="footer-column">

        <a href="index.php" >
       <img src="img/logo3.png" alt="River Garden Logo" class="footer-logo-img">
    </a>
      <p>Vive una experiencia inolvidable rodeado de naturaleza y confort a orillas del río.</p>
    </div>
    
    <div class="footer-column">
      <h3>Navegación</h3>
      <a href="index.php">Inicio</a>
      <a href="servicios.php">Nuestros Servicios</a>
      <a href="reservas.php">Haz tu Reserva</a>
      <a href="contacto.php">Contacto</a>
      
      <a href="#" class="modal-trigger" data-modal="privacyModal">Política de Privacidad</a>
      <a href="#" class="modal-trigger" data-modal="cookieModal">Política de Cookies</a>
    </div>

    <div class="footer-column">
      <h3>Contacto</h3>
      <p><i class="fas fa-map-marker-alt"></i> Centro Arriba, Rivera, Huila</p>
      <p><i class="fas fa-phone"></i> +57 315 252 8546</p>
      <p><i class="fas fa-envelope"></i> reservas@rivergarden.com</p>
    </div>

    <div class="footer-column">
      <h3>Síguenos (Redes)</h3>
      <p>Entérate de nuestras promociones y eventos.</p>
      <div class="social-icons">
        <a href="https://facebook.com" target="_blank" aria-label="Facebook"><i class="fab fa-facebook-f"></i></a>
        <a href="https://instagram.com" target="_blank" aria-label="Instagram"><i class="fab fa-instagram"></i></a>
        <a href="https://wa.me/573152528546" target="_blank" aria-label="WhatsApp"><i class="fab fa-whatsapp"></i></a>
      </div>
    </div>
  </div>
  <div class="footer-bottom">
    <p>&copy; <?php echo date('Y'); ?> River Garden Hotel. Todos los derechos reservados.</p>
  </div>
</footer>

<div id="cookieModal" class="modal">
  <div class="modal-content">
    <span class="close-modal" data-close="cookieModal">&times;</span>
    <h2>Política de Cookies</h2>
    <p>Este sitio web utiliza cookies para asegurar que obtengas la mejor experiencia. Al continuar navegando, aceptas nuestro uso de cookies...</p>
  </div>
</div>
<div id="privacyModal" class="modal">
  <div class="modal-content">
    <span class="close-modal" data-close="privacyModal">&times;</span>
    <h2>Política de Privacidad</h2>
    <p>Tu privacidad es importante para nosotros. Nos comprometemos a proteger tus datos personales. No compartiremos tu información con terceros sin tu consentimiento...</p>
  </div>
</div>

<script>
  // Script para los modales
  document.querySelectorAll('.modal-trigger').forEach(trigger => {
    trigger.addEventListener('click', function (e) {
      e.preventDefault();
      const modalId = this.getAttribute('data-modal');
      document.getElementById(modalId).style.display = 'flex';
    });
  });
  
  document.querySelectorAll('.close-modal').forEach(btn => {
    btn.addEventListener('click', function () {
      const modalId = this.getAttribute('data-close');
      document.getElementById(modalId).style.display = 'none';
    });
  });
  
  window.addEventListener('click', function (e) {
    document.querySelectorAll('.modal').forEach(modal => {
      if (e.target === modal) {
        modal.style.display = 'none';
      }
    });
  });
</script>

</body>
</html>