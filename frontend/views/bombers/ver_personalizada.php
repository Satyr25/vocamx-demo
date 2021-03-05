<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\View;
use yii\bootstrap\ActiveForm;
use app\assets\MasonryAsset;
use app\assets\LazyAsset;
use app\models\Categoria;
use app\models\Producto;

MasonryAsset::register($this);
LazyAsset::register($this);
$reviews = $producto->reviewsActivas;
?>
<div id="bloque-header"></div>
<div class="visible-xs visible-sm text-center back-collection-block">
    <a href="<?= (isset($photoForm) ? Url::to(['bombers/trazos']) : Url::to(['bombers/coleccion', 'coleccion' => '2018', '#' => 'producto-cell-'.$producto->id])) ?>" class="btn-back important-text">
        <i class="fas fa-angle-double-left"></i> <?= (isset($photoForm) ? 'Trazado' : 'Colección') ?>
    </a>
    &emsp;
    <span class="important-text">
        DISEÑO
    </span>
    <?php if(isset($bomberPrev)): ?>
    <a href="<?= Url::to(['bombers/ver', 'id' => $bomberPrev]) ?>" class="important-text"><i class="fas fa-chevron-left"></i></a>
    <?php endif; ?>
    <?php if(isset($bomberAct)): ?>
    <span class="important-text">
        <?= $bomberAct + 1 ?> / <?= $bomberNum ?>
    </span>
    <?php endif; ?>
    <?php if(isset($bomberSig)): ?>
    <a href="<?= Url::to(['bombers/ver', 'id' => $bomberSig]) ?>" class="important-text"><i class="fas fa-chevron-right"></i></a>
    <?php endif; ?>
