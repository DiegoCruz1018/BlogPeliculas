<?php 
    include 'includes/app.php';
    incluirTemplate('header', $inicio = false);
?>  

    <main class="container mt-5">
        <h1>Categoría</h1>

        <div class="row">
            <div class="col-lg-4 mb-2">
                    <a href="pelicula.php">
                        <img loading="lazy" src="img/joker.jpg" alt="Imagen Pelicula">

                        <div class="contenido-pelicula" style="background-color: #cb0000;">
                            <h3 class="mb-1 text-light nombre-pagina">Joker</h3>
                            <p class="text-light">2019</p>
                        </div>
                    </a>
                </div>
                
                <div class="col-lg-4 mb-2">
                    <a href="pelicula.php">
                        <img loading="lazy" src="img/joker.jpg" alt="Imagen Pelicula">

                        <div class="contenido-pelicula" style="background-color: #cb0000;">
                            <h3 class="mb-1 text-light">Joker</h3>
                            <p class="text-light">2019</p>
                        </div>
                    </a>
                </div>
                
                <div class="col-lg-4 mb-2">
                    <a href="pelicula.php">
                        <img loading="lazy" src="img/joker.jpg" alt="Imagen Pelicula">

                        <div class="contenido-pelicula" style="background-color: #cb0000;">
                            <h3 class="mb-1 text-light">Joker</h3>
                            <p class="text-light">2019</p>
                        </div>
                    </a>
                </div>
                
                <div class="col-lg-4 mb-2">
                    <a href="pelicula.php">
                        <img loading="lazy" src="img/joker.jpg" alt="Imagen Pelicula">

                        <div class="contenido-pelicula" style="background-color: #cb0000;">
                            <h3 class="mb-1 text-light">Joker</h3>
                            <p class="text-light">2019</p>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </main>

<?php 
    incluirTemplate('footer');
?>