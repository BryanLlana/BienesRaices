<?php

namespace App;

class Vendedor extends ActiveRecord
{
  protected static $tabla = 'vendedores';
  protected static $columnasDB = ['id', 'nombre', 'apellido', 'celular'];

  protected $id;
  protected $nombre;
  protected $apellido;
  protected $celular;

  public function __construct($args = [])
  {
    $this->nombre = $args['nombre'] ?? '';
    $this->apellido = $args['apellido'] ?? '';
    $this->celular = $args['celular'] ?? '';
  }

  public function validar()
  {
    //* VALIDAR FORMULARIO
    if (!$this->nombre) {
      array_push(self::$errores, "Debes añadir un nombre");
    }

    if (!$this->apellido) {
      array_push(self::$errores, "Debes añadir un apellido");
    }

    if (!preg_match('/[0-9]{9}/', $this->celular)) {
      array_push(self::$errores, "Agregue un número de celular válido");
    }

    return self::$errores;
  }

  //* GETTER AND SETTER
  public function getNombre()
  {
    return $this->nombre;
  }

  public function getApellido()
  {
    return $this->apellido;
  }

  public function getCelular()
  {
    return $this->celular;
  }

  public function getId()
  {
    return $this->id;
  }
}
