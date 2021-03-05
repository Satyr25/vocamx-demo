<?php
use yii\helpers\Html;
use yii\helpers\Url;
?>
<div id="bloque-header"></div>
<section class="container info-section">
    <div class="row">
        <div class="col-md-12">
            <h2><?= $contenido->bloque1_titulo ?></h2>
            <p><?= nl2br($contenido->bloque1_texto) ?></p>
            <div class="text-center button-wrp">
                <a href="https://m.me/VocaMXoficial?tr=529281824267405" class="info-button" target="_blank">
                    <i class="fab fa-facebook-messenger"></i>
                    AYUDA
                </a>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="text-section">
                <h2><?= $contenido->bloque2_titulo ?></h2>
                <p><?= nl2br($contenido->bloque2_texto) ?></p>
            </div>
            <div class="text-section">
                <h2><?= $contenido->bloque3_titulo ?></h2>
                <p><?= nl2br($contenido->bloque3_texto) ?></p>
            </div>
        </div>
        <div class="col-md-6">
            <?= Html::img($contenido->imagen1, ['class' => 'img-responsive']) ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="text-section">
                <h2><?= $contenido->bloque4_titulo ?></h2>
                <p><?= nl2br($contenido->bloque4_texto) ?></p>
            </div>
            <div class="text-section">
                <h2><?= $contenido->bloque5_titulo ?></h2>
                <p><?= nl2br($contenido->bloque5_texto) ?><a href= '<?= $contenido->bloque5_correo ?>' ><?= $contenido->bloque5_correo ?></a> <?= nl2br($contenido->bloque5_texto2) ?></p>
                <p>Para más detalle conoce a fondo nuestras políticas y garantías <a href="<?= $contenido->enlace1 ?>">aquí</a>.</p>
            </div>
        </div>
        <div class="col-md-6">
            <?= Html::img($contenido->imagen2, ['class' => 'img-responsive']) ?>
        </div>
    </div>
</section>