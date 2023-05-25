<?php 
    require '../../includes/app.php';

    use App\Categoria;

    iniciarSession();
    isAdmin();

    $auth = $_SESSION['login'] ?? false;

    $categoria = new Categoria;

    //Categoria para el menu
    $categorias = Categoria::all();

    //Arreglo con mensajes de errores
    $errores = Categoria::getErrores();

    if($_SERVER['REQUEST_METHOD'] === 'POST'){
   
        //Creando una nueva instancia
        $categoria = new Categoria($_POST['categoria']);

        $errores = $categoria->validar();

        if(empty($errores)){ 
            //Guardar en la BD
            $resultado = $categoria->crear();

            if($resultado){
                //Redireccionar al usuario
                header('Location: /BlogPeliculas/admin/indexCategoria.php?resultado=1');
            }
        }
    }

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

    <main class="container mt-5 mb-5">
        <h1>Crear Categoria</h1>

        <div class="d-flex justify-content-start mb-4">
            <a class="boton" href="/BlogPeliculas/admin/indexCategoria.php">Volver</a>
        </div>

        <?php foreach($errores as $error): ?>
            <div class="error">
                <?php echo $error; ?>
            </div>
        <?php endforeach; ?>

        <form class="formulario" method="POST">
            
            <?php include '../../includes/templates/formulario_categorias.php'; ?>

            <div class="d-flex justify-content-end mb-4">
                <input type="submit" value="Crear Categoria" class="crear">
            </div>
        </form>

        <div>
            <p>
                El género cinematográfico es el tema general de una película que sirve para su clasificación. 
                Así mismo supone un pacto implícito entre el público y el exhibidor, que garantiza el acomodo 
                entre las expectativas psicológicas del espectador y la obra que va a visionar. El género es una 
                guía para el comportamiento del público -reír (comedia), emocionarse o llorar (drama), asustarse 
                (terror), sorprenderse (fantástico), entretenerse (aventuras), etcétera- o para el reconocimiento 
                de temas, espacios, iconos, situaciones, objetos, acciones... que espera encontrar en las películas.
            </p>
        </div>
    </main>

<?php 
    incluirTemplate('footer');
?>