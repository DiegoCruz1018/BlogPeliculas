<?php 
    require '../includes/app.php';

    use App\Categoria;
    use App\Contacto;

    iniciarSession();
    isAdmin();

    $nombre = $_SESSION['nombre'];

    $auth = $_SESSION['login'] ?? false;

    $categorias = Categoria::all();
    $mensajes = Contacto::all();

    //Muestra mensaje condicional
    $resultado = $_GET['resultado'] ?? null;

    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        $id = $_POST['id'];
        $id = filter_var($id, FILTER_VALIDATE_INT);

        if($id){

            $tipo = $_POST['tipo'];

            if(validarTipoContenido($tipo)){
                //Compara lo que vamos a eliminar
                if($tipo === 'mensaje'){
                    $mensaje = Contacto::find($id);

                    $resultado = $mensaje->eliminar();

                    if($resultado){
                        //Redireccionar al usuario
                        header('Location: /BlogPeliculas/admin/mensajes.php?resultado=3');
                    }
                }
            }
        }
    }

    incluirTemplate('header', $inicio = false);
?>  
    <header>
        <nav class="navbar navbar-expand-lg navbar-dark" data-bs-theme="dark" style="background-color: #cb0000;">
            <div class="container-fluid">
                <a class="navbar-brand p-enlace nav-margin" href="/BlogPeliculas/index.php">Movie Magic</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNavDropdown">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link p-enlace" aria-current="page" href="/BlogPeliculas/nosotros.php">Nosotros</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link p-enlace" href="/BlogPeliculas/contacto.php">Contacto</a>
                    </li>
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

    <main class="container mt-5 mb-5">
        <h1>Administrador de Mensajes</h1>

        <h2><?php echo "Hola " . $nombre; ?></h2>

        <?php 
            $mensaje = mostrarNotificacion(intval($resultado));

            if($mensaje): ?>
                <p class="exito"> <?php echo s($mensaje); ?> </p>
        <?php endif; ?>

        <div class="d-flex mb-4">
            <a href="/BlogPeliculas/admin/indexUsuario.php" class="crear ms-3">Usuarios</a>
            <a href="/BlogPeliculas/admin/indexPelicula.php" class="crear ms-3">Peliculas</a>
            <a href="/BlogPeliculas/admin/indexCategoria.php" class="crear ms-3">Categorias</a>
            <a href="/BlogPeliculas/admin/indexComentario.php" class="crear ms-3">Comentarios</a>
        </div>

        <h2>Categorias</h2>

        <table class="peliculas">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Correo</th>
                    <th>telefono</th>
                    <th>Mensaje</th>
                    <th>Enviado</th>
                    <th>Acciones</th>
                </tr>
            </thead>

            <tbody> <!-- Mostrar los resultados -->
                <?php foreach($mensajes as $mensaje): ?>
                    <tr>
                        <td> <?php echo $mensaje->id; ?> </td>
                        <td> <?php echo $mensaje->nombre . " " . $mensaje->apellido; ?> </td>
                        <td> <?php echo $mensaje->correo ?> </td>
                        <td> <?php echo $mensaje->telefono ?> </td>
                        <td> <?php echo $mensaje->mensaje ?> </td>
                        <td> <?php echo $mensaje->enviado ?> </td>
                        <td>
                            <form method="POST" class="w-100">
                                <input type="hidden" name="id" value="<?php echo $mensaje->id; ?>">
                                <input type="hidden" name="tipo" value="mensaje">
                                <input type="submit" class="borrar" value="Eliminar">
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </main>

<?php 
    incluirTemplate('footer');
?>