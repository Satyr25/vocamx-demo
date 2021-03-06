<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;
use yii\data\ActiveDataProvider;
use yii\bootstrap\ActiveForm;
?>

<div class="container">
    <h2 class="titulo-seccion">BOMBERS</h2>
    
    <?php $form = ActiveForm::begin([
        'id' => 'formulario-mensualidades',
        'action' => Url::to(['bombers/mensualidades']),
        'method' => 'post'
    ]); ?>
    <?= $form->field($mensualidades, 'mensualidades')->inline(true)->checkboxList($numero_mensualidades) ?>
    <?= Html::submitButton('Guardar', ['class' => 'btn-accion']) ?>
    <?php ActiveForm::end(); ?>

    <?= Html::a('Agregar bombers', [Url::to('bombers/agregar')], ['class' => 'btn-taller btn-accion accion-principal', 'id' => 'agregar-bomber']) ?>
    <?= Html::a('Ordenar bombers', ['bombers/ordenar'], ['class' => 'btn-taller btn-accion accion-principal', 'id' => 'agregar-bomber']) ?>
    <?= Html::a('Filtrar bombers', [Url::to('bombers/filtrar-plantillas')], ['class' => 'btn-taller btn-accion accion-principal', 'id' => 'agregar-bomber']) ?>

    <div class="clear"></div>

    <div class="clear"></div>
    <div class="clear"></div>

    <?=
    GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            'nombre',
            'categoria',
            'sexo',
            [
                'label' => 'Precio',
                'value' => function ($model) {
                    return '$'.number_format($model->precio, 2);
                }
            ],
            [
                'label' => 'Precio De Descuento',
                'value' => function ($model) {
                    return '$'.number_format($model->precio_descuento, 2);
                }
            ],
            [
                'label' => 'Precio USD',
                'value' => function ($model) {
                    return '$'.number_format($model->precio_usd, 2);
                }
            ],
            [
                'label' => 'Precio De Descuento USD',
                'value' => function ($model) {
                    return '$'.number_format($model->precio_descuento_usd, 2);
                }
            ],
            [
                'header' => 'Acci??n',
                'class' => 'yii\grid\ActionColumn',
                'template' => '{view} {update} {delete}',
                'buttons' => [
                    'view' => function ($url,$model) {
                        return Html::a(
                            '',
                            $url,
                            ['class'=>'boton-ver']
                        );
                    },
                    'update' => function ($url,$model) {
                        return Html::a(
                            '',
                            $url,
                            ['class'=>'boton-editar']);
                    },
                    'delete' => function ($url,$model) {
                        return Html::a('', ['delete', 'id' => $model->id], [
                            'class' => 'boton-borrar',
                            'data' => [
                                'confirm' => '??Est??s seguro de eliminar el producto?',
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
