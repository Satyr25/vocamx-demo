<?php
use yii\helpers\Html;
use yii\helpers\Url;
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

        <div class="edita-fotos">
            <?php foreach($producto->fotos_upd as $foto) { ?>
                <?php $extension = pathinfo(Yii::getAlias('@web/images/'.$foto->archivo), PATHINFO_EXTENSION); ?>
                <div class="foto-guardada">
                    <?php if(in_array($extension,['mp4','webm'])){ ?>
                        <video controls style="height:200px;width:200px;">
                            <source src="<?= \Yii::$app->request->BaseUrl ?>/images/<?= $foto->archivo ?>" type="video/mp4" />
                        </video>
                    <?php }else{ ?>
                        <?= Html::img('@web/images/'.$foto->archivo, ['class'=>'fotos-edita']); ?>
                    <?php } ?>

                    <?= Html::a('Quitar', 'javascript:;', ['id'=>$foto->id, 'class'=>'quitar-foto producto']); ?>
                </div>
            <?php } ?>
        </div>

        <div id="fotos">
            <div>
                <?= $form->field($producto, 'fotos[]')->fileInput(['accept' => '.jpg,.jpeg,.png,.mp4']) ?>
            </div>
            <a href="javascript:;" class="btn-accion" id="agregar-foto-producto">Agregar foto</a>
        </div>

        <div>
            <img src="<?= Url::to('@web/images/'.$producto->thumb) ?>" alt="">
            <?= $form->field($producto, 'thumb')->fileInput(['accept' => '.jpg,.jpeg,.png']) ?>
        </div>

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
        <?= $form->field($producto, 'tallas')->inline(true)->checkboxList($tallas) ?>
        <?= $form->field($producto, 'sold')->inline(true)->checkboxList($tallas) ?>

        <?= $form->field($producto, 'tipos')->inline(true)->checkboxList($tipos) ?>

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
            <?= Html::submitButton('Actualizar', ['class' => 'btn-accion']) ?>
        </div>

    <?php ActiveForm::end(); ?>
</div>