</div>
<div id="ver-producto-container">
    <div id="ver-producto" class="container">
        <div class="grid">
            <div class="grid-sizer col-md-12"></div>
            <div id="visor-fotos" class="col-md-7 col-sm-12 bloque-ver-compra col-xs-12">
                <div id="contenedor-fotos">
                    <div id="fotos-producto" class="container">
                        <?php if(isset($photoForm)): ?>
                            <div class="foto">
                                <?= Html::img('@web/images/'.$photoForm->fotoRoute, ['data-zoom-image' => Yii::getAlias('@web/images/'.$photoForm->fotoRoute), 'href' => Yii::getAlias('@web/images/'.$photoForm->fotoRoute)]) ?>
                            </div>
                        <?php endif; ?>
                        <div class="foto">
                            <img src="<?= $producto_form->imagen_personalizada ?>" data-zoom-image="<?= $producto_form->imagen_personalizada ?>" href="<?= $producto_form->imagen_personalizada ?>"/>
                        </div>
                        <?php foreach($fotos as $i => $foto){ ?>
                            <?php $extension = pathinfo(Yii::getAlias('@web/images/'.$foto->foto), PATHINFO_EXTENSION); ?>
                            <div class="foto">
                                <?php if(in_array($extension,['mp4','webm'])){ ?>
                                    <video id="video-vocamx-<?= $i ?>" class="video-vocamx" controls preload="none" poster="<?= Yii::getAlias('@web') ?>/images/poster_video.jpg">
                                        <source src="<?= \Yii::$app->request->BaseUrl ?>/images/<?= $foto->foto ?>" type="video/mp4" />
                                    </video>
                                <?php }else{ ?>
                                    <?= Html::img('@web/images/'.$foto->foto,['data-zoom-image' => Yii::getAlias('@web/images/'.$foto->foto), 'href' => Yii::getAlias('@web/images/'.$foto->foto)]) ?>
                                <?php } ?>
                            </div>
                        <?php } ?>
                          <div class="foto youtube">
                            <a href="https://www.youtube.com/watch?v=bJr1RZ2JEm4&feature=youtu.be" class="youtube-link hidden"></a>
                            <iframe src="https://www.youtube.com/embed/bJr1RZ2JEm4?enablejsapi=1&version=3&playerapiid=ytplayer&rel=0"  class="youtube-iframe carrusel" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                            <div class="cover1"></div>
                            <div class="cover2"></div>
                        </div>
                        <div class="foto youtube">
                            <a href="https://www.youtube.com/watch?v=VzBuUs1npls&feature=youtu.be" class="youtube-link hidden"></a>
                            <iframe src="https://www.youtube.com/embed/VzBuUs1npls?enablejsapi=1&version=3&playerapiid=ytplayer&rel=0"  class="youtube-iframe carrusel" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                            <div class="cover1"></div>
                            <div class="cover2"></div>
                        </div>
                        <div class="foto youtube">
                            <a href="https://www.youtube.com/watch?v=lUQxyRchTg8&feature=youtu.be" class="youtube-link hidden"></a>
                            <iframe src="https://www.youtube.com/embed/lUQxyRchTg8?enablejsapi=1&version=3&playerapiid=ytplayer&rel=0"  class="youtube-iframe carrusel" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                            <div class="cover1"></div>
                            <div class="cover2"></div>
                        </div>
                    </div>
                    <div id="cantidad-fotos">
                        <label class="total-imagenes"><?= $total_imagenes = count($fotos) + 3; ?> Fotos</label>
                    </div>
                    <div>
                    <!-- <? /* \ymaker\social\share\widgets\SocialShare::widget([
                        'configurator'  => 'socialShare',
                        'url'           => Url::to(['bombers/ver', 'id' => $producto->id], true),
                        'title'         => 'VOCAMX | Chamarras personalizadas para hombre y mujer',
                        'description'   => 'Checa este artículo: '.$producto->nombre,
                        'imageUrl'      => Url::to('@web/images/'.$fotos[0]->foto, true),
                        'containerOptions' => ['tag' => 'div', 'class' => 'social-share text-right'],
                        'linkContainerOptions' => ['tag' => '']
                    ]); */?> -->
                    </div>
                </div>
                
                <div id="thumb-fotos">
                    <div class="foto">
                        <img src="<?= $producto_form->imagen_personalizada ?>" />
                    </div>
                    <?php foreach($fotos as $i => $foto){ ?>
                        <?php $extension = pathinfo(Yii::getAlias('@web/images/'.$foto->foto), PATHINFO_EXTENSION); ?>
                        <div class="foto">
                            <?php if(in_array($extension,['mp4','webm'])){ ?>
                                <?= Html::img('@web/images/poster_video.jpg') ?>
                            <?php }else{ ?>
                                <?= Html::img('@web/images/'.$foto->foto) ?>
                            <?php } ?>
                        </div>
                    <?php } ?>
                    <div class="foto">
                        <img class="video-miniatura lazy-load" data-src= "<?= Url::to('@web/images/videoMiniatura.jpg', true
                          ) ?>" >
                    </div>
                    <div class="foto">
                           <img class="video-miniatura lazy-load" data-src= "<?= Url::to('@web/images/videoMiniatura.jpg', true
                          ) ?>" >
                    </div>
                    <div class="foto">
                        <img class="video-miniatura lazy-load" data-src= "<?= Url::to('@web/images/videoMiniatura.jpg', true
                          ) ?>" >
                    </div>
                </div>
            </div>
            <div id="datos-producto" class="col-md-5 col-sm-12 bloque-ver-compra col-xs-12">
                <div class="row fondo-gris">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="nombre-bomber"><?= $producto->nombre ?></div>
                    </div>
                </div>
                <div class="row fondo-gris">
                    <div class="col-md-12">
                        <?php $categoria = Categoria::findOne($producto->categoria_id);
                        $precio_desc = $producto->precio_descuento;
                        ?>
                        <p class="price-info">
                            <?php if ($precio_desc != null & $precio_desc > 0 ): ?>
                                $<?= ((int)($precio_desc) != (float)($precio_desc) ? number_format(($precio_desc), 1) : number_format(intval(($precio_desc)))), $producto['moneda']; ?>
                            <?php else:?>
                                $<?= number_format(round($producto->precio, 0, PHP_ROUND_HALF_UP)), $producto['moneda']; ?>
                            <?php endif; ?>&emsp;
                            <s>
                                $<?= number_format(round($producto->precio, 0, PHP_ROUND_HALF_UP)), $producto['moneda']; ?>
                            </s>&emsp;
                            Ahorro:
                            $<?= round($producto->precio - $producto->precio_descuento, 0, PHP_ROUND_HALF_UP), $producto['moneda'];?>
                        </p>
                    </div>
                </div>
                <hr>
                    <?php $form = ActiveForm::begin([
                        'id' => 'form-agrega-carrito',
                        'action' => ['bombers/agrega-carrito']
                        ]
                    );
                    ?>
                    <?= $form->field($producto_form, 'producto')->hiddenInput()->label(false); ?>
                    <?php if ($producto->clave_categoria !== 'HOP'){ ?>
                        <div class="row equal tallas-bloque fondo-gris">
                            <div class="col-md-12 col-sm-12 col-xs-12 bloque-botones">
                                <p class="titulos-sub">
                                    Talla:
                                </p>
                                <?php foreach ($tallas as $i => $talla) { ?>
                                    <?php if ($talla->sold === '1'){ ?>
                                        <button type="button" class="btn-sel-talla talla-sold2 talla-sold<?=$talla->talla?>" data-talla-id="<?= $talla->talla_id ?>">
                                            <?= $talla->talla ?>
                                        </button>
                                    <?php } else { ?>
                                        <button type="button" class="btn-sel-talla talla-buy" data-talla-id="<?= $talla->talla_id ?>">
                                            <?= $talla->talla ?>
                                        </button>
                                    <?php } ?>
                                <?php } ?>
                                <?= $form->field($producto_form, 'talla')->hiddenInput()->label(false); ?>
                            </div>
                        </div>
                    <?php } else { ?>
                        <?= $form->field($producto_form, 'talla')->hiddenInput(['value' => '1'])->label(false); ?>
                    <?php } ?>
                    <div class="row fondo-gris bloque-cantidad">
                        <div class="col-md-12">
                            <p class="titulos-sub">Cantidad:</p>
                            <div class="bloque-btn-cantidad same-line">
                                <button type="button" class="btn-sel-cantidad" id="minus">-</button>
                                <span class="numero-cantidad">1</span>
                                <button type="button" class="btn-sel-cantidad" id="plus">+</button>
                                <?= $form->field($producto_form, 'cantidad')->hiddenInput(['value' => 1])->label(false); ?>
                            </div>
                            <?php if($producto->id == 94){ ?>
                                <div id="imagen-coleccion">
                                    <label id="subeFotoColeccion" for="customColeccion">
                                        <?= Html::img('@web/images/personaliza_foto/subeFoto.png') ?>
                                        Sube tu imagen
                                    </label>
                                    <?= Html::img('@web/images/personaliza_foto/imagen.png', ['id' => 'img-coleccion-subida'])?>
                                    <i class="far fa-check-circle" id="subida-exito"></i>
                                    <?= $form->field($producto_form, 'fotoCustom')->fileInput(['id' => "customColeccion", 'style'=>'display:none;'])->label(false) ?>
                                    <input type="hidden" id="imagen_personalizada" />
                                </div>
                            <?php } ?>
                            <div class="ver-warning-container">
                                <div class="bloque-ver-warning hidden">
                                    Selecciona una talla.
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row fondo-gris">
                        <div class="col-md-12">
                            <?php if(isset($photoForm)){ ?>
                            <?= $form->field($producto_form, 'foto_id')->hiddenInput(['value' => $photoForm->modelId])->label(false) ?>
                            <?php } ?>
                        </div>
                    </div>
                        <div class="row fondo-gris producto-form-botones">
                            <div class="col-md-6 col-sm-6">
                                <button type="button" class="btn-accion" id="btn-carrito">Agregar al carrito</button>
                            </div>
                            <div class="col-md-6 col-sm-6">
                                <button type="submit" class="btn-accion" id="btn-com">Comprar</button>
                            </div>
                        </div>
                        
                    <?php ActiveForm::end() ?>
                    <?php $form = ActiveForm::begin([
                        'id' => 'sold-correo'
                        ]
                    );?>
                    
                    <div class="row sold-correo hidden">
                        <div class="col-md-12">
                            <p>¡LA TALLA SELECCIONADA SE HA AGOTADO!</p>
                            <p>Déjanos tu correo y te avisaremos cuando esté nuevamente disponible.</p>
                        </div>
                        <div class="col-md-6 sold-correo-botones">
                            <?= $form->field($soldCorreo, 'correo')->textInput(['class' => 'ver-input-correo'])->label(false) ?>
                            <?= $form->field($soldCorreo, 'producto_id')->hiddenInput(['value' => $producto->id])->label(false) ?>
                            <?= $form->field($soldCorreo, 'talla_id')->hiddenInput()->label(false) ?>
                        </div>
                        <div class="col-md-6 sold-correo-botones">
                            <button type="submit" class="btn-accion" id="btn-sold-correo">Enviar</button>
                        </div>
                    </div>
                    
                    <?php ActiveForm::end() ?>
                    
                    <div class="row fondo-gris">
                        <div class="sk-folding-cube" id="spinner" style="display:none;">
                            <div class="sk-cube1 sk-cube"></div>
                            <div class="sk-cube2 sk-cube"></div>
                            <div class="sk-cube4 sk-cube"></div>
                            <div class="sk-cube3 sk-cube"></div>
                        </div>
                    </div>


                <hr>
                <div class="row payment-symbols text-center fondo-gris">
                    <i class="fab fa-cc-visa"></i>
                    <i class="fab fa-cc-mastercard"></i>
                    <i class="fab fa-cc-amex"></i>
                    <i class="fab fa-cc-paypal"></i>
                </div>
                <div class="row security-images text-center fondo-gris">
                    <div class="col-md-6 col-sm-6 col-xs-6">
                        <?= Html::img('@web/images/mcafee.png', ['class' => 'img-responsive']) ?>
                    </div>
                    <div class="col-md-6 col-sm-6 col-xs-6">
                        <?= Html::img('@web/images/scanalert.jpg', ['class' => 'img-responsive']) ?>
                    </div>
                </div>
                <div class="row claves-producto visible-lg visible-md">
                    <div class="col-md-5 text-center">
                        <span class="titulos-sub">SKU:</span>
                        <span><?= $producto->sku ?></span>
                    </div>
                    <div class="col-md-7 text-center">
                        <span class="titulos-sub">UPC:</span>
                        <span><?= ltrim($producto->ean, '0') ?></span>
                    </div>
                    <div class="col-md-12 text-center">
                        <span class="titulos-sub">FB ID:</span>
                        <span><?= $producto->id_facebook ?></span>
                    </div>
                </div>
                    <div class="row tab-buttons text-center">
                        <?php if($producto->categoria != 'HopeBox'){ ?>
                            <div class="col-md-6 col-sm-6 col-xs-6">
                                <button class="tab-button active" data-tab="descripcion-tab" type="button">
                                        Descripción
                                </button>
                            </div>
                            <div class="col-md-6 col-sm-6 col-xs-6">
                                <button class="tab-button" data-tab="tallas-tab" type="button">
                                    Guía de tallas
                                </button>    
                            </div>
                        <?php }  ?>
                    </div>
                <div class="row tabs">
                    <div class="col-md-12 tab" id="descripcion-tab">
                        <p class="titulos-sub">Descripción:</p>
                        <div>
                            <?= $producto->descripcion_breve ?>
                            <?= $producto->descripcion ?>
                        </div>
                    </div>
                    <div class="col-md-12 tab oculto" id="tallas-tab">
                        <?= Html::img('@web/images/tallas.jpg', ['class' => 'img-responsive']) ?>
                    </div>
                </div>
                <div id="reviews">
                    <div class="row">
                        <div class="col-md-12">
                            <h3 class="titulos-sub">Opiniones:</h3>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-2">
                            <span class="calificacion-bomber">
                                <?php
                                if($reviews){
                                    foreach($reviews as $review){
                                        $suma = $suma + $review->puntuacion;
                                    }
                                    $promedio = round($suma / count($reviews));
                                } else {
                                    $promedio = 0;
                                }
                                ?>
                                <?= $promedio ?>
                            </span>
                        </div>
                        <div class="col-md-5">
                            <div class="estrellas">
                            <?php
                            for ($estrellasLlenas = 0; $estrellasLlenas < 5; $estrellasLlenas++){
                                if($estrellasLlenas < $promedio){
                            ?>
                                <span class="estrella llena"></span>
                            <?php
                                } else { ?>
                                <span class="estrella"></span>
                            <?php }
                            }
                            ?>
                            </div>
                            <p>Promedio entre <?= count($reviews) ?> opiniones</p>
                        </div>
                        <div class="col-md-5 flex-center">
                            <a href="#popup-form" class="btn-accion inline-popup">Deja tu reseña</a>
                        </div>
                    </div>
                    <?php if($reviews){ ?>
                        <?php foreach ($reviews as $review) { ?>
                            <div class="review">
                                <div class="estrellas">
                                <?php for ($estrellasLlenas = 0; $estrellasLlenas < 5; $estrellasLlenas++) {
                                    if ($estrellasLlenas < $review->puntuacion) {
                                ?>
                                    <span class="estrella llena"></span>
                                <?php
                                    } else {
                                ?>
                                    <span class="estrella"></span>
                                <?php
                                    }
                                }
                                ?>
                                </div>
                                <div class="datos-review">
                                    <p><?= $review->nombre ?></p>
                                    <p><?= $review->review ?></p>
                                </div>
                            </div>
                        <?php } ?>
                    <?php } ?>
                </div>
            </div>
            <div class="col-md-12 col-sm-12 bloque-ver-compra col-xs-12" id="reviews-block">
            </div>
            <?php if($bombersBest){ ?>
            <div class="col-md-12 col-sm-12 bloque-ver-compra col-xs-12" id="bloque-bombers-best">
                <div class="row">
                    <h3 class="titulos-sub titulo-best">
                    Best Sellers
                </h3>
                <?php $i = 0; ?>
                <?php foreach($bombersBest as $bomber){ ?>
                    <?php if($bomber->status == 1){ ?>
                        <?php $i++; ?>
                        <?php 
                            $ip = Yii::$app->geoip->ip();
                            if ($ip->country == 'Mexico'){
                                $moneda = ' MXN';
                                $precio = number_format($bomber->precios[0]->precio, 2);
                                $precio_descuento = number_format($bomber->precios[0]->precio_descuento, 2);
                            } 
                                                   else {
                                $moneda = ' USD';
                                $precio = number_format($bomber->precios[0]->precio_usd, 2);
                                $precio_descuento = number_format($bomber->precios[0]->precio_descuento_usd, 2);
                            }                         
                        ?>
                        <div class="bloques-best text-center <?php echo ($i > 2  ? 'hidden-mobile' : ''); ?> <?php echo ($i < 2 ? 'col-sm-6 col-xs-6' : ''); ?>">
                            <a href="<?= Url::to(['bombers/ver', 'id' => $bomber->id]) ?>">
                                <?= Html::img('@web/images/' . $bomber->fotos[0]->archivo, ['class' => 'images-best-section']) ?>
                                <span class="bomber-name"><?= $bomber->nombre ?></span>
                                <span class="bomber-price">
                                   
                                    <?php if ($precio_descuento != null & $precio_descuento > 0){ ?>
                                        $<?= $precio_descuento, $moneda?>
                                    <?php } else { ?>
                                        $<?= $precio, $moneda ?>
                                    <?php } ?>
                                </span>
                                <span class="bomber-discount"><s>$<?= $precio, $moneda ?></s></span>
                                <div class="ahorro-bomber">
                                    <span><span class="title">Ahorro: </span>$<?= round((str_replace(',','',$precio)) - (str_replace(',','',$precio_descuento))), $moneda ?></span>
                                </div>
                            </a>
                        </div>
                    <?php } ?>
                <?php } ?>
                </div>
            </div>
            <?php } ?>
        </div>
    </div>
