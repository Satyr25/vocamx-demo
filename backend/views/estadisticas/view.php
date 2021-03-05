<?php
use yii\helpers\Html;
?>
<div class="container">
    <h2>Contenido del Carrito</h2>
    <?php foreach($carrito->productoCarritos as $cartItem): ?>
        <?php if ($cartItem->producto->categoria_id != 7){ ?>
            <div class="row">
                <div class="col-md-6">
                    <?= Html::img('@web/images/'.$cartItem->producto->fotos[0]->archivo, ['class' => 'img-responsive']) ?>
                </div>
                <div class="col-md-6">
                    <div class="row">
                        <div class="col-md-12">
                            <h3>Nombre:</h3>
                            <p><?= $cartItem->producto->nombre ?></p>
                        </div>
                        <div class="col-md-12">
                            <h3>Cantidad:</h3>
                            <p><?= $cartItem->cantidad ?></p>
                        </div>
                        <div class="col-md-12">
                            <h3>Talla:</h3>
                            <p><?= $cartItem->talla->talla ?></p>
                        </div>
                        <?php if(isset($cartItem->diseno)): ?>
                        <div class="col-md-12">
                            <h3>Diseño:</h3>
                            <p><?= $cartItem->diseno ?></p>
                        </div>
                        <div class="col-md-12">
                            <h3>Linea 1:</h3>
                            <p><?= $cartItem->linea1 ?></p>
                        </div>
                        <div class="col-md-12">
                            <h3>Linea 2:</h3>
                            <p><?= $cartItem->linea2 ?></p>
                        </div>
                        <div class="col-md-12">
                            <h3>Linea 3:</h3>
                            <p><?= $cartItem->linea3 ?></p>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        <?php } else { ?>
            <div class="row">
                <div class="col-md-offset-3 col-md-6 text-center">
                    <h1>+ EXTRA</h1>
                </div>
            </div>
        <?php } ?>
    
    <?php endforeach; ?>
</div>