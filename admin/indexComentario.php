<?php 
    require '../includes/app.php';
    //estaAutenticado();

    iniciarSession();
    isAdmin();

    $nombre = $_SESSION['nombre'];

    $auth = $_SESSION['login'] ?? false;

    //Importar Clase

    use App\AdminComentario;
    use App\Usuario;
    use App\Categoria;
    use App\Comentario;
    use App\Pelicula;

    //Implementar un método para obtener todas los comentarios
    // $comentarios = Comentario::all();

    //Consultar la base de datos
    $consulta = "SELECT c.id AS id, CONCAT(u.nombre, ' ', u.apellido) AS usuario, c.comentario AS comentario, p.titulo AS pelicula
    FROM comentarios c INNER JOIN usuarios u ON c.idUsuario = u.id INNER JOIN peliculas p ON c.idPelicula = p.id
    ORDER BY c.id ASC";

    $comentarios = AdminComentario::SQL($consulta);

    //Traer todos los usuarios
    $usuario = new Usuario;

    //Traer todas las peliculas
    $pelicula = new Pelicula;

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
                $comentario = Comentario::find($id);

                $resultado = $comentario->eliminar(); 

                if($resultado){
                    //Redireccionar al usuario
                    header('Location: /BlogPeliculas/admin/indexComentario.php?resultado=3');
                }
            }
        }
    }

    incluirTemplate('header', $inicio = false);
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
        <h1>Administrador de Comentarios</h1>

        <h2><?php echo "Hola " . $nombre; ?></h2>

        <?php 
            $mensaje = mostrarNotificacion(intval($resultado));

            if($mensaje): ?>
                <p class="exito"> <?php echo s($mensaje); ?> </p>
        <?php endif; ?>

        <div class="d-flex mb-4">
            <!-- <a class="nuevo justify-content-start" href="/BlogPeliculas/admin/usuarios/crear.php">Nuevo Usuario</a> -->
            <a href="/BlogPeliculas/admin/indexPelicula.php" class="crear ms-3">Peliculas</a>
            <a href="/BlogPeliculas/admin/indexCategoria.php" class="crear ms-3">Categorias</a>
            <a href="/BlogPeliculas/admin/indexUsuario.php" class="crear ms-3">Usuarios</a>
            <a href="/BlogPeliculas/admin/mensajes.php" class="crear ms-3">Ver Mensajes</a>
        </div>

        <h2>Comentarios</h2>

        <table class="peliculas">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Usuario</th>
                    <th>Comentario</th>
                    <th>Pelicula</th>
                    <th>Acciones</th>
                </tr>
            </thead>

            <tbody> <!-- Mostrar los resultados -->
                <?php foreach($comentarios as $comentario): ?>
                    <tr>
                        <td> <?php echo $comentario->id; ?> </td>
                        <td> <?php echo $comentario->usuario ?> </td>
                        <td class="w-50"> <?php echo $comentario->comentario; ?> </td>
                        <td> <?php echo $comentario->pelicula; ?> </td>
                        <td>
                            <form method="POST" class="w-100">
                                <input type="hidden" name="id" value="<?php echo $comentario->id; ?>">
                                <input type="hidden" name="tipo" value="comentario">
                                <input type="submit" class="borrar" value="Eliminar">
                            </form>
                            <a href="/BlogPeliculas/admin/usuarios/actualizar.php?id=<?php echo $comentario->id; ?>" class="actualizar">Actualizar</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </main>

<?php 
    incluirTemplate('footer');
?>