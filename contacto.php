<?php 
    include 'includes/app.php';

    use App\Categoria;

    $categorias = Categoria::all();

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

        <img src="img/contacto.jpg" alt="Imagen Contacto">

        <h2 class="descripcion-pagina">Llene el formulario de contacto</h2>

        <form class="formulario">
            <fieldset>
                    
                <label for="nombre">Nombre:</label>
                <input type="text" name="nombre" placeholder="Tu Nombre" id="nombre">

                <label for="apellido">Apellido:</label>
                <input type="text" name="apellido" placeholder="Tu Apellido" id="apellido">

                <label for="email">E-mail:</label>
                <input type="email" name="email" placeholder="Tu Email" id="email">

                <label for="telefono">Telefono:</label>
                <input type="tel" name="telefono" placeholder="Tu Telefono" id="telefono">

                <label for="mensaje">Mensaje:</label>
                <textarea id="mensaje" name="mensaje" placeholder="Escribenos tu opinion..."></textarea>
            </fieldset>

            <div class="d-flex justify-content-end mb-4">
                <input type="submit" value="Enviar" class="boton">
            </div>
        </form>
    </main>

<?php 
    incluirTemplate('footer');
?>