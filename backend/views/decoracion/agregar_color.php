<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use dosamigos\ckeditor\CKEditor;

use dosamigos\fileupload\FileUploadUI;
?>

<div class="wrap container">
    <h2>Agregar Color Decoración Interior</h2>
    <?php $form = ActiveForm::begin([]); ?>

        <?= $form->field($color, 'color')->textInput() ?>
        <div class="form-group acciones">
            <?= Html::submitButton('Guardar', ['class' => 'btn-accion']) ?>
        </div>

    <?php ActiveForm::end(); ?>
</div>
