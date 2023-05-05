<?php 
    namespace App;

    class Contacto extends ActiveRecord{
        protected static $tabla = 'contacto';
        protected static $columnasDB = ['id', 'nombre', 'apellido', 'correo',
        'telefono', 'mensaje', 'enviado'];

        public $id;
        public $nombre;
        public $apellido;
        public $correo;
        public $telefono;
        public $mensaje;
        public $enviado;

        public function __construct($args = [])
        {
            $this->id = $args['id'] ?? null;
            $this->nombre = $args['nombre'] ?? '';
            $this->apellido = $args['apellido'] ?? '';
            $this->correo = $args['correo'] ?? '';
            $this->telefono = $args['telefono'] ?? '';
            $this->mensaje = $args['mensaje'] ?? '';
            $this->enviado = date('Y-m-d');
        }

        public function validar(){
            if(!$this->nombre){
                self::$errores[] = 'Debes añadir un nombre';
            }

            if(!$this->apellido){
                self::$errores[] = 'Debes añadir un apellido';
            }

            if(!$this->correo){
                self::$errores[] = 'Debes añadir un correo';
            }

            if(!$this->telefono){
                self::$errores[] = 'Debes añadir un telefono';
            }

            if(!$this->mensaje){
                self::$errores[] = 'Debes añadir un mensaje';
            }

            return self::$errores;
        }
    }