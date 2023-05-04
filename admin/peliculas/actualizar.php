<?php
    require '../../includes/app.php';

    use App\Pelicula;
    use App\Categoria;
    use Intervention\Image\ImageManagerStatic as Image;

    //estaAutenticado();

    //Consulta para obtener las categorias
    $categorias = Categoria::all();

    //Validar la URL por ID válido
    $id = $_GET['id'];
    $id = filter_var($id, FILTER_VALIDATE_INT);

    if(!$id){
        header('Location: /BlogPeliculas/admin/indexPeliculas.php');
    }

    //Obtener los datos de la pelicula
    $pelicula = Pelicula::find($id);

    //Consulta para obtener las categorias
    $consulta = "SELECT * FROM categorias";
    $resultado = mysqli_query($db, $consulta);

    //Arreglo con errores
    $errores = Pelicula::getErrores();

    //Ejecutar el código después de que el usuario envia el formulario
    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        
        //Asignar los atributos
        $args = $_POST['pelicula'];

        $pelicula->sincronizar($args);

        //Validación 
        $errores = $pelicula->validar();

        /* SUBIDA DE ARCHIVOS */

        //Genera un nombre único
        $nombreImagen = md5(uniqid(rand(), true)) . ".jpg";

        //Setear la imagen
        //Realiza un resize a la imagen con intervention
        if($_FILES['pelicula']['tmp_name']['imagen']){
            $image = Image::make($_FILES['pelicula']['tmp_name']['imagen'])->fit(800, 600);
            $pelicula->setImagen($nombreImagen);
        }

        if(empty($errores)){
            //Almacenar la imagen
            if($_FILES['pelicula']['tmp_name']['imagen']){
                $image->save(CARPETA_IMAGENES . $nombreImagen);
            }

            $pelicula->guardar();
        }
    }

    incluirTemplate('header', $inicio = false);
?>  

    <main class="container mt-5">
        <h1>Actualizar Pelicula</h1>

        <div class="d-flex justify-content-start mb-4">
            <a class="boton" href="/BlogPeliculas/admin/indexPelicula.php">Volver</a>
        </div>

        <?php foreach($errores as $error): ?>
            <div class="error">
                <?php echo $error ?>
            </div>
        <?php endforeach; ?>

        <form class="formulario" method="POST" enctype="multipart/form-data">

            <?php include '../../includes/templates/formulario_peliculas.php'; ?>

            <div class="d-flex justify-content-end mb-4">
                <input type="submit" value="Actualizar Pelicula" class="crear">
            </div>
        </form>
    </main>

<?php 
    incluirTemplate('footer');
?>