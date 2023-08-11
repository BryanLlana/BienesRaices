<?php
require '../../includes/app.php';
use App\Vendedor;

//* VERIFICAR AUTENTICACIÓN
if (!estaAutenticado()) {
  header('Location: /bienesraices/login.php');
}

//* VALIDAR QUE SEA UN ID VALIDO
$id = filter_var($_GET['id'], FILTER_VALIDATE_INT);

if (!$id) {
  header('Location: /bienesraices/admin/index.php');
}

//* OBTENER ARREGLO DE VENDEDOR
$vendedor = Vendedor::find($id);

//* ARREGLO PARA OBTENER ERRORES
$errores = Vendedor::getErrores();

//* METODO POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  //* ASIGNAR VALORES 
  $vendedor->sincronizar($_POST);
  $errores = $vendedor->validar();

  if (empty($errores)) {
    $resultado = $vendedor->guardar();

    if ($resultado) {
      header('Location: /bienesraices/admin/index.php?resultado=2');
    }
  }
}

incluirTemplate('header');
?>

<main class="contenedor seccion">
  <h1>Actualizar Vendedor(a)</h1>

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

    <input type="submit" value="Actualizar Vendedor" class="btn-verde">
  </form>
</main>

<?php
incluirTemplate('footer');
?>