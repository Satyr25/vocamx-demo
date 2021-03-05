<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\ActiveForm;
use dosamigos\ckeditor\CKEditor;

use dosamigos\fileupload\FileUploadUI;
?>

<div class="wrap container">
    <h2>Actualizar Decoración Interior</h2>
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

            <table id="imagenes-color">
                <thead>
                    <tr>
                        <th colspan="2">Fotos Color</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($fotos_color as $foto){ ?>
                        <tr class="imagen-color">
                            <td>
                                <?=
                                    $form->field($producto, 'imagen_color[]')
                                        ->dropDownList(
                                            $colores,
                                            [
                                                'prompt'=>'Color',
                                                'options'=>[$foto->color_decoracion_id=>["Selected"=>true]]
                                            ]
                                        )->label(false);
                                ?>
                            </td>
                            <td>
                                <?= Html::img('@web/images/'.$foto->archivo,['class' => 'foto-color']) ?>
                                <?= $form->field($producto, 'ids_imagen_color[]')->hiddenInput(['value' => $foto->id])->label(false) ?>
                            </td>
                        </tr>
                    <?php } ?>
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
                        <th colspan="3">PRECIOS</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($variantes as $variante){ ?>
                        <tr class="variante">
                            <td class="color">
                                <?=
                                    $form->field($producto, 'colores[]')
                                        ->dropDownList(
                                            $colores,
                                            [
                                                'prompt'=>'Color',
                                                'options'=>[$variante->color_decoracion_id=>["Selected"=>true]]
                                            ]
                                        )->label(false);
                                ?>
                            </td>
                            <td class="medida">
                                <?=
                                    $form->field($producto, 'medidas[]')
                                        ->dropDownList(
                                            $medidas,
                                            [
                                                'prompt'=>'Medida',
                                                'options'=>[$variante->medidas_id=>["Selected"=>true]]
                                            ]
                                        )->label(false);
                                ?>
                            </td>
                            <td class="precio-variante">
                                <?= $form->field($producto, 'precios_variante[]')->textInput(['placeholder' => 'MXN', 'value' => $variante->precio])->label(false) ?>
                            </td>
                            <td class="precio-variante">
                                <?= $form->field($producto, 'precios_usd_variante[]')->textInput(['placeholder' => 'USD', 'value' => $variante->precio_usd])->label(false) ?>
                                <?= $form->field($producto, 'ids_variantes[]')->hiddenInput(['value' => $variante->id])->label(false) ?>
                            </td>
                        </tr>
                    <?php } ?>
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
                    <td colspan="4">
                        <a href="javascript:;" id="agregar-variante">Agregar</a>
                    </td>
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
            <?= Html::submitButton('Actualizar', ['class' => 'btn-accion']) ?>
        </div>

    <?php ActiveForm::end(); ?>
</div>