</div>

<input type="hidden" id="id_facebook" value="<?= $producto->id_facebook ?>" />
<input type="hidden" id="nombre_facebook" value="<?= $producto->nombre ?>" />
<input type="hidden" id="precio_facebook" value="<?= $producto->precio ?>" />
<input type="hidden" id="categoria_clave" value="<?= $producto->categoria ?>" />
<input type="hidden" id="producto_sku" value="<?= $producto->sku ?>" />

<?php if($reviewForm){ ?>
<div id="popup-form" class="white-popup mfp-hide">
    <?= $this->render('_reviews-form', [
        'reviewForm' => $reviewForm,
        'producto' => $producto,
    ]) ?>
</div>
<?php } ?>
<div id="popup-tabla-tallas" class="white-popup mfp-hide bigger-popup">
    <div id="tabla-tallas-container">
        <div class="row">
            <div class="col-md-12 col-sm-12">
                <img class="foto lazy-load medidas-full" data-src= "<?= Url::to('@web/images/medidas_full.jpg', true ) ?>" >
            </div>
            <!-- <div class="col-md-4 col-sm-4">
                <img class="foto lazy-load" data-src= "<?= Url::to('@web/images/medidas.jpg', true ) ?>" >
            </div> -->
        </div>
        <!-- <div class="row">
            <div class="col-md-12">
                <p>
                    Para confirmar la talla que te gusta: toma una chamarra que tengas en casa y tómale
                    las medidas sobre la prenda extendida y la que más se acerque será tu talla en VOCAMX
                    Sigue el ejemplo de la imagen para poder tomarlas adecuadamente.
                </p>
            </div>
        </div> -->
    </div>
