<?php
  //* BASE DE DATOS
  require './includes/app.php';
  $db = conectarDB();

  $limite = 12;
  $queryObtenerPropiedades = "SELECT * FROM propiedades LIMIT $limite";
  $resultadoPropiedades = mysqli_query($db, $queryObtenerPropiedades);

  //* IMPLEMENTAR PLANTILLA
  $inicio = true;
  incluirTemplate('header');
?>

<main class="contenedor seccion">
  <h2>Casas y Depas en Venta</h2>

  <div class="contenedor-anuncios">
    <?php while ($propiedad = mysqli_fetch_assoc($resultadoPropiedades)) { ?>
      <div class="anuncio">
        <img src="/bienesraices/imagenes/<?php echo $propiedad['imagen'] ?>" alt="Imagen <?php echo $propiedad['nombre'] ?>" loading="lazy">
        <div class="contenido-anuncio">
          <h3><?php echo $propiedad['nombre'] ?></h3>
          <p><?php echo $propiedad['descripcion'] ?></p>
          <p class="precio">$<?php echo $propiedad['precio'] ?></p>

          <ul class="iconos-caracteristicas">
            <li>
              <img src="./build/img/icono_wc.svg" alt="Icono WC" loading="lazy">
              <p><?php echo $propiedad['wc'] ?></p>
            </li>
            <li>
              <img src="./build/img/icono_estacionamiento.svg" alt="Icono Estacionamiento" loading="lazy">
              <p><?php echo $propiedad['estacionamiento'] ?></p>
            </li>
            <li>
              <img src="./build/img/icono_dormitorio.svg" alt="Icono Habitaciones" loading="lazy">
              <p><?php echo $propiedad['habitaciones'] ?></p>
            </li>
          </ul>

          <a href="./anuncio.php?id=<?php echo $propiedad['id'] ?>" class="btn-amarillo-block">Ver Propiedad</a>
        </div>
      </div>
    <?php } ?>
  </div>
</main>

<?php
  //* CERRAR CONEXIÓN
  mysqli_close($db);

  incluirTemplate('footer');
?>