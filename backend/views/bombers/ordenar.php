<?php
use richardfan\sortable\SortableGridView;
use yii\helpers\Url;
?>

<div class="container">
    <h2 class="titulo-seccion">Ordenar bombers de coleccion</h2>
    <?= SortableGridView::widget([
        'dataProvider' => $dataProvider,
        'sortUrl' => Url::to(['bombers/sortItem']),
        'columns' => [
            'nombre',
        ],
    ]); ?>
</div>