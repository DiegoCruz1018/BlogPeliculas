<?php 
    include 'includes/app.php';

    use App\Categoria;

    iniciarSession();
    $auth = $_SESSION['login'] ?? false;

    $categorias = Categoria::all();

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

    <main class="contenedor">
        <h3 class="titulo-parrafo">CONOCENOS</h3>
        <section class="sobre-nosotros container">
            <div class="contenedor-sobre-nosotros row">
                <div class="img-nosotros col-md-6">
                    <img src="img/img1.jpg" alt="" class="imagen-about-us">
                </div>
                <div class="contenido-textos col-md-6">
                    <p>
                        Este blog esta conformado por colegas de la universidad, nuestro proposito es compartir nuestra aficion por el cine y la cerveza bien fria, tambien compartimos una serie de ideas, pensamientos, inquietudes, emociones, experiencias y risas.
                    </p>
                    <p>
                        Ante todo, advertir que esta no es una web de criticas, si  no de opciones de entretenimiento, puntos de vista y siempre que se pueda humor. Cada cosa que puedas ver, leer o sentir en este lugar tedra el valor que tu le quiera dar, pues tan solo sera nuestra vision sobre algun acontesimiento de la vida o algun fruto de nuestra imaginación. 
                    </p>
                </div>
            </div>
        </section>
    </main>
    
    


<?php 
    incluirTemplate('footer');
?> 














