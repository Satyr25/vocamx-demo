<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\ActiveForm;
?>
<div id="bloque-header"></div>
<div id="seleccion-envio">
    <div id="direccion-seleccionada">
        <div class="container">
            <h2>¿Dónde quieres recibir tu bomber?</h2>
            <?= Html::img('@web/images/pin.png', ['class' => 'pin']) ?>
            <div class="direccion-seleccionada">
                <?php if($direccion){ ?>
                    <div>C.P. <?= $direccion->cp ?></div>
                    <div><?= $direccion->calle.' '.$direccion->num_ext.($direccion->num_int ? ' / '.$direccion->num_int : '') ?></div>
                    <div><?= $direccion->colonia ?></div>
                    <?php if($direccion->pais){ ?>
                        <?= $direccion->ciudad ?>, <?= $direccion->estado ?>. <?= $direccion->pais ?>
                    <?php } ?>
                <?php } ?>
            </div>
            <a href="<?= Url::to(['direcciones/']) ?>" id="otra-direccion">
                Agregar dirección
            </a>
        </div>
    </div>
    <div id="seleccionar-envio">
        <div class="container">
            <?php if(!$direccion){ ?>
                <div id="mensaje-direccion">
                    Para continuar, primero agrega un domicilio.
                </div>
            <?php }else{ ?>
                <h2>Recuerda que la producción de tu Bomber toma 4 días.</h2>
                <h2>¿Qué envío prefieres?</h2>
                <?php if(count($costos_envio) == 1 && isset($costos_envio[""])){ ?>
                    <div id="no-envio">
                        No encontramos un proveedor para hacer tu envío.
                        ¿Estás seguro de que tu dirección es correcta?
                    </div>
                <?php }else{ ?>
                    <div class="metodos-envio">
                        <?php $form = ActiveForm::begin([
                            'method' => 'post',
                            'id' => 'formulario-envio'
                        ]); ?>
                        <div class="form-group field-pedidoform-clave required">
                            <?php foreach($costos_envio as $costo => $envios){  ?>
                                <?php foreach($envios as $envio){ ?>
                                    <?php if($envio['proveedor'] != 'redpack' || $envio['proveedor'] != 'ivoy'){ ?>
                                        <label class="modal-radio">
                                            <div class="contenedor-input">
                                                <input
                                                    name="PedidoForm[envio]"
                                                    value="<?= $envio['rate_id'] ?>|<?= $envio['shipment_id'] ?>|<?= $envio['servicio'] ?>|<?= $envio['costo']*1.16 ?>|<?= $envio['proveedor'] ?>|<?= $envio['carrier_service_code'] ?>|<?= $envio['fecha_estimada'] ?>"
                                                    type="radio"
                                                    />
                                            </div>
                                            <span class="nombre-envio">
                                                <span class="nombre-proveedor">
                                                    <?= $envio['proveedor'] ?>
                                                </span>
                                                <?php if($envio['servicio']){ ?>
                                                    <span class="nombre-servicio">
                                                        <span>Fecha estimada de entrega:</span><br>
                                                        <?= $envio['fecha_estimada'] ?>
                                                    </span>
                                                <?php } ?>
                                            </span>
                                            <span class="costo-envio">
                                                $<?= number_format($envio['costo']*1.16,2) ?>
                                            </span>
                                            <div class="clear"></div>
                                        </label>
                                    <?php } ?>
                                <?php } ?>
                            <?php } ?>
                        </div>
                        <?= $form->field($pedido, 'cliente_id')->hiddenInput()->label(false) ?>
                        <?= Html::submitButton('Continuar', ['class' => 'btn btn-accion', 'name' => 'continuar', 'id' => 'continuar-compra']) ?>
                        <?php ActiveForm::end(); ?>
                    </div>
                <?php } ?>
            <?php } ?>
        </div>
    </div>
</div>

