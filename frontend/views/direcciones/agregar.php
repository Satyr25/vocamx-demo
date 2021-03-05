<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\ActiveForm;
use kartik\depdrop\DepDrop;
use kartik\select2\Select2;
?>
<div class="container" id="registro-usuario">
    <div id="bloque-header"></div>
    <?php $form = ActiveForm::begin(['id' => 'formulario-direccion']); ?>
    <div class="datos-direccion" id="direcciones">
        <h2>¿Dónde quieres recibir tu bomber?</h2>
        <?= $form->field($direccion, 'nombre')->textInput(['autofocus' => true, 'placeholder' => 'Nombre y Apellido *'])->label(false) ?>
        <?= $form->field($direccion, 'telefono')->textInput(['placeholder' => 'Teléfono *'])->label(false) ?>
        <?= $form->field($direccion, 'id_direccion')->hiddenInput()->label(false) ?>
        <?= $form->field($direccion, 'pais')->widget(Select2::classname(), [
                'data' => $paises,
                'language' => 'es',
                'options' => ['placeholder' => 'País', 'id' => 'pais-id'],
                'pluginOptions' => [
                    'allowClear' => false
                ],
            ])->label(false);
        ?>
        <?= $form->field($direccion, 'estado')->widget(DepDrop::classname(), [
                'type'=>DepDrop::TYPE_SELECT2,
                'data' => [$direccion->estado => $direccion->estado_seleccionado],
                'options' => [
                    'id'=>'estado-id',
                ],
                'pluginOptions'=>[
                    'depends'=>['pais-id'],
                    'initialize' => $direccion->estado ? true : false,
                    'placeholder' => 'Estado',
                    'url' => Url::to(['/clientes/estado'])
                ]
            ])->label(false);
        ?>
        <?= $form->field($direccion, 'ciudad')->textInput(['placeholder' => 'Ciudad *'])->label(false) ?>
        <?= $form->field($direccion, 'cp')->textInput(['placeholder' => 'Código postal *', 'type' => 'number', 'maxlength'=>'5'])->label(false) ?>
        <?= $form->field($direccion, 'calle')->textInput(['placeholder' => 'Calle *'])->label(false) ?>
        <?= $form->field($direccion, 'externo')->textInput(['placeholder' => 'Número externo *'])->label(false) ?>
        <?= $form->field($direccion, 'interno')->textInput(['placeholder' => 'Número interno (opcional)'])->label(false) ?>
        <?= $form->field($direccion, 'entre_calles')->textInput(['placeholder' => 'Entre calles'])->label(false) ?>
        <?= $form->field($direccion, 'referencias')->textInput(['placeholder' => 'Referencias'])->label(false) ?>
        <?= $form->field($direccion, 'colonia')->textInput(['placeholder' => 'Colonia *'])->label(false) ?>
        <?= Html::submitButton('Continuar', ['class' => 'btn btn-accion', 'name' => 'continuar']) ?>
    </div>
    <div class="clear"></div>
    <?php ActiveForm::end(); ?>
</div>
