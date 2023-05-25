<?php 
    include 'includes/app.php';

    use App\Categoria;
    use App\Contacto;
    
    iniciarSession();
    $auth = $_SESSION['login'] ?? false;

    //Instancia para contacto
    $contacto = new Contacto;

    //Obtener todas las categorias
    $categorias = Categoria::all();

    //Obtener errores
    $errores = Contacto::getErrores();

    //Muestra mensaje condicional
    $resultado = $_GET['resultado'] ?? null;

    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        
        //Crear una nueva instancia
        $contacto = new Contacto($_POST['contacto']);

        //Crear una nueva instancia de PHPMailer
        // $mail = new PHPMailer();

        // //Configurar SMTP
        // $mail->isSMTP();
        // $mail->Host = 'sandbox.smtp.mailtrap.io';
        // $mail->SMTPAuth = true;
        // $mail->Username = '5b8f1f839b139a';
        // $mail->Password = 'b48fe8e7b1757b';
        // $mail->SMTPSecure = 'tls';
        // $mail->Port = 2525;

        //Configurar el contenido del mail
        // $mail->setFrom('admin@blogpeliculas.com');
        // $mail->addAddress('admin@blogpeliculas.com', 'BlogPeliculas.com');
        // $mail->Subject = 'Tienes un Nuevo Mensaje';

        //Habilitar HTML
        // $mail->isHTML(true);
        // $mail->CharSet = 'UTF-8';

        //Definir el contenido
        // $contenido = '<html>';
        // $contenido .= '<p>Tienes un nuevo mensaje</p>'; 
        // $contenido .= '<p>Nombre: ' . $respuestas['nombre'] . $respuestas['apellido'] .'</p>'; 
        // $contenido .= '<p>Nombre: ' . $respuestas['correo'] .'</p>'; 
        // $contenido .= '<p>Nombre: ' . $respuestas['telefono'] .'</p>'; 
        // $contenido .= '<p>Nombre: ' . $respuestas['mensaje'] .'</p>'; 
        // $contacto .= '</html>';

        // $mail->Body = $contenido;
        // $mail->AltBody = 'Texto alternativo sin HTML';

        // //Enviar el email
        // if($mail->send()){
        //     echo "Mensaje enviado correctamente";
        // }else{
        //     echo "El mensaje no se pudo enviar";
        // }

        //Validar
        $errores = $contacto->validar();

        if(empty($errores)){
            //Guardar en la BD
            $resultado = $contacto->crear();

            if($resultado){
                header('Location: /BlogPeliculas/contacto.php?resultado=4');
            }
        }
    }

    incluirTemplate('header', $inicio = false);
?>  
                    <li class="nav-item">
                      <?php if($auth): ?>
                          <a class="nav-link p-enlace" href="/BlogPeliculas/logout.php">Cerrar Sesión</a>
                      <?php else: ?>
                          <a class="nav-link p-enlace" href="/BlogPeliculas/login.php">Iniciar Sesión</a>
                      <?php endif; ?>
                    </li>
                    <li class="nav-item dropdown">
                      <a class="nav-link dropdown-toggle p-enlace" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                      Categorias
                    </a>
                    <ul class="dropdown-menu">
                        <?php foreach($categorias as $cate): ?>
                            <a class="dropdown-item p-enlace" href="/BlogPeliculas/categorias.php?id=<?php echo $cate->id; ?>"><?php echo $cate->nombre; ?></a>
                        <?php endforeach; ?>
                    </ul>
                    </li>
                </ul>
                </div>
            </div>
        </nav>
    </header>

    <main class="container">
        <h1 class="mt-5">Contacto</h1>

        <?php 
            $mensaje = mostrarNotificacion(intval($resultado));

            if($mensaje): ?>
                <p class="exito"> <?php echo s($mensaje); ?> </p>
        <?php endif; ?>

        <img src="img/contacto.jpg" alt="Imagen Contacto">

        <h2 class="descripcion-pagina">Envianos tu opinion sobre nosotros</h2>

        <?php foreach($errores as $error): ?>
            <div class="error">
                <?php echo $error; ?>
            </div>
        <?php endforeach; ?>

        <form class="formulario" method="POST">
            <fieldset>
                    
                <label for="nombre">Nombre:</label>
                <input type="text" name="contacto[nombre]" placeholder="Tu Nombre" id="nombre" value="<?php echo s($contacto->nombre); ?>">

                <label for="apellido">Apellido:</label>
                <input type="text" name="contacto[apellido]" placeholder="Tu Apellido" id="apellido" value="<?php echo s($contacto->apellido); ?>">

                <label for="email">E-mail:</label>
                <input type="email" name="contacto[correo]" placeholder="Tu Email" id="email" value="<?php echo s($contacto->correo); ?>">

                <label for="telefono">Telefono:</label>
                <input type="tel" name="contacto[telefono]" placeholder="Tu Telefono" id="telefono" value="<?php echo s($contacto->telefono); ?>">

                <label for="mensaje">Mensaje:</label>
                <textarea id="mensaje" name="contacto[mensaje]" placeholder="Escribenos tu opinion..."><?php echo s($contacto->mensaje); ?></textarea>
            </fieldset>

            <div class="d-flex justify-content-end mb-4">
                <input type="submit" value="Enviar" class="crear">
            </div>
        </form>
    </main>

<?php 
    incluirTemplate('footer');
?>