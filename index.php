<?php
// Definimos el título de esta página
$page_title = 'Bienvenido a River Garden Hotel - Tu paraíso en Rivera, Huila';
$header_style = 'transparent'; // <-- ¡CLAVE para el menú flotante!
// Incluimos la cabecera
include 'includes/header.php';
?>

<section class="hero-slider">
  <div class="slider-wrapper">
    <div class="slide" style="background-image: url('img/img1.JPG');"></div>
    <div class="slide" style="background-image: url('img/img2.jpg');"></div>
    <div class="slide" style="background-image: url('img/img3.jpg');"></div>
    <div class="slide" style="background-image: url('img/piscinaimagen.jpg');"></div>
    <div class="slide" style="background-image: url('img/img1.JPG');"></div>
  </div>

  <div class="hero-content">
    <h1>RIVER GARDEN</h1>
    <p>Donde la naturaleza se encuentra con el confort. Tu escapada perfecta.</p>
    <a href="reservas.php" class="hero-btn">RESERVAR AHORA</a>
  </div>
</section>

<section class="about-section" id="about">
  <div class="about-container">
    <div class="about-image">
      <img src="img/img1.JPG" alt="Vista del hotel River Garden">
    </div>
    <div class="about-content">
      <h2>Descubre River Garden</h2>
      <p>Ubicados en el corazón de Mocoa, Putumayo, River Garden Hotel ofrece una experiencia única donde la aventura amazónica se combina con el lujo y la relajación. Nuestras instalaciones están diseñadas para brindarte el máximo confort mientras te sumerges en un entorno natural incomparable.</p>
      <a href="servicios.php" class="btn-learn-more">Nuestros Servicios</a>
    </div>
  </div>
</section>

<section class="featured-rooms-section" id="reservas">
  <h2>Nuestras Habitaciones</h2>
  <div class="featured-rooms-container">
    
    <div class="featured-room">
      <img src="img/hab1.jpg" alt="Habitación sencilla">
      <h3>Habitación Individual</h3>
      <p>150.000 COP/Noche</p>
      <a href="servicios.php" class="btn-learn-more blue-btn">Leer más</a>
    </div>
    
    <div class="featured-room">
      <img src="img/hab2.jpg" alt="Habitación doble">
      <h3>Habitación Pareja</h3>
      <p>250.000 COP/Noche</p>
      <a href="servicios.php" class="btn-learn-more blue-btn">Leer más</a>
    </div>
    
    <div class="featured-room">
      <img src="img/hab1.jpg" alt="Habitación triple">
      <h3>Habitación Triple</h3>
      <p>350.000 COP/Noche</p>
      <a href="servicios.php" class="btn-learn-more blue-btn">Leer más</a>
    </div>

    <div class="featured-room">
      <img src="img/hab2.jpg" alt="Habitación familiar">
      <h3>Habitación Familiar</h3>
      <p>450.000 COP/Noche</p>
      <a href="servicios.php" class="btn-learn-more blue-btn">Leer más</a>
    </div>
  </div>
</section>

<section class="activities-section" id="actividades">
  <h2>Actividades y Experiencias</h2>
  <div class="activities-container">
    
    <div class="activity-card">
      <img src="img/img2.jpg" alt="Piscina">
      <div class="activity-content">
        <h3>Piscina y Arenero Infantil</h3>
        <p>Disfruta en familia de nuestro arenero y piscina con chorros y luces</p>
      </div>
    </div>
    
    <div class="activity-card">
      <img src="img/img3.jpg" alt="Senderismo">
      <div class="activity-content">
        <h3>Terrazas</h3>
        <p>Relajate y toma una copa de vino con una hermosa vista a Neiva y sus alrededores</p>
      </div>
    </div>

    <div class="activity-card">
      <img src="img/restauranteimage.JPG" alt="Restaurante">
      <div class="activity-content">
        <h3>Gastronomía Local</h3>
        <p>Disfruta de sabores tipicos del Huila en nuestro restaurante.</p>
      </div>
    </div>
    
  </div>
</section>

<?php
// Incluimos el pie de página
include 'includes/footer.php';
?>