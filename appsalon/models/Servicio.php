<?php 

namespace Model;

class Servicio extends ActiveRecord {

    // Base de datos
    protected static $tabla = 'servicios';
    protected static $columnasDB = ['id', 'nombre', 'precio'];

    public $id;
    public $nombre;
    public $precio;

    public function __construct($args = []) {
        $this->id = $args['id'] ?? null;
        $this->nombre = $args['nombre'] ?? '';
        $this->precio = $args['precio'] ?? 0;
    }

    public function validar() {
        if (!$this->nombre) {
            self::$alertas['error'][] = 'El nombre del servicio es obligatorio';
        }
        if (!$this->precio) {
            self::$alertas['error'][] = 'El precio del servicio es obligatorio';
        }
        if (!is_numeric($this->precio) || $this->precio <= 0) {
            self::$alertas['error'][] = 'El precio debe ser un número positivo';
        }
        return self::$alertas;
    }
}