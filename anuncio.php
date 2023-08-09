<?php 
  //* BASE DE DATOS
  require './includes/app.php';
  $db = conectarDB();

  //* OBTENER QUERY ID
  $idPropiedad = filter_var($_GET['id'], FILTER_VALIDATE_INT) ?? null;

  if (!$idPropiedad) {
    header('Location: /bienesraices/index.php');
  }

  $queryObtenerPropiedad = "SELECT * FROM propiedades WHERE id=$idPropiedad";
  $resultadoPropiedad = mysqli_query($db, $queryObtenerPropiedad);

  if (!$resultadoPropiedad -> num_rows) {
    header('Location: /bienesraices/index.php');
  }

  $propiedad = mysqli_fetch_assoc($resultadoPropiedad);

  //* IMPLEMENTAR PLANTILLA
  $inicio = true;
  incluirTemplate('header');
?>

  <main class="contenedor seccion contenido-centrado">
    <h1><?php echo $propiedad['nombre'] ?></h1>
    <img src="/bienesraices/imagenes/<?php echo $propiedad['imagen'] ?>" alt="Imagen <?php echo $propiedad['nombre'] ?>" loading="lazy">

    <div class="resumen-propiedad">
      <p class="precio"><?php echo $propiedad['precio'] ?></p>
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
      <p><?php echo $propiedad['descripcion'] ?></p>
    </div>
  </main>

<?php 
  mysqli_close($db);
  incluirTemplate('footer');
?>