</div>
<div id="popup-devolucion" class="white-popup mfp-hide bigger-popup">
    <div id="devolucion-container">
        <div class="row">
            <div class="col-md-12">
                <span class="popup-title">POLÍTICA DE DEVOLUCIÓN</span>
                <?= Html::img('@web/images/datos_producto/devolucion.png') ?>
                <p class="paragraph-padding explicacion-popup">
                    <strong>¡TU COMPRA ESTÁ PROTEGIDA!</strong> si no recibes el producto que pediste te
                     lo cambiaremos sin costo.<br><br>
                    Tienes <strong>3 días</strong>  para notificarnos y devolver un producto de línea con algún defecto*
                    Las devoluciones no aplican a la venta de productos personalizados o artículos dañados por
                    el desgaste normal. En caso de existir algún <strong>problema de origen con un producto
                    aún siendo personalizado</strong> favor de enviar una foto al recibirlo a
                    <a href="mailto:contacto@vocamx.com" class="link-popup">contacto@vocamx.com</a> con el asunto “Defecto” en un plazo
                     máximo de 3 días.<br><br>
                    Si el motivo de devolución es un producto dañado o defectuoso de fábrica, el costo del envío y
                     retorno correrá por parte de VOCAMX.<br><br>
                    Los cambios se harán efectivos por el mismo producto.<br><br>
                    Si tienes dudas contáctanos:<br><br>
                    <strong>Whats App:</strong> (55) 4936 8267<br>
                    <strong>Mail:</strong> <a href="mailto:contacto@vocamx.com" class="link-popup">contacto@vocamx.com</a><br><br>
                    <em>
                        *Las devoluciones aplican para productos de línea; no gastados, limpios, en perfecto estado
                        y sin usar con las etiquetas y embalaje original en un plazo menor a 3 días después que lo recibas.
                    </em>
                </p>
            </div>
        </div>
    </div>
