<?php

define('TEMPLATES_URL', __DIR__ . '/templates');
define('FUNCIONES_URL', __DIR__ . '/funciones.php');
define('CARPETA_IMAGENES', __DIR__ . '/../imagenes/');

function incluirTemplate(string $nombre, bool $inicio = false){
    include TEMPLATES_URL . "/$nombre.php";
}

function estaAutenticado() : bool{
    session_start();

    if(!$_SESSION['login']){
        header('Location: /BlogPeliculas/index.php');
    }
    return false;
}

function debuguear($variable){
    echo "<pre>";
    var_dump($variable);
    echo "</pre>";

    exit;
}

//Escapa / Sanitizar el HTML
function s($html) : string{
    $s = htmlspecialchars($html);
    return $s;
}

//Validar tipo de contenido
function validarTipoContenido($tipo){
    $tipos = ['categoria', 'pelicula', 'mensaje'];

    return in_array($tipo, $tipos);
}

//Muesta los mensajes
function mostrarNotificacion($codigo){
    $mensaje = '';

    switch($codigo){
        case 1: $mensaje = 'Creado correctamente';
            break;
        case 2: $mensaje = 'Actualizado correctamente';
            break;
        case 3: $mensaje = 'Eliminado correctamente';
            break;
        case 4: $mensaje = 'Enviado correctamente';
            break;
        default: $mensaje = false;
            break;   
    }

    return $mensaje;
}

function iniciarSession() {
    if(!isset($_SESSION)){
        session_start();
    }  
}

//Función que revisa que el usuario este autenticado
// function isAuth() : void{
//     if(!isset($_SESSION['login'])){
//         header('Location: /BlogPeliculas/index.php');
//     }
// }

function isAdmin() : void{
    if(!isset($_SESSION['idRol'])){
        header('location: /BlogPeliculas/index.php');
    }
}