<?php 
    require 'includes/app.php';

    iniciarSession();

    $auth = $_SESSION['login'] ?? false;

    use App\Categoria;
    use App\Pelicula;
    
    $id = $_GET['id'];
    $id = filter_var($id, FILTER_VALIDATE_INT);

    if(!$id){
        header('Location: /BlogPeliculas/index.php');
    }

    $categorias = Categoria::all();
    $peliculas = Pelicula::allPeliculas($id);
    $categoria = Categoria::find($id);

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

    <main class="container mt-5">
        <h1><?php echo $categoria->nombre; ?></h1>

        <div class="row">
            <?php foreach($peliculas as $pelicula): ?>
                <div class="col-lg-4 mb-2">
                    <a href="pelicula.php?id=<?php echo $pelicula->id; ?>">
                        <img loading="lazy" class="img-fluid" src="/BlogPeliculas/imagenes/<?php echo $pelicula->imagen ?>" alt="Imagen Pelicula">

                        <div class="contenido-pelicula bg-primary">
                            <h3 class="mb-1 mt-2 text-light nombre-pagina"><?php echo $pelicula->titulo; ?></h3>
                            <p class="text-light"><?php echo $pelicula->estreno; ?></p>
                        </div>
                    </a>
                </div>
            <?php endforeach; ?>
        </div>
    </main>

<?php 
    incluirTemplate('footer');
?>