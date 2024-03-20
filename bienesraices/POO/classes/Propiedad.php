<?php 

namespace App;

class Propiedad {

    // base de datos

    protected static $db; 
    public $id;
    public $titulo;
    public $precio;
    public $imagen;
    public $descripcion;
    public $habitaciones;
    public $wc;
    public $estacionamiento;
    public $creado;
    public $vendedorId;

    public function __construct($args = []){
        $this->id = $args['id'] ?? null;
        $this->titulo = $args['titulo'] ?? '';
        $this->precio = $args['precio'] ?? '';
        $this->imagen = $args['imagen'] ?? '';
        $this->descripcion = $args['descripcion'] ?? '';
        $this->habitaciones = $args['habitaciones'] ?? '';
        $this->wc = $args['wc'] ?? '';
        $this->estacionamiento = $args['estacionamiento'] ?? '';
        $this->creado = date('Y-m-d');
        $this->vendedorId = $args['vendedorId'] ?? '';
    }

    public function guardar(){
        // Insertar en BD
        $query = "INSERT INTO propiedades (titulo, precio, imagen, descripcion, habitaciones, wc, estacionamientos, creado, vendedores_id) 
                VALUES ('$this->titulo', '$this->precio', '$this->imagen', '$this->descripcion', '$this->habitaciones', '$this->wc', 
                '$this->estacionamiento', '$this->creado', '$this->vendedorId')";

        $resultado = self::$db->query($query);

        debuguear($resultado);
    }

    // Definir la conexión a la base de datos

    public static function setDB($dataBase){
        self::$db = $dataBase;
    }
}