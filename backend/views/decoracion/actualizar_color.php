<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use dosamigos\ckeditor\CKEditor;

use dosamigos\fileupload\FileUploadUI;
?>

<div class="wrap container">
    <h2>Editar Color</h2>
    <?php $form = ActiveForm::begin([]); ?>

        <?= $form->field($color, 'color')->textInput() ?>
        <?= $form->field($color, 'id')->hiddenInput()->label(false); ?>
        <div class="form-group acciones">
            <?= Html::submitButton('Guardar', ['class' => 'btn-accion']) ?>
        </div>

    <?php ActiveForm::end(); ?>
</div>
