<?php

    function conectarDB() : mysqli{
        $db = mysqli_connect('localhost', 'root', '12345', 'blogpeliculas');

        if(!$db){
            echo "Error de conexion";
            exit;
        }

        return $db;
    }