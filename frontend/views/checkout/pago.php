<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\ActiveForm;
use app\models\Foto;
?>
<div id="bloque-header"></div>
<div id="confirmacion-pedido">
    <div class="container">
        <h2>Detalle de la compra</h2>
        <div class="bombers-compradas">
            <?php $total_productos = 0; ?>
            <?php foreach($productos as $producto){ ?>
                <?php $total_productos += $producto->total; ?>
                <?php $foto = Foto::find()->where('producto_id='.$producto->producto)->one() ?>
                <div class="bomber">
                    <div class="imagen-bomber">
                        <?php if($producto->diseno){ ?>
                            <?= Html::img('@web/images/'.$producto->imagen_personalizada, ['class' => 'foto-bomber']) ?>
                        <?php }else{ ?>
                            <?= Html::img('@web/images/'.$foto->archivo, ['class' => 'foto-bomber']) ?>
                        <?php } ?>
                    </div>
                    <div class="datos-bomber">
                        <div class="nombre-producto">
                            <?= $producto->nombre ?>
                        </div>
                        <?php if($producto->diseno){ ?>
                            <div class="campo-producto">
                                <span class="campo-nombre">Frase: </span>
                                <span class="campo-valor"><?= implode(' ', [$producto->linea1,$producto->linea2,$producto->linea3]) ?></span>
                            </div>
                        <?php } ?>
                        <div class="campo-producto">
                            <span class="campo-nombre">Talla: </span>
                            <span class="campo-valor"><?= $producto->talla ?></span>
                        </div>
                        <div class="campo-producto">
                            <span class="campo-nombre">Modelo: </span>
                            <span class="campo-valor"><?= $producto->categoria ?></span>
                        </div>
                        <div class="campo-producto">
                            <span class="campo-nombre">Cantidad: </span>
                            <span class="campo-valor"><?= $producto->cantidad ?></span>
                        </div>
                        <div class="campo-producto">
                            <span class="campo-nombre">Precio: </span>
                            <span class="campo-valor">$<?= number_format(($producto->total),2) ?></span>
                        </div>
                    </div>
                    <div class="clear"></div>
                </div>
            <?php } ?>
        </div>
        <div id="desglose-cargos">
            <div class="cargo">
                <h2>Envío</h2>
                <div class="desglose-cargo">
                    <?= $envio->proveedor ?>
                    <span>$<?= number_format($envio->costo,2) ?></span>
                    <br>
                    <span class="campo-nombre">Entrega estimada:</span>
                    <span><?= $envio->entrega_estimada ?></span>
                </div>
            </div>

            <div class="cargo">
                <h2>Total</h2>
                <div class="desglose-cargo">
                    <div class="total-compra">
                        $<?= number_format($envio->costo+$total_productos,2) ?>
                    </div>
                </div>
            </div>
        </div>

        <!-- <div id="pagar">
            <h2>Pagar con PayPal</h2>
            <?= Html::img('@web/images/pago/paypal.png') ?>
            <?= Html::img('@web/images/pago/visa.png') ?>
            <?= Html::img('@web/images/pago/mastercard.png') ?>
            <a href="<?= $enlace_paypal ?>" class="btn-accion" id="terminar-compra">
                Pagar
            </a>
        </div> -->
        <div id="metodos-pago">
            <div class="container">
                <h2>¿Cómo quieres pagar?</h2>
                <div id="metodos-guardados">
                    <?php if($tarjetas){ ?>
                        <h3>Medios sugeridos</h3>
                        <?php foreach($tarjetas as $tarjeta){ ?>
                            <div class="tarjeta" id="tarjeta-<?= $tarjeta->id ?>">
                                <div class="tarjeta-activa">
                                    <input
                                        type="radio"
                                        name="metodo-pago"
                                        id="<?= $tarjeta->id ?>"
                                    />
                                </div>
                                <div class="tipo-tarjeta">
                                    <label for="<?= $tarjeta->id ?>">
                                        <?php if($tarjeta->brand == 'mastercard'){ ?>
                                            <?= Html::img('@web/images/tarjetas/mc.png') ?>
                                        <?php }else if($tarjeta->brand == 'visa'){ ?>
                                            <?= Html::img('@web/images/tarjetas/visa.png') ?>
                                        <?php }else{ ?>
                                            <?= Html::img('@web/images/tarjetas/amex.png') ?>
                                        <?php } ?>
                                    </label>
                                </div>
                                <div class="numero-tarjeta">
                                    <label for="<?= $tarjeta->id ?>">
                                        <?= $tarjeta->serializableData['card_number'] ?>
                                    </label>
                                </div>
                                <div class="clear"></div>
                            </div>
                        <?php } ?>
                    <?php } ?>
                </div>
                <div id="registrar-metodo">
                    <?php if($tarjetas){ ?>
                        <h3>Otros medios</h3>
                    <?php } ?>
                    <div class="metodo-pago">
                        <div class="input-metodo">
                            <input type="radio" name="metodo-pago" id="metodo-tarjeta">
                        </div>
                        <div class="imagen-metodo">
                            <label for="metodo-tarjeta">
                                <?= Html::img('@web/images/pago/tarjeta.png') ?>
                            </label>
                        </div>
                        <div class="nombre-metodo">
                            <label for="metodo-tarjeta">
                                Tarjeta Bancaria
                            </label>
                        </div>
                    </div>
                    <?php $form = ActiveForm::begin([
                        'method' => 'post',
                        'id' => 'tarjeta-openpay'
                    ]); ?>
                        <?= Html::img('@web/images/tarjetas/visa.png') ?>
                        <?= Html::img('@web/images/tarjetas/mc.png') ?>
                        <?= Html::img('@web/images/tarjetas/amex.png') ?>
                        <?= Html::img('@web/images/tarjetas/openpay.png') ?>
                        <div id="tipo-tarjeta">
                            <?= $form->field($tarjetaForm, 'tipo_tarjeta')->radioList(['CRE' => 'Crédito', 'DEB' => 'Debito'])->label(false); ?>
                        </div>
                        <div class="clear"></div>
                        <?= $form->field($tarjetaForm, 'token')->hiddenInput(['id' => 'token_id'])->label(false) ?>
                        <?= $form->field($tarjetaForm, 'device_session_id')->hiddenInput(['id' => 'device_session_id'])->label(false) ?>
                        <?= $form->field($tarjetaForm, 'numero_pedido')->hiddenInput()->label(false) ?>
                        <?= Html::input(
                            'text',
                            '',
                            '',
                            [
                                'placeholder' => 'Nombre',
                                'class' => 'campo-openpay',
                                'autocomplete' => 'off',
                                'data-openpay-card' => 'holder_name',
                                'id' => 'nombre-tarjeta'
                            ]
                        ) ?>
                        <?= Html::input(
                            'text',
                            '',
                            '',
                            [
                                'placeholder' => 'Número de tarjeta',
                                'class' => 'campo-openpay',
                                'autocomplete' => 'off',
                                'data-openpay-card' => 'card_number',
                                'id' => 'numero-tarjeta',
                                'size' => '16',
                                'maxlength' => '16'
                            ]
                        ) ?>
                        <?= Html::input(
                            'text',
                            '',
                            '',
                            [
                                'placeholder' => 'CVV',
                                'class' => 'campo-openpay',
                                'autocomplete' => 'off',
                                'data-openpay-card' => 'cvv2',
                                'id' => 'cvv-tarjeta',
                                'size' => '4',
                                'maxlength' => '4',
                            ]
                        ) ?>
                        <div id="bloque-vencimiento">
                            <?= Html::input(
                                'text',
                                '',
                                '',
                                [
                                    'placeholder' => 'MM',
                                    'class' => 'campo-openpay',
                                    'autocomplete' => 'off',
                                    'data-openpay-card' => 'expiration_month',
                                    'size' => '2',
                                    'maxlength' => '2',
                                    'id' => 'mes-tarjeta'
                                ]
                            ) ?>
                            <?= Html::input(
                                'text',
                                '',
                                '',
                                [
                                    'placeholder' => 'AA',
                                    'class' => 'campo-openpay',
                                    'autocomplete' => 'off',
                                    'data-openpay-card' => 'expiration_year',
                                    'size' => '2',
                                    'maxlength' => '2',
                                    'id' => 'anio-tarjeta'
                                ]
                            ) ?>
                        </div>
                        <div class="clear"></div>
                        <div class="metodo-pago">
                            <div class="input-metodo secure">
                                <?= $form->field($tarjetaForm, 'secure')->checkbox()->label(false) ?>
                            </div>
                            <div class="imagen-metodo secure">
                                <label for="TarjetaForm[secure]">
                                    <?= Html::img('@web/images/pago/3dSecure.jpg', ['id'=>'secure-img']) ?>
                                </label>
                            </div>
                            <div class="nombre-metodo secure">
                                <label for="TarjetaForm[secure]">
                                    Usar 3D Secure
                                </label>
                            </div>
                        </div>
                        <?= $form->field($tarjetaForm, 'mensualidades')->radioList($mensualidades,['id' => 'mensualidades'])->label(false); ?>
                        <div class="checkbox">
                            <label><input type="checkbox" name="terminos" id="acepta-terminos-tarjeta">Acepto los <a href="<?= Yii::$app->request->BaseUrl ?>/legal/terminos_condiciones.pdf" target="_blank" class="link-terminos">Términos y condiciones</a></label>
                        </div>
                        <?= Html::submitButton('Continuar', ['class' => 'btn btn-accion tarjeta', 'name' => 'continuar', 'id' => 'continuar-compra', 'disabled'=>true]) ?>
                    <?php ActiveForm::end(); ?>
                    <?php if($costo_total < 10000){ ?>
                        <div class="metodo-pago">
                            <div class="input-metodo">
                                <input type="radio" name="metodo-pago" id="metodo-efectivo">
                            </div>
                            <div class="imagen-metodo">
                                <label for="metodo-efectivo">
                                    <?= Html::img('@web/images/pago/efectivo.png') ?>
                                </label>
                            </div>
                            <div class="nombre-metodo">
                                <label for="metodo-efectivo">
                                    Efectivo
                                </label>
                            </div>
                        </div>
                        <?php $form = ActiveForm::begin([
                            'method' => 'post',
                            'id' => 'tienda-openpay'
                        ]); ?>
                            <?= $form->field($tiendaForm, 'numero_pedido')->hiddenInput()->label(false) ?>
                            <div id="mensaje-tienda">
                                Puedes pagar tu pedido en
                                <span>7 Eleven</span>, <span>Extra</span>, <span>Circle K</span>, <span>Walmart</span>, <span>Bodega Aurrera</span> o <span>Farmacias del ahorro</span> entre muchos más.
                                <br><br>
                                Para ver el listado completo da click
                                <a href="https://www.openpay.mx/tiendas-de-conveniencia.html" target="_blank">aquí</a>
                            </div>
                            <div class="checkbox">
                                <label><input type="checkbox" name="terminos" id="acepta-terminos-efectivo">Acepto los <a href="<?= Yii::$app->request->BaseUrl ?>/legal/terminos_condiciones.pdf" target="_blank" class="link-terminos">Términos y condiciones</a></label>
                            </div>
                            <div class="clear"></div>
                            <?= Html::submitButton('Continuar', ['class' => 'btn btn-accion efectivo', 'name' => 'continuar', 'id' => 'continuar-compra', 'disabled' => true]) ?>
                        <?php ActiveForm::end(); ?>
                    <?php } ?>
                    <!-- <div class="metodo-pago">
                        <div class="input-metodo">
                            <input type="radio" name="metodo-pago" id="metodo-paypal">
                        </div>
                        <div class="imagen-metodo">
                            <label for="metodo-paypal">
                                <?= Html::img('@web/images/pago/paypal.png') ?>
                            </label>
                        </div>
                        <div class="nombre-metodo">
                            <label for="metodo-paypal">
                                PayPal
                            </label>
                        </div>
                    </div>
                    <div id="boton-paypal">
                        <div class="checkbox">
                            <label><input type="checkbox" name="terminos" id="acepta-terminos-paypal">Acepto los <a href="<?= Yii::$app->request->BaseUrl ?>/legal/terminos_condiciones.pdf" target="_blank" class="link-terminos">Términos y condiciones</a></label>
                        </div>
                        <a href="<?= $enlace_paypal ?>" class="btn btn-accion boton-paypal-a oculto">Pagar con PayPal</a>
                    </div>
                </div> -->
                <!-- <a href="javascript:;" id="guarda-pago" class="btn-accion">Continuar</a> -->
            </div>
        </div>
        <input type="hidden" id="openpay_id" value="<?= $openpay_id ?>" />
        <input type="hidden" id="openpay_public" value="<?= $openpay_public ?>" />
        <input type="hidden" id="openpay_production" value="<?= $openpay_production ?>" />
    </div>
</div>
