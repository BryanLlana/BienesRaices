<?php
//* BASE DE DATOS
require './includes/app.php';
$db = conectarDB();

//* INICIAR SESIÓN
$errores = [];
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $email = mysqli_real_escape_string($db, filter_var($_POST['email'], FILTER_VALIDATE_EMAIL));
  $password = mysqli_real_escape_string($db, $_POST['password']);

  if (!$email) {
    $errores[] = "El email es obligatorio";
  }

  if (!$password) {
    $errores[] = "El password es obligatorio";
  }

  if (empty($errores)) {
    //* REVISAR SI EL USUARIO EXISTE
    $queryUsuarioExiste = "SELECT * FROM usuarios WHERE email='$email'";
    $resultadoUsuarioExiste = mysqli_query($db, $queryUsuarioExiste);

    if ($resultadoUsuarioExiste->num_rows) {
      //* REVISAR SI EL PASSWORD ES CORRECTO
      $usuario = mysqli_fetch_assoc($resultadoUsuarioExiste);
      $auth = password_verify($password, $usuario['password']);

      if ($auth) {
        //* USUARIO AUTENTICADO
        session_start();
        $_SESSION['usuario'] = $usuario['email'];
        $_SESSION['login'] = true;

        header('Location: /bienesraices/admin/index.php');
      } else {
        $errores[] = "Password incorrecto";
      }
    } else {
      $errores[] = "El usuario no existe";
    }
  }
}

//* IMPLEMENTAR PLANTILLA
$inicio = true;
incluirTemplate('header');
?>

<main class="contenedor seccion contenido-centrado">
  <h1>Iniciar Sesión</h1>

  <?php forEach($errores as $error) { ?>
    <div class="alerta error">
      <?php echo $error ?>
    </div>
  <?php } ?>

  <form method="post" class="formulario">
    <fieldset>
      <legend>Email y Password</legend>

      <label for="email">E-mail</label>
      <input type="email" name="email" id="email" placeholder="Ejm: bryan@gmail.com">

      <label for="password">Password</label>
      <input type="password" name="password" id="password" placeholder="Ejm: *********">
    </fieldset>

    <input type="submit" value="Iniciar Sesión" class="btn-verde">
  </form>
</main>

<?php
incluirTemplate('footer');
?>