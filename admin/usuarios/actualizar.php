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