<fieldset>
                
    <legend>Información de la Pelicula</legend>

    <label for="titulo">Titulo:</label>
    <input type="text" name="pelicula[titulo]" placeholder="Titulo de la Pelicula" id="titulo" value="<?php echo s($pelicula->titulo); ?>">

    <label for="imagen">Imagen:</label>
    <input type="file" id="imagen" accept="image/jpeg, image/png" name="pelicula[imagen]">

    <?php if($pelicula->imagen): ?>
        <img src="../../imagenes/<?php echo $pelicula->imagen; ?>" class="imagen-small">
    <?php endif; ?>

    <label for="director">Director:</label>
    <input type="text" name="pelicula[director]" placeholder="Director de la Pelicula" id="director" value="<?php echo s($pelicula->director); ?>">

    <label for="protagonista">Protagonista:</label>
    <input type="text" name="pelicula[protagonista]" placeholder="Protagonista de la Pelicula" id="protagonista" value="<?php echo s($pelicula->protagonista); ?>">

    <label for="estreno">Año de Estreno:</label>
    <input type="text" name="pelicula[estreno]" placeholder="Año de Estreno de la Pelicula" id="estreno" value="<?php echo s($pelicula->estreno); ?>">

    <label for="sipnosis">Sinopsis:</label>
    <textarea id="sipnosis" name="pelicula[sipnosis]"><?php echo s($pelicula->sipnosis); ?></textarea>

</fieldset>

<fieldset>
    <legend>Seleccione la categoria de la Pelicula</legend>

    <label for="categoria">Categoria</label>
    <select name="pelicula[idCategoria]" id="categoria">
        <option selected value="">-- Seleccione --</option>
        <?php foreach($categorias as $categoria): ?>   
            <option <?php echo $pelicula->idCategoria === $categoria->id ? 'selected' : ''; ?> value="<?php echo s($categoria->id); ?>" > <?php echo s($categoria->nombre); ?> </option>
        <?php endforeach; ?>
    </select>
</fieldset>