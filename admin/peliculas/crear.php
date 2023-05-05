<?php 
    require '../../includes/app.php';

    use App\Pelicula;
    use App\Categoria;
    use Intervention\Image\ImageManagerStatic as Image;

    //estaAutenticado();

    $pelicula = new Pelicula;

    //Consulta para obtener las categorias
    $categorias = Categoria::all();

    //arreglo con mensajes de errores
    $errores = Pelicula::getErrores();

    if($_SERVER['REQUEST_METHOD'] === 'POST'){

        // Crea una nueva instancia
        $pelicula = new Pelicula($_POST['pelicula']);

        /* SUBIDA DE ARCHIVOS */

        //Genera un nombre único
        $nombreImagen = md5(uniqid(rand(), true)) . ".jpg";

        //Setear la imagen
        //Realiza un resize a la imagen con intervention
        if($_FILES['pelicula']['tmp_name']['imagen']){
            $image = Image::make($_FILES['pelicula']['tmp_name']['imagen'])->fit(800, 600);
            $pelicula->setImagen($nombreImagen);
        }

        //Validar
        $errores = $pelicula->validar();

        if(empty($errores)){

            //Crear la carpeta para subir imagenes
            $carpetaImagenes = '../../imagenes/';

            if(!is_dir(CARPETA_IMAGENES)){
                mkdir(CARPETA_IMAGENES);
            }

            //Guarda la imagen en el servidor
            $image->save(CARPETA_IMAGENES . $nombreImagen);

            //Guarda en la BD
            $pelicula->guardar();
        }
    }

    incluirTemplate('header', $inicio = false);
?>  

    <main class="container mt-5">
        <h1>Crear Peliculas</h1>

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
                <input type="submit" value="Crear Pelicula" class="crear">
            </div>
        </form>
    </main>

<?php 
    incluirTemplate('footer');
?>