<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\ActiveForm;
?>
<div id="bloque-header"></div>
<div id="metodos-pago">
    <div class="container">
        <h2>¿Cómo quieres pagar?</h2>
        <div id="metodos-guardados">
            <h3>Medios sugeridos</h3>
            <?php if($tarjetas){ ?>
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
                        'id' => 'numero-tarjeta'
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
                        'id' => 'cvv-tarjeta'
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
                            'id' => 'anio-tarjeta'
                        ]
                    ) ?>
                </div>
                <div class="clear"></div>
                <?= Html::submitButton('Continuar', ['class' => 'btn btn-accion', 'name' => 'continuar', 'id' => 'continuar-compra']) ?>
            <?php ActiveForm::end(); ?>
        </div>
        <a href="javascript:;" id="guarda-pago" class="btn-accion">Continuar</a>
    </div>
</div>
<input type="hidden" id="openpay_id" value="<?= $openpay_id ?>" />
<input type="hidden" id="openpay_public" value="<?= $openpay_public ?>" />
<input type="hidden" id="openpay_production" value="<?= $openpay_production ?>" />
