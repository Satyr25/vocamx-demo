<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use yii\grid\GridView;
use yii\data\ActiveDataProvider;
use yii\jui\DatePicker;
?>

<div class="container">
    <h2 class="titulo-seccion">Pedidos</h2>

    <div class="clear"></div>

    <div class="pedidos-search" id="search-block">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>
    <?= $form->field($searchModel, 'estado')
        ->dropDownList(
            $estados,
            ['prompt'=>'Estado']
        ) ?>
    <?= $form->field($searchModel, 'cliente')->textInput(['placeholder' => 'Cliente'])->label(false) ?>
    <div class="clear"></div>
    <div class="form-group">
        <?= Html::submitButton('Buscar', ['class' => 'btn btn-accion']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

    <?=
    GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            [
                'label' => '#',
                'value' => function ($model) {
                    return $model->numero_pedido;
                }
            ],
            [
                'label' => 'Fecha',
                'value' => function ($model) {
                    return date( "d/m/Y", $model->fecha);
                }
            ],
            'cliente',
            'telefono',
            [
                'label' => 'Envío',
                'value' => function ($model) {
                    return $model->costo_envios;
                }
            ],
            [
                'label' => 'Productos',
                'value' => function ($model) {
                    return $model->cantidadProductos();
                }
            ],
            [
                'label' => 'Total',
                'value' => function ($model) {
                    return number_format($model->total, 2);
                }
            ],
            'estado',
            [
                'header' => 'Acción',
                'class' => 'yii\grid\ActionColumn',
                'template' => '{view}',
                'buttons' => [
                    'view' => function ($url,$model) {
                        return Html::a(
                            '',
                            $url,
                            ['class'=>'boton-ver']
                        );
                    },
    	        ],
            ],
        ],
    ]);
    ?>
</div>
