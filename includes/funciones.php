<?php
define('TEMPLATES_URL', __DIR__.'/templates');
define('FUNCIONES_URL', __DIR__.'/funciones.php');

function incluirTemplate(string $nombre, bool $inicio = false): void{
  include TEMPLATES_URL . "/$nombre.php";
}

function estaAutenticado(): bool{
  session_start();

  if ($_SESSION['login']) {
    return true;
  }

  return false;
}
