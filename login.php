<?php

    use App\Usuario;

    include 'includes/app.php';

    $errores = [];

    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        $auth = new Usuario($_POST);

        $errores = $auth->validarLogin();

        if(empty($errores)){
            // Comprobar que exista el usuario
            $usuario = Usuario::where('correo', $auth->correo);

            if($usuario){
                //Verificar el password
                if($usuario->comprobarPasswordAndVerificado($auth->password)){
                    //Autenticar el usuario
                    session_start();

                    $_SESSION['id'] = $usuario->id;
                    $_SESSION['nombre'] = $usuario->nombre . " " . $usuario->apellido;
                    $_SESSION['correo'] = $usuario->correo;
                    $_SESSION['login'] = true;

                    //Redireccionamiento
                    if($usuario->idRol === '1'){
                        $_SESSION['idRol'] = $usuario->idRol ?? null;

                        header('Location: /BlogPeliculas/admin/indexPelicula.php');

                    }else{
                        header('Location: /BlogPeliculas/index.php');
                    }

                    debuguear($_SESSION);
                }
            }else{
                Usuario::setError('Usuario no encontrado');
            }
        }
    }

    $errores = Usuario::getErrores();

    incluirTemplate('header-login', $inicio = false);
?>  
        <div class="contenedor-app">
            <div class="imagen"></div>

            <div class="app">
                <h1 class="nombre-pagina" >Login</h1>
                <p class="descripcion-pagina">Inicia Sesión con tus datos</p>

                <?php foreach($errores as $error): ?>
                    <div class="error">
                        <?php echo $error ?>
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

                    <div class="campo">
                        <label for="password">Password:</label>
                        <input 
                            type="password"
                            id="password"
                            name="password"
                            placeholder="Tu Password"
                        >
                    </div>

                    <input type="submit" class="boton" value="Iniciar Sesión">
                </form>

                <div class="acciones">
                    <a href="/BlogPeliculas/crear-cuenta.php">¿Aún no tienes una cuenta? Crear Una</a>
                    <a href="/BlogPeliculas/olvide-password.php">¿Olvidaste tu Password?</a>
                </div>
            </div>
        </div>

<?php 
    incluirTemplate('footer-login');
?>