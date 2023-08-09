<?php 
  require '../includes/app.php';
  //* VERIFICAR AUTENTICACION
  if (!estaAutenticado()) {
    header('Location: /bienesraices/login.php');
  }

  //* IMPORTAR CONEXION
  $db = conectarDB();

  //* QUERY
  $queryObtenerPropiedades = "SELECT * FROM propiedades";

  //* CONSULTAR LA BD
  $resultadoPropiedades = mysqli_query($db, $queryObtenerPropiedades);

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
            <?php while($propiedad = mysqli_fetch_assoc($resultadoPropiedades)) { ?>
              <tr>
                <td><?php echo $propiedad["id"] ?></td>
                <td><?php echo $propiedad["nombre"] ?></td>
                <td><img class="imagen-tabla" src="/bienesraices/imagenes/<?php echo $propiedad["imagen"] ?>" alt="Imagen <?php echo $propiedad["nombre"] ?>"></td>
                <td>$<?php echo $propiedad["precio"] ?></td>
                <td>
                  <a href="/bienesraices/admin/propiedades/actualizar.php?id=<?php echo $propiedad["id"] ?>" class="btn-amarillo-block">Modificar</a>
                  <form method="post" class="w-100">
                    <input type="hidden" name="id" value="<?php echo $propiedad["id"] ?>">
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