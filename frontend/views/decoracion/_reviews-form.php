<?php
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
$form = ActiveForm::begin([
    'id' => 'formulario-review',
]);
?>

<div class="write-review">
    <h3 class="titulos-sub">
        Deja tu reseña
    </h3>
    <?= $form->field($reviewForm, 'nombre')->textInput(['placeholder' => 'Nombre']) ?>
    <?= $form->field($reviewForm, 'email')->input('email',['placeholder' => 'Correo electrónico']) ?>
    <?= $form->field($reviewForm, 'puntuacion')->hiddenInput() ?><div id="review-estrellas">
        <a href="javascript:;" class="estrella" id="estrella-1"></a>
        <a href="javascript:;" class="estrella" id="estrella-2"></a>
        <a href="javascript:;" class="estrella" id="estrella-3"></a>
        <a href="javascript:;" class="estrella" id="estrella-4"></a>
        <a href="javascript:;" class="estrella" id="estrella-5"></a>
    </div>
    <?= $form->field($reviewForm, 'review')->textArea(['placeholder' => 'Escribe tu reseña','maxlength' => '200']) ?>
    <?= $form->field($reviewForm, 'producto_id')->hiddenInput(['value' => $producto->id])->label(false) ?>
    <div id="contador-letras">
        <span>0</span>/200
    </div>
    <div class="form-group">
        <div class="col-md-offset-6 col-md-6">
            <?= Html::submitButton('Enviar', ['class' => 'btn-accion']) ?>
        </div>
    </div>
    <div class="clear"></div>
</div>

<?php ActiveForm::end() ?>
