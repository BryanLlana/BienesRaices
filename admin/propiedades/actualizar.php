<?php
require '../../includes/app.php';
//* VERIFICAR AUTENTICACION
if (!estaAutenticado()) {
  header('Location: /bienesraices/login.php');
}

//* BASE DE DATOS
$db = conectarDB();

//* SANITIZAR Y VALIDAR ID
$idPropiedad = filter_var($_GET["id"], FILTER_VALIDATE_INT);

if (!$idPropiedad) {
  header('Location: /bienesraices/admin/index.php');
}

//* OBTENER PROPIEDAD PARA ACTUALIZAR
$queryObtenerPropiedad = "SELECT * FROM propiedades WHERE id = $idPropiedad";
$resultadoPropiedad = mysqli_query($db, $queryObtenerPropiedad);
$propiedad = mysqli_fetch_assoc($resultadoPropiedad);

//* CONSULTAR VENDEDORES
$queryObtenerVendedores = "SELECT * FROM vendedores";
$resultadoVendedores = mysqli_query($db, $queryObtenerVendedores);

$nombre = $propiedad["nombre"];
$precio = $propiedad["precio"];
$descripcion = $propiedad["descripcion"];
$habitaciones = $propiedad["habitaciones"];
$wc = $propiedad["wc"];
$estacionamiento = $propiedad["estacionamiento"];
$vendedorId = $propiedad["vendedorId"];
$imagenPropiedad = $propiedad["imagen"];

$errores = [];
//* ENVIAR FORMULARIO
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  //* SANITIZAR LOS DATOS CON MRES
  $nombre = mysqli_real_escape_string($db, $_POST['nombre']);
  $precio = mysqli_real_escape_string($db, $_POST['precio']);
  $descripcion = mysqli_real_escape_string($db, $_POST['descripcion']);
  $habitaciones = mysqli_real_escape_string($db, $_POST['habitaciones']);
  $wc = mysqli_real_escape_string($db, $_POST['wc']);
  $estacionamiento = mysqli_real_escape_string($db, $_POST['estacionamiento']);
  $vendedorId = mysqli_real_escape_string($db, $_POST['vendedorId']);
  $creado = date('Y/m/d');
  $imagen = $_FILES["imagen"];

  //* VALIDAR FORMULARIO
  if (!$nombre) {
    array_push($errores, "Debes añadir un título");
  }

  if (!$precio) {
    array_push($errores, "Debes añadir un precio");
  }

  if (!$descripcion) {
    array_push($errores, "Debes añadir una descripción");
  }

  if (!$habitaciones || !$wc || !$estacionamiento) {
    array_push($errores, "Debes añadir los tres campos de habitaciones, wc y estacionamiento");
  }

  if (!$vendedorId) {
    array_push($errores, "Selecciona un vendedor");
  }

  $medidaImagen = 2000 * 100;
  if ($imagen["size"] > $medidaImagen) {
    array_push($errores, "La imagen es muy pesada");
  }

  if (empty($errores)) {
    //* CREAR ARCHIVO DE IMAGENES 
    $carpetaImagenes = '../../imagenes/';

    if (!is_dir($carpetaImagenes)) {
      mkdir($carpetaImagenes);
    }

    $nombreImagen = '';

    //* EVALUAR SI SE SUBIÓ NUEVA IMAGEN
    if ($imagen['name']) {
      //* ELIMINAR IMAGEN PREVIA
      unlink($carpetaImagenes . $propiedad['imagen']);

      //* GENERAR UN NOMBRE UNICO
      $nombreImagen = md5(uniqid(rand(), true)) . ".jpg";
  
      //* SUBIR LA IMAGEN
      move_uploaded_file($imagen["tmp_name"], $carpetaImagenes . $nombreImagen);
    } else {
      $nombreImagen = $propiedad['imagen'];
    }


    //* CREAR CONSULTA
    $query = "UPDATE propiedades SET nombre='$nombre', precio='$precio', imagen='$nombreImagen', descripcion='$descripcion', habitaciones='$habitaciones', wc='$wc', estacionamiento='$estacionamiento', vendedorId='$vendedorId' WHERE id='$idPropiedad'";

    //* GUARDAR EN BD
    $resultado = mysqli_query($db, $query);

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
      <input type="text" id="nombre" name="nombre" placeholder="Ejm: Propiedad de Lujo" value="<?php echo $nombre ?>">

      <label for="precio">Precio:</label>
      <input type="number" id="precio" name="precio" placeholder="Ejm: 3.000.000" value=<?php echo $precio ?>>

      <label for="imagen">Imagen:</label>
      <input type="file" id="imagen" name="imagen" accept="image/jpeg, image/png">

      <img class="imagen-small" src="/bienesraices/imagenes/<?php echo $imagenPropiedad ?>" alt="Imagen <?php echo $nombre ?>">

      <label for="descripcion">Descripcion:</label>
      <textarea id="descripcion" name="descripcion"><?php echo $descripcion ?></textarea>
    </fieldset>

    <fieldset>
      <legend>Información Propiedad</legend>

      <label for="habitaciones">Habitaciones:</label>
      <input type="number" id="habitaciones" name="habitaciones" placeholder="Ej: 3" min="1" max="9" value=<?php echo $habitaciones ?>>

      <label for="wc">Baños:</label>
      <input type="number" id="wc" name="wc" placeholder="Ej: 3" min="1" max="9" value=<?php echo $wc ?>>

      <label for="estacionamiento">Estacionamiento:</label>
      <input type="number" id="estacionamiento" name="estacionamiento" placeholder="Ej: 3" min="1" max="9" value=<?php echo $estacionamiento ?>>
    </fieldset>

    <fieldset>
      <legend>Vendedor</legend>

      <select name="vendedorId">
        <option value="" disabled selected>--Seleccione--</option>
        <?php while ($vendedor = mysqli_fetch_assoc($resultadoVendedores)) { ?>
          <option <?php echo $vendedor["id"] === $vendedorId ? 'selected' : '' ?> value=<?php echo $vendedor["id"] ?>><?php echo $vendedor["nombre"] . ' ' . $vendedor["apellido"] ?></option>
        <?php } ?>
      </select>
    </fieldset>

    <input type="submit" value="Actualizar Propiedad" class="btn-verde">
  </form>
</main>

<?php
incluirTemplate('footer');
?>