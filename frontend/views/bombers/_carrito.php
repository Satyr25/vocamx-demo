<?php
use app\models\Foto;
use yii\helpers\Html;
use yii\helpers\Url;
?>
<?php if($productos){ ?>
        <?php $total_productos = 0; ?>
        <?php foreach($productos as $producto){ ?>
            <div class="bomber-comprada">
            <?php $total = $producto->precio*$producto->cantidad ?>
            <?php $total_productos += $total; ?>
            <?php $foto = Foto::find()->where('producto_id='.$producto->producto)->one() ?>
            <div class="eliminar-producto-container">
                <button class="eliminar-producto" data-talla="<?= $producto->talla_id ?>" data-producto="<?= $producto->producto ?>"><?= Html::img('@web/images/cesto.png') ?></button>
                <div class="sk-folding-cube" style="display:none;">
                    <div class="sk-cube1 sk-cube"></div>
                    <div class="sk-cube2 sk-cube"></div>
                    <div class="sk-cube4 sk-cube"></div>
                    <div class="sk-cube3 sk-cube"></div>
                </div>
            </div>
            <?php if(!$producto->diseno){ ?>
                <a href="<?= Url::to(['bombers/ver','id' => $producto->producto]) ?>" class="bomber" id="bomber-<?= $producto->producto ?>-<?= $producto->talla ?>">
            <?php }else{ ?>
                <div class="bomber">
            <?php } ?>
            <?php if($producto->diseno){ ?>
                <?= Html::img('@web/images/'.$producto->imagen_personalizada, ['class' => 'foto-bomber']) ?>
            <?php }else{ ?>
                <?= Html::img('@web/images/'.$foto->archivo, ['class' => 'foto-bomber']) ?>
            <?php } ?>
            <div class="nombre-producto">
                <?= $producto->nombre ?>
            </div>
            <?php if($producto->diseno){ ?>
                <div class="campo-producto">
                    <span class="campo-nombre">Frase: </span>
                    <span class="campo-valor"><?= implode(' ', [$producto->linea1,$producto->linea2,$producto->linea3]) ?></span>
                </div>
            <?php } ?>
                <div class="campo-producto">
                    <span class="campo-nombre">Talla: </span>
                    <span class="campo-valor"><?= $producto->talla ?></span>
                </div>
                <div class="campo-producto">
                    <span class="campo-nombre">Modelo: </span>
                    <span class="campo-valor"><?= $producto->categoria ?></span>
                </div>
                <div class="campo-producto">
                    <span class="campo-nombre">Cantidad: </span>
                    <span class="campo-valor cantidad"><?= $producto->cantidad ?></span>
                </div>
                <div class="campo-producto">
                    <span class="campo-nombre">Precio: </span>
                    <span class="campo-valor">$<?= number_format(($total - $total * .20),2)  ?></span>
                    <span class="campo-valor important-text precio-chico">$<s><?= number_format(($total), 2) ?></s></span>
                </div>
                <div class="ahorro-bomber">
                    <span><span class="title">Ahorro: </span>$<?= round($producto['precio'] * .20) ?></span>
                </div>
                <?php if(!$producto->diseno){ ?>
                    </a>
                <?php }else{ ?>
                    </div>
                <?php } ?>
            </div>
        <?php } ?>
        <?php $url_chekout = Url::to(['checkout/']) ?>
        <a href="<?= $url_chekout ?>" class="btn-accion muestra-loader" id="btn-checkout">
            Checkout
        </a>
<?php }else{ ?>
    <div id="carrito-vacio">No hay productos en tu carrito.</div>
<?php } ?>
