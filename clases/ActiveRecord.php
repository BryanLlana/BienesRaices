<?php

namespace App;

class ActiveRecord
{
  //* BASE DE DATOS
  protected static $db;
  protected static $columnasDB = [];
  protected static $tabla = '';
  
  //* ERRORES
  protected static $errores = [];
  
  //* DEFINIR LA CONEXION BD
  public static function setDB($database)
  {
    self::$db = $database;
  }

  public function validar() {
    static::$errores = [];
    return static::$errores;
  }
  
  public static function getErrores()
  {
    return static::$errores;
  }
  
  public function guardar()
  {
    if (isset($this->id)) {
      return $this->actualizar();
    } else {
      return $this->crear();
    }
  }

  public function crear()
  {
    //* SANITIZAR DATOS
    $atributos = $this->sanitizarAtributos();
    $campos = join(', ', array_keys($atributos));
    $valores = join("', '", array_values($atributos));

    //* INSERTAR EN BD
    $query = "INSERT INTO ". static::$tabla ." ($campos) VALUES ('$valores')";
    $resultado = self::$db->query($query);
    return $resultado;
  }

  public function actualizar()
  {
    //* SANITIZAR DATOS
    $atributos = $this->sanitizarAtributos();
    $valores = [];
    foreach ($atributos as $key => $value) {
      $valores[] = "$key='$value'";
    }

    $camposValores = join(', ', $valores);
    $query = "UPDATE ". static::$tabla ." SET $camposValores WHERE id='" . self::$db->escape_string($this->id) . "'";
    $resultado = self::$db->query($query);
    return $resultado;
  }

  public function eliminar()
  {
    $query = "DELETE FROM ". static::$tabla ." WHERE id ='" . self::$db->escape_string($this->id) . "'";
    $resultado = self::$db->query($query);

    if ($resultado) {
      $this->borrarImagen();
    }

    return $resultado;
  }

  public function atributos()
  {
    $atributos = [];
    foreach (static::$columnasDB as $columna) {
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
  public function setImagen($imagen)
  {
    //* ELIMINAR LA IMAGEN PREVIA
    if (isset($this->id)) {
      $this->borrarImagen();
    }

    if ($imagen) {
      $this->imagen = $imagen;
    }
  }

  public function borrarImagen()
  {
    //* ELIMINAR LA IMAGEN PREVIA
    $existeArchivo = file_exists(__DIR__ . '/../imagenes/' . $this->imagen);
    if ($existeArchivo) {
      unlink(__DIR__ . '/../imagenes/' . $this->imagen);
    }
  }


  //* LISTAR
  public static function all()
  {
    $query = "SELECT * FROM " . static::$tabla;
    $resultado = self::consultarSQL($query);

    return $resultado;
  }

  //* LISTAR CON LIMITE
  public static function get($cantidad)
  {
    $query = "SELECT * FROM " . static::$tabla . " LIMIT " . $cantidad;
    $resultado = self::consultarSQL($query);

    return $resultado;
  }

  public static function find($id)
  {
    $query = "SELECT * FROM ". static::$tabla ." WHERE id = $id";
    $resultado = self::consultarSQL($query);
    return array_shift($resultado);
  }

  public static function consultarSQL($query)
  {
    //* CONSULTAR LA BD
    $resultado = self::$db->query($query);

    //* ITERAR LOS RESULTADOS
    $array = [];
    while ($registro = $resultado->fetch_assoc()) {
      $array[] = static::crearObjeto($registro);
    }

    //* LIBERAR LA MEMORIA
    $resultado->free();

    return $array;
  }

  protected static function crearObjeto($registro)
  {
    $objeto = new static;

    foreach ($registro as $key => $value) {
      if (property_exists($objeto, $key)) {
        $objeto->$key = $value;
      }
    }

    return $objeto;
  }

  public function sincronizar($args = [])
  {
    foreach ($args as $key => $value) {
      if (property_exists($this, $key) && !is_null($value)) {
        $this->$key = $value;
      }
    }
  }

}
