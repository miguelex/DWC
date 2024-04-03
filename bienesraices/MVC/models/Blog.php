<?php 

namespace Model;

class Blog  extends ActiveRecord{

    protected static $tabla = 'blog';
    protected static $columnasDB = ['id', 'titulo', 'texto', 'imagen', 'vendedorId', 'escrito'];

    public $id;
    public $titulo;
    public $texto;
    public $imagen;
    public $vendedorId;
    public $escrito;

    public function __construct($args = []){
        $this->id = $args['id'] ?? null;
        $this->titulo = $args['titulo'] ?? null;
        $this->texto = $args['texto'] ?? '';
        $this->imagen = $args['imagen'] ?? '';
        $this->vendedorId = $args['vendedorId'] ?? '';
        $this->escrito = date('Y-m-d');
    }

    public function validar(){
        if(!$this->titulo){
            self::$errores[] = "Debes añadir un titulo";
        }

        if(!$this->texto){
            self::$errores[] = "Debes añadir una entrada";
        }

        if(strlen($this->texto) < 100){
            self::$errores[] = "Debes añadir una entrada y debe tener al menos 100 caracteres";
        }

        if(!$this->vendedorId){
            self::$errores[] = "Debes añadir un vendedor";
        }

        if(!$this->imagen){
            self::$errores[] = "La imagen de la propiedad es obligatoria";
        }

        return self::$errores;
    
    }
}