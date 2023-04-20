<?php 
    include 'includes/app.php';
    incluirTemplate('header', $inicio = false);
?>  

    <main class="container">
        <h1 class="mt-5">Contacto</h1>

        <img src="img/contacto.jpg" alt="Imagen Contacto">

        <h2 class="descripcion-pagina">Llene el formulario de contacto</h2>

        <form class="formulario">
            <fieldset>
                    
                <label for="nombre">Nombre:</label>
                <input type="text" name="nombre" placeholder="Tu Nombre" id="nombre">

                <label for="apellido">Apellido:</label>
                <input type="text" name="apellido" placeholder="Tu Apellido" id="apellido">

                <label for="email">E-mail:</label>
                <input type="email" name="email" placeholder="Tu Email" id="email">

                <label for="telefono">Telefono:</label>
                <input type="tel" name="telefono" placeholder="Tu Telefono" id="telefono">

                <label for="mensaje">Mensaje:</label>
                <textarea id="mensaje" name="mensaje" placeholder="Escribenos tu opinion..."></textarea>
            </fieldset>

            <div class="d-flex justify-content-end">
                <input type="submit" value="Enviar" class="boton">
            </div>
        </form>
    </main>

<?php 
    incluirTemplate('footer');
?>