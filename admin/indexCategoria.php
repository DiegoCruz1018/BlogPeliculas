<?php 
    require '../includes/app.php';
    //estaAutenticado();

    use App\Categoria;

    //Implementar un método para obtener todas las peliculas
    $categorias = Categoria::all();

    //Muestra mensaje condicional
    $resultado = $_GET['resultado'] ?? null;

    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        $id = $_POST['id'];
        $id = filter_var($id, FILTER_VALIDATE_INT);

        if($id){

            $tipo = $_POST['tipo'];

            if(validarTipoContenido($tipo)){
                //Compara lo que vamos a eliminar
                if($tipo === 'categoria'){
                    $categoria = Categoria::find($id);

                    $categoria->eliminar();
                }
            }
        }
    }

    incluirTemplate('header', $inicio = false);
?>  

    <main class="container mt-5">
        <h1>Administrador de Categorias</h1>

        <?php 
            $mensaje = mostrarNotificacion(intval($resultado));

            if($mensaje): ?>
                <p class="exito"> <?php echo s($mensaje); ?> </p>
        <?php endif; ?>

        <div class="d-flex mb-4">
            <a class="nuevo justify-content-start" href="/BlogPeliculas/admin/categorias/crear.php">Nueva Categoria</a>
            <a href="" class="crear ms-3">Usuarios</a>
            <a href="/BlogPeliculas/admin/indexPelicula.php" class="crear ms-3">Peliculas</a>
            <a href="" class="crear ms-3">Comentarios</a>
        </div>

        <h2>Categorias</h2>

        <table class="peliculas">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Acciones</th>
                </tr>
            </thead>

            <tbody> <!-- Mostrar los resultados -->
                <?php foreach($categorias as $categoria): ?>
                    <tr>
                        <td> <?php echo $categoria->id; ?> </td>
                        <td> <?php echo $categoria->nombre; ?> </td>
                        <td>
                            <form method="POST" class="w-100">
                                <input type="hidden" name="id" value="<?php echo $categoria->id; ?>">
                                <input type="hidden" name="tipo" value="categoria">
                                <input type="submit" class="borrar" value="Eliminar">
                            </form>
                            <a href="/BlogPeliculas/admin/categorias/actualizar.php?id=<?php echo $categoria->id; ?>" class="actualizar">Actualizar</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </main>

<?php 
    incluirTemplate('footer');
?>