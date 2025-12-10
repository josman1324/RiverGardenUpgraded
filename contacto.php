<?php
// Definimos el título de esta página
$page_title = 'Contacto - River Garden Hotel';
$header_style = 'solid'; // <-- Menú sólido
// Incluimos la cabecera (Menú)
include 'includes/header.php';
?>

<main>
  <section class="contact" style="padding: 100px 20px; text-align: center; min-height: 50vh; display:flex; align-items:center; justify-content:center;">
    <div class="container">
      <h2 style="font-size: 2.5rem; color: #003366; margin-bottom: 20px;">Contáctanos</h2>
      <p style="font-size: 1.2rem; max-width: 500px; margin: 0 auto 30px;">¿Tienes preguntas o quieres más información? Contáctanos directamente por WhatsApp para una atención inmediata.</p>
      <a href="https://wa.me/573152528546" target="_blank" class="btn-whatsapp-contact">
        <i class="fab fa-whatsapp"></i> Escríbenos al WhatsApp
      </a>
    </div>
  </section>
</main>
<?php
// Incluimos el pie de página
include 'includes/footer.php';
?>