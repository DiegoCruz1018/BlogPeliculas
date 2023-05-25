<?php 
    require '../../includes/app.php';

    use App\Usuario;
    use App\Categoria;
    use App\Rol;

    //estaAutenticado();

    iniciarSession();
    isAdmin();

    $auth = $_SESSION['login'] ?? false;

    $usuario = new Usuario;

    //Consulta para obtener las categorias
    $categorias = Categoria::all();

    //Consulta para obtener los roles
    $roles = Rol::all();

    //arreglo con mensajes de errores
    $errores = Usuario::getErrores();

    if($_SERVER['REQUEST_METHOD'] === 'POST'){

        // Crea una nueva instancia
        $usuario = new Usuario($_POST['usuario']);

        //Validar
        $errores = $usuario->validarNuevaCuenta();

        if(empty($errores)){

            //Verificar que el usuario no este registrado
            $resultado = $usuario->existeUsuario();

            if($resultado->num_rows){
                $errores = Usuario::getErrores();
            }else{
                //Hashear el password
                $usuario->hashPassword();

                //Guarda en la BD
                $resultado = $usuario->crear();

                if($resultado){
                    //Redireccionar al usuario
                    header('Location: /BlogPeliculas/admin/indexUsuario.php?resultado=1');
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
        <h1>Crear Usuario</h1>

        <div class="d-flex justify-content-start mb-4">
            <a class="boton" href="/BlogPeliculas/admin/indexUsuario.php">Volver</a>
        </div>

        <?php foreach($errores as $error): ?>
            <div class="error">
                <?php echo $error ?>
            </div>
        <?php endforeach; ?>

        <form class="formulario" method="POST" enctype="multipart/form-data">
            
            <?php include '../../includes/templates/formulario_usuarios.php'; ?>

            <fieldset>
                <legend>Confirmar cuenta</legend>

                <label for="confirmado" >Confirmado</label>
                <select name="usuario[confirmado]" id="confirmado">
                    <option selected>-- Seleccione --</option>
                    <option <?php echo $usuario->confirmado; ?> value="1" > Confirmado </option>
                </select>
            </fieldset>

            <div class="d-flex justify-content-end mb-4">
                <input type="submit" value="Crear Usuario" class="crear">
            </div>
        </form>
    </main>

<?php 
    incluirTemplate('footer');
?>