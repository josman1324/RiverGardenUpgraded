<?php
// Definimos el título de esta página
$page_title = 'Nuestros Servicios - River Garden Hotel';
$header_style = 'solid'; // <-- ¡CLAVE para el menú sólido!
// Incluimos la cabecera
include 'includes/header.php';
?>

<header class="service-page-header">
    <h1>Servicio de Hotel de Lujo y Confort</h1>
    <p>Todo lo que necesitas para una estadía perfecta</p>
</header>



<div class="service-container">
    <div class="service-item">
        <img src="img/hab2.jpg" alt="Habitación Confortable">
        <div class="service-item-content">
            <h2>Confort en tu Habitación</h2>
            <p>Tu descanso es nuestra prioridad. Todas las habitaciones están equipadas con las mejores comodidades para que te sientas como en casa, con la elegancia de un hotel de lujo.</p>
            <ul class="amenities">
                <li><i class="fas fa-wifi"></i> <strong>WiFi de Alta Velocidad</strong></li>
                <li><i class="fas fa-tv"></i> <strong>TV con Satélite</strong></li>
                <li><i class="fas fa-fan"></i> Aire Acondicionado</li>
                <li><i class="fas fa-shower"></i> Baño Privado</li>
                <li><i class="fas fa-coffee"></i> <strong>Desayuno Incluido</strong></li>
                <li><i class="fas fa-car"></i> <strong>Parqueadero Privado</strong></li>
            </ul>
        </div>
    </div>

    <div class="service-item">
        <img src="img/piscinaimagen.jpg" alt="Piscina del hotel">
        <div class="service-item-content">
            <h2>Piscina y Terrazas</h2>
            <p>Sumérgete en nuestra espectacular piscina con luces y chorros. Un oasis de relajación perfecto para escapar del calor y disfrutar del sol.</p>
            <ul class="amenities">
                <li><i class="fas fa-sun"></i> Sillas de sol</li>
                <li><i class="fas fa-umbrella-beach"></i> Sombrillas</li>
                <li><i class="fas fa-cocktail"></i> Servicio de Bar</li>
            </ul>
        </div>
    </div>

    <div class="service-item" id="restaurante">
        <img src="img/restauranteimage.JPG" alt="Restaurante">
        <div class="service-item-content">
            <h2>Restaurante y Gastronomía</h2>
            <p>Nuestro restaurante ofrece una carta que fusiona lo mejor de la cocina local con platos internacionales. Todos nuestros planes de hospedaje incluyen un desayuno tipo buffet completo.</p>
            <ul class="amenities">
                <li><i class="fas fa-utensils"></i> Almuerzos a la carta</li>
                <li><i class="fas fa-wine-glass"></i> Cenas y Vinos</li>
            </ul>
        </div>
    </div>

    

    <div class="service-item">
        <img src="img/img2.jpg" alt="Zonas de esparcimiento">
        <div class="service-item-content">
            <h2>Instalaciones y Esparcimiento</h2>
            <p>El hotel está rodeado de atractivos. Ofrecemos una terraza con mirador, parqueadero vigilado y espacios diseñados para el disfrute de toda la familia.</p>
            <ul class="amenities">
                <li><i class="fas fa-tree"></i> <strong>Zona de Esparcimiento</strong></li>
                <li><i class="fas fa-child"></i> Parque Infantil</li>
                
            </ul>
        </div>
    </div>
</div>

<section class="why-us-section">
    <h2>¿Por qué River Garden?</h2>
    <div class="why-us-container">
        <div class="why-us-item">
            <i class="fas fa-leaf"></i>
            <h3>Conexión visual</h3>
            <p>Despierta con las hermosas vistas de nuestra terraza. Una inmersión total en la belleza de los paisajes .</p>
        </div>
        <div class="why-us-item">
            <i class="fas fa-concierge-bell"></i>
            <h3>Servicio Premium</h3>
            <p>Nuestro personal está dedicado a hacer que tu estadía sea inolvidable.</p>
        </div>
        <div class="why-us-item">
            <i class="fas fa-map-marked-alt"></i>
            <h3>Ubicación Única</h3>
            <p>Cerca de las cascadas más famosas y los atractivos turísticos de Rivera.</p>
        </div>
    </div>
</section>

<section class="testimonials-section">
    <h2>Lo que dicen nuestros huéspedes</h2>
    <div class="testimonials-container">
        <div class="testimonial-card">
            <p>"Un lugar mágico. La atención fue de primera y la vista desde la piscina es inmejorable. Volveremos sin duda."</p>
            <div class="testimonial-author">
                <img src="img/avatar1.png" alt="Avatar Huésped 1"> <span>- María G.</span>
            </div>
        </div>
        <div class="testimonial-card">
            <p>"El desayuno incluido es espectacular. Mucha variedad y sabores locales. Las habitaciones son muy cómodas y limpias."</p>
            <div class="testimonial-author">
                <img src="img/avatar1.png" alt="Avatar Huésped 2"> <span>- Juan Carlos P.</span>
            </div>
        </div>
    </div>
</section>

<section class="cta-section">
    <h2>¿Listo para tu escapada?</h2>
    <p>No esperes más para vivir la experiencia River Garden. Reserva tu habitación hoy mismo.</p>
    <a href="reservas.php" class="hero-btn">RESERVAR AHORA</a>
</section>

<?php
// Incluimos el pie de página
include 'includes/footer.php';
?>