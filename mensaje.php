<?php
    include 'includes/app.php';

    incluirTemplate('header-login', $inicio = false);
?>

        <div class="contenedor-app">
            <div class="imagen"></div>

            <div class="app">
                <h1 class="nombre-pagina">Confirma tu Cuenta</h1>
                <p class="descripcion-pagina">
                    Hemos enviado las instrucciones para confirmar tu cuenta a tu e-mail.
                </p>

                
            </div>
        </div>

<?php
    incluirTemplate('footer-login');
?>