<?php 
    require 'includes/app.php';

    iniciarSession();

    $nombre = $_SESSION['nombre'];
    $idUsuario = $_SESSION['id'];

    $auth = $_SESSION['login'] ?? false;

    use App\Pelicula;
    use App\Categoria;
    use App\Usuario;
    use App\Comentario;
    use App\ComentarioView;

    $id = $_GET['id'];
    $id = filter_var($id, FILTER_VALIDATE_INT);

    if(!$id){
        header('Location: /BlogPeliculas/index.php');
    }

    $categorias = Categoria::all();

    $usuario = new Usuario;

    $pelicula = Pelicula::find($id);

    $comentarios = Comentario::comentariosPeliculas($id);

    $comentariosView = ComentarioView::comentariosViews($id);

    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        //Creando una nueva instancia
        $comentario = new Comentario($_POST['comentario']);

        //Guardar en la BD
        $comentario->comentarPelicula($idUsuario, $id);

        //Validar ID
        // $id = $_POST['id'];
        // $id = filter_var($id, FILTER_VALIDATE_INT);

        // if($id){
        //      $tipo = $_POST['tipo'];

        //     if(validarTipoContenido($tipo)){
        //         $comentario = Comentario::find($id);

        //         $comentario->eliminar(); 
        //     }
        // }
    }

    incluirTemplate('header', $inicio = false);
?>  

    <header>
        <nav class="navbar navbar-expand-lg navbar-dark" data-bs-theme="dark" style="background-color: #cb0000;">
            <div class="container-fluid">
                <a class="navbar-brand p-enlace nav-margin" href="/BlogPeliculas/index.php">Blog Peliculas</a>
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
                        <?php foreach($categorias as $categoria): ?>
                            <a class="dropdown-item p-enlace" href="/BlogPeliculas/categorias.php?id=<?php echo $categoria->id; ?>"><?php echo $categoria->nombre; ?></a>
                        <?php endforeach; ?>
                    </ul>
                    </li>
                </ul>
                </div>
            </div>
        </nav>
    </header>

    <main class="container mt-5 mb-5">
        <h1><?php echo $pelicula->titulo; ?></h1>

        <div class="row">
            <div class="col-md-6">
                <img class="h-100" src="/BlogPeliculas/imagenes/<?php echo $pelicula->imagen; ?>" alt="Imagen Pelicula">
            </div>
            <div class="col-md-6 mt-5">
                <h2 class="nombre-pagina text-primary">Director: 
                    <span class="text-light"><?php echo $pelicula->director; ?></span>
                </h2>
                <h2 class="nombre-pagina text-primary">Protagonista: <span class="text-light"><?php echo $pelicula->protagonista; ?></span></h2>
                <h2 class="nombre-pagina text-primary">Sipnosis: </h2>
                <p class="text-primary">
                    <span class="text-light"><?php echo $pelicula->sipnosis; ?></span>
                </p>
            </div>
        </div>

        <h3 class="mt-5 text-secondary">Comentarios sobre la pelicula</h3>

        <div class="comentarios btn position-relative pe-none">
            <?php foreach($comentariosView as $comentarioView): ?>
                <h4 class="d-flex flex-start ms-5 text-light"><?php echo $comentarioView->nombreUsuario; ?></h4>
                <p class="d-flex flex-start ms-5 mb-1 p-3 bg-light bg-gradient text-dark border border-succes rounded">
                    <?php echo $comentarioView->comentario; ?>
                </p>
                <!-- <div class="d-flex justify-content-end">
                    <form method="POST" class="mt-0 fw-bold fs-5 pe-auto">
                        <input type="hidden" name="id" value="<?php echo $comentario->id; ?>">
                        <input type="hidden" name="tipo" value="comentario">
                        <input type="submit" class="borrar" value="Eliminar">
                    </form>
                </div> -->
                <hr class="mt-4">
            <?php endforeach; ?>
        </div>

        <?php if($auth): ?>
            <h3 class="mt-5 text-secondary">Escribe un comentario sobre la pelicula:</h3>

            <div>
                <form class="formulario" method="POST">
                    <fieldset>
                        <label for="comentario"><?php echo $nombre; ?></label>
                        <textarea id="comentario" name="comentario[comentario]" placeholder="Escribe un comentario..."></textarea>
                    </fieldset>

                    <div class="d-flex justify-content-end mb-4">
                        <input type="submit" value="Comentar" class="boton">
                    </div>
                </form>
            </div>
        <?php else: ?>
            <h3 class="mt-5 text-secondary">Si deseas comentar tienes que iniciar sesión</h3>

            <a href="/BlogPeliculas/login.php" class="crear d-inline ms-3">Inicia Sesión</a>
        <?php endif; ?>
    </main>

<?php 
    incluirTemplate('footer');
?>