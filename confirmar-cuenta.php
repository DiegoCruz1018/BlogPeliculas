<?php

use App\Usuario;

    include 'includes/app.php';

    $errores = [];
    $alertas = [];

    $token = s($_GET['token']);

    $usuario = Usuario::where('token', $token);

    if(empty($usuario) || $usuario->token === ''){
        //Mostrar mensaje de error
        Usuario::setError('Token No Válido');
    }else{
        //Modificar a usuario confirmado
        $usuario->confirmado = '1';
        $usuario->token = null;

        $usuario->guardar();

        Usuario::setAlerta('Cuenta Comprobada Correctamente');
    }

    $alertas = Usuario::getAlertas();
    $errores = Usuario::getErrores();

    incluirTemplate('header-login', $inicio = false);
?>

        <div class="contenedor-app">
            <div class="imagen"></div>

            <div class="app">
                <h1 class="nombre-pagina">Confirma Cuenta</h1>
                
                <?php foreach($errores as $error): ?>
                    <div class="error">
                        <?php echo $error ?>
                    </div>
                <?php endforeach; ?> 

                <?php foreach($alertas as $alerta): ?>
                    <div class="exito">
                        <?php echo $alerta ?>
                    </div>
                <?php endforeach; ?>

                <div class="acciones">
                    <a href="/BlogPeliculas/login.php">Iniciar Sesión</a>
                </div>
                
            </div>
        </div>

<?php
    incluirTemplate('footer-login');
?>