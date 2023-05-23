<?php
    require '../../includes/app.php';

    use App\Categoria;
    use App\Rol;
    use App\Usuario;

    //estaAutenticado();
    iniciarSession();
    isAdmin();

    $auth = $_SESSION['login'] ?? false;

    //Consulta para obtener las categorias
    $categorias = Categoria::all();

    //Consulta para obtener los roles
    $roles = Rol::all();

    //Validar la URL por ID válido
    $id = $_GET['id'];
    $id = filter_var($id, FILTER_VALIDATE_INT);

    if(!$id){
        header('Location: /BlogPeliculas/admin/indexUsuario.php');
    }

    //Obtener los datos de la pelicula
    $usuario = Usuario::find($id);

    //Arreglo con errores
    $errores = Usuario::getErrores();

    //Ejecutar el código después de que el usuario envia el formulario
    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        
        //Asignar los atributos
        $args = $_POST['usuario'];

        $usuario->sincronizar($args);

        //Validación 
        $errores = $usuario->validarNuevaCuenta();

        if(empty($errores)){

            $resultado = $usuario->actualizar();

            if($resultado){
                //Redireccionar al usuario
                header('Location: /BlogPeliculas/admin/indexUsuario.php?resultado=2');
            }
        }
    }

    incluirTemplate('header', $inicio = false);
?>  

    <header>
        <nav class="navbar navbar-expand-lg navbar-dark" data-bs-theme="dark" style="background-color: #cb0000;">
            <div class="container-fluid">
                <a class="navbar-brand p-enlace nav-margin" href="/BlogPeliculas/index.php">Movie Magic</a>
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
        <h1>Actualizar Usuario</h1>

        <div class="d-flex justify-content-start mb-4">
            <a class="boton" href="/BlogPeliculas/admin/indexUsuario.php">Volver</a>
        </div>

        <?php foreach($errores as $error): ?>
            <div class="error">
                <?php echo $error ?>
            </div>
        <?php endforeach; ?>

        <form class="formulario" method="POST">

            <?php include '../../includes/templates/formulario_usuarios.php'; ?>

            <div class="d-flex justify-content-end mb-4">
                <input type="submit" value="Actualizar Usuario" class="crear">
            </div>
        </form>
    </main>

<?php 
    incluirTemplate('footer');
?>