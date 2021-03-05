<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;
use yii\data\ActiveDataProvider;
use yii\bootstrap\ActiveForm;
?>

<div class="container">
    <h2 class="titulo-seccion">Colores Decoración de Interiores</h2>
    <?= Html::a('Agregar Color', ['decoracion/agregar-color'], ['class' => 'btn-taller btn-accion accion-principal', 'id' => 'agregar-bomber']) ?>
    <div class="clear"></div>

    <?=
    GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            'color',
            [
                'header' => 'Acción',
                'class' => 'yii\grid\ActionColumn',
                'template' => '{update}',
                'buttons' => [
                    'update' => function ($url,$model) {
                        return Html::a(
                            '',
                            Url::to(['decoracion/actualizar-color', 'id' => $model->id]),
                            ['class'=>'boton-editar']);
                    },
                ],
            ],
        ]
    ]);
    ?>
</div>
