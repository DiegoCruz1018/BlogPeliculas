<?php 
    require 'includes/app.php';

    iniciarSession();

    $nombre = $_SESSION['nombre'];

    $auth = $_SESSION['login'] ?? false;

    use App\Categoria;

    $categorias = Categoria::all();

    incluirTemplate('header', $inicio = true);
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

    <main class="container mt-5">
        <h1>Titulo de la página</h1>

        <h2><?php if($auth){
            echo "Bienvenido " . $nombre;
        } ?></h2>
    </main>
   <div class="contenedor-imagen">
   
   </div>

<?php 
    incluirTemplate('footer');
?> 













