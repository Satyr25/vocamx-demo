<?php
use yii\helpers\Html;
use yii\helpers\Url;
?>

<div id="ver-producto">
    <div class="container">
        <div class="btn-regresar">
            <?= Html::a('Regresar', [Url::to('bombers/index')], ['class' => 'btn-accion']) ?>
        </div>
    </div>
    <div id="contenedor-fotos">
        <div id="fotos-producto">
                <?php foreach($fotos as $i => $foto){ ?>
                    <?php $extension = pathinfo(Yii::getAlias('@web/images/'.$foto->foto), PATHINFO_EXTENSION); ?>
                    <div class="foto">
                        <?php if(in_array($extension,['mp4','webm'])){ ?>
                            <video id="video-vocamx-<?= $i ?>" class="video-vocamx" class="video-js vjs-default-skin" controls preload="none" poster="<?= Yii::getAlias('@web') ?>/images/poster_video.jpg">
                                <source src="<?= \Yii::$app->request->BaseUrl ?>/images/<?= $foto->foto ?>" type="video/mp4" />
                            </video>
                        <?php }else{ ?>
                            <?= Html::img('@web/images/'.$foto->foto) ?>
                        <?php } ?>
                    </div>
                <?php } ?>
        </div>
        <div id="cantidad-fotos">
            <?= count($fotos) ?> Fotos
        </div>
    </div>
    <div class="container">
        <h2>Thumb</h2>
        <img src="<?= Url::to('@web/images/'.$producto->thumb) ?>" alt="">
    </div>
    <div id="datos-producto" class="container">
        <div class="nombre-bomber"><?= $producto->nombre ?></div>
        <div class="campo-producto" id="categoria-producto">
            <span class="campo">Categoría:</span>
            <span class="valor-campo"><?= $producto->categoria ?></span>
        </div>
        <div class="campo-producto" id="tallas-producto">
            <span class="campo">Tallas:</span>
            <span class="valor-campo">
                <?php foreach($tallas as $i => $talla){ ?>
                    <?= $talla->talla ?>
                    <?= $i+1 < count($tallas) ? ', ' : '' ?>
                <?php } ?>
            </span>
        </div>
        <div class="campo-producto" id="descripcion-producto">
            <span class="valor-campo"><?= $producto->descripcion ?></span>
        </div>
        <div class="precio-producto">$<?= number_format($producto->precio, 2) ?></div>
        <div class="precio-producto">$<?= number_format($producto->precio_descuento, 2) ?></div>
        <div class="campo-producto">
            <span class="campo">Facebook ID:</span>
            <span class="valor-campo"><?= $producto->id_facebook ?></span>
        </div>
        <div class="campo-producto">
            <span class="campo">SKU:</span>
            <span class="valor-campo"><?= $producto->sku ?></span>
        </div>
        <div class="campo-producto">
            <span class="campo">EAN:</span>
            <span class="valor-campo"><?= $producto->ean ?></span>
        </div>
    </div>

</div>
