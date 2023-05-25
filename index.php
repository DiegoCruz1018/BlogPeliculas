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

    <div class="barra"></div>

    <section class="container mt-5">

        <h2><?php if($auth){
            echo "Bienvenido "; ?> <span class="h1-usuario"> <?php echo $nombre; ?> </span>
        <?php } ?></h2>

        <div class="row">
            <div class="col-md-6 col-lg-4 mb-4 w-1">
                <img src="img/1.jpg" alt="">
            </div>
            <div class="col-md-6 col-lg-4 mb-4">
                <img src="img/2.jpg" alt="">
            </div>
            <div class="col-md-6 col-lg-4 mb-4">
                <img src="img/3.jpg" alt="">
            </div>
        </div>

        <h2 class="mt-5 text-secondary">LAS MEJORES PELÍCULAS DEL MOMENTO</h2>
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
    </section>

    <section class="imagen-contacto mt-4">
        <h2>Ve los comentarios de tu película favorita</h2>
        <p>Envíanos tu opinion sobre nuestra página</p>
        <a href="/BlogPeliculas/contacto.php" class="crear">Contactános</a>
    </section>
   
    <div class="contenedor mb-2">
        <section class="blog">
            <h3 class="text-secondary">Nuestro blog</h3>

            <div class="row mb-4">
                <div class="col-lg-6">
                    <img loading="lazy" src="/BlogPeliculas/img/taquilleras.jpg" alt="Texto entrada blog">
                </div>

                <div class="col-lg-6 mt-3">
                    <a target="_blank" href="https://www.fotogramas.es/noticias-cine/g39711025/100-peliculas-taquilleras/?slide=1">
                        <h3 class="h1-usuario">Las 100 películas más taquilleras de la historia</h3>

                        <p class="h1-usuario">Escrito el: <span class="text-light">24/05/2023</span> por: <span class="text-light">FRAN CHICO</span></p>

                        <p>
                            Repasamos las 100 películas con más recaudación de todos los tiempos, con 'Avatar' y 
                            'Vengadores: Endgame' luchando por el primer puesto.
                        </p>
                    </a>
                </div>
            </div>

            <div class="row mb-4">
                <div class="col-lg-6">
                    <img loading="lazy" src="/BlogPeliculas/img/groot.avif" alt="Texto entrada blog">
                </div>

                <div class="col-lg-6 mt-3">
                    <a target="_blank" href="https://www.sensacine.com/noticias/cine/noticia-1000025663/">
                        <h3 class="h1-usuario">Guardianes de la Galaxia Vol. 3 es el fin de una era</h3>

                        <p class="h1-usuario">Escrito el: <span class="text-light">23/05/2023</span> por: <span class="text-light">Andrea Zamora</span></p>

                        <p>
                            James Gunn ha dado una nueva frase a Groot en 'Guardianes de la Galaxia 3', pero que le entiendas tiene truco
                        </p>
                    </a>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-6">
                    <img loading="lazy" src="/BlogPeliculas/img/oppenheimer.webp" alt="Texto entrada blog">
                </div>

                <div class="col-lg-6 mt-3">
                    <a target="_blank" href="https://www.ecartelera.com/noticias/oppenheimer-christopher-nolan-explosion-nuclear-sin-cgi-73472/">
                        <h3 class="h1-usuario">Cómo Christopher Nolan ha recreado una explosión nuclear sin efectos visuales</h3>

                        <p class="h1-usuario">Escrito el: <span class="text-light">24/05/2023</span> por: <span class="text-light">Paula Torres</span></p>

                        <p>
                            'Oppenheimer' llegará a los cines el 21 de julio con Cillian Murphy dando vida al "padre" de la bomba atómica, 
                            en un intenso biopic.
                        </p>
                    </a>
                </div>
            </div>
        </section>
    </div>

<?php 
    incluirTemplate('footer');
?> 













