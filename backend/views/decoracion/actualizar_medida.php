<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use dosamigos\ckeditor\CKEditor;

use dosamigos\fileupload\FileUploadUI;
?>

<div class="wrap container">
    <h2>Editar Medida</h2>
    <?php $form = ActiveForm::begin([]); ?>

        <?= $form->field($medida, 'medida')->textInput() ?>
        <?= $form->field($medida, 'id')->hiddenInput()->label(false) ?>
        <div class="form-group acciones">
            <?= Html::submitButton('Guardar', ['class' => 'btn-accion']) ?>
        </div>

    <?php ActiveForm::end(); ?>
</div>
