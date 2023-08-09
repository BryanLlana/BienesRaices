<?php 
  require '../includes/app.php';
  use App\Propiedad;

  //* VERIFICAR AUTENTICACION
  if (!estaAutenticado()) {
    header('Location: /bienesraices/login.php');
  }

  //* IMPLEMENTAR UN METODO PARA OBTENER PROPIEDADES
  $propiedades = Propiedad::all(); 

  //* MOSTRAR MENSAJE CONDICIONAL
  $resultado = $_GET["resultado"] ?? null;

  //* ELIMINAR PROPIEDAD
  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $idPropiedad = filter_var($_POST['id'], FILTER_VALIDATE_INT);

    if ($idPropiedad) {
      //* ELIMINAR ARCHIVO IMAGEN
      $queryObtenerPropiedad = "SELECT imagen FROM propiedades WHERE id=$idPropiedad";
      $resultadoPropiedad = mysqli_query($db, $queryObtenerPropiedad);
      $propiedad = mysqli_fetch_assoc($resultadoPropiedad);
      unlink('../imagenes/' . $propiedad['imagen']);

      $queryEliminarPropiedad = "DELETE FROM propiedades WHERE id=$idPropiedad";
      $resultadoPropiedadEliminado = mysqli_query($db, $queryEliminarPropiedad);

      if ($resultadoPropiedadEliminado) {
        header ('Location: /bienesraices/admin/index.php?resultado=3');
      }
    }
  }

  //* IMPLEMENTAR PLANTILLA
  $inicio = true;
  incluirTemplate('header');
?>

    <main class="contenedor seccion">
        <h1>Administrador de Bienes Raices</h1>

        <?php if (intval($resultado) === 1) { ?>
          <p class="alerta exito">Propiedad Creada Correctamente</p>
        <?php } else if (intval($resultado) === 2) { ?>
          <p class="alerta exito">Propiedad Modificada Correctamente</p>
        <?php } else if (intval($resultado) === 3) { ?>
          <p class="alerta exito">Propiedad Eliminada Correctamente</p>
        <?php } ?>

        <a href="/bienesraices/admin/propiedades/crear.php" class="btn-verde">Nueva Propiedad</a>

        <table class="propiedades">
          <thead>
            <tr>
              <th>ID</th>
              <th>Nombre</th>
              <th>Imagen</th>
              <th>Precio</th>
              <th>Acciones</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach($propiedades as $propiedad) { ?>
              <tr>
                <td><?php echo $propiedad->getId() ?></td>
                <td><?php echo $propiedad->getNombre() ?></td>
                <td><img class="imagen-tabla" src="/bienesraices/imagenes/<?php echo $propiedad->getImagen() ?>" alt="Imagen <?php echo $propiedad->getNombre() ?>"></td>
                <td>$<?php echo $propiedad->getPrecio() ?></td>
                <td>
                  <a href="/bienesraices/admin/propiedades/actualizar.php?id=<?php echo $propiedad->getId() ?>" class="btn-amarillo-block">Modificar</a>
                  <form method="post" class="w-100">
                    <input type="hidden" name="id" value="<?php echo $propiedad->getId() ?>">
                    <input type="submit" class="btn-rojo-block" value="Eliminar"/>
                  </form>
                </td>
              </tr>
            <?php } ?>
          </tbody>
        </table>
    </main>

<?php 
  //* CERRAR LA CONEXION
  mysqli_close($db);

  incluirTemplate('footer');
?>