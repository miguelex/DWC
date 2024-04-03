<?php 

namespace Model;

class Vendedor extends ActiveRecord{
   
    protected static $tabla = 'vendedores';
    protected static $columnasDB = ['id', 'nombre', 'apellidos', 'telefono', 'email', 'imagen'];

    public $id;

    public $nombre;

    public $apellidos;

    public $telefono;

    public $email;

    public $imagen;

    public function __construct($args = []){
        $this->id = $args['id'] ?? null;
        $this->nombre = $args['nombre'] ?? '';
        $this->apellidos = $args['apellidos'] ?? '';
        $this->telefono = $args['telefono'] ?? '';
        $this->email = $args['email'] ?? '';
        $this->imagen = $args['imagen'] ?? '';
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

        if (!preg_match('/[0-9]{9}/', $this->telefono)) {
            self::$errores[] = "Formato de teléfono no válido";
        }

        if(!$this->email){
            self::$errores[] = "El email es obligatorio";
        }

        if(!filter_var($this->email, FILTER_VALIDATE_EMAIL)){
            self::$errores[] = "Email no válido";
        }

        if(!$this->imagen){
            self::$errores[] = "La imagen del vendedor(a) es obligatoria";
        }

        return self::$errores;
    }
}