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
                    <div class="foto <?= $foto['color'] ? 'color-'.$foto['color'] : '' ?>">
                        <?php if(in_array($extension,['mp4','webm'])){ ?>
                            <video id="video-vocamx-<?= $i ?>" class="video-vocamx" class="video-js vjs-default-skin" controls preload="none" poster="<?= Yii::getAlias('@web') ?>/images/poster_video.jpg">
                                <source src="<?= \Yii::$app->request->BaseUrl ?>/images/<?= $foto['foto'] ?>" type="video/mp4" />
                            </video>
                        <?php }else{ ?>
                            <?= Html::img('@web/images/'.$foto['foto']) ?>
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
        <div class="campo-producto" id="descripcion-producto">
            <span class="valor-campo"><?= $producto->descripcion ?></span>
        </div>

        <table id="variantes">
            <thead>
                <tr>
                    <th colspan="3">PRECIOS:</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($variantes as $variante){ ?>
                    <tr class="variante">
                        <td class="color">
                            <?= $variante->color ?>
                        </td>
                        <td class="medida">
                            <?= $variante->medidas ?>
                        </td>
                        <td class="precio-variante">
                            <?= number_format($variante->precio, 2) ?>
                        </td>
                        <td class="precio-variante">
                            <?= number_format($variante->precio_usd, 2) ?>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>

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
