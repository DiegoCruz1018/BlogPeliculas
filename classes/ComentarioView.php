<?php 

    namespace App;

    class ComentarioView extends ActiveRecord{
        protected static $tabla = 'comentariosView';
        protected static $columnasDB = ['nombreUsuario', 'comentario', 'pelicula'];

        public $nombreUsuario;
        public $comentario;
        public $pelicula;

        public function __construct($args = [])
        {
            $this->nombreUsuario = $args['nombreUsuario'] ?? '';
            $this->comentario = $args['comentario'] ?? '';
        }

        //Vista para los comentarios
        public static function comentariosViews($id){
            $query = "SELECT * FROM " . self::$tabla . " WHERE Pelicula = $id";

            $resultado = self::consultarSQL($query);

            return $resultado;
        }
    }