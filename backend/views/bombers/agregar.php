<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use dosamigos\ckeditor\CKEditor;

use dosamigos\fileupload\FileUploadUI;
?>

<div class="wrap container">
    <h2>Agregar Bomber</h2>
    <?php $form = ActiveForm::begin([
        'id' => 'formulario-producto',
        'options' => ['enctype' => 'multipart/form-data'],
    ]); ?>

        <?=
            $form->field($producto, 'categoria')
                ->dropDownList(
                    $categorias,
                    ['prompt'=>'']
                );
        ?>

        <?=
            $form->field($producto, 'sexo')
                ->dropDownList(
                    $sexos,
                    ['prompt'=>'']
                );
        ?>

        <div class="clear"></div>

        <?= $form->field($producto, 'precio')->textInput() ?>
        <?= $form->field($producto, 'precio_descuento')->textInput() ?>
        <?= $form->field($producto, 'precio_usd')->textInput() ?>
        <?= $form->field($producto, 'precio_descuento_usd')->textInput() ?>
        <?= $form->field($producto, 'nombre')->textInput() ?>
        
       


        <?= $form->field($producto, 'must_have')->checkbox(); ?>

        <div id="fotos">
            <div>
                <?= $form->field($producto, 'fotos[]')->fileInput(['accept' => '.jpg,.jpeg,.png']) ?>
            </div>
            <a href="javascript:;" class="btn-accion" id="agregar-foto-producto">Agregar foto</a>
        </div>

        <?= $form->field($producto, 'thumb')->fileInput(['accept' => '.jpg,.jpeg,.png']) ?>
        <?= $form->field($producto, 'descripcion_breve')->textArea(['rows' => 5]) ?>
        <?= $form->field($producto, 'descripcion')->widget(CKEditor::className(), [
                'options' => ['rows' => 6],
                'preset' => 'custom',
                'clientOptions' => [
                    'toolbarGroups' => [
                        ['name' => 'undo'],
                        ['name' => 'basicstyles', 'groups' => ['basicstyles', 'cleanup']],
                        ['name' => 'list'],
                    ]
                ]
            ]) ?>
        <?= $form->field($producto, 'tallas[]')->inline(true)->checkboxList($tallas) ?>
        <?= $form->field($producto, 'sold')->inline(true)->checkboxList($tallas) ?>

        <?= $form->field($producto, 'tipos[]')->inline(true)->checkboxList($tipos) ?>

        <div class="row">
            <div class="col-md-6">
                <?= $form->field($producto, 'fb_id')->textInput() ?>
            </div>
            <div class="col-md-6">
                <?= $form->field($producto, 'sku')->textInput() ?>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <?= $form->field($producto, 'ean')->textInput() ?>
            </div>
        </div>

        <div class="clear"></div>


        <div class="form-group acciones">
            <?= Html::submitButton('Guardar', ['class' => 'btn-accion']) ?>
        </div>

    <?php ActiveForm::end(); ?>
</div>
