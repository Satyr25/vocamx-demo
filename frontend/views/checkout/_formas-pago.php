<?php
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;

//if ($mensualidades->id == 12){
//    $mensualidades->descripcion = '12 Meses sin intereses de $' . round(($precioTotal) / 12,1);
//}
?>
<?php if(!Yii::$app->user->isGuest && $cliente){ ?>
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
<?php } ?>
<div id="registrar-metodo">
    <?php
    if(Yii::$app->user->isGuest){
        if(isset($tarjetas)){ ?>
        <h3>Otros medios</h3>
    <?php }
    }
    ?>
    <div id="metodo-limite">
       <?php
            $ip = Yii::$app->geoip->ip();
            if($ip->country == 'Mexico'){ ?>
                <div class="metodo-pago payment-label  ">
                    <div class="input-metodo">
                        <input type="radio" name="metodo-pago" id="metodo-efectivo" value="efectivo">
                    </div>
                    <div class="nombre-metodo">
                        <label for="metodo-efectivo">
                            Efectivo
                        </label>
                    </div>
                    <div class="imagen-metodo less">
                        <label for="metodo-efectivo">
                            <?= Html::img('@web/images/7eleven.png') ?>
                            <?= Html::img('@web/images/walmart.png') ?>
                        </label>
                    </div>
                </div>
            <?php } ?>
    </div>
    <?php $form = ActiveForm::begin([
        'method' => 'post',
        'id' => 'tienda-openpay'
    ]); ?>
        <?= $form->field($tiendaForm, 'numero_pedido')->hiddenInput()->label(false) ?>
        <div id="mensaje-tienda">
            Puedes pagar tu pedido en
            <span>7 Eleven</span>, <span>Extra</span>, <span>Circle K</span>, <span>Walmart</span>, <span>Bodega Aurrera</span> o <span>Farmacias del ahorro</span> entre muchos <a href="#popup-tiendas" class="links-prod inline-popup tiendas-info"> más.</a>

            <br><br>
        </div>
        <div class="clear"></div>
    <?php ActiveForm::end(); ?>
    <div class="metodo-pago payment-label bancaria">
        <div class="input-metodo">
            <input type="radio" name="metodo-pago" id="metodo-tarjeta" value="tarjeta">
        </div>
        <div class="nombre-metodo">
            <label for="metodo-tarjeta">
                Tarjeta Bancaria
            </label>
        </div>
        <div class="imagen-metodo">
            <label for="metodo-tarjeta">
                <?= Html::img('@web/images/pago/visa.png') ?>
                <?= Html::img('@web/images/pago/mastercard.png') ?>
                <?= Html::img('@web/images/pago/Amex.png') ?>
                <?= Html::img('@web/images/tarjetas/openpay.png', ['class' => 'hidden-sm hidden-xs']) ?>
            </label>
        </div>
    </div>
    <?php
    $form = ActiveForm::begin([
        'method' => 'post',
        'id' => 'tarjeta-openpay'
    ]); ?>
        <div id="tipo-tarjeta">
            <?= $form->field($tarjetaForm, 'tipo_tarjeta')->radioList(['CRE' => 'Crédito', 'DEB' => 'Débito'])->label(false); ?>
        </div>
        <div class="clear"></div>
        <?= $form->field($tarjetaForm, 'token')->hiddenInput(['id' => 'token_id'])->label(false) ?>
        <?= $form->field($tarjetaForm, 'device_session_id')->hiddenInput(['id' => 'device_session_id'])->label(false) ?>
        <?= $form->field($tarjetaForm, 'numero_pedido')->hiddenInput()->label(false) ?>
        <div class="col-md-12">
            <div class="form-group field-card-number">
                <div>
                    <p class="help-block help-block-error"></p>
                    <div class="input-group">
                        <?= Html::input(
                            'text',
                            '',
                            '',
                            [
                                'placeholder' => 'Número de tarjeta',
                                'class' => 'campo-openpay form-control',
                                'autocomplete' => 'off',
                                'data-openpay-card' => 'card_number',
                                'id' => 'numero-tarjeta',
                                'size' => '20',
                                'maxlength' => '20'
                            ]
                        ) ?>
                        <div class="input-group-addon"><i class="fas fa-lock"></i></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-group field-card-name">
                <div>
                    <p class="help-block help-block-error"></p>
                    <?= Html::input(
                        'text',
                        '',
                        '',
                        [
                            'placeholder' => 'Nombre',
                            'class' => 'campo-openpay form-control',
                            'autocomplete' => 'off',
                            'data-openpay-card' => 'holder_name',
                            'id' => 'nombre-tarjeta',
                            'data-tipo' => 'Nombre en la tarjeta'
                        ]
                    ) ?>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group field-card-month">
                <div>
                    <p class="help-block help-block-error"></p>
                    <?= Html::dropDownList(
                        'month',
                        null,
                        ['01' => '01','02' => '02','03' => '03','04' => '04','05' => '05','06' => '06','07' => '07','08' => '08','09' => '09','10' => '10','11' => '11','12' => '12'],
                        [
                            'prompt' => 'MM',
                            'class' => 'campo-openpay form-control',
                            'autocomplete' => 'off',
                            'data-openpay-card' => 'expiration_month',
                            'id' => 'mes-tarjeta',
                            'data-tipo' => 'Mes de expiraciòn'
                        ]
                    ) ?>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group field-card-year">
                <div>
                    <p class="help-block help-block-error"></p>
                    <?= Html::dropDownList(
                        'year',
                        null,
                        ['19' => '19', '20' => '20', '21' => '21', '22' => '22', '23' => '23', '24' => '24', '25' => '25', '26' => '26', '27' => '27', '28' => '28', '29' => '29', '30' => '30', '31' => '31', '32' => '32', '33' => '33', '34' => '34', '35' => '35', '36' => '36', '37' => '37', '38' => '38', '39' => '39', '40' => '40'],
                        [
                            'prompt' => 'AA',
                            'class' => 'campo-openpay form-control',
                            'autocomplete' => 'off',
                            'data-openpay-card' => 'expiration_year',
                            'id' => 'anio-tarjeta',
                            'data-tipo' => 'Año de expiraciòn'
                        ]
                    ) ?>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group field-card-code">
                <div>
                    <p class="help-block help-block-error"></p>
                    <div class="input-group">
                        <?= Html::input(
                            'text',
                            '',
                            '',
                            [
                                'placeholder' => 'CVV',
                                'class' => 'campo-openpay form-control',
                                'autocomplete' => 'off',
                                'data-openpay-card' => 'cvv2',
                                'id' => 'cvv-tarjeta',
                                'size' => '4',
                                'maxlength' => '4',
                                'data-tipo' => 'CVV'
                            ]
                        ) ?>
                        <div class="input-group-addon"><i class="fas fa-question-circle"></i></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="clear"></div>
        
        <div class="row bloque-mensualidades ">
            <div class="col-md-12">
                <?= $form->field($tarjetaForm, 'mensualidades')
                    ->inline(true)
                    ->radioList($mensualidades,['id' => 'mensualidades'])
                    ->label(false);
                ?>
            </div>
        </div>
        
        
