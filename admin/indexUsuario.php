<?php 
    require '../includes/app.php';
    //estaAutenticado();

    iniciarSession();
    isAdmin();

    $nombre = $_SESSION['nombre'];

    $auth = $_SESSION['login'] ?? false;

    //Importar Clase
    use App\Usuario;
    use App\Categoria;

    //Implementar un método para obtener todas los usuarios
    $usuarios = Usuario::all();

    //Categorias para el menu
    $categorias = Categoria::all();

    //Muestra mensaje condicional
    $resultado = $_GET['resultado'] ?? null;

    if($_SERVER['REQUEST_METHOD'] === 'POST'){

        //Validar ID
        $id = $_POST['id'];
        $id = filter_var($id, FILTER_VALIDATE_INT);

        if($id){
            $tipo = $_POST['tipo'];

            if(validarTipoContenido($tipo)){
                $usuario = Usuario::find($id);

                $resultado = $usuario->eliminar(); 

                if($resultado){
                    //Redireccionar al usuario
                    header('Location: /BlogPeliculas/admin/indexUsuario.php?resultado=3');
                }
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
        <h1>Administrador de Usuarios</h1>

        <h2><?php echo "Hola " . $nombre; ?></h2>

        <?php 
            $mensaje = mostrarNotificacion(intval($resultado));

            if($mensaje): ?>
                <p class="exito"> <?php echo s($mensaje); ?> </p>
        <?php endif; ?>

        <div class="d-flex mb-4">
            <a class="nuevo justify-content-start" href="/BlogPeliculas/admin/usuarios/crear.php">Nuevo Usuario</a>
            <a href="/BlogPeliculas/admin/indexPelicula.php" class="crear ms-3">Peliculas</a>
            <a href="/BlogPeliculas/admin/indexCategoria.php" class="crear ms-3">Categorias</a>
            <a href="/BlogPeliculas/admin/indexComentario.php" class="crear ms-3">Comentarios</a>
            <a href="/BlogPeliculas/admin/mensajes.php" class="crear ms-3">Ver Mensajes</a>
        </div>

        <h2>Usuarios</h2>

        <table class="peliculas">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Correo</th>
                    <th>Teléfono</th>
                    <th>Rol</th>
                    <th>Acciones</th>
                </tr>
            </thead>

            <tbody> <!-- Mostrar los resultados -->
                <?php foreach($usuarios as $usuario): ?>
                    <tr>
                        <td> <?php echo $usuario->id; ?> </td>
                        <td> <?php echo $usuario->nombre . " " . $usuario->apellido; ?> </td>
                        <td> <?php echo $usuario->correo; ?> </td>
                        <td> <?php echo $usuario->telefono; ?> </td>
                        <td> <?php if($usuario->idRol === '1'){
                            echo 'Administrador';
                        }elseif($usuario->idRol === '2'){
                            echo 'Usuario';
                        } ?> </td>
                        <td>
                            <form method="POST" class="w-100">
                                <input type="hidden" name="id" value="<?php echo $usuario->id; ?>">
                                <input type="hidden" name="tipo" value="usuario">
                                <input type="submit" class="borrar" value="Eliminar">
                            </form>
                            <a href="/BlogPeliculas/admin/usuarios/actualizar.php?id=<?php echo $usuario->id; ?>" class="actualizar">Actualizar</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </main>

<?php 
    incluirTemplate('footer');
?>