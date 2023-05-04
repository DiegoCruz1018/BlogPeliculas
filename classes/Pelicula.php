<?php

    namespace App;

    class Pelicula extends ActiveRecord{
        
        //Base de datos
        protected static $tabla = 'peliculas';
        protected static $columnasDB = ['id', 'titulo', 'imagen', 'director', 'protagonista', 
        'sipnosis', 'estreno', 'idCategoria', 'creado'];

        public $id;
        public $titulo;
        public $imagen;
        public $director;
        public $protagonista;
        public $sipnosis;
        public $estreno;
        public $idCategoria;
        public $creado;

        public function __construct($args = [])
        {
            $this->id = $args['id'] ?? null;
            $this->titulo = $args['titulo'] ?? '';
            $this->imagen = $args['imagen'] ?? '';
            $this->director = $args['director'] ?? '';
            $this->protagonista = $args['protagonista'] ?? '';
            $this->sipnosis = $args['sipnosis'] ?? '';
            $this->estreno = $args['estreno'] ?? '';
            $this->idCategoria = $args['idCategoria'] ?? '';
            $this->creado = date('Y-m-d');
        }

        public function validar(){
            if(!$this->titulo){
                self::$errores[] = "Debes añadir un titulo";
            }

            if(!$this->director){
                self::$errores[] = "Debes añadir un director";
            }

            if(!$this->protagonista){
                self::$errores[] = "Debes añadir un protagonista";
            }

            if(!$this->sipnosis){
                self::$errores[] = "Debes añadir una sipnosis";
            }

            if(!$this->estreno){
                self::$errores[] = "Debes añadir el año de estreno";
            }

            if(!$this->idCategoria){
                self::$errores[] = "Debes añadir una categoria";
            }

            if(!$this->imagen){
                self::$errores[] = "La imagen es obligatoria";
            }

            return self::$errores;
        }

        //Lista todas las peliculas
        public static function allPeliculas($id){
            $query = "SELECT * FROM peliculas WHERE idCategoria = $id";

            $resultado = self::consultarSQL($query);

            return $resultado;
        }
    }