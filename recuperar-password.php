<?php

use App\Usuario;

    include 'includes/app.php';
    
    $errores = [];
    $alerta = false;

    $token = s($_GET['token']);

    //Buscar usuario por su token
    $usuario = Usuario::where('token', $token);

    if(empty($usuario)){
        Usuario::setError('Token no Válido');
        $alerta = true;
    }

    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        //Leer el nuevo password y guardarlo
        $password = new Usuario($_POST);

        $errores = $password->validarPasword();

        if(empty($errores)){
            $usuario->password = null;
            $usuario->password = $password->password;
            $usuario->hashPassword();
            $usuario->token = null;

            $resultado = $usuario->actualizar();

            if($resultado){
                header('Location: /BlogPeliculas/login.php');
            }
        }
    }

    //debuguear($usuario);
    $errores = Usuario::getErrores();

    incluirTemplate('header-login', $inicio = false);
?>

        <div class="contenedor-app">
            <div class="imagen"></div>

            <div class="app">
                <h1 class="nombre-pagina">Recuperar Password</h1>
                <p class="descripcion-pagina">
                    Coloca tu nuevo password a continuación
                </p>

                <?php foreach($errores as $error): ?>
                    <div class="error">
                        <?php echo $error ?>
                    </div>
                <?php endforeach; ?>

                <?php if($alerta) return; ?>

                <form method="POST">
                    <div class="campo">
                        <label for="password">Password: </label>
                        <input 
                        type="password"
                        id="password"
                        name="password"
                        placeholder="Tu Nuevo Password"
                        >
                    </div>

                    <input type="submit" class="boton" value="Guardar Nuevo Password">
                </form>

                <div class="acciones">
                    <a href="/BlogPeliculas/login.php">¿Ya tienes una cuenta? Inicia Sesión</a>
                    <a href="/BlogPeliculas/olvide-password.php">¿Aún no tienes cuenta? Obtener Una</a>
                </div>
                
            </div>
        </div>

<?php
    incluirTemplate('footer-login');
?>