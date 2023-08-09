<?php 
require __DIR__ . '/funciones.php';
require __DIR__ . '/config/database.php';
require __DIR__ . '/../vendor/autoload.php';

//* CONECTARNOS A LA DB
$db = conectarDB();

use App\Propiedad;

Propiedad::setDB($db);