<!--
        <div class="row">
            <div class="col-md-12">
                <?= $form->field($tarjetaForm, 'secure')->checkbox([
                        'label' => Html::img('@web/images/pago/3dSecure.jpg', ['id'=>'secure-img']).'  Usar 3D Secure'
                    ])
                    ?>
            </div>
        </div>
-->
        <div class="row">
            <div class="col-md-12" id="protegida-block">
                <div class="same-level">
                    <?= Html::img('@web/images/compraSegura.png', ['class' => 'segura-img']) ?>
                </div>
                <div class="green-text same-level">
                    <span>
                        Compra protegida por BBVA,<br>Paypal y seguridad SSL
                    </span>
                </div>
            </div>
        </div>
        <?= Html::img('@web/images/tarjetas/openpay.png', ['class' => 'openpay-corner hidden-lg hidden-md']) ?>
    <?php ActiveForm::end(); ?>
    <div>
<!--
        <div class="metodo-pago payment-label">
            <div class="input-metodo">
                <input type="radio" name="metodo-pago" id="metodo-paypal" value="paypal">
            </div>
            <div class="nombre-metodo">
                <label for="metodo-paypal">
                    PayPal
                </label>
            </div>
            <div class="imagen-metodo less">
                <label for="metodo-paypal">
                    <?= Html::img('@web/images/pago/paypal.png', ['class' => 'img-responsive']) ?>
                </label>
            </div>
        </div>
-->
    </div>
    <input type="hidden" id="openpay_id" value="<?= $openpay_id ?>" />
    <input type="hidden" id="openpay_public" value="<?= $openpay_public ?>" />
    <input type="hidden" id="openpay_production" value="<?= $openpay_production ?>" />
</div>

<div id="popup-tiendas" class="white-popup mfp-hide bigger-popup">
    <div id="tiendas-container">
        <div class="row">
            <div class="col-md-12 flex-center">
            <a href="https://www.paynet.com.mx/mapa-tiendas/index.html" target="_blank" class="btn-accion">Encuentra tu tienda más cercana</a>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
            <?= Html::img('@web/images/tiendas.jpg', ['class' => 'tiendas-img']) ?>
            </div>
        </div>
    </div>
</div>
