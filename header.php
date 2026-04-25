<nav class="nav">
  <div class="container nav-inner">

    <div class="brand">
      <div class="logo">🍔</div>
      <span class="brand-text">Sabores del Sur</span>
    </div>

    <ul>
      <li><a href="index.php">Inicio</a></li>
      <li><a href="productos.php">Menú</a></li>
      <li><a href="mis_pedidos.php">Mis pedidos</a></li>
      <li><a href="index.php#nosotros">Nosotros</a></li>
      <li><a href="index.php#contacto">Contacto</a></li>
    </ul>

    <div class="nav-actions">
      <?php if(isset($_SESSION['usuario_id'])): ?>
        <span class="user">Hola, <?php echo $_SESSION['usuario_nombre']; ?></span>
        <a class="btn" href="php/logout.php">Cerrar sesión</a>
      <?php else: ?>
        <a class="btn" href="login.php">Iniciar sesión</a>
      <?php endif; ?>
    </div>

  </div>
</nav>