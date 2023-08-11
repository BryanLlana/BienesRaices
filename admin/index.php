<?php
require '../includes/app.php';

use App\Propiedad;
use App\Vendedor;

//* VERIFICAR AUTENTICACION
if (!estaAutenticado()) {
  header('Location: /bienesraices/login.php');
}

//* IMPLEMENTAR UN METODO PARA OBTENER PROPIEDADES
$propiedades = Propiedad::all();

//* OBTENER VENDEDORES
$vendedores = Vendedor::all();

//* MOSTRAR MENSAJE CONDICIONAL
$resultado = $_GET["resultado"] ?? null;

//* ELIMINAR PROPIEDAD
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $idPropiedad = filter_var($_POST['idPropiedad'], FILTER_VALIDATE_INT);
  $idVendedor = filter_var($_POST['idVendedor'], FILTER_VALIDATE_INT);

  if ($idPropiedad) {
    $propiedad = Propiedad::find($idPropiedad);
    $resultadoPropiedadEliminado = $propiedad->eliminar();
  
    if ($resultadoPropiedadEliminado) {
      header('Location: /bienesraices/admin/index.php?resultado=3');
    }
  }

  if ($idVendedor) {
    $vendedor = Vendedor::find($idVendedor);
    $resultadoVendedorEliminado = $vendedor->eliminar();

    if ($resultadoVendedorEliminado) {
      header('Location: /bienesraices/admin/index.php?resultado=3');
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
    <p class="alerta exito">Creado Correctamente</p>
  <?php } else if (intval($resultado) === 2) { ?>
    <p class="alerta exito">Modificado Correctamente</p>
  <?php } else if (intval($resultado) === 3) { ?>
    <p class="alerta exito">Eliminado Correctamente</p>
  <?php } ?>

  <a href="/bienesraices/admin/propiedades/crear.php" class="btn-verde">Nueva Propiedad</a>
  <a href="/bienesraices/admin/vendedores/crear.php" class="btn-amarillo">Nuevo(a) Vendedor</a>

  <h2>Propiedades</h2>

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
      <?php foreach ($propiedades as $propiedad) { ?>
        <tr>
          <td><?php echo $propiedad->getId() ?></td>
          <td><?php echo $propiedad->getNombre() ?></td>
          <td><img class="imagen-tabla" src="/bienesraices/imagenes/<?php echo $propiedad->getImagen() ?>" alt="Imagen <?php echo $propiedad->getNombre() ?>"></td>
          <td>$<?php echo $propiedad->getPrecio() ?></td>
          <td>
            <a href="/bienesraices/admin/propiedades/actualizar.php?id=<?php echo $propiedad->getId() ?>" class="btn-amarillo-block">Modificar</a>
            <form method="post" class="w-100">
              <input type="hidden" name="idPropiedad" value="<?php echo $propiedad->getId() ?>">
              <input type="submit" class="btn-rojo-block" value="Eliminar" />
            </form>
          </td>
        </tr>
      <?php } ?>
    </tbody>
  </table>

  <h2>Vendedores</h2>

  <table class="propiedades">
    <thead>
      <tr>
        <th>ID</th>
        <th>Nombre</th>
        <th>Celular</th>
        <th>Acciones</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($vendedores as $vendedor) { ?>
        <tr>
          <td><?php echo $vendedor->getId() ?></td>
          <td><?php echo $vendedor->getNombre() . " " . $vendedor->getApellido() ?></td>
          <td><?php echo $vendedor->getCelular() ?></td>
          <td>
            <a href="/bienesraices/admin/vendedores/actualizar.php?id=<?php echo $vendedor->getId() ?>" class="btn-amarillo-block">Modificar</a>
            <form method="post" class="w-100">
              <input type="hidden" name="idVendedor" value="<?php echo $vendedor->getId() ?>">
              <input type="submit" class="btn-rojo-block" value="Eliminar" />
            </form>
          </td>
        </tr>
      <?php } ?>
    </tbody>
  </table>
</main>

<?php
incluirTemplate('footer');
?>