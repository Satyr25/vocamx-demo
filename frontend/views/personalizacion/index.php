<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\ActiveForm;
use app\assets\CustomBomberAsset;

CustomBomberAsset::register($this);
?>
<div id="bloque-header"></div>
<div id="personalizacion">
    <div class="container">
        <div id="slider-full">
            <h2 class="paso">Paso 1</h2>
            <span>Elige tu diseño</span>
            <?= $this->render('_estampas') ?>
        </div>
        <div class="textos-personalizacion hidden-xs hidden-sm una-linea">
            <h2 class="paso">Paso 2</h2>
            <span>ESCRIBE TU IDEA MÁXIMO 10 CARACTERES POR LÍNEA</span>
            <input type="text" class="linea-1" placeholder="" maxlength="10" value="México" />
            <input type="text" class="linea-2" placeholder="" maxlength="10" />
            <input type="text" class="linea-3" placeholder="" maxlength="10" />
            <div class="clear"></div>
        </div>
        <div id="bloque-bomber">
            <div id="texto-diseno" style="width: 132px;" class="mexico">
       <?= Html::img('@web/images/personalizacion/plantillas/ultra_mexa_aguila.png',['id' => 'aguila']) ?>
                <div type="text" class="linea-1 letras-6" id="edicion-linea-1"><span id="span-linea-1" class="texto-custom">México</span></div>
                <div type="text" class="linea-2 letras-6" id="edicion-linea-2"><span id="span-linea-2" class="texto-custom"></span></div>
                <div type="text" class="linea-3 letras-0" id="edicion-linea-3"><span id="span-linea-3" class="texto-custom"></span></div>
            </div>
            <?= Html::img('@web/images/logo_negro.png', ['id' => 'logo-marca_agua']) ?>
            <div id="texto-diseno">
                <?= Html::img('@web/images/personalizacion/plantillas/ultra_mexa_aguila.png',['id' => 'aguila']) ?>
                <div type="text" class="linea-1" id="edicion-linea-1"><span id="span-linea-1" class="texto-custom">México</span></div>
                <div type="text" class="linea-2" id="edicion-linea-2"><span id="span-linea-2" class="texto-custom"></span></div>
                <div type="text" class="linea-3" id="edicion-linea-3"><span id="span-linea-3" class="texto-custom"></span></div>
            </div>
            <input type="hidden" id="diseno_seleccionado" value="" />
            <div class="bloque-input-mob hidden-lg hidden-md">
                 <a href="javascript:;" class="btn-accion btn-comprar-custom plantilla-comprar" id="btn-comprar-custom">
                    Siguiente
                </a>
                <div class="textos-personalizacion una-linea">
                    <h2 class="paso">Paso 2</h2>
                    <div class="icon-wrapper text-center">
                        <i class="far fa-edit"></i>
                    </div>
                    <input type="text" class="linea-1" placeholder="" maxlength="10" value="México" />
                    <input type="text" class="linea-2" placeholder="" maxlength="10" />
                    <input type="text" class="linea-3" placeholder="" maxlength="10" />
                    <div class="btn-wrapper text-center">
                        <button class="btn-descargar-mob"><i class="fas fa-download"></i></button>
                    </div>
                    <div class="clear"></div>
                </div>
                <div id="slider-personalizacion">
                    <?= $this->render('_estampasMobile') ?>
                </div>
            </div>
            <a href="https://m.me/VocaMXoficialtr?id={your-pixel-id-goes-here}" target="_blank" class="btn-ayuda-bomber asistencia-messenger hidden-lg hidden-md hidden-sm hidden-xs">
                <?= Html::img('@web/images/ayuda.png') ?>&emsp;<span>Ayuda</span>
            </a>
            <button type="button" class="btn-galeria hidden-lg hidden-md hidden-sm hidden-xs">
                <?= Html::img('@web/images/galeriaPersonalizacion/galleryIcon.png', ['class' => 'img-responsive']) ?>
            </button>
            <div class="botones-filtros hidden-sm hidden-xs text-center">
                <a href="#" class="male filtro">
                    <i class="fas fa-male"></i>
                </a>
                <a href="#"class="female filtro">
                    <i class="fas fa-female"></i>
                </a>
                <a href="#" class="letter filtro" >
                    <?= Html::img('@web/images/letra.png',['class' => 'max-width']) ?>
                </a>
            </div>
        </div>
        <div id="bloque-comprar-full">
            <div class="clear"></div>
            <a href="javascript:;" class="btn-accion btn-comprar-custom" id="btn-comprar-custom">
                Siguiente
                </a>
            <a href="javascript:;" class="btn-descargar">Descargar</a>
        </div>
        <div class="clear"></div>
    </div>
    <?php $form = ActiveForm::begin([
        'id' => 'personalizada-form',
        'method' => 'post',
        'action' => Url::to(['bombers/ver-custom'])
    ]); ?>
        <?= $form->field($formulario, 'diseno')->textInput()->label(false) ?>
        <?= $form->field($formulario, 'linea1')->textInput()->label(false) ?>
        <?= $form->field($formulario, 'linea2')->textInput()->label(false) ?>
        <?= $form->field($formulario, 'linea3')->textInput()->label(false) ?>
        <?= $form->field($formulario, 'imagen')->textInput()->label(false) ?>
    <?php ActiveForm::end(); ?>
