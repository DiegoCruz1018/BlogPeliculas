<?php

use App\Email;
use App\Usuario;

    include 'includes/app.php';

    $errores = [];
    $alertas = [];

    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        $auth = new Usuario($_POST);
        $errores = $auth->validarEmail();

        if(empty($errores)){
            $usuario = Usuario::where('correo', $auth->correo);

            if($usuario && $usuario->confirmado === "1"){
                //Generar un token
                $usuario->crearToken();
                $usuario->guardar();

                //Enviar el email
                $email = new Email($usuario->correo, $usuario->nombre, $usuario->token);
                $email->enviarInstrucciones();

                //Alerta de exito
                Usuario::setAlerta('Revisa tu email');
                $alertas = Usuario::getAlertas();
            }else{
                Usuario::setError('El usuario no existe o no esta confirmado');
                $errores = Usuario::getErrores();
            }
        }
    }

    incluirTemplate('header-login', $inicio = false);
?>  
        <div class="contenedor-app">
            <div class="imagen"></div>

            <div class="app">
                <h1 class="nombre-pagina">Olvidé Password</h1>
                <p class="descripcion-pagina">Reestablece tu Password</p>

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

                <form class="form" method="POST">
                    <div class="campo">
                        <label for="correo">Email:</label>
                        <input 
                            type="email"
                            id="correo"
                            name="correo"
                            placeholder="Tu E-mail"
                        >
                    </div>

                    <input type="submit" class="boton" value="Enviar Instrucciones">
                </form>

                <div class="acciones">
                    <a href="/BlogPeliculas/login.php">¿Ya tienes una cuenta? Inicia Sesión</a>
                    <a href="/BlogPeliculas/crear-cuenta.php">¿Aún no tienes una cuenta? Crear Una</a>
                </div>
            </div>
        </div>

<?php 
    incluirTemplate('footer-login');
?>