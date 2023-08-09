<?php 
  if (!isset($_SESSION)) {
    session_start();
  }
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Bienes Raíces</title>
  <link rel="stylesheet" href="/bienesraices/build/css/app.css">
</head>

<body>
  <header class="header <?php echo $inicio ? 'inicio' : '' ?>">
    <div class="contenedor contenido-header">
      <div class="barra">
        <a href="/bienesraices/index.php">
          <img src="/bienesraices/build/img/logo.svg" alt="Logotipo de Bienes Raíces">
        </a>

        <div class="mobile-menu">
          <img src="/bienesraices/build/img/barras.svg" alt="Icono menú responsive">
        </div>

        <div class="derecha">
          <img src="/bienesraices/build/img/dark-mode.svg" alt="Icono dark mode" class="dark-mode-btn">
          <nav class="navegacion">
            <a href="/bienesraices/nosotros.php">Nosotros</a>
            <a href="/bienesraices/anuncios.php">Anuncios</a>
            <a href="/bienesraices/blog.php">Blog</a>
            <a href="/bienesraices/contacto.php">Contacto</a>
            <?php if ($_SESSION['login']) { ?>
              <a href="/bienesraices/admin/index.php">Admin</a>
              <a href="/bienesraices/cerrar-sesion.php">Cerrar Sesión</a>
            <?php } ?>
          </nav>
        </div>
      </div>
      <?php if($inicio) {?>
        <h1>Ventas de Casas y Departamentos Exclusivos de Lujo</h1>
      <?php } ?>
    </div>
  </header>