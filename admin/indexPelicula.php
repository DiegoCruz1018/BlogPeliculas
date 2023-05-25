<?php 
    require '../includes/app.php';
    //estaAutenticado();

    iniciarSession();
    isAdmin();

    $nombre = $_SESSION['nombre'];

    $auth = $_SESSION['login'] ?? false;

    //Importar Clase
    use App\Pelicula;
    use App\Categoria;

    //Implementar un método para obtener todas las peliculas
    $peliculas = Pelicula::all();

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
                $pelicula = Pelicula::find($id);

                $resultado = $pelicula->eliminar(); 

                if($resultado){
                    //Redireccionar al usuario
                header('Location: /BlogPeliculas/admin/indexPelicula.php?resultado=3');
                }
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
        <h1>Administrador de Peliculas</h1>

        <h2><?php echo "Hola "; ?>  <span class="h1-usuario"> <?php echo $nombre; ?> </span> </h2>

        <?php 
            $mensaje = mostrarNotificacion(intval($resultado));

            if($mensaje): ?>
                <p class="exito"> <?php echo s($mensaje); ?> </p>
        <?php endif; ?>

        <div class="d-flex mb-4">
            <a class="nuevo justify-content-start" href="/BlogPeliculas/admin/peliculas/crear.php">Nueva Pelicula</a>
            <a href="/BlogPeliculas/admin/indexUsuario.php" class="crear ms-3">Usuarios</a>
            <a href="/BlogPeliculas/admin/indexCategoria.php" class="crear ms-3">Categorias</a>
            <a href="/BlogPeliculas/admin/indexComentario.php" class="crear ms-3">Comentarios</a>
            <a href="/BlogPeliculas/admin/mensajes.php" class="crear ms-3">Ver Mensajes</a>
        </div>

        <h2>Peliculas</h2>

        <table class="peliculas">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Titulo</th>
                    <th>Imagen</th>
                    <th>Director</th>
                    <th>Protagonista</th>
                    <th>Estreno</th>
                    <th>Acciones</th>
                </tr>
            </thead>

            <tbody> <!-- Mostrar los resultados -->
                <?php foreach($peliculas as $pelicula): ?>
                    <tr>
                        <td> <?php echo $pelicula->id; ?> </td>
                        <td> <?php echo $pelicula->titulo; ?> </td>
                        <td>
                            <img src="../imagenes/<?php echo $pelicula->imagen; ?>" class="imagen-tabla">
                        </td>
                        <td> <?php echo $pelicula->director; ?> </td>
                        <td> <?php echo $pelicula->protagonista; ?> </td>
                        <td> <?php echo $pelicula->estreno; ?> </td>
                        <td>
                            <form method="POST" class="w-100">
                                <input type="hidden" name="id" value="<?php echo $pelicula->id; ?>">
                                <input type="hidden" name="tipo" value="pelicula">
                                <input type="submit" class="borrar" value="Eliminar">
                            </form>
                            <a href="/BlogPeliculas/admin/peliculas/actualizar.php?id=<?php echo $pelicula->id; ?>" class="actualizar">Actualizar</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </main>

<?php 
    incluirTemplate('footer');
?>