<?php 
    require '../../includes/app.php';

    use App\Categoria;

    $categoria = new Categoria;

    //Arreglo con mensajes de errores
    $errores = Categoria::getErrores();

    if($_SERVER['REQUEST_METHOD'] === 'POST'){
   
        //Creando una nueva instancia
        $categoria = new Categoria($_POST['categoria']);

        $errores = $categoria->validar();

        if(empty($errores)){ 
            //Guardar en la BD
            $categoria->guardar();
        }
    }

    incluirTemplate('header', $inicio = false);
?>  

    <main class="container mt-5">
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
    </main>

<?php 
    incluirTemplate('footer');
?>