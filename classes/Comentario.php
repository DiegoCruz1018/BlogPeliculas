<?php

    namespace App;

    class Comentario extends ActiveRecord{
        protected static $tabla = 'comentarios';
        protected static $columnasDB = ['id', 'comentario', 'idUsuario', 'idPelicula','creado'];

        public $id;
        public $comentario;
        public $idUsuario;
        public $idPelicula;
        public $creado;

        public function __construct($args = [])
        {
            $this->id = $args['id'] ?? null;
            $this->comentario = $args['comentario'] ?? '';
            $this->idUsuario = $args['idUsuario'] ?? '';
            $this->idPelicula = $args['idPelicula'] ?? '';
            $this->creado = date('Y-m-d');
        }

        //Lista todas las peliculas
        public static function comentariosPeliculas($id){
            $query = "SELECT * FROM " . self::$tabla . " WHERE idPelicula = $id";

            $resultado = self::consultarSQL($query);

            return $resultado;
        }

        //Comentar en las peliculas
        public function comentarPelicula($idUsuario, $idPelicula){
            $query = "INSERT INTO " . self::$tabla . " (comentario, idUsuario, idPelicula, creado) 
            VALUES ('$this->comentario', '$idUsuario', '$idPelicula', '$this->creado')";

            $resultado = self::$db->query($query);

            return $resultado;
        }
    }