<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;
use yii\data\ActiveDataProvider;
?>

<div class="container">
    <h2 class="titulo-seccion">REVIEWS</h2>
    <div class="clear"></div>
    <?=
    GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            'nombre',
            'email',
            'producto',
//            [
//                'label' => 'Producto',
//                'value' => 'producto'
//            ],
            'puntuacion',
            [
                'attribute' => 'status',
                'value' => function($model){
                    if($model->status){
                        return 'Publicada';
                    } else {
                        return 'No Publicada';
                    }
                }
            ],
            'created_at:date',
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{view} {update} {delete}',
                'buttons' => [
                    'view' => function ($url, $model) {
                        return Html::a(
                            null,
                            $url,
                            ['class' => 'boton-ver']
                        );
                    },
                    'update' => function ($url, $model) {
                        return Html::a(
                            null,
                            $url,
                            ['class' => 'boton-editar']
                        );
                    },
                    'delete' => function ($url, $model) {
                        return Html::a(null, ['delete', 'id' => $model->id], [
                            'class' => 'boton-borrar',
                            'data' => [
                                'confirm' => '¿Estás seguro de eliminar el producto?',
                                'method' => 'post',
                            ],
                        ]);
                    },
                ],
            ],
        ],
    ]);
    ?>
</div>
