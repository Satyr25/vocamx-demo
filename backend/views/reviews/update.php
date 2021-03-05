<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
$form = ActiveForm::begin ([
    'id' => 'formulario-producto',
    'options' => ['enctype' => 'multipart/form-data']
    ]);
?>

<div class="wrap container">
    <h2>Editar Review</h2>

    <?= $form->field($review, 'nombre')->textInput() ?>
    <?= $form->field($review, 'email')->input('email') ?>
    <?= $form->field($review, 'puntuacion')->input('number') ?>
    <?= $form->field($review, 'status')->dropDownList([
        0 => 'No publicada',
        1 => 'Publicada'
    ]) ?>
    <?= $form->field($review, 'review')->textArea() ?>

    <div class="form-group">
        <?= Html::submitButton('Actualizar', ['class' => 'btn-accion']) ?>
    </div>
</div>
<?php ActiveForm::end(); ?>