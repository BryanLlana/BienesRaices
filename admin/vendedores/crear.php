<?php
require '../../includes/app.php';

use App\Vendedor;

//* VERIFICAR AUTENTICACIÓN
if (!estaAutenticado()) {
  header('Location: /bienesraices/login.php');
}

$vendedor = new Vendedor();

//* ARREGLO PARA OBTENER ERRORES
$errores = Vendedor::getErrores();

//* METODO POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $vendedor = new Vendedor($_POST);
  $errores = $vendedor->validar();

  if (empty($errores)) {
    $resultado = $vendedor->guardar();

    if ($resultado) {
      //* REDIRECCIONAR 
      header('Location: /bienesraices/admin/index.php?resultado=1');
    }
  }
}

incluirTemplate('header');
?>

<main class="contenedor seccion">
  <h1>Crear Vendedor(a)</h1>

  <a href="/bienesraices/admin/index.php" class="btn-verde">Volver</a>

  <?php foreach ($errores as $error) { ?>
    <div class="alerta error">
      <?php echo $error ?>
    </div>
  <?php } ?>

  <form class="formulario" method="post" enctype="multipart/form-data">
    <fieldset>
      <legend>Información General</legend>

      <label for="nombre">Nombre:</label>
      <input type="text" id="nombre" name="nombre" placeholder="Ejm: Juan Manolo" value="<?php echo htmlspecialchars($vendedor->getNombre()) ?>">

      <label for="apellido">Apellidos:</label>
      <input type="text" id="apellido" name="apellido" placeholder="Ejm: Tiburcio Marin" value="<?php echo htmlspecialchars($vendedor->getApellido()) ?>">

      <label for="celular">Celular:</label>
      <input type="tel" id="celular" name="celular" placeholder="Ejm: 123456789" value="<?php echo htmlspecialchars($vendedor->getCelular()) ?>">
    </fieldset>

    <input type="submit" value="Crear Vendedor" class="btn-verde">
  </form>
</main>

<?php
incluirTemplate('footer');
?>