</div>
<div id="popup-envio" class="white-popup mfp-hide bigger-popup">
    <div id="envio-container">
        <div class="row">
            <div class="col-md-12">
                <span class="popup-title">TIEMPOS DE ENTREGA</span>
                <?= Html::img('@web/images/datos_producto/entrega.png') ?>
                <p class="paragraph-padding explicacion-popup">
                    Nos preocupamos por tu tiempo, es por ello que casi todos nuestros productos los
                    <strong>enviamos al día siguiente del pedido</strong>. Para tu comodidad, máximo
                    tardamos dos días en producir.<br><br>
                    La entrega realmente varía por el tiempo de envío que elijas (2- 6 días)<br><br>
                    Tiempos máximos de entrega:<br><br>
                    Chamarras coleccionables: <strong>1 – 7 días máximo</strong><br>
                    Diseños de Plantilla y Trazados:  <strong>2 - 10 días máximo</strong><br>
                    Diseños Exclusivos:  <strong>5 – 13 días máximo</strong><br><br>
                    Al confirmar tu compra te compartiremos el número de rastreo para conocer
                    el estatus del envío.<br><br>
                    Para mayor rapidez trabajamos con:
                </p>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 images-envios text-center">
                <?= Html::img('@web/images/datos_producto/fedex.png') ?>
                <?= Html::img('@web/images/datos_producto/dhl.png') ?>
                <?= Html::img('@web/images/datos_producto/estafeta.png') ?>
                <?= Html::img('@web/images/datos_producto/ups.png') ?>
                <?= Html::img('@web/images/datos_producto/ivoy.png') ?>
            </div>
        </div>
    </div>
