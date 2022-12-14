<div class="contenedor-anuncios">
    <?php foreach($propiedades as $propiedad): ?>
                <div class="anuncio" data-cy="anuncio">
                    
                    <img src="/imagenes/<?php echo $propiedad->imagen;?>" alt="anuncio" loading="lazy">
                    
                    <div class="contenido-anuncio">
                        <h3><?php 
                            echo truncate($propiedad->titulo,20);
                            ?>
                        </h3>
                        <p><?php 
                            echo truncate($propiedad->descripcion, 100);
                        ?>
                        </p>
                        <p class="precio"><?php echo $propiedad->precio;?>€</p>
                        <ul class="iconos-caracteristicas">
                            <li>
                                <img class="iconos" loading="lazy" src="build/img/icono_wc.svg" alt="icono wc">
                                <p><?php echo $propiedad->wc;?></p>
                            </li>
                            <li>
                                <img class="iconos" loading="lazy" src="build/img/icono_estacionamiento.svg" alt="icono estacionamiento">
                                <p><?php echo $propiedad->estacionamiento;?></p>
                            </li>
                            <li>
                                <img class="iconos" loading="lazy" src="build/img/icono_dormitorio.svg" alt="icono dormitorio">
                                <p><?php echo $propiedad->habitaciones;?></p>
                            </li>
                        </ul>
    
                        <a data-cy="enlace-propiedad" href="/propiedad?id=<?php echo $propiedad->id; ?>" class="boton-amarillo-block">Ver Propiedad</a>
                    </div> <!--.contenido-anuncio-->
                </div> <!--.anuncio-->
    <?php endforeach; ?>

</div> <!--.contenedor-anuncios-->