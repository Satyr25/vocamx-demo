<?php
use yii\helpers\Html;
 ?>

<div id="seleccion-envio" class='oculto'>
    <div id="direccion-seleccionada">
        <div class="container">
            <h2>¿Dónde quieres recibir tu chamarra?</h2>
            <?= Html::img('@web/images/ubicacionCO.png', ['class' => 'pin']) ?>
            <div class="direccion-seleccionada">
                    <div> Domicilio: <span class="calle-text"></span></div>
                    <div class="colonia-text"></div>
                    <div>
                        <a href="javascript:;" class="link-rojo" id="editar-direccion">Editar dirección</a>
                    </div>
            </div>
        </div>
    </div>
    <div id="seleccionar-envio">
        <div class="text-center bloque-info-produccion">
            <i class="fas fa-info-circle"></i>
            <p >Tiempo de entrega aproximado <strong><span id='mensaje-envio'>0</span></strong> dependiendo de tu código postal.</p>
        </div>
        <div><h2>El costo del envío es de <span class="costo-envio"></span></h2></div>
    </div>
    <div class="mensaje-cupon-envios hidden">
        Ha sido aplicado el envio gratuito, continue al siguiente paso.
    </div>
    <button type="button" id="envio-chk-btn" class="btn btn-accion">Proceder</button>
</div>
