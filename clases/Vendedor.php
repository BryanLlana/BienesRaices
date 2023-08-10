<?php

namespace App;

class Vendedor extends ActiveRecord {
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