</div>
<?php foreach ($filtros as $filtro) { ?>
    <input type="hidden" value="<?= $filtro->plantilla->css_id?>" class="<?= $filtro->filtro->clave?>">
<?php } ?>
<div id="popup-galeria-custom" class="white-popup mfp-hide bigger-popup">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12 text-center title-gallery">
                <span>Nuestra chamarra</span><i class="fas fa-caret-down"></i>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-4 col-xs-4">
                <?= Html::img('@web/images/galeriaPersonalizacion/2.jpg',['class' => 'img-responsive']) ?>
            </div>
            <div class="col-sm-4 col-xs-4">
                <?= Html::img('@web/images/galeriaPersonalizacion/3.jpg',['class' => 'img-responsive']) ?>
            </div>
            <div class="col-sm-4 col-xs-4">
                <?= Html::img('@web/images/galeriaPersonalizacion/4.jpg',['class' => 'img-responsive']) ?>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-4 col-xs-4">
                <?= Html::img('@web/images/galeriaPersonalizacion/5.jpg',['class' => 'img-responsive']) ?>
            </div>
            <div class="col-sm-4 col-xs-4">
                <?= Html::img('@web/images/galeriaPersonalizacion/6.jpg',['class' => 'img-responsive']) ?>
            </div>
            <div class="col-sm-4 col-xs-4">
                <?= Html::img('@web/images/galeriaPersonalizacion/7.jpg',['class' => 'img-responsive']) ?>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 text-center title-gallery">
                <span>Nuestros Clientes</span><i class="fas fa-caret-down"></i>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-4 col-xs-4">
                <?= Html::img('@web/images/datos_producto/1.jpg',['class' => 'img-responsive']) ?>
            </div>
            <div class="col-sm-4 col-xs-4">
                <?= Html::img('@web/images/datos_producto/2.jpg',['class' => 'img-responsive']) ?>
            </div>
            <div class="col-sm-4 col-xs-4">
                <?= Html::img('@web/images/datos_producto/3.jpg',['class' => 'img-responsive']) ?>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-4 col-xs-4">
                <?= Html::img('@web/images/datos_producto/4.jpg',['class' => 'img-responsive']) ?>
            </div>
            <div class="col-sm-4 col-xs-4">
                <?= Html::img('@web/images/datos_producto/5.jpg',['class' => 'img-responsive']) ?>
            </div>
            <div class="col-sm-4 col-xs-4">
                <?= Html::img('@web/images/datos_producto/6.jpg',['class' => 'img-responsive']) ?>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-4 col-xs-4">
                <?= Html::img('@web/images/datos_producto/7.jpg',['class' => 'img-responsive']) ?>
            </div>
            <div class="col-sm-4 col-xs-4">
                <?= Html::img('@web/images/datos_producto/8.jpg',['class' => 'img-responsive']) ?>
            </div>
            <div class="col-sm-4 col-xs-4">
                <?= Html::img('@web/images/datos_producto/9.jpg',['class' => 'img-responsive']) ?>
            </div>
        </div>
    </div>
</div>
<div id="popup-generated-img" class="white-popup mfp-hide bigger-popup">
    <div class="img-downloaded-holder text-center">
        <p class="explanation">Si tu navegador no descargó la imagen automáticamente, puedes guardar la imagen inferior.</p>
        <img src="" class="img-generated img-responsive">
    </div>
</div>
