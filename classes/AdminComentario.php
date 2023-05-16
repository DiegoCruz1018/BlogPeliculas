<?php 

    namespace App;

    class AdminComentario extends ActiveRecord{
        protected static $tabla = 'comentarios';
        protected static $columnasDB = ['id', 'usuario', 'comentario', 'pelicula'];

        public $id;
        public $usuario;
        public $comentario;
        public $pelicula;
        
        public function __construct($args=[])
        {
            $this->id = $args['id'] ?? null;
            $this->usuario = $args['usuario'] ?? '';
            $this->comentario = $args['comentario'] ?? '';
            $this->pelicula = $args['pelicula'] ?? '';
        }
    }