<?php 
  require './includes/app.php';
  use App\Propiedad;

  //* OBTENER QUERY ID
  $idPropiedad = filter_var($_GET['id'], FILTER_VALIDATE_INT) ?? null;

  if (!$idPropiedad) {
    header('Location: /bienesraices/index.php');
  }

  $propiedad = Propiedad::find($idPropiedad);

  //* IMPLEMENTAR PLANTILLA
  $inicio = true;
  incluirTemplate('header');
?>

  <main class="contenedor seccion contenido-centrado">
    <h1><?php echo $propiedad->getNombre() ?></h1>
    <img src="/bienesraices/imagenes/<?php echo $propiedad->getImagen() ?>" alt="Imagen <?php echo $propiedad->getNombre() ?>" loading="lazy">

    <div class="resumen-propiedad">
      <p class="precio"><?php echo $propiedad->getPrecio() ?></p>
      <ul class="iconos-caracteristicas">
        <li>
          <img src="./build/img/icono_wc.svg" alt="Icono WC" loading="lazy">
          <p><?php echo $propiedad->getWc() ?></p>
        </li>
        <li>
          <img src="./build/img/icono_estacionamiento.svg" alt="Icono Estacionamiento" loading="lazy">
          <p><?php echo $propiedad->getEstacionamiento() ?></p>
        </li>
        <li>
          <img src="./build/img/icono_dormitorio.svg" alt="Icono Habitaciones" loading="lazy">
          <p><?php echo $propiedad->getHabitaciones() ?></p>
        </li>
      </ul>
      <p><?php echo $propiedad->getDescripcion() ?></p>
    </div>
  </main>

<?php 
  incluirTemplate('footer');
?>