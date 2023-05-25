<?php 
    require 'includes/app.php';

    iniciarSession();

    $nombre = $_SESSION['nombre'];

    $auth = $_SESSION['login'] ?? false;

    use App\Categoria;

    $categorias = Categoria::all();

    incluirTemplate('header', $inicio = true);
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

        <h2><?php if($auth){
            echo "Bienvenido " . $nombre;
        } ?></h2>

        <div class="row">
            <div class="col-md-6 col-lg-4 mb-4 w-1">
                <img src="img/1.jpg" alt="">
            </div>
            <div class="col-md-6 col-lg-4">
                <img src="img/2.jpg" alt="">
            </div>
            <div class="col-md-6 col-lg-4">
                <img src="img/3.jpg" alt="">
            </div>
        </div>

        <h2 class="mt-3" >LAS MEJORES PELICULAS DEL MOMENTO</h2>
            <p>
                Las mejores películas de 2023 nos dejaron algunas joyas imprescindibles y aquí las colocamos de peor a mejor para que sepas qué 
                debes recuperar y qué debes olvidar.
            </p>
            <p>
                La lista contiene películas que fueron tan esperadas como 'The Batman' con Robert Pattinson,
                las aclamadas 'Drive my car' y 'La peor persona del mundo', y además de películas de Marvel como 'Black Panther: Wakanda Forever'.
                En muchas de ellas los números hablaron por sí solos, de alguna de las películas de Netflix más vistas de su historia (que, claro,
                ya se cuentan entre las mejores películas de Netflix en 2023) hasta algún taquillazo inesperado.
            </p>
    </main>
    </main>
   <div class="contenedor-imagen">
   
   </div>

<?php 
    incluirTemplate('footer');
?> 













