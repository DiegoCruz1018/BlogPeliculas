<?php

    use App\Email;
    use App\Usuario;

    include 'includes/app.php';

    $usuario = new Usuario;

    //Errores
    $errores = [];

    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        
        $usuario->sincronizar($_POST);
        $errores = $usuario->validarNuevaCuenta();

        //Revisar que errores este vacio
        if(empty($errores)){
            //Verificar que el usuario no este registrado
            $resultado = $usuario->existeUsuario();

            if($resultado->num_rows){
                $errores = Usuario::getErrores();
            }else{
                //Hashear el password
                $usuario->hashPassword();

                //Generar un Token único
                $usuario->crearToken();

                //Enviar el E-mail
                $email = new Email($usuario->correo, $usuario->nombre, $usuario->token);

                $email->enviarConfirmacion();

                // debuguear($usuario);

                //Crear el usuario
                $resultado = $usuario->crear();
                if($resultado){
                    header('Location: /BlogPeliculas/mensaje.php');
                }
            }
        }
    }

    incluirTemplate('header-login', $inicio = false);
?>  

        <div class="contenedor-app">
            <div class="imagen"></div>

            <div class="app">
                <h1 class="nombre-pagina">Crear Cuenta</h1></h1>
                <p class="descripcion-pagina">Crear una cuenta para que puedas comentar nuestras peliculas</p>

                <?php foreach($errores as $error): ?>
                    <div class="error">
                        <?php echo $error ?>
                    </div>
                <?php endforeach; ?>

                <form class="form" method="POST">
                    <div class="campo">
                        <label class="me-lg-1" for="nombre">Nombre:</label>
                        <input 
                            type="text"
                            id="nombre"
                            name="nombre"
                            placeholder="Tu Nombre"
                            value="<?php echo s($usuario->nombre); ?>"
                        >
                    </div>

                    <div class="campo">
                        <label for="apellido">Apellido:</label>
                        <input 
                            type="text"
                            id="apellido"
                            name="apellido"
                            placeholder="Tu Apellido"
                            value="<?php echo s($usuario->apellido); ?>"
                        >
                    </div>

                    <div class="campo">
                        <label for="telefono">Teléfono:</label>
                        <input 
                            type="tel"
                            id="telefono"
                            name="telefono"
                            placeholder="Tu Teléfono"
                            value="<?php echo s($usuario->telefono); ?>"
                        >
                    </div>

                    <div class="campo">
                        <label for="email">Email:</label>
                        <input 
                            type="email"
                            id="correo"
                            name="correo"
                            placeholder="Tu Email"
                            value="<?php echo s($usuario->correo); ?>"
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

                    <input type="submit" class="boton" value="Crear Cuenta">
                </form>

                <div class="acciones">
                    <a href="/BlogPeliculas/login.php">¿Ya tienes una cuenta? Inicia Sesión</a>
                    <a href="/BlogPeliculas/olvide-password.php">¿Olvidaste tu Password?</a>
                </div>
            </div>
        </div>

<?php 
    incluirTemplate('footer-login'); 
?>