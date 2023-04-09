<?php 
    include 'includes/templates/header-login.php'
?>
        <div class="contenedor-app">
            <div class="imagen"></div>

            <div class="app">
                <h1 class="nombre-pagina" >Login</h1>
                <p class="descripcion-pagina">Inicia Sesión con tus datos</p>

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

                    <div class="campo">
                        <label for="password">Password</label>
                        <input 
                            type="password"
                            id="password"
                            name="password"
                            placeholder="Tu Password"
                        >
                    </div>

                    <input type="submit" class="boton" value="Iniciar Sesión">
                </form>

                <div class="acciones">
                    <a href="crear-cuenta.php">¿Aún no tienes una cuenta? Crear Una</a>
                    <a href="olvide-password.php">¿Olvidaste tu Password?</a>
                </div>
            </div>
        </div>

<?php 
    include 'includes/templates/footer-login.php'
?>