<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;
use yii\data\ActiveDataProvider;
use yii\bootstrap\ActiveForm;
?>

<div class="container">
    <h2 class="titulo-seccion">Medidas Decoración de Interiores</h2>
    <?= Html::a('Agregar Medida', ['decoracion/agregar-medida'], ['class' => 'btn-taller btn-accion accion-principal', 'id' => 'agregar-bomber']) ?>
    <div class="clear"></div>

    <?=
    GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            'medidas',
            [
                'header' => 'Acción',
                'class' => 'yii\grid\ActionColumn',
                'template' => '{update}',
                'buttons' => [
                    'update' => function ($url,$model) {
                        return Html::a(
                            '',
                            Url::to(['decoracion/actualizar-medida', 'id' => $model->id]),
                            ['class'=>'boton-editar']);
                    },
                ],
            ],
        ],
    ]);
    ?>
</div>
