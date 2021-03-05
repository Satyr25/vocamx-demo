<?php
use yii\helpers\Html;
?>
<div id="bloque-header"></div>
<section class="container info-section">
    <div class="row">
        <div class="col-md-6">
            <div class="row">
                <div class="col-md-12">
                    <div class="text-section">
                        <h1><?= $contenido->bloque1_titulo ?></h1>
                        <p><?= nl2br($contenido->bloque1_texto) ?></p>
                    </div>
                    <div class="text-section">
                        <h2><?= $contenido->bloque2_titulo ?></h2>
                        <p><?= nl2br($contenido->bloque2_texto) ?></p>
                    </div>
                    <div class="text-section">
                        <h2><?= $contenido->bloque3_titulo ?></h2>
                        <p><?= nl2br($contenido->bloque3_texto) ?></p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 image-text-container">
                    <?= Html::img($contenido->logo1, ['class' => 'logo-us']) ?>
                    <div class="team-info">
                        <h3><?= $contenido->bloque4_titulo ?></h3>
                        <strong>
                            <?= nl2br($contenido->bloque4_texto) ?>
                        </strong>
                    </div>
                </div>
                <div class="col-md-6">
                    <h3><?= $contenido->bloque5_titulo ?></h3>
                    <p><?= nl2br($contenido->bloque5_texto) ?></p>
                    <a href="mailto:<?= $contenido->correo1 ?>"><?= $contenido->correo1 ?></a>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <?= Html::img($contenido->imagen1, ['class' => 'img-responsive']) ?>
        </div>
    </div>
</section>