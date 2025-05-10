<?php 

namespace Model;

class Cita extends ActiveRecord {
    protected static $columnasDB = ['id', 'fecha', 'hora', 'usuarioId'];
    protected static $tabla = 'citas';

    public $id;
    public $fecha;
    public $hora;
    public $usuarioId;

    public function __construct($args = []) {
        $this->id = $args['id'] ?? null;
        $this->fecha = $args['fecha'] ?? '';
        $this->hora = $args['hora'] ?? '';
        $this->usuarioId = $args['usuarioId'] ?? '';
    }
}