</div>
<div id="popup-tiendas" class="white-popup mfp-hide bigger-popup">
    <div id="tiendas-container">
        <div class="row">
            <div class="col-md-12 flex-center">
                <a href="https://www.paynet.com.mx/mapa-tiendas/index.html" target="_blank" class="btn-accion">Encuentra tu tienda más cercana</a>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <?= Html::img('@web/images/tiendas.jpg', ['class' => 'tiendas-img']) ?>
            </div>
        </div>
    </div>
</div>
<div id="popup-tiendas" class="white-popup mfp-hide bigger-popup">
    <div id="tiendas-container">
        <div class="row">
            <div class="col-md-12 flex-center">
                <a href="https://www.paynet.com.mx/mapa-tiendas/index.html" target="_blank" class="btn-accion">Encuentra tu tienda más cercana</a>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <?= Html::img('@web/images/tiendas.jpg', ['class' => 'tiendas-img']) ?>
            </div>
        </div>
    </div>
</div>
<?php if(isset($bombersFloat)): ?>
<div class="float-bottom hidden-lg hiddem-md container-fluid">
    <div class="row">
        <?php foreach($bombersFloat as $bomber): ?>
        <div class="col-sm-3 col-xs-3">
            <a href="<?= Url::to(['bombers/ver', 'id' => $bomber->id]) ?>">
                <?= Html::img('@web/images/'.$bomber->thumb, ['class' => 'img-coleccion'],['id' => 'imagen-coleccion']) ?>
            </a>
        </div>
        <?php endforeach; ?>
    </div>
</div>
<?php endif; ?>
<input type="hidden" value="<?= $pageView->id ?>" id="valorVisita">
<?php
//if ($producto->categoria == 1){
//    $categ = 'Bombers de linea';
//} elseif ($producto->categoria == 2){
//    $categ = 'Chamarras Coleccionables';    
//} elseif ($producto->categoria == 3){
//    $categ = 'Edicion Limitada';    
//} elseif ($producto->categoria == 4){
//    $categ = 'Personalizado';    
//} elseif ($producto->categoria == 5){
//    $categ = 'Alta Personalizacion';    
//} elseif ($producto->categoria == 6){
//    $categ = 'Personaliza Foto';    
//}
$dataLayerData = array(
            'content_category' => $producto->categoria,
            'content_name' => $producto->nombre, 
            'content_id' => $producto->sku,
            'content_type' => 'product',
            'contents' => array(array(
                    'id' => $producto->sku,
                    'quantity' => 1,
                    'item_price' => $producto->precio,
                )),
            'currency' => 'MXN',
            'value' => $producto->precio,
       );
$this->registerJs(
    "fbq('track', 'ViewContent', ".json_encode($dataLayerData).");",
    View::POS_HEAD
)
?>
        

        
