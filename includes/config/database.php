<?php

    function conectarDB() : mysqli{
        $db = new mysqli('localhost', 'root', '12345', 'blogpeliculas');

        if(!$db){
            echo "Error de conexion";
            exit;
        }

        return $db;
    }