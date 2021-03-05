<?php
use yii\helpers\Html;
use yii\helpers\Url;
use app\assets\MasonryAsset;
use app\assets\LazyAsset;
use app\models\Producto;
use app\models\Categoria;

MasonryAsset::register($this);
LazyAsset::register($this);
?>

<div id="bloque-header"></div>
<div class="visible-sm visible-xs text-center franja-imagen">
    <span class="text-left">
         <img class="imagen-camara lazy-load" data-src= "<?= Url::to('@web/images/personaliza_foto/subetufoto.png', true)?>" >
    IMAGEN</span>
</div>
<div id="pasos-trazos" class="container-fluid">
    <div class="container visible-sm visible-xs mobile-imagenes">
        <div class="imagen-seleccionada-mobile" id="imagen-seleccionada-mobile">
            <?php $categoria = Categoria::find()->where("categoria.clave = 'TRAZ'")->one();?>
            <?php $producto = Producto::find()->where("categoria_id =". $categoria->id ." AND status = 1")->all(); ?>
            <div>
                <img class="imagen-carrousel lazy-load" data-src= "<?= Url::to('@web/images/personaliza_foto/carrousel1.jpg', true)?>" >
                <div class="texto-fondo">
                    <p class="texto-abajo"><span class="tatuajes">TATUAJES</span>
                    <span class="costo">
                        <?php if ($producto[0]->precios[0]->precio_descuento != null & $producto[0]->precios[0]->precio_descuento > 0) { ?>
                                $<?= number_format($producto[0]->precios[0]->precio_descuento) ?>
                        <?php } else { ?>
                                $<?= number_format($producto[0]->precios[0]->precio) ?>
                        <?php } ?>
                    </span></p>
                    <p class="texto-abajo-agrega"><span class="agrega">AGREGA TU @INSTAGRAM,NOMBRE O FRASE </span>
                    <span class="entrega">ENTREGA DE 2 A 10 DÍAS</span></p>
                </div>
            </div>
            <div>
                <img class="imagen-carrousel lazy-load" data-src= "<?= Url::to('@web/images/personaliza_foto/carrousel2.jpg', true)?>" >
                <div class="texto-fondo">
                    <p class="texto-abajo"><span class="tatuajes">TATUAJES</span>
                    <span class="costo">
                        <?php if ($producto[0]->precios[0]->precio_descuento != null & $producto[0]->precios[0]->precio_descuento > 0) { ?>
                                $<?= number_format($producto[0]->precios[0]->precio_descuento) ?>
                        <?php } else { ?>
                                $<?= number_format($producto[0]->precios[0]->precio) ?>
                        <?php } ?>
                    </span></p>
                    <p class="texto-abajo-agrega"><span class="agrega">AGREGA TU @INSTAGRAM,NOMBRE O FRASE </span>
                    <span class="entrega">ENTREGA DE 2 A 10 DÍAS</span></p>
                </div>
            </div>
            <div>
                <img class="imagen-carrousel lazy-load" data-src= "<?= Url::to('@web/images/personaliza_foto/carrousel3.jpg', true)?>" >
                <div class="texto-fondo">
                    <p class="texto-abajo"><span class="tatuajes">TATUAJES</span>
                    <span class="costo">
                        <?php if ($producto[0]->precios[0]->precio_descuento != null & $producto[0]->precios[0]->precio_descuento > 0) { ?>
                                $<?= number_format($producto[0]->precios[0]->precio_descuento) ?>
                        <?php } else { ?>
                                $<?= number_format($producto[0]->precios[0]->precio) ?>
                        <?php } ?>
                    </span></p>
                    <p class="texto-abajo-agrega"><span class="agrega">AGREGA TU @INSTAGRAM,NOMBRE O FRASE </span>
                    <span class="entrega">ENTREGA DE 2 A 10 DÍAS</span></p>
                </div>
            </div>
            <div>
                <img class="imagen-carrousel lazy-load" data-src= "<?= Url::to('@web/images/personaliza_foto/carrousel4.jpg', true)?>" >
                <div class="texto-fondo">
                    <p class="texto-abajo"><span class="tatuajes">TATUAJES</span>
                    <span class="costo">
                        <?php if ($producto[0]->precios[0]->precio_descuento != null & $producto[0]->precios[0]->precio_descuento > 0) { ?>
                                $<?= number_format($producto[0]->precios[0]->precio_descuento) ?>
                        <?php } else { ?>
                                $<?= number_format($producto[0]->precios[0]->precio) ?>
                        <?php } ?>
                    </span></p>
                    <p class="texto-abajo-agrega"><span class="agrega">AGREGA TU @INSTAGRAM,NOMBRE O FRASE </span>
                    <span class="entrega">ENTREGA DE 2 A 10 DÍAS</span></p>
                </div>
            </div>
            <div>
                <img class="imagen-carrousel lazy-load" data-src= "<?= Url::to('@web/images/personaliza_foto/carrousel5.jpg', true)?>" >
                <div class="texto-fondo">
                    <p class="texto-abajo"><span class="tatuajes">TATUAJES</span>
                    <span class="costo">
                        <?php if ($producto[0]->precios[0]->precio_descuento != null & $producto[0]->precios[0]->precio_descuento > 0) { ?>
                                $<?= number_format($producto[0]->precios[0]->precio_descuento) ?>
                        <?php } else { ?>
                                $<?= number_format($producto[0]->precios[0]->precio) ?>
                        <?php } ?>
                    </span></p>
                    <p class="texto-abajo-agrega"><span class="agrega">AGREGA TU @INSTAGRAM,NOMBRE O FRASE </span>
                    <span class="entrega">ENTREGA DE 2 A 10 DÍAS</span></p>
                </div>
            </div>
            <div>
                <img class="imagen-carrousel lazy-load" data-src= "<?= Url::to('@web/images/personaliza_foto/carrousel6.jpg', true)?>" >
                <div class="texto-fondo">
                    <p class="texto-abajo"><span class="tatuajes">TATUAJES</span>
                    <span class="costo">
                        <?php if ($producto[0]->precios[0]->precio_descuento != null & $producto[0]->precios[0]->precio_descuento > 0) { ?>
                                $<?= number_format($producto[0]->precios[0]->precio_descuento) ?>
                        <?php } else { ?>
                                $<?= number_format($producto[0]->precios[0]->precio) ?>
                        <?php } ?>
                    </span></p>
                    <p class="texto-abajo-agrega"><span class="agrega">AGREGA TU @INSTAGRAM,NOMBRE O FRASE </span>
                    <span class="entrega">ENTREGA DE 2 A 10 DÍAS</span></p>
                </div>
            </div>
            <div>
                <img class="imagen-carrousel lazy-load" data-src= "<?= Url::to('@web/images/personaliza_foto/carrousel7.jpg', true)?>" >
                <div class="texto-fondo">
                    <p class="texto-abajo"><span class="tatuajes">TATUAJES</span>
                    <span class="costo">
                        <?php if ($producto[0]->precios[0]->precio_descuento != null & $producto[0]->precios[0]->precio_descuento > 0) { ?>
                                $<?= number_format($producto[0]->precios[0]->precio_descuento) ?>
                        <?php } else { ?>
                                $<?= number_format($producto[0]->precios[0]->precio) ?>
                        <?php } ?>
                    </span></p>
                    <p class="texto-abajo-agrega"><span class="agrega">AGREGA TU @INSTAGRAM,NOMBRE O FRASE </span>
                    <span class="entrega">ENTREGA DE 2 A 10 DÍAS</span></p>
                </div>
            </div>
            <div>
                <img class="imagen-carrousel lazy-load" data-src= "<?= Url::to('@web/images/personaliza_foto/carrousel8.jpg', true)?>" >
                <div class="texto-fondo">
                    <p class="texto-abajo"><span class="tatuajes">TATUAJES</span>
                    <span class="costo">
                        <?php if ($producto[0]->precios[0]->precio_descuento != null & $producto[0]->precios[0]->precio_descuento > 0) { ?>
                                $<?= number_format($producto[0]->precios[0]->precio_descuento) ?>
                        <?php } else { ?>
                                $<?= number_format($producto[0]->precios[0]->precio) ?>
                        <?php } ?>
                    </span></p>
                    <p class="texto-abajo-agrega"><span class="agrega">AGREGA TU @INSTAGRAM,NOMBRE O FRASE </span>
                    <span class="entrega">ENTREGA DE 2 A 10 DÍAS</span></p>
                </div>
            </div>
            <div>
                <img class="imagen-carrousel lazy-load" data-src= "<?= Url::to('@web/images/personaliza_foto/carrousel9.jpg', true)?>" >
                <div class="texto-fondo">
                    <p class="texto-abajo"><span class="tatuajes">TATUAJES</span>
                    <span class="costo">
                        <?php if ($producto[0]->precios[0]->precio_descuento != null & $producto[0]->precios[0]->precio_descuento > 0) { ?>
                                $<?= number_format($producto[0]->precios[0]->precio_descuento) ?>
                        <?php } else { ?>
                                $<?= number_format($producto[0]->precios[0]->precio) ?>
                        <?php } ?>
                    </span></p>
                    <p class="texto-abajo-agrega"><span class="agrega">AGREGA TU @INSTAGRAM,NOMBRE O FRASE </span>
                    <span class="entrega">ENTREGA DE 2 A 10 DÍAS</span></p>
                </div>
            </div>
            <div>
                <img class="imagen-carrousel lazy-load" data-src= "<?= Url::to('@web/images/personaliza_foto/carrousel10.jpg', true)?>" >
                <div class="texto-fondo">
                    <p class="texto-abajo"><span class="tatuajes">TATUAJES</span>
                    <span class="costo">
                        <?php if ($producto[0]->precios[0]->precio_descuento != null & $producto[0]->precios[0]->precio_descuento > 0) { ?>
                                $<?= number_format($producto[0]->precios[0]->precio_descuento) ?>
                        <?php } else { ?>
                                $<?= number_format($producto[0]->precios[0]->precio) ?>
                        <?php } ?>
                    </span></p>
                    <p class="texto-abajo-agrega"><span class="agrega">AGREGA TU @INSTAGRAM,NOMBRE O FRASE </span>
                    <span class="entrega">ENTREGA DE 2 A 10 DÍAS</span></p>
                </div>
            </div>
            <div>
                <img class="imagen-carrousel lazy-load" data-src= "<?= Url::to('@web/images/personaliza_foto/carrousel11.jpg', true)?>" >
                <div class="texto-fondo">
                    <p class="texto-abajo"><span class="tatuajes">TATUAJES</span>
                    <span class="costo">
                        <?php if ($producto[0]->precios[0]->precio_descuento != null & $producto[0]->precios[0]->precio_descuento > 0) { ?>
                                $<?= number_format($producto[0]->precios[0]->precio_descuento) ?>
                        <?php } else { ?>
                                $<?= number_format($producto[0]->precios[0]->precio) ?>
                        <?php } ?>
                    </span></p>
                    <p class="texto-abajo-agrega"><span class="agrega">AGREGA TU @INSTAGRAM,NOMBRE O FRASE </span>
                    <span class="entrega">ENTREGA DE 2 A 10 DÍAS</span></p>
                </div>
            </div>
        </div>
    </div>
     <a href="#" class="btn-info btn-galeria hidden-lg hidden-md">
    <span>+INFO</span>
     </a>
