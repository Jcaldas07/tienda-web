<?php session_start(); ?>
<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Sabores del Sur</title>
<link rel="stylesheet" href="css/estilos.css">
</head>
<body>

<?php include("header.php"); ?>

<!-- HERO -->
<header class="hero">
  <div class="hero-content container">

    <span class="tag">Restaurante · Cocina latina</span>

    <h1>
      Bienvenido a <br>
      <span>Sabores del Sur</span>
    </h1>

    <p>
      Disfruta los sabores auténticos de siempre con un toque moderno.
      Vive una experiencia única, reserva tu mesa o explora nuestro menú.
    </p>

    <div class="hero-buttons">
      <a href="productos.php" class="btn">Ver Menú</a>

      <?php if(!isset($_SESSION['usuario_id'])): ?>
        <a href="login.php" class="btn btn-outline">Iniciar sesión</a>
      <?php endif; ?>
    </div>

  </div>
</header>

<!-- NOSOTROS -->
<section id="nosotros" class="section">
  <div class="section-box">
    <h2>Sobre Nosotros</h2>
    <p>
      <p>
En Sabores del Sur nos apasiona ofrecer mucho más que comida: creamos experiencias. 
Combinamos la riqueza de la cocina tradicional latina con técnicas modernas para 
brindar platos únicos, llenos de sabor y calidad.

Nuestro compromiso es trabajar con ingredientes frescos, seleccionados cuidadosamente, 
y ofrecer un servicio que haga sentir a cada cliente como en casa. Cada receta está 
pensada para despertar emociones, recordar sabores auténticos y sorprender con un 
toque innovador.

Ya sea que vengas por una comida rápida o una ocasión especial, en Sabores del Sur 
encontrarás un lugar donde el sabor, la calidad y la experiencia se unen.
</p>
    </p>
  </div>
</section>

<!-- MISION Y VISION -->
<section class="section grid-2">
  <div class="section-box">
    <h2>Misión</h2>
    <p>
Nuestra misión es brindar experiencias gastronómicas de alta calidad, ofreciendo 
productos frescos, deliciosos y preparados con estándares profesionales. 

Buscamos no solo satisfacer el hambre, sino también crear momentos agradables, 
con un servicio rápido, amable y eficiente que supere las expectativas de 
nuestros clientes en cada visita.
</p>
  </div>

  <div class="section-box">
    <h2>Visión</h2>
    <p>
Nuestra visión es convertirnos en el restaurante referente en comida rápida gourmet 
de nuestra ciudad, destacándonos por la innovación, la calidad y la atención al cliente. 

Aspiramos a crecer constantemente, expandiendo nuestra marca y posicionándonos como 
una opción confiable y preferida para quienes buscan sabor, rapidez y una experiencia 
diferente.
</p>
  </div>
</section>

<!-- CONTACTO -->
<section id="contacto" class="section">
  <div class="section-box">
    <h2>Contacto</h2>
    <p>📍 Calle 123 - Ciudad</p>
    <p>📞 300 000 0000</p>
    <p>✉ contacto@saboresdelsur.com</p>
  </div>
</section>

<footer>
  <p>© 2026 Sabores del Sur - Proyecto Académico</p>
</footer>

</body>
</html>