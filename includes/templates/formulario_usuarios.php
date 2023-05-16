
    <div class="campo">
        <label class="me-lg-1" for="nombre">Nombre:</label>
        <input 
            type="text"
            id="nombre"
            name="usuario[nombre]"
            placeholder="Tu Nombre"
            value="<?php echo s($usuario->nombre); ?>"
        >
    </div>

    <div class="campo">
        <label for="apellido">Apellido:</label>
        <input 
            type="text"
            id="apellido"
            name="usuario[apellido]"
            placeholder="Tu Apellido"
            value="<?php echo s($usuario->apellido); ?>"
        >
    </div>

    <div class="campo">
        <label for="telefono">Teléfono:</label>
        <input 
            type="tel"
            id="telefono"
            name="usuario[telefono]"
            placeholder="Tu Teléfono"
            value="<?php echo s($usuario->telefono); ?>"
        >
    </div>

    <div class="campo">
        <label for="email">Email:</label>
        <input 
            type="email"
            id="correo"
            name="usuario[correo]"
            placeholder="Tu Email"
            value="<?php echo s($usuario->correo); ?>"
        >
    </div>

    <div class="campo">
        <label for="password">Password:</label>
        <input 
            type="password"
            id="password"
            name="usuario[password]"
            placeholder="Tu Password"
            value="<?php echo s($usuario->password); ?>"
        >
    </div>

    <fieldset>
        <legend>Seleccione el Rol del Usuario</legend>
    
        <label for="rol">Rol</label>
        <select name="usuario[idRol]" id="rol">
            <option selected value="">-- Seleccione --</option>
            <?php foreach($roles as $rol): ?>   
                <option <?php echo $usuario->idRol === $rol->id ? 'selected' : ''; ?> value="<?php echo s($rol->id); ?>" > <?php echo s($rol->nombre); ?> </option>
            <?php endforeach; ?>
        </select>
    </fieldset>