</div>
<div id="detalles-trazos" class="container visible-sm visible-xs">
    <div class="col-md-6">
        <div class="text-center">
            <h3 class="titulo-seccion-pasos hidden-sm hidden-xs">Echa un vistazo a lo que han hecho</h3>
            <div id="carrusel-gato">
                <div class="imagenes">
                    <?= Html::img('@web/images/personaliza_foto/carrousel1.jpg', [
                        'href' => Yii::getAlias('@web/images/personaliza_foto/carrousel1.jpg'),
                        'class' => 'Chamarra_Personalizada'
                    ]) ?>
                </div>
                <?php for ($i = 2; $i < 12; $i++) { ?>
                    <div class="imagenes">
                        <?= Html::img('@web/images/personaliza_foto/carrousel' . $i . '.jpg', ['href' => Yii::getAlias('@web/images/personaliza_foto/carrousel' . $i . '.jpg')]) ?>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <?php echo $this->render('_photo-form', [
            'photoForm' => $photoForm,
            'desktop' => false
        ]) ?>

        <div class="bloque-imagenes-mobile row">
            <div class="col-sm-4 col-xs-4">
                 <img class="img-bomber lazy-load" data-src= "<?= Url::to('@web/images/personaliza_foto/H1.jpg', true) ?>" >
            </div>
            <div class="col-sm-4 col-xs-4">
                <img class="img-bomber1 lazy-load" data-src= "<?= Url::to('@web/images/personaliza_foto/PAREJA-VOCAMX.jpg', true) ?>" >
                </div>
            <div class="col-sm-4 col-xs-4">
                 <img class="img-bomber2 lazy-load" data-src= "<?= Url::to('@web/images/personaliza_foto/VOCAMX.jpg', true) ?>" >
            </div>
       </div>
       <div class="bloque-importante-mobile">
           <span class=" visible-sm visible-xs franja-importante text-center">IMPORTANTE</span>
           <span class=" visible-sm visible-xs franja-ayudasiguiente text-center">PARA LOGRAR UN MEJOR RESULTADO AYUDANOS CON LO SIGUIENTE</span>
       </div>
        <div class="bloque-ayuda-mobile row">
            <div class="col-sm-4 col-xs-4">
                 <img class="imagen-ayuda lazy-load" data-src= "<?= Url::to('@web/images/personaliza_foto/imagenNitida.png', true) ?>" >
                <label class="texto-nitido text-center">SUBIR UNA IMAGEN NITIDA</label>
            </div>
            <div class="col-sm-4 col-xs-4">
                 <img class="imagen-ayuda lazy-load" data-src= "<?= Url::to('@web/images/personaliza_foto/imagenfrente.png', true) ?>" >
                <label class="texto-imagen-frente text-center">UNA IMAGEN TOMADA DE FRENTE</label>
            </div>
            <div class="col-sm-4 col-xs-4">
                 <img class="imagen-ayuda lazy-load" data-src= "<?= Url::to('@web/images/personaliza_foto/derechos.png', true)?>" >
                <label class="texto-derechos text-center">NO USAR IMÁGENES CON DERECHOS</label>
            </div>
       </div>

       <div class="bloque-proceso-mobile">
           <span class=" visible-sm visible-xs franja-conoce text-center">CONOCE NUESTRO PROCESO</span>
       </div>

         <div class="bloque-video-proceso text-center">
                <a href="https://www.youtube.com/watch?v=ff0OQ1QvCGw&feature=youtu.be" class="youtube-link hidden"></a>
                <iframe class="video-youtube-proceso" src="https://www.youtube.com/embed/ff0OQ1QvCGw" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
        </div>

        <div class="bloque-imagenes-mobile row">
            <div class="col-sm-4 col-xs-4">
                 <img class="img-chica1 lazy-load" data-src= "<?= Url::to('@web/images/personaliza_foto/13.jpg', true) ?>" >
            </div>
            <div class="col-sm-4 col-xs-4">
                 <img class="img-chica2 lazy-load" data-src= "<?= Url::to('@web/images/personaliza_foto/15.jpg', true)?>" >
            </div>
            <div class="col-sm-4 col-xs-4">
                <img class="img-chica3 lazy-load" data-src= "<?= Url::to('@web/images/personaliza_foto/14.jpg', true)?>" >
            </div>
       </div>
    </div>
</div>



<!--ESCRITORIO-->


<div id="pasos-trazos-escritorio" class="container-fluid">
    <div class="container  hidden-sm hidden-xs">
         <div class="col-md-6 bloque-carrusel">
            <div class=" text-center franjaimg-escritorio">
                <span class="text-left">
                 <img class="imgcamara-escritorio lazy-load" data-src= "<?= Url::to('@web/images/personaliza_foto/subetufoto.png', true)?>" >
            IMAGEN</span>
        </div>
        <div class="imagen-seleccionada-escritorio hidden-sm hidden-xs" id="imagen-seleccionada-escritorio">
            <?php $categoria = Categoria::find()->where("categoria.clave = 'TRAZ'")->one();?>
            <?php $producto = Producto::find()->where("categoria_id =". $categoria->id ." AND status = 1")->all(); ?>
                <div>
                    <?php echo Html::img('@web/images/personaliza_foto/carrousel1.jpg' , ['class' => 'imagen-carrusel']) ?>
                    <div class="texto-fondo-escritorio">
                        <p class="texto-abajo-escritorio"><span class="tatuajes-escritorio">TATUAJES</span>
                            <span class="costo-escritorio">
                                <?php if ($producto[0]->precios[0]->precio_descuento != null & $producto[0]->precios[0]->precio_descuento > 0) { ?>
                                    $<?= number_format($producto[0]->precios[0]->precio_descuento) ?>
                                <?php } else { ?>
                                    $<?= number_format($producto[0]->precios[0]->precio) ?>
                                <?php } ?> </span></p>
                        <p class="texto-abajo-agrega-escritorio"><span class="agrega-escritorio">AGREGA TU @INSTAGRAM,NOMBRE O FRASE </span>
                            <span class="entrega-escritorio">ENTREGA DE 2 A 10 DÍAS</span></p>
                    </div>
                </div>
                <div>
                    <?php echo Html::img('@web/images/personaliza_foto/carrousel2.jpg' , ['class' => 'imagen-carrusel']) ?>
                    <div class="texto-fondo-escritorio">
                    <p class="texto-abajo-escritorio"><span class="tatuajes-escritorio">TATUAJES</span>
                            <span class="costo-escritorio">
                                <?php if ($producto[0]->precios[0]->precio_descuento != null & $producto[0]->precios[0]->precio_descuento > 0) { ?>
                                    $<?= number_format($producto[0]->precios[0]->precio_descuento) ?>
                                <?php } else { ?>
                                    $<?= number_format($producto[0]->precios[0]->precio) ?>
                                <?php } ?>
                            </span></p>
                        <p class="texto-abajo-agrega-escritorio"><span class="agrega-escritorio">AGREGA TU @INSTAGRAM,NOMBRE O FRASE </span>
                            <span class="entrega-escritorio">ENTREGA DE 2 A 10 DÍAS</span></p>
                    </div>
                </div>
                <div>
                    <?php echo Html::img('@web/images/personaliza_foto/carrousel3.jpg' , ['class' => 'imagen-carrusel']) ?>
                <div class="texto-fondo-escritorio">
                    <p class="texto-abajo-escritorio"><span class="tatuajes-escritorio">TATUAJES</span>
                            <span class="costo-escritorio">
                                <?php if ($producto[0]->precios[0]->precio_descuento != null & $producto[0]->precios[0]->precio_descuento > 0) { ?>
                                    $<?= number_format($producto[0]->precios[0]->precio_descuento) ?>
                                <?php } else { ?>
                                    $<?= number_format($producto[0]->precios[0]->precio) ?>
                                <?php } ?>
                            </span></p>
                        <p class="texto-abajo-agrega-escritorio"><span class="agrega-escritorio">AGREGA TU @INSTAGRAM,NOMBRE O FRASE </span>
                            <span class="entrega-escritorio">ENTREGA DE 2 A 10 DÍAS</span></p>
                    </div>
                </div>
                <div>
                    <?php echo Html::img('@web/images/personaliza_foto/carrousel4.jpg' , ['class' => 'imagen-carrusel']) ?>
                    <div class="texto-fondo-escritorio">
                   <p class="texto-abajo-escritorio"><span class="tatuajes-escritorio">TATUAJES</span>
                            <span class="costo-escritorio">
                                <?php if ($producto[0]->precios[0]->precio_descuento != null & $producto[0]->precios[0]->precio_descuento > 0) { ?>
                                    $<?= number_format($producto[0]->precios[0]->precio_descuento) ?>
                                <?php } else { ?>
                                    $<?= number_format($producto[0]->precios[0]->precio) ?>
                                <?php } ?>
                            </span></p>
                        <p class="texto-abajo-agrega-escritorio"><span class="agrega-escritorio">AGREGA TU @INSTAGRAM,NOMBRE O FRASE </span>
                            <span class="entrega-escritorio">ENTREGA DE 2 A 10 DÍAS</span></p>
                    </div>
                </div>
                <div>
                    <?php echo Html::img('@web/images/personaliza_foto/carrousel5.jpg' , ['class' => 'imagen-carrusel']) ?>
                    <div class="texto-fondo-escritorio">
                    <p class="texto-abajo-escritorio"><span class="tatuajes-escritorio">TATUAJES</span>
                            <span class="costo-escritorio">
                                <?php if ($producto[0]->precios[0]->precio_descuento != null & $producto[0]->precios[0]->precio_descuento > 0) { ?>
                                    $<?= number_format($producto[0]->precios[0]->precio_descuento) ?>
                                <?php } else { ?>
                                    $<?= number_format($producto[0]->precios[0]->precio) ?>
                                <?php } ?>
                            </span></p>
                        <p class="texto-abajo-agrega-escritorio"><span class="agrega-escritorio">AGREGA TU @INSTAGRAM,NOMBRE O FRASE </span>
                            <span class="entrega-escritorio">ENTREGA DE 2 A 10 DÍAS</span></p>
                    </div>
                </div>
                 <div>
                    <?php echo Html::img('@web/images/personaliza_foto/carrousel6.jpg' , ['class' => 'imagen-carrusel']) ?>
                    <div class="texto-fondo-escritorio">
                    <p class="texto-abajo-escritorio"><span class="tatuajes-escritorio">TATUAJES</span>
                            <span class="costo-escritorio">
                                <?php if ($producto[0]->precios[0]->precio_descuento != null & $producto[0]->precios[0]->precio_descuento > 0) { ?>
                                    $<?= number_format($producto[0]->precios[0]->precio_descuento) ?>
                                <?php } else { ?>
                                    $<?= number_format($producto[0]->precios[0]->precio) ?>
                                <?php } ?>
                            </span></p>
                        <p class="texto-abajo-agrega-escritorio"><span class="agrega-escritorio">AGREGA TU @INSTAGRAM,NOMBRE O FRASE </span>
                            <span class="entrega-escritorio">ENTREGA DE 2 A 10 DÍAS</span></p>
                    </div>
                </div>
                <div>
                    <?php echo Html::img('@web/images/personaliza_foto/carrousel7.jpg' , ['class' => 'imagen-carrusel']) ?>
                    <div class="texto-fondo-escritorio">
                    <p class="texto-abajo-escritorio"><span class="tatuajes-escritorio">TATUAJES</span>
                            <span class="costo-escritorio">
                                <?php if ($producto[0]->precios[0]->precio_descuento != null & $producto[0]->precios[0]->precio_descuento > 0) { ?>
                                    $<?= number_format($producto[0]->precios[0]->precio_descuento) ?>
                                <?php } else { ?>
                                    $<?= number_format($producto[0]->precios[0]->precio) ?>
                                <?php } ?>
                            </span></p>
                        <p class="texto-abajo-agrega-escritorio"><span class="agrega-escritorio">AGREGA TU @INSTAGRAM,NOMBRE O FRASE </span>
                            <span class="entrega-escritorio">ENTREGA DE 2 A 10 DÍAS</span></p>
                    </div>
                </div>
                <div>
                    <?php echo Html::img('@web/images/personaliza_foto/carrousel8.jpg' , ['class' => 'imagen-carrusel']) ?>
                <div class="texto-fondo-escritorio">
                    <p class="texto-abajo-escritorio"><span class="tatuajes-escritorio">TATUAJES</span>
                            <span class="costo-escritorio">
                                <?php if ($producto[0]->precios[0]->precio_descuento != null & $producto[0]->precios[0]->precio_descuento > 0) { ?>
                                    $<?= number_format($producto[0]->precios[0]->precio_descuento) ?>
                                <?php } else { ?>
                                    $<?= number_format($producto[0]->precios[0]->precio) ?>
                                <?php } ?>
                            </span></p>
                        <p class="texto-abajo-agrega-escritorio"><span class="agrega-escritorio">AGREGA TU @INSTAGRAM,NOMBRE O FRASE </span>
                            <span class="entrega-escritorio">ENTREGA DE 2 A 10 DÍAS</span></p>
                    </div>
                </div>
                <div>
                    <?php echo Html::img('@web/images/personaliza_foto/carrousel9.jpg' , ['class' => 'imagen-carrusel']) ?>
                    <div class="texto-fondo-escritorio">
                    <p class="texto-abajo-escritorio"><span class="tatuajes-escritorio">TATUAJES</span>
                            <span class="costo-escritorio">
                                <?php if ($producto[0]->precios[0]->precio_descuento != null & $producto[0]->precios[0]->precio_descuento > 0) { ?>
                                    $<?= number_format($producto[0]->precios[0]->precio_descuento) ?>
                                <?php } else { ?>
                                    $<?= number_format($producto[0]->precios[0]->precio) ?>
                                <?php } ?>
                            </span></p>
                        <p class="texto-abajo-agrega-escritorio"><span class="agrega-escritorio">AGREGA TU @INSTAGRAM,NOMBRE O FRASE </span>
                            <span class="entrega-escritorio">ENTREGA DE 2 A 10 DÍAS</span></p>
                    </div>
                </div>
                <div>
                    <?php echo Html::img('@web/images/personaliza_foto/carrousel10.jpg' , ['class' => 'imagen-carrusel']) ?>
                    <div class="texto-fondo-escritorio">
                    <p class="texto-abajo-escritorio"><span class="tatuajes-escritorio">TATUAJES</span>
                            <span class="costo-escritorio">
                                <?php if ($producto[0]->precios[0]->precio_descuento != null & $producto[0]->precios[0]->precio_descuento > 0) { ?>
                                    $<?= number_format($producto[0]->precios[0]->precio_descuento) ?>
                                <?php } else { ?>
                                    $<?= number_format($producto[0]->precios[0]->precio) ?>
                                <?php } ?>
                            </span></p>
                        <p class="texto-abajo-agrega-escritorio"><span class="agrega-escritorio">AGREGA TU @INSTAGRAM,NOMBRE O FRASE </span>
                            <span class="entrega-escritorio">ENTREGA DE 2 A 10 DÍAS</span></p>
                    </div>
                </div>
                <div>
                    <?php echo Html::img('@web/images/personaliza_foto/carrousel11.jpg' , ['class' => 'imagen-carrusel']) ?>
                    <div class="texto-fondo-escritorio">
                    <p class="texto-abajo-escritorio"><span class="tatuajes-escritorio">TATUAJES</span>
                            <span class="costo-escritorio">
                                <?php if ($producto[0]->precios[0]->precio_descuento != null & $producto[0]->precios[0]->precio_descuento > 0) { ?>
                                    $<?= number_format($producto[0]->precios[0]->precio_descuento) ?>
                                <?php } else { ?>
                                    $<?= number_format($producto[0]->precios[0]->precio) ?>
                                <?php } ?>
                            </span></p>
                        <p class="texto-abajo-agrega-escritorio"><span class="agrega-escritorio">AGREGA TU @INSTAGRAM,NOMBRE O FRASE </span>
                            <span class="entrega-escritorio">ENTREGA DE 2 A 10 DÍAS</span></p>
                    </div>
                </div>
            </div>
            <div class="text-center escritorio">
                <div class="carrusel-gato2">
                    <div class="imagenes-escritorio  hidden-sm hidden-xs">
                        <?= Html::img('@web/images/personaliza_foto/carrousel1.jpg', [
                            'href' => Yii::getAlias('@web/images/personaliza_foto/carrousel1.jpg'),
                            'class' => 'img-carrusel-gato'
                        ]) ?>
                    </div>
                    <?php for ($i = 2; $i < 12; $i++) { ?>
                        <div class="imagenes-escritorio">
                            <?= Html::img('@web/images/personaliza_foto/carrousel' . $i . '.jpg', ['class' => 'img-carrusel-gato  hidden-sm hidden-xs' , 'href' => Yii::getAlias('@web/images/personaliza_foto/carrousel' . $i . '.jpg')]) ?>
                        </div>
                    <?php } ?>
                </div>
            </div>
            <a href="#" class="btn-informacion btn-galeria ">
                <span>+INFO</span>
            </a>
        </div>
        <div class="col-md-6 bloque-subir">
            <?php echo $this->render('_photo-form', [
                'photoForm' => $photoForm,
                'desktop' => true
            ]) ?>
            <div class="bloque-importante  hidden-sm hidden-xs">
               <span class="franja-importante-escritorio text-center">IMPORTANTE</span><br>
               <span class="franjaayuda-escritorio text-center">PARA LOGRAR UN MEJOR RESULTADO AYUDANOS CON LO SIGUIENTE</span>
           </div>
            <div class="bloque-ayuda  hidden-sm hidden-xs row">
                <div class="col-sm-4 col-xs-4">
                    <?= Html::img('@web/images/personaliza_foto/imagenNitida.png', ['class' => 'imagen-ayuda-escritorio img-responsive'])?>
                    <label class="texto-nitido-escritorio text-center">SUBIR UNA IMAGEN NITIDA</label>
                </div>
                <div class="col-sm-4 col-xs-4">
                    <?= Html::img('@web/images/personaliza_foto/imagenfrente.png', ['class' => 'imagen-ayuda-escritorio img-responsive'])?>
                    <label class="texto-imagen-frente-esc text-center">UNA IMAGEN TOMADA DE FRENTE</label>
                </div>
                <div class="col-sm-4 col-xs-4">
                    <?= Html::img('@web/images/personaliza_foto/derechos.png', ['class' => 'imagen-ayuda-escritorio img-responsive'])?>
                    <label class="texto-derechos-escritorio text-center">NO USAR IMÁGENES CON DERECHOS</label>
                </div>
           </div>
        </div>
    </div>
    <div class="bloque2-escritorio  hidden-sm hidden-xs">
        <div class="col-md-6">
       </div>
        <div class="col-md-6 video-escritorio">
           <div class="bloque-proceso hidden-sm hidden-xs">
               <span class="franja-conoce-escritorio text-center">CONOCE NUESTRO PROCESO</span>
            </div>
            <div class="video-escritorio text-center">
                <a href="https://www.youtube.com/watch?v=ff0OQ1QvCGw&feature=youtu.be" class="youtube-link hidden"></a>
                <iframe class="proceso-video" src="https://www.youtube.com/embed/ff0OQ1QvCGw" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
            </div>
            <div class="bloque-imagenes hidden-sm hidden-xs row">
                <div class="col-sm-4 col-xs-4">
                    <?= Html::img('@web/images/personaliza_foto/13.jpg', ['class' => 'imgchica-escritorio'])?>
                </div>
                <div class="col-sm-4 col-xs-4">
                    <?= Html::img('@web/images/personaliza_foto/15.jpg', ['class' => 'imgchica2-escritorio'])?>
                </div>
                <div class="col-sm-4 col-xs-4">
                    <?= Html::img('@web/images/personaliza_foto/14.jpg', ['class' => 'imgchica3-escritorio'])?>
                </div>
           </div>
        </div>
    </div>
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
