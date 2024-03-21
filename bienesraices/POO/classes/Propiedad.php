<?php 

namespace App;

class Propiedad {

    // base de datos

    protected static $db; 
    protected static $columnasDB = ['id', 'titulo', 'precio', 'imagen', 'descripcion', 'habitaciones', 'wc', 'estacionamientos', 'creado', 'vendedores_id'];
    
    //Errores

    protected static $errores = [];

    public $id;
    public $titulo;
    public $precio;
    public $imagen;
    public $descripcion;
    public $habitaciones;
    public $wc;
    public $estacionamientos;
    public $creado;
    public $vendedores_id;

    public function __construct($args = []){
        $this->id = $args['id'] ?? null;
        $this->titulo = $args['titulo'] ?? '';
        $this->precio = $args['precio'] ?? '';
        $this->imagen = $args['imagen'] ?? '';
        $this->descripcion = $args['descripcion'] ?? '';
        $this->habitaciones = $args['habitaciones'] ?? '';
        $this->wc = $args['wc'] ?? '';
        $this->estacionamientos = $args['estacionamiento'] ?? '';
        $this->creado = date('Y-m-d');
        $this->vendedores_id = $args['vendedorId'] ?? '';
    }

    // Definir la conexión a la base de datos

    public static function setDB($dataBase){
        self::$db = $dataBase;
    }

    public function guardar(){

        // Sanitizar los datos
        $atributos = $this->sanitizarAtributos();

        $string = join(', ', array_map(function($p){
            return "$p = '{$this->$p}'";
        }, array_keys($atributos)));
        
        // Insertar en BD
        $query = "INSERT INTO propiedades ( ";
        $query .= join(', ', array_keys($atributos));
        $query .= " ) VALUES (' ";
        $query .= join("', '", array_values($atributos));
        $query .= "' );";
        
        $resultado = self::$db->query($query);

        return $resultado;
    }

    public function atributos(){
        $atributos = [];
        foreach (self::$columnasDB as $columna) {
            if($columna === 'id') continue;
            $atributos[$columna] = $this->$columna;
        }
        return $atributos;
    }

    public function sanitizarAtributos(){
        $atributos = $this->atributos();
        $sanitizado = [];
        foreach ($atributos as $key => $value) {
            $sanitizado[$key] = self::$db->escape_string($value);
        }
        return $sanitizado;
    }

    //subir Imagen

    public function setImagen($imagen){
        // Eliminar la imagen previa
        /*if(!is_null($this->id)){
            $this->borrarImagen();
        }*/

        // Asignar al atributo de imagen el nombre de la imagen
        if($imagen){
            $this->imagen = $imagen;
        }
    }

    //Validación

    public static function getErrores(){
        return self::$errores;
    }

    public function validar(){
        if(!$this->titulo){
            self::$errores[] = "Debes añadir un titulo";
        }

        if(!$this->precio){
            self::$errores[] = "Debes añadir un precio";
        }

        if(strlen($this->descripcion) < 50){
            self::$errores[] = "Debes añadir una descripción y debe tener al menos 50 caracteres";
        }

        if(!$this->habitaciones){
            self::$errores[] = "Debes añadir un número de habitaciones";
        }

        if(!$this->wc){
            self::$errores[] = "Debes añadir un número de baños";
        }

        if(!$this->estacionamientos){
            self::$errores[] = "Debes añadir un número de estacionamientos";
        }

        if(!$this->vendedores_id){
            self::$errores[] = "Debes añadir un vendedor";
        }

        if(!$this->imagen){
            self::$errores[] = "La imagen es obligatoria";
        }

        return self::$errores;
    
    }

    // Listar todas las propeidades

    public static function all(){
        $query = "SELECT * FROM propiedades";
        $resultado = self::consultarSQL($query);

        return $resultado;
    }

    public static function consultarSQL ($query){

        // Consultar la base de datos
        $resultado = self::$db->query($query);

        // Iterar los resultados
        $array = [];

        while($registro = $resultado->fetch_assoc()){
            $array[] = self::crearObjeto($registro);
        }

        // Liberar la memoria
        $resultado->free();

        // Retornar los resultados  
        return $array;
    }

    protected static function crearObjeto($registro){
        $objeto = new self;

        foreach ($registro as $key => $value) {
            if(property_exists($objeto, $key)){
                $objeto->$key = $value;
            }
        }

        return $objeto;
    }
}