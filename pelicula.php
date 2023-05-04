<?php 
    require 'includes/app.php';

    use App\Pelicula;
    use App\Categoria;

    $id = $_GET['id'];
    $id = filter_var($id, FILTER_VALIDATE_INT);

    if(!$id){
        header('Location: /BlogPeliculas/index.php');
    }

    $categorias = Categoria::all();

    $pelicula = Pelicula::find($id);

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
                        <a class="nav-link p-enlace" href="/BlogPeliculas/login.php">Iniciar Sesión</a>
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
                <img src="/BlogPeliculas/imagenes/<?php echo $pelicula->imagen; ?>" alt="Imagen Pelicula">
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

        <div>
            <h3 class="mt-5">Escribe un comentario sobre la pelicula:</h3>

            <form class="formulario">
                <fieldset>
                        
                    <label for="nombre">Nombre:</label>
                    <input type="text" name="nombre" placeholder="Tu Nombre" id="nombre">

                    <label for="comentario">Comentario:</label>
                    <textarea id="comentario" name="comentario" placeholder="Escribe un comentario..."></textarea>
                </fieldset>

                <div class="d-flex justify-content-end mb-4">
                    <input type="submit" value="Comentar" class="boton">
                </div>
            </form>
        </div>
    </main>

<?php 
    incluirTemplate('footer');
?>