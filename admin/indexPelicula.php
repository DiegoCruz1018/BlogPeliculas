<?php 
    require '../includes/app.php';
    //estaAutenticado();

    //Importar Clase
    use App\Pelicula;

    //Implementar un método para obtener todas las peliculas
    $peliculas = Pelicula::all();

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

                $pelicula->eliminar(); 
            }
        }
    }

    incluirTemplate('header', $inicio = false);
?>  

    <main class="container mt-5">
        <h1>Administrador de Peliculas</h1>

        <?php 
            $mensaje = mostrarNotificacion(intval($resultado));

            if($mensaje): ?>
                <p class="exito"> <?php echo s($mensaje); ?> </p>
        <?php endif; ?>

        <div class="d-flex mb-4">
            <a class="nuevo justify-content-start" href="/BlogPeliculas/admin/peliculas/crear.php">Nueva Pelicula</a>
            <a href="" class="crear ms-3">Usuarios</a>
            <a href="/BlogPeliculas/admin/indexCategoria.php" class="crear ms-3">Categorias</a>
            <a href="" class="crear ms-3">Comentarios</a>
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