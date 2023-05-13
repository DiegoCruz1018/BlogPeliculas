<?php 
    require '../../includes/app.php';

    use App\Categoria;

    $categoria = new Categoria;

    //Categoria para el menu
    $categorias = Categoria::all();

    iniciarSession();
    isAdmin();

    $auth = $_SESSION['login'] ?? false;

    //Validar la URL por ID válido
    $id = $_GET['id'];
    $id = filter_var($id, FILTER_VALIDATE_INT);

    if(!$id){
        header('Location: /BlogPeliculas/admin/indexCategorias.php');
    }

    //Obtener datos de la Categoria
    $categoria = Categoria::find($id);

    //Arreglo con mensajes de errores
    $errores = Categoria::getErrores();

    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        
        //Asignar los atributos
        $args = $_POST['categoria'];

        $categoria->sincronizar($args);

        //Validación
        $errores = $categoria->validar();

        if(empty($errores)){
            $resultado = $categoria->actualizar();

            if($resultado){
                //Redireccionar al usuario
                header('Location: /BlogPeliculas/admin/indexCategoria.php?resultado=2');
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
        <h1>Actualizar Categoria</h1>

        <div class="d-flex justify-content-start mb-4">
            <a class="boton" href="/BlogPeliculas/admin/indexCategoria.php">Volver</a>
        </div>

        <?php foreach($errores as $error): ?>
            <div class="error">
                <?php echo $error; ?>
            </div>
        <?php endforeach; ?>

        <form class="formulario" method="POST">
            <fieldset>
                
                <legend>Información de la Categoria</legend>
            
                <label for="nombre">Nombre:</label>
                <input type="text" name="categoria[nombre]" placeholder="Nombre de la Categoria" id="nombre" value="<?php echo s($categoria->nombre); ?>">
            
            </fieldset>

            <div class="d-flex justify-content-end mb-4">
                <input type="submit" value="Actualizar Categoria" class="crear">
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