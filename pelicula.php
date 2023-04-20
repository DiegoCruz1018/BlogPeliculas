<?php 
    include 'includes/app.php';
    incluirTemplate('header', $inicio = false);
?>  

    <main class="container mt-5 mb-5">
        <h1>Joker</h1>

        <div class="row">
            <div class="col-md-6">
                <img src="img/joker.jpg" alt="Imagen Pelicula">
            </div>
            <div class="col-md-6">
                <h2 class="nombre-pagina">Director: 
                    <span>Joker</span>
                </h2>
                <h2 class="nombre-pagina">Protagonista: <span>Joker</span></h2>
                <h2 class="nombre-pagina">Sipnosis: </h2>
                <p>
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Libero 
                    laboriosam error iure. Debitis distinctio corrupti nulla blanditiis 
                    numquam sed temporibus ipsam cumque? Mollitia excepturi itaque omnis, 
                    odit culpa quaerat earum.
                </p>
            </div>
        </div>
    </main>

<?php 
    incluirTemplate('footer');
?>