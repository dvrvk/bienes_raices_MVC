<fieldset>
            <legend>Información General</legend>
            
            <label for="titulo">Titulo:</label>
            <input type="text" name="propiedad[titulo]" id="titulo" placeholder="Titulo Propiedad" value="<?php echo s($propiedad->titulo); ?>">

            <label for="precio">Precio:</label>
            <input type="number"  name="propiedad[precio]" id="precio" placeholder="Precio Propiedad" value="<?php echo s($propiedad->precio); ?>">

            <label for="imagen">Imagen:</label>
            <input type="file"  name="propiedad[imagen]" id="imagen" accept="image/jpeg, imagen/png">
            <?php if($propiedad->imagen): ?>
                <img src="/imagenes/<?php echo $propiedad->imagen; ?>" class="imagen-small" alt="">
            <?php endif; ?>

            <label for="descripcion">Descripción:</label>
            <textarea id="descripcion" name="propiedad[descripcion]"><?php echo s($propiedad->descripcion); ?></textarea>
        </fieldset>

        <fieldset>
            <legend>Información Propiedad</legend>
            
            <label for="habitaciones">Habitaciones:</label>
            <input type="number" name="propiedad[habitaciones]" id="habitaciones" placeholder="Ej: 3" min="1" max="15" value="<?php echo s($propiedad->habitaciones); ?>">

            <label for="wc">Baños:</label>
            <input type="number" name="propiedad[wc]" id="wc" placeholder="Ej: 2" min="1" max="15" value="<?php echo s($propiedad->wc); ?>">

            <label for="estacionamiento">Plazas Garaje:</label>
            <input type="number" name="propiedad[estacionamiento]" id="estacionamiento" placeholder="Ej: 1" min="1" max="15" value="<?php echo s($propiedad->estacionamiento); ?>">

        </fieldset>

        <fieldset>
            <legend>Vendedor</legend>
            
            <label for="vendedor">Vendedor</label>
            <select name="propiedad[vendedorId]" id="vendedor">
                <option selected disabled value="">-- Seleccione --</option>
                <?php foreach($vendedores as $vendedor) : ?>
                    <option <?php echo $propiedad->vendedorId === $vendedor->id ? 'selected' : ''; //Guarda la selección?> 
                        value="<?php echo s($vendedor->id); ?>">
                        <?php echo s($vendedor->nombre) . " " . s($vendedor->apellido); ?>
                    </option>
                <?php endforeach; ?>
            </select>

        </fieldset>