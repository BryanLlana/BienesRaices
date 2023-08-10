<?php

namespace App;

class Propiedad extends ActiveRecord
{
  protected static $tabla = 'propiedades';
  protected static $columnasDB = ['id', 'nombre', 'precio', 'imagen', 'descripcion', 'habitaciones', 'wc', 'estacionamiento', 'creado', 'vendedorId'];

  protected $id;
  protected $nombre;
  protected $precio;
  protected $imagen;
  protected $descripcion;
  protected $habitaciones;
  protected $wc;
  protected $estacionamiento;
  protected $creado;
  protected $vendedorId;

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

  public function validar()
  {
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

  //* GETTER AND SETTER
  public function getNombre()
  {
    return $this->nombre;
  }

  public function getPrecio()
  {
    return $this->precio;
  }

  public function getDescripcion()
  {
    return $this->descripcion;
  }

  public function getImagen()
  {
    return $this->imagen;
  }

  public function getHabitaciones()
  {
    return $this->habitaciones;
  }

  public function getWc()
  {
    return $this->wc;
  }

  public function getEstacionamiento()
  {
    return $this->estacionamiento;
  }

  public function getVendedorId()
  {
    return $this->vendedorId;
  }

  public function getId()
  {
    return $this->id;
  }
}
