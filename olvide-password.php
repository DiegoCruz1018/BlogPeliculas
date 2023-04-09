<?php 
    include 'includes/templates/header-login.php'
?>
        <div class="contenedor-app">
            <div class="imagen"></div>

            <div class="app">
                <h1 class="nombre-pagina">Olvidé Password</h1>
                <p class="descripcion-pagina">Reestablece tu Password</p>

                <form class="form" method="POST">
                    <div class="campo">
                        <label for="email">Email:</label>
                        <input 
                            type="email"
                            id="email"
                            name="email"
                            placeholder="Tu E-mail"
                        >
                    </div>

                    <input type="submit" class="boton" value="Enviar Instrucciones">
                </form>

                <div class="acciones">
                    <a href="login.php">¿Ya tienes una cuenta? Inicia Sesión</a>
                    <a href="crear-cuenta.php">¿Aún no tienes una cuenta? Crear Una</a>
                </div>
            </div>
        </div>

<?php 
    include 'includes/templates/footer-login.php'
?>