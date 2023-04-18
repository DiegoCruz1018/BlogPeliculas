<?php 
    include 'includes/app.php';
    incluirTemplate('header-login', $inicio = false);
?>  

        <div class="contenedor-app">
            <div class="imagen"></div>

            <div class="app">
                <h1 class="nombre-pagina">Crear Cuenta</h1></h1>
                <p class="descripcion-pagina">Llena el formulario para crear una cuenta</p>

                <form class="form" method="POST">
                    <div class="campo">
                        <label for="nombre">Nombre:</label>
                        <input 
                            type="text"
                            id="nombre"
                            name="nombre"
                            placeholder="Tu Nombre"
                        >
                    </div>

                    <div class="campo">
                        <label for="apellido">Apellido:</label>
                        <input 
                            type="text"
                            id="apellido"
                            name="apellido"
                            placeholder="Tu Apellido"
                        >
                    </div>

                    <div class="campo">
                        <label for="telefono">Teléfono:</label>
                        <input 
                            type="tel"
                            id="telefono"
                            name="telefono"
                            placeholder="Tu Teléfono"
                        >
                    </div>

                    <div class="campo">
                        <label for="email">Email:</label>
                        <input 
                            type="email"
                            id="email"
                            name="email"
                            placeholder="Tu Email"
                        >
                    </div>

                    <div class="campo">
                        <label for="password">Password:</label>
                        <input 
                            type="password"
                            id="password"
                            name="password"
                            placeholder="Tu Password"
                        >
                    </div>

                    <input type="submit" class="boton" value="Crear Cuenta">
                </form>

                <div class="acciones">
                    <a href="login.php">¿Ya tienes una cuenta? Inicia Sesión</a>
                    <a href="olvide-password.php">¿Olvidaste tu Password?</a>
                </div>
            </div>
        </div>

<?php 
    incluirTemplate('footer-login'); 
?>