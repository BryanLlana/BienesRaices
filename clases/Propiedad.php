<?php

namespace App;

class Propiedad
{
  //* BASE DE DATOS
  private static $db;
  private static $columnasDB = ['id', 'nombre', 'precio', 'imagen', 'descripcion', 'habitaciones', 'wc', 'estacionamiento', 'creado', 'vendedorId'];

  //* ERRORES
  private static $errores = [];

  private $id;
  private $nombre;
  private $precio;
  private $imagen;
  private $descripcion;
  private $habitaciones;
  private $wc;
  private $estacionamiento;
  private $creado;
  private $vendedorId;

  public function __construct($args = [])
  {
    $this->nombre = $args['nombre'] ?? '';
    $this->precio = $args['precio'] ?? '';
    $this->imagen = $args['imagen'] ?? '';
    $this->descripcion = $args['descripcion'] ?? '';
    $this->habitaciones = $args['habitaciones'] ?? '';
    $this->wc = $args['wc'] ?? '';
    $this->estacionamiento = $args['estacionamiento'] ?? '';
    $this->creado = date('Y/m/d');
    $this->vendedorId = $args['vendedorId'] ?? '';
  }

  public function guardar()
  {
    //* SANITIZAR DATOS
    $atributos = $this->sanitizarAtributos();
    $campos = join(', ', array_keys($atributos));
    $valores = join("', '", array_values($atributos));

    //* INSERTAR EN BD
    $query = "INSERT INTO propiedades ($campos) VALUES ('$valores')";
    $resultado = self::$db->query($query);
    return $resultado;
  }

  public function atributos()
  {
    $atributos = [];
    foreach (self::$columnasDB as $columna) {
      if ($columna === 'id') {
        continue;
      }
      $atributos[$columna] = $this->$columna;
    }

    return $atributos;
  }

  public function sanitizarAtributos()
  {
    $atributos = $this->atributos();
    $sanitizados = [];

    foreach ($atributos as $key => $value) {
      $sanitizados[$key] = self::$db->escape_string($value);
    }

    return $sanitizados;
  }

  //* SUBIDA DE ARCHIVOS
  public function setImagen($imagen) {
    if ($imagen) {
      $this->imagen = $imagen;
    }
  }

  public static function getErrores()
  {
    return self::$errores;
  }

  public function validar(){
    //* VALIDAR FORMULARIO
    if (!$this->nombre) {
      array_push(self::$errores, "Debes añadir un título");
    }

    if (!$this->precio) {
      array_push(self::$errores, "Debes añadir un precio");
    }

    if (!$this->descripcion) {
      array_push(self::$errores, "Debes añadir una descripción");
    }

    if (!$this->habitaciones || !$this->wc || !$this->estacionamiento) {
      array_push(self::$errores, "Debes añadir los tres campos de habitaciones, wc y estacionamiento");
    }

    if (!$this->vendedorId) {
      array_push(self::$errores, "Selecciona un vendedor");
    }

    if (!$this->imagen) {
      array_push(self::$errores, "Suba una imagen");
    }

    return self::$errores;
  }

  //* DEFINIR LA CONEXION BD
  public static function setDB($database)
  {
    self::$db = $database;
  }

  //* GETTER AND SETTER
  public function getNombre() {
    return $this->nombre;
  }

  public function getPrecio() {
    return $this->precio;
  }

  public function getDescripcion() {
    return $this->descripcion;
  }

  public function getImagen() {
    return $this->imagen;
  }

  public function getHabitaciones() {
    return $this->habitaciones;
  }

  public function getWc() {
    return $this->wc;
  }

  public function getEstacionamiento() {
    return $this->estacionamiento;
  }

  public function getVendedorId() {
    return $this->vendedorId;
  }
  
  public function getId() {
    return $this->id;
  }
}