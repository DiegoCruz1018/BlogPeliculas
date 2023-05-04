<?php 
    require '../../includes/app.php';

    use App\Categoria;

    $categoria = new Categoria;

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
            $categoria->guardar();
        }
    }

    incluirTemplate('header', $inicio = false);
?>  

    <main class="container mt-5">
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
    </main>

<?php 
    incluirTemplate('footer');
?>