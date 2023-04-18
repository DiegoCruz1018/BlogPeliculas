<?php 
    include 'includes/templates/header.php';
?>  

    <main class="contenedor seccion">
        <h1 class="nombre-pagina">Contacto</h1>

        <img class="img-fluid rounded mx-auto d-block" src="img/contacto.jpg" alt="Imagen Contacto">

        <h2 class="descripcion-pagina">Llene el formulario de contacto</h2>

        <form class="formulario" method="POST">
            <fieldset>
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
                    <label for="mensaje">Mensaje:</label>
                    <textarea 
                        id="mensaje"
                        name="mensaje"
                        placeholder="Escribenos tu opinion..."
                    ></textarea>
                </div>
            </fieldset>

            <div class="d-flex justify-content-end">
                <input type="submit" class="boton" value="Enviar">
            </div>
        </form>
    </main>

<?php 
    include 'includes/templates/footer.php';
?>