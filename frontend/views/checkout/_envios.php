<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
?>
<div id="seleccion-envio" class="<?php  echo (Yii::$app->user->isGuest ? 'oculto' : '') ?>">
    <div id="direccion-seleccionada">
        <div class="container">
            <h2>¿Dónde quieres recibir tu chamarra?</h2>
            <?= Html::img('@web/images/ubicacionCO.png', ['class' => 'pin']) ?>
            <div class="direccion-seleccionada">
                <?php if ($direccion) : ?>
                    <div> Domicilio: <?= $direccion->calle . ' ' . $direccion->num_ext . ($direccion->num_int ? ' / ' . $direccion->num_int : '') ?></div>
                    <div><?= $direccion->colonia ?></div>
                    <div>
                        <a href="javascript:;" class="link-rojo" id="editar-direccion">Editar dirección</a>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <div id="seleccionar-envio">
        <?php if (!$direccion): ?>
        <div id="mensaje-direccion">
            Para continuar, primero agrega un domicilio.
        </div>
        <?php else: ?>
        <div class="text-center bloque-info-produccion">
            <i class="fas fa-info-circle"></i>
            <p>Recuerda que la producción de tu chamarra puede variar de <strong>2 a 7 días habiles</strong> dependiendo de tu código postal.</p>
        </div>
        <h2>¿Qué envío prefieres?</h2>
            <?php if (count($costos_envio) == 1 && isset($costos_envio[""])) : ?>
            <div id="no-envio">
                No encontramos un proveedor para hacer tu envío.
                ¿Estás seguro de que tu dirección es correcta?
            </div>
            <?php else: ?>
            <div class="metodos-envio">
                <?php $form = ActiveForm::begin([
                    'method' => 'post',
                    'id' => 'formulario-envio'
                ]); ?>
                <div class="form-group field-pedidoform-clave required">
                    <?php $contador_envios = 1; ?>
                    <?php foreach ($costos_envio as $costo => $envios) { ?>
                        <?php foreach ($envios as $envio) { ?>
                            <?php if ($envio['proveedor'] != 'redpack' || $envio['proveedor'] != 'ivoy') { ?>
                                <?php
                                if($contador_envios == 4){
                                ?>
                                <div class="btn-muestra-wrapper">
                                    <a href="javascript:;" class="link-rojo" id="muestra-envios-ocultos">Ver más opciones</a>
                                </div>
                                <div class="envios-ocultos oculto">
                                <?php
                                }
                                ?>
                                <label class="modal-radio">
                                    <div class="contenedor-input">
                                        <input
                                            name="PedidoForm[envio]"
                                            value="<?= $envio['rate_id'] ?>|<?= $envio['shipment_id'] ?>|<?= $envio['servicio'] ?>|<?= $envio['costo'] * 1.16 ?>|<?= $envio['proveedor'] ?>|<?= $envio['carrier_service_code'] ?>|<?= $envio['fecha_estimada'] ?>"
                                            type="radio"
                                            />
                                    </div>
                                    <span class="nombre-envio">
                                        <span class="nombre-proveedor">
                                            <?= $envio['proveedor'] ?>
                                        </span>
                                        <?php if ($envio['servicio']) { ?>
                                            <span class="nombre-servicio">
                                                <span class="fecha-text">Fecha estimada de entrega:</span>
                                                <span class="fecha"><?= $envio['fecha_estimada'] ?></span>
                                            </span>
                                        <?php
                                    } ?>
                                    </span>
                                    <span class="costo-envio">
                                        $<?= number_format($envio['costo'] * 1.16, 2) ?>
                                    </span>
                                    <div class="clear"></div>
                                </label>
                                <?php $contador_envios++; ?>
                            <?php } ?>
                        <?php } ?>
                    <?php } ?>
                </div>
                </div>
                <?= $form->field($pedido, 'cliente_id')->hiddenInput()->label(false) ?>
                <?php ActiveForm::end(); ?>
            </div>
            <?php endif; ?>
        <?php endif; ?>
    </div>
    <div class="mensaje-cupon-envios hidden">
        Ha sido aplicado el envio gratuito, continue al siguiente paso.
    </div>
    <button type="button" id="envio-chk-btn" class="btn btn-accion">Proceder</button>
</div>
