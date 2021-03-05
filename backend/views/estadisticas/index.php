<?php

use yii\helpers\Html;
use yii\grid\GridView;
use kartik\date\DatePicker;
use yii\bootstrap\ActiveForm;
use yii\widgets\Pjax;
use yii\helpers\Url;
?>

<div class="container">
   <div class="row">
        <div class="col-md-12">
            <?php $form = ActiveForm::begin(['method' => 'post', 'id' => 'form_excel', 'action' => ['estadisticas/excel']]);?>
            <div class="row">
                <div class="col-md-offset-9 col-md-3">
                    <?=
                        DatePicker::widget([
                            'name' => 'VistasExcel[fecha_inicio]',
                            'value' => '01-01-2019',
                            'type' => DatePicker::TYPE_RANGE,
                            'name2' => 'VistasExcel[fecha_final]',
                            'value2' => date('d-m-Y', time()),
                            'pluginOptions' => [
                                'autoclose' => true,
                                'format' => 'dd-mm-yyyy'
                            ]
                        ]);
                    ?>
                    <button class="btn-blk">Exportar Estadísticas</button>
                    <?php ActiveForm::end(); ?>
                </div>
            </div>
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col-md-12">
            <h2>Carritos Abandonados</h2>
        </div>
    </div>
    
    <div class="row">
        <div class="col-md-12">
            <?php Pjax::begin(); ?>
            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],
                    'email',
                    [
                        'label' => 'Fecha',
                        'attribute' => 'created_at',
                        'format' => 'date'
                    ],
                    [
                        'label' => 'Número de productos',
                        'value' => function ($model) {
                            $cantidad = $model->cantidadProductos();
//                            var_dump($cantidad);
                            return  $cantidad ? $cantidad : 0 ;
                        }
                    ],
                    [
                        'label' => 'Productos',
                        'value' => function ($model) {
                            $productos = $model->stringProductos();
                            return  $productos ? $productos : 0 ;
                        }
                    ],
                    [
                        'class' => 'yii\grid\ActionColumn',
                        'template' => '{view}',
                        'buttons' => [
                            'view' => function ($url, $model) {
                                return Html::a(
                                    '',
                                    $url,
                                    ['class' => 'boton-ver']
                                );
                            },
                        ],
                    ],
                ],
            ]);
            ?>
            <?php Pjax::end(); ?>
        </div>
    </div>
    <hr>
    <div class="row">
        <div class="col-md-12">
            <h2>Vistas de página</h2>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <?php $form = ActiveForm::begin(['method' => 'get', 'id' => 'form_vistas', 'action' => ['estadisticas/index#form_vistas']]); ?>
            <div class="row">
                <div class="col-md-offset-9 col-md-3">
                    <?=
                        DatePicker::widget([
                            'name' => 'VistasSearch[fecha_inicio]',
                            'value' => '01-01-2019',
                            'type' => DatePicker::TYPE_RANGE,
                            'name2' => 'VistasSearch[fecha_final]',
                            'value2' => date('d-m-Y', time()),
                            'pluginOptions' => [
                                'autoclose' => true,
                                'format' => 'dd-mm-yyyy'
                            ]
                        ]);
                    ?>
                    <button class="btn-blk">Filtrar</button>
                    <?php ActiveForm::end(); ?>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
           <?php Pjax::begin(); ?>
            <?= GridView::widget([
                'dataProvider' => $vistasProvider,
                'formatter' => ['class' => 'yii\i18n\Formatter','nullDisplay' => '', 'locale' => 'es-ES'],
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],
                    'nombre',
                    [
                        'label' => 'Número de vistas',
                        'attribute' => 'numero_vistas'
                    ],
                    [
                        'label' => 'Tiempo de Visita Total',
                        'attribute' => 'tiempo_visita',
                        'format' => 'duration'
                    ],
                ],
            ]);
            ?>
            <?php Pjax::end(); ?>
        </div>
    </div>
    <hr>
    <div class="row">
        <div class="col-md-12">
            <h2>Ventas por Género</h2>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <?php $form2 = ActiveForm::begin(['method' => 'get', 'id' => 'form_genero', 'action' => ['estadisticas/index#form_genero']]);?>
                <div class="row">
                    <div class="col-md-offset-9 col-md-3">
                        <?= $form2->field($ventasGeneroSearch, 'genero')->dropDownList(['MUJ'=>'Mujer', 'HOM'=>'Hombre'],['prompt' => 'Seleccionar'])?>
                        <button class="btn-blk">Filtrar</button>
                    </div>
                </div>
            <?php ActiveForm::end();?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
           <?php Pjax::begin(); ?>
            <?= GridView::widget([
                'dataProvider' => $ventasGeneroProvider,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],
                    'nombre_producto',
                    [
                        'label' => 'Género',
                        'attribute' => 'nombre_tipo',
                    ],
                    'cantidad',
                ],
            ]);
            ?>
            <?php Pjax::end(); ?>
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col-md-12">
            <h2>Productos Sold Out</h2>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-offset-6 col-md-3">
                    <?php $form3 = ActiveForm::begin(['method' => 'get', 'id' => 'form_sold_talla', 'action' => ['estadisticas/index#form_sold_talla']]);?>
                    <?= $form3->field($soldSearch, 'talla')->dropDownList([ '7'=>'Unitalla Mujer', '1'=>'Junior','2'=>'Extra Chica', '3'=>'Chica', '4'=>'Mediana', '5' => 'Grande', '6'=>'Extra Grande'],['prompt' => 'Seleccionar'])?>
                </div>
                <div class="col-md-3">
                    <?= $form3->field($soldSearch, 'producto')->textInput(['class' => 'asd'])?>
                    <button class="btn-blk">Filtrar</button>
                    <?php ActiveForm::end();?>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
           <?php Pjax::begin(); ?>
            <?= GridView::widget([
                'dataProvider' => $soldProvider,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],
                    'correo',
                    'producto',
                    'talla',
                    [
                        'label' => 'Fecha',
                        'attribute' => 'created_at',
                        'format' => 'date'
                    ],
                ],
            ]);
            ?>
            <?php Pjax::end(); ?>
        </div>
    </div>
</div>
