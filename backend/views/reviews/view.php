<?php
use yii\helpers\Html;
use yii\helpers\Url;
?>

<div id="ver-producto">
    <div class="container">
        <div class="btn-regresar">
            <?= Html::a('Regresar', [Url::to('reviews/index')], ['class' => 'btn-accion']) ?>
        </div>
    </div>
    <div id="datos-producto" class="container">
        <div class="campo-producto">
            <span class="campo">Nombre:</span>
            <span class="valor-campo"><?= $review->nombre ?></span>
        </div>
        <div class="campo-producto">
            <span class="campo">Email:</span>
            <span class="valor-campo"><?= $review->email ?></span>
        </div>
        <div class="campo-producto">
            <span class="campo">Puntiacion:</span>
            <span class="valor-campo"><?= $review->puntuacion ?></span>
        </div>
        <div class="campo-producto">
            <span class="campo">Review:</span>
            <span class="valor-campo"><?= $review->review ?></span>
        </div>
    </div>

</div>
