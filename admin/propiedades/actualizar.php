<?php
require '../../includes/app.php';

use App\Propiedad;
use Intervention\Image\ImageManagerStatic as Image;

//* VERIFICAR AUTENTICACION
if (!estaAutenticado()) {
  header('Location: /bienesraices/login.php');
}

//* SANITIZAR Y VALIDAR ID
$idPropiedad = filter_var($_GET["id"], FILTER_VALIDATE_INT);

if (!$idPropiedad) {
  header('Location: /bienesraices/admin/index.php');
}

//* OBTENER PROPIEDAD PARA ACTUALIZAR
$propiedad = Propiedad::find($idPropiedad);

//* CONSULTAR VENDEDORES
$queryObtenerVendedores = "SELECT * FROM vendedores";
$resultadoVendedores = mysqli_query($db, $queryObtenerVendedores);

$errores = Propiedad::getErrores();

//* ENVIAR FORMULARIO
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $propiedad->sincronizar($_POST);
  $errores = $propiedad->validar();

  //* GENERAR UN NOMBRE UNICO
  $nombreImagen = md5(uniqid(rand(), true)) . ".jpg";

  if ($_FILES['imagen']['tmp_name']) {
    //* REALIZA UN RESIZE A LA IMAGEN CON INTERVENTION
    $image = Image::make($_FILES['imagen']['tmp_name'])->fit(800, 600);
    //* SETEAR LA IMAGEN
    $propiedad->setImagen($nombreImagen);
  }

  if (empty($errores)) {
    //* ALMACENAR IMAGEN
    if (isset($image)) {
      $image->save(__DIR__ . '/../../imagenes/' . $nombreImagen);
    }

    $resultado = $propiedad->guardar();

    if ($resultado) {
      //* REDIRECCIONAR 
      header('Location: /bienesraices/admin/index.php?resultado=2');
    }
  }
}

//* IMPLEMENTAR PLANTILLA
$inicio = true;
incluirTemplate('header');
?>

<main class="contenedor seccion">
  <h1>Actualizar Propiedad</h1>

  <a href="/bienesraices/admin/index.php" class="btn-verde">Volver</a>

  <?php foreach ($errores as $error) { ?>
    <div class="alerta error">
      <?php echo $error ?>
    </div>
  <?php } ?>

  <form class="formulario" method="post" enctype="multipart/form-data">
    <fieldset>
      <legend>Información General</legend>

      <label for="nombre">Título:</label>
      <input type="text" id="nombre" name="nombre" placeholder="Ejm: Propiedad de Lujo" value="<?php echo htmlspecialchars($propiedad->getNombre()) ?>">

      <label for="precio">Precio:</label>
      <input type="number" id="precio" name="precio" placeholder="Ejm: 3.000.000" value=<?php echo htmlspecialchars($propiedad->getPrecio()); ?>>

      <label for="imagen">Imagen:</label>
      <input type="file" id="imagen" name="imagen" accept="image/jpeg, image/png">

      <?php if ($propiedad->getImagen()) { ?>
        <img src="/bienesraices/imagenes/<?php echo $propiedad->getImagen() ?>" class="imagen-small" alt="Imagen <?php echo $propiedad->getNombre() ?>">
      <?php } ?>

      <label for="descripcion">Descripcion:</label>
      <textarea id="descripcion" name="descripcion"><?php echo htmlspecialchars($propiedad->getDescripcion()); ?></textarea>
    </fieldset>

    <fieldset>
      <legend>Información Propiedad</legend>

      <label for="habitaciones">Habitaciones:</label>
      <input type="number" id="habitaciones" name="habitaciones" placeholder="Ej: 3" min="1" max="9" value=<?php echo htmlspecialchars($propiedad->getHabitaciones()); ?>>

      <label for="wc">Baños:</label>
      <input type="number" id="wc" name="wc" placeholder="Ej: 3" min="1" max="9" value=<?php echo htmlspecialchars($propiedad->getWc()); ?>>

      <label for="estacionamiento">Estacionamiento:</label>
      <input type="number" id="estacionamiento" name="estacionamiento" placeholder="Ej: 3" min="1" max="9" value=<?php echo htmlspecialchars($propiedad->getEstacionamiento()); ?>>
    </fieldset>

    <fieldset>
      <legend>Vendedor</legend>

      <select name="vendedorId">
        <option value="" disabled selected>--Seleccione--</option>
        <?php while ($vendedor = mysqli_fetch_assoc($resultadoVendedores)) { ?>
          <option <?php echo $vendedor["id"] === htmlspecialchars($propiedad->getVendedorId()) ? 'selected' : '' ?> value=<?php echo $vendedor["id"] ?>><?php echo $vendedor["nombre"] . ' ' . $vendedor["apellido"] ?></option>
        <?php } ?>
      </select>
    </fieldset>

    <input type="submit" value="Actualizar Propiedad" class="btn-verde">
  </form>
</main>

<?php
incluirTemplate('footer');
?>