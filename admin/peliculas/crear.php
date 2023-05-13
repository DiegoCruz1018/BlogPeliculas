<?php 
    require '../../includes/app.php';

    use App\Pelicula;
    use App\Categoria;
    use Intervention\Image\ImageManagerStatic as Image;

    //estaAutenticado();

    iniciarSession();
    isAdmin();

    $auth = $_SESSION['login'] ?? false;

    $pelicula = new Pelicula;

    //Consulta para obtener las categorias
    $categorias = Categoria::all();

    //arreglo con mensajes de errores
    $errores = Pelicula::getErrores();

    if($_SERVER['REQUEST_METHOD'] === 'POST'){

        // Crea una nueva instancia
        $pelicula = new Pelicula($_POST['pelicula']);

        /* SUBIDA DE ARCHIVOS */

        //Genera un nombre único
        $nombreImagen = md5(uniqid(rand(), true)) . ".jpg";

        //Setear la imagen
        //Realiza un resize a la imagen con intervention
        if($_FILES['pelicula']['tmp_name']['imagen']){
            $image = Image::make($_FILES['pelicula']['tmp_name']['imagen'])->fit(800, 600);
            $pelicula->setImagen($nombreImagen);
        }

        //Validar
        $errores = $pelicula->validar();

        if(empty($errores)){

            //Crear la carpeta para subir imagenes
            $carpetaImagenes = '../../imagenes/';

            if(!is_dir(CARPETA_IMAGENES)){
                mkdir(CARPETA_IMAGENES);
            }

            //Guarda la imagen en el servidor
            $image->save(CARPETA_IMAGENES . $nombreImagen);

            //Guarda en la BD
            $resultado = $pelicula->crear();

            if($resultado){
                //Redireccionar al usuario
                header('Location: /BlogPeliculas/admin/indexPelicula.php?resultado=1');
            }
        }
    }

    incluirTemplate('header', $inicio = false);
?>  
    <header>
        <nav class="navbar navbar-expand-lg bg-body-tertiary navbar-dark" data-bs-theme="dark" style="background-color: #090909;">
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

    <main class="container mt-5">
        <h1>Crear Peliculas</h1>

        <div class="d-flex justify-content-start mb-4">
            <a class="boton" href="/BlogPeliculas/admin/indexPelicula.php">Volver</a>
        </div>

        <?php foreach($errores as $error): ?>
            <div class="error">
                <?php echo $error ?>
            </div>
        <?php endforeach; ?>

        <form class="formulario" method="POST" enctype="multipart/form-data">
            
            <?php include '../../includes/templates/formulario_peliculas.php'; ?>

            <div class="d-flex justify-content-end mb-4">
                <input type="submit" value="Crear Pelicula" class="crear">
            </div>
        </form>
    </main>

<?php 
    incluirTemplate('footer');
?>