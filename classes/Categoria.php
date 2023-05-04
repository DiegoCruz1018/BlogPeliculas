<?php 
    namespace App;

    class Categoria extends ActiveRecord{

        protected static $tabla = 'categorias';
        protected static $columnasDB = ['id', 'nombre', 'creado'];

        public $id;
        public $nombre;
        public $creado;

        public function __construct($args = [])
        {
            $this->id = $args['id'] ?? null;
            $this->nombre = $args['nombre'] ?? '';
            $this->creado = date('Y-m-d');
        }

        public function validar(){
            if(!$this->nombre){
                self::$errores[] = "Debes añadir un nombre";
            }

            return self::$errores;
        }
    }