<?php 

namespace App;

class Vendedor extends ActiveRecord{
   
    protected static $tabla = 'vendedores';
    protected static $columnasDB = ['id', 'nombre', 'apellidos', 'telefono'];

    public $id;

    public $nombre;

    public $apellidos;

    public $telefono;

    public function __construct($args = []){
        $this->id = $args['id'] ?? null;
        $this->nombre = $args['nombre'] ?? '';
        $this->apellidos = $args['apellidos'] ?? '';
        $this->telefono = $args['telefono'] ?? '';
    }

    public function validar(){
        if(!$this->nombre){
            self::$errores[] = "El nombre es obligatorio";
        }

        if(!$this->apellidos){
            self::$errores[] = "Los apellidos son obligatorios";
        }

        if(!$this->telefono){
            self::$errores[] = "El teléfono es obligatorio";
        }

        if (!preg_match('/[0-9]{10}/', $this->telefono)) {
            self::$errores[] = "Formato de teléfono no válido";
        }

        return self::$errores;
    }
}