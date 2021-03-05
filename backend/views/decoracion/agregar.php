<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use dosamigos\ckeditor\CKEditor;

use dosamigos\fileupload\FileUploadUI;
?>

<div class="wrap container">
    <h2>Agregar Decoración Interior</h2>
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

        <div class="clear"></div>

        <?= $form->field($producto, 'precio')->textInput() ?>
        <?= $form->field($producto, 'precio_descuento')->textInput() ?>
        <?= $form->field($producto, 'precio_usd')->textInput() ?>
        <?= $form->field($producto, 'precio_descuento_usd')->textInput() ?>
        <?= $form->field($producto, 'nombre')->textInput() ?>

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

        <table id="imagenes-color">
            <thead>
                <tr>
                    <th colspan="2">Fotos Color</th>
                </tr>
            </thead>
            <tbody>
                <tr class="imagen-color">
                    <td>
                        <?=
                            $form->field($producto, 'imagen_color[]')
                                ->dropDownList(
                                    $colores,
                                    ['prompt'=>'Color']
                                )->label(false);
                        ?>
                    </td>
                    <td>
                        <?= $form->field($producto, 'imagen_color_ruta[]')->fileInput(['accept' => '.jpg,.jpeg,.png'])->label(false) ?>
                    </td>
                </tr>
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="2">
                        <a href="javascript:;" id="agregar-fotoscolor">Agregar</a>
                    </td>
                </tr>
            </tfoot>
        </table>

        <table id="variantes">
            <thead>
                <tr>
                    <th colspan="5">PRECIOS</th>
                </tr>
            </thead>
            <tbody>
                <tr class="variante">
                    <td class="color">
                        <?=
                            $form->field($producto, 'colores[]')
                                ->dropDownList(
                                    $colores,
                                    ['prompt'=>'Color']
                                )->label(false);
                        ?>
                    </td>
                    <td class="medida">
                        <?=
                            $form->field($producto, 'medidas[]')
                                ->dropDownList(
                                    $medidas,
                                    ['prompt'=>'Medida']
                                )->label(false);
                        ?>
                    </td>
                    <td class="precio-variante">
                        <?= $form->field($producto, 'precios_variante[]')->textInput(['placeholder' => 'MXN'])->label(false) ?>
                    </td>
                    <td class="precio-variante">
                        <?= $form->field($producto, 'precios_usd_variante[]')->textInput(['placeholder' => 'USD'])->label(false) ?>
                    </td>
                </tr>
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="5">
                        <a href="javascript:;" id="agregar-variante">Agregar</a>
                    </td>
                </tr>
            </tfoot>
        </table>

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
