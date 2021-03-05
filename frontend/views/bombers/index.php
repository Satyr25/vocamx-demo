<?php

use yii\helpers\Html;
use yii\helpers\Url;
use app\models\Producto;
use app\models\Categoria;
$ip = Yii::$app->geoip->ip();
?>
<div id="bloque-header"></div>
<!-- <div class="visible-sm visible-xs text-center franja-descuento">
    <span class="text-center">20% EN TODA LA TIENDA &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; </span>
</div> -->
<!--
<div class="container-fluid linea-pasos" id="lin-pasos">
    <ul class="list-unstyled multi-steps">
        <li class="paso-1 is-active">Elige diseño</li>
        <li class="paso-2">Registro</li>
        <li class="paso-3">Envío</li>
        <li class="paso-4">Pago</li>
        <li class="paso-5">Confirmación</li>
    </ul>
</div>
-->
<br>
<div id="hub-productos" class="container">
    <div class="bloque-bombers-mobile hidden-desktop">
       <br>
       <div class="container">
           <div class="row text-center">
               <div class="col-12 bomber-info2">
                   <h3><?= $contenido->bloque1_titulo1 ?></h3>
               </div>
                <div class="col-12 bomber-info2">
                   <?= $contenido->bloque1_texto1 ?>
                </div>
           </div>
            <div class="row text-center" id="bloque-1">
                <a href="<?= $contenido->bloque1_enlace1?>">
                    <div class="col-xs-12 col-sm-offset-2 col-sm-8">
                            <?php $categoria = Categoria::find()->where("categoria.clave = 'PERS'")->one();?>
                            <?php $producto = Producto::find()->where("categoria_id =". $categoria->id ." AND status = 1")->all(); ?>
                    </div>
                    <div class="col-xs-12 bloque-sm">
                        <?= Html::img($contenido->bloque1_fondo1, ['class' => 'img-bloque-mobile']) ?>
                        <div class="btn-accion">
                            <?= $contenido->bloque1_boton1 ?>
    <!--                    <?= Html::img('@web/images/flechas.png', ['class' => 'flecha-img']) ?>-->
                        </div>
                    </div>
                </a>
            </div>
            <div class="row text-center">
                <div class="col-12 bomber-info2">
                    <?php if( $ip->country == 'Mexico') { ?>
                        <span class="main-price"><s>$<?= number_format($producto[0]->precios[0]->precio), ' MXN' ?></s></span>
                        <span class="precio">
                            <?php if ($producto[0]->precios[0]->precio_descuento != null & $producto[0]->precios[0]->precio_descuento > 0) { ?>
                                $<?= number_format($producto[0]->precios[0]->precio_descuento), ' MXN' ?>
                            <?php } else { ?>
                                $<?= number_format($producto[0]->precios[0]->precio), ' MXN' ?>
                            <?php } ?>
                        </span>
                     <?php }else{ ?>
                         <span class="main-price"><s>$<?= number_format($producto[0]->precios[0]->precio_usd, 2),' USD' ?></s></span>
                        <span class="precio">
                            <?php if ($producto[0]->precios[0]->precio_descuento_usd != null & $producto[0]->precios[0]->precio_descuento_usd > 0) { ?>
                                $<?= number_format($producto[0]->precios[0]->precio_descuento_usd, 2),' USD' ?>
                            <?php } else { ?>
                                $<?= number_format($producto[0]->precios[0]->precio_usd, 2),' USD' ?>
                            <?php } ?>
                        </span>
                    <?php } ?>
                </div>
                <div class="col-12 bomber-info2">
                    <?= $contenido->bloque1_texto2 ?>
                </div>
            </div>
            <br>
            <br>
            <div class="row text-center">
               <div class="col-12 bomber-info2">
                   <h3><?= $contenido->bloque2_titulo1 ?></h3>
               </div>
                <div class="col-12 bomber-info2">
                   <?= $contenido->bloque2_texto1 ?>
                </div>
           </div>
            <div class="row text-center" id="bloque-1">
                <a href="<?= $contenido->bloque2_enlace1?>">
                    <div class="col-xs-12 col-sm-offset-2 col-sm-8">
                            <?php $categoria = Categoria::find()->where("categoria.clave = 'TRAZ'")->one();?>
                            <?php $producto = Producto::find()->where("categoria_id =". $categoria->id ." AND status = 1")->all(); ?>
                    </div>
                    <div class="col-xs-12 bloque-sm">
                        <?= Html::img($contenido->bloque2_fondo1, ['class' => 'img-bloque-mobile']) ?>
                        <div class="btn-accion">
                            <?= $contenido->bloque2_boton1 ?>
    <!--                    <?= Html::img('@web/images/flechas.png', ['class' => 'flecha-img']) ?>-->
                        </div>
                    </div>
                </a>
            </div>
            <div class="row text-center">
                <div class="col-12 bomber-info2">
                    <?php if( $ip->country == 'Mexico') { ?>
                        <span class="main-price"><s>$<?= number_format($producto[0]->precios[0]->precio), ' MXN' ?></s></span>
                        <span class="precio">
                            <?php if ($producto[0]->precios[0]->precio_descuento != null & $producto[0]->precios[0]->precio_descuento > 0) { ?>
                                $<?= number_format($producto[0]->precios[0]->precio_descuento), ' MXN' ?>
                            <?php } else { ?>
                                $<?= number_format($producto[0]->precios[0]->precio), ' MXN' ?>
                            <?php } ?>
                        </span>
                     <?php }else{ ?>
                         <span class="main-price"><s>$<?= number_format($producto[0]->precios[0]->precio_usd, 2),' USD' ?></s></span>
                        <span class="precio">
                            <?php if ($producto[0]->precios[0]->precio_descuento_usd != null & $producto[0]->precios[0]->precio_descuento_usd > 0) { ?>
                                $<?= number_format($producto[0]->precios[0]->precio_descuento_usd, 2),' USD' ?>
                            <?php } else { ?>
                                $<?= number_format($producto[0]->precios[0]->precio_usd, 2),' USD' ?>
                            <?php } ?>
                        </span>
                    <?php } ?>
                </div>
                <div class="col-12 bomber-info2">
                    <?= $contenido->bloque2_texto2 ?>
                </div>
            </div>
            <br>
            <br>
            <div class="row text-center">
               <div class="col-12 bomber-info2">
                   <h3><?= $contenido->bloque3_titulo1 ?></h3>
               </div>
                <div class="col-12 bomber-info2">
                   <?= $contenido->bloque3_texto1 ?>
                </div>
           </div>
            <div class="row text-center" id="bloque-1">
                <a href="<?= $contenido->bloque3_enlace1?>">
                    <div class="col-xs-12 col-sm-offset-2 col-sm-8">
                            <?php $categoria = Categoria::find()->where("categoria.clave = 'ALPR'")->one();?>
                            <?php $producto = Producto::find()->where("categoria_id =". $categoria->id ." AND status = 1")->all(); ?>
                    </div>
                    <div class="col-xs-12 bloque-sm">
                        <?= Html::img($contenido->bloque3_fondo1, ['class' => 'img-bloque-mobile']) ?>
                        <div class="btn-accion">
                            <?= $contenido->bloque3_boton1 ?>
    <!--                    <?= Html::img('@web/images/flechas.png', ['class' => 'flecha-img']) ?>-->
                        </div>
                    </div>
                </a>
            </div>
            <div class="row text-center">
                <div class="col-12 bomber-info2">
                    <?php if( $ip->country == 'Mexico') { ?>
                        <span class="main-price"><s>$<?= number_format($producto[0]->precios[0]->precio), ' MXN' ?></s></span>
                        <span class="precio">
                            <?php if ($producto[0]->precios[0]->precio_descuento != null & $producto[0]->precios[0]->precio_descuento > 0) { ?>
                                $<?= number_format($producto[0]->precios[0]->precio_descuento), ' MXN' ?>
                            <?php } else { ?>
                                $<?= number_format($producto[0]->precios[0]->precio), ' MXN' ?>
                            <?php } ?>
                        </span>
                     <?php }else{ ?>
                         <span class="main-price"><s>$<?= number_format($producto[0]->precios[0]->precio_usd, 2),' USD' ?></s></span>
                        <span class="precio">
                            <?php if ($producto[0]->precios[0]->precio_descuento_usd != null & $producto[0]->precios[0]->precio_descuento_usd > 0) { ?>
                                $<?= number_format($producto[0]->precios[0]->precio_descuento_usd, 2),' USD' ?>
                            <?php } else { ?>
                                $<?= number_format($producto[0]->precios[0]->precio_usd, 2),' USD' ?>
                            <?php } ?>
                        </span>
                    <?php } ?>
                </div>
                <div class="col-12 bomber-info2">
                    <?= $contenido->bloque3_texto2 ?>
                </div>
            </div>
       </div>
    </div>

<!--    aqui empieza codigo que se ve en escritorio-->


    <div class="row" id="pasos-escritorio">
        <div class="col-md-4">
            <div class="info-producto">
                <div class="container-talla-name">
                    <h3> <?= $contenido->bloque1_titulo1 ?></h3>
                </div>
                <p class="text-center explicacion"><?= $contenido->bloque1_texto1 ?></p>
            </div>
        </div>
        <div class="col-md-4">
            <div class="info-producto">
                <div class="container-talla-name">
                    <h3><?= $contenido->bloque2_titulo1  ?></h3>
                </div>
                <p class="text-center explicacion"><?= $contenido->bloque2_texto1 ?></p>
            </div>
        </div>
        <div class="col-md-4">
            <div class="info-producto">
                <div class="container-talla-name">
                    <h3><?= $contenido->bloque3_titulo1 ?></h3>
                </div>
                <p class="text-center explicacion"><?= $contenido->bloque3_texto1 ?></p>
            </div>
        </div>
    </div>
    <div class="row hidden-mobile" id="main-banners">
         <div class="col-md-4 banner" id="personaliza">
            <a href="<?= $contenido->bloque1_enlace1 ?>">
                <?php $categoria = Categoria::find()->where("categoria.clave = 'PERS'")->one();?>
                <?php $producto = Producto::find()->where("categoria_id =". $categoria->id ." AND status = 1")->all(); ?>
                <?php if( $ip->country == 'Mexico'){ ?>
                    <span class="precio eng"><s>$<?= number_format($producto[0]->precios[0]->precio), ' MXN' ?></s></span>
                    <span class="precio">
                        <?php if ($producto[0]->precios[0]->precio_descuento != null & $producto[0]->precios[0]->precio_descuento > 0) { ?>
                            $<?= number_format($producto[0]->precios[0]->precio_descuento), ' MXN' ?>
                        <?php } else { ?>
                                $<?= number_format($producto[0]->precios[0]->precio), ' MXN' ?>
                        <?php } ?>
                    </span>

                <?php }else{ ?>
                    <span class="precio eng"><s>$<?= number_format($producto[0]->precios[0]->precio_usd, 2),' USD' ?></s></span>
                    <span class="precio">
                        <?php if ($producto[0]->precios[0]->precio_descuento_usd != null & $producto[0]->precios[0]->precio_descuento_usd > 0) { ?>
                            $<?= number_format($producto[0]->precios[0]->precio_descuento_usd, 2),' USD' ?>
                        <?php } else { ?>
                                $<?= number_format($producto[0]->precios[0]->precio_usd, 2),' USD' ?>
                        <?php } ?>
                    </span>
                <?php } ?>
                <?= Html::img($contenido->bloque1_imagen1, ['class' => 'nuevo-img']) ?>
                <div class="img-producto">
                    <?= Html::img($contenido->bloque1_fondo1, ['class' => 'img-responsive Elige_Diseño', 'alt' => 'Elige un diseño para tu chamarra y personaliza con una frase']) ?>
                    <div class="btn-producto flex-center">
                        <span class="btn-accion">
                            <?= $contenido->bloque1_boton1 ?>
                        </span>
                    </div>
                </div>
                <div class="envio-producto text-center">
                    <?= Html::img($contenido->bloque1_imagen2, ['class' => 'entrega-img']) ?>
                    <span class="entrega-text"><?= $contenido->bloque1_texto2 ?></span>
                </div>
            </a>
        </div>
<!--
        <div class="col-md-3 banner" id="coleccionables">
            <a href="?= Url::to(['bombers/coleccion', 'coleccion' => '2018']) ?>">
                ?php $categoria = Categoria::find()->where("categoria.clave = '2018'")->one();?>
                >?php $producto = Producto::find()->where("categoria_id =". $categoria->id ." AND status = 1")->all(); ?>
                >?php if( $ip->country == 'Mexico'){ ?>
                    <span class="precio eng"><s>$>?= number_format($producto[0]->precios[0]->precio), ' MXN' ?></s></span>
                    <span class="precio">
                        >?php if ($producto[0]->precios[0]->precio_descuento != null & $producto[0]->precios[0]->precio_descuento > 0) { ?>
                            $>?= number_format($producto[0]->precios[0]->precio_descuento), ' MXN' ?>
                        >?php } else { ?>
                                $>?= number_format($producto[0]->precios[0]->precio), ' MXN' ?>
                        >?php } ?>
                    </span>
                >?php }else{ ?>
                    <span class="precio eng"><s>$>?= number_format($producto[0]->precios[0]->precio_usd, 2),' USD' ?></s></span>
                    <span class="precio">
                        >?php if ($producto[0]->precios[0]->precio_descuento_usd != null & $producto[0]->precios[0]->precio_descuento_usd > 0) { ?>
                            $>?= number_format($producto[0]->precios[0]->precio_descuento_usd, 2),' USD' ?>
                        >?php } else { ?>
                                $>?= number_format($producto[0]->precios[0]->precio_usd, 2),' USD' ?>
                        >?php } ?>
                    </span>
                >?php } ?>
                <div class="info-producto">
                    <div class="container-talla-name">
                        <h3>chamarras coleccionables</h3>
                    </div>
                    <p class="text-center explicacion">Personaliza la colección con tu nombre o iniciales</p>
                </div>
                <div class="img-producto">
                    ?= Html::img('@web/images/hub_productos/hPcoleccion.png', ['class' => 'img-responsive Chamarra_Coleccionable', 'alt' => 'Chamarra Coleccionable, puedes personalizar la colección con tu nombre o iniciales']) ?>
                </div>
                <div class="btn-producto flex-center">
                    <span class="btn-accion">
                        Colección&emsp;
                        ?= Html::img('@web/images/flechas.png') ?>
                    </span>
                </div>
                <div class="envio-producto text-center">
                    ?= Html::img('@web/images/hub_productos/entrega.png', ['class' => 'entrega-img']) ?>
                    <span class="entrega-text">Entrega 1 - 7 días</span>
                </div>
                        }
            </a>
        </div>
-->
        <div class="col-md-4 banner" id="sube">
            <a href="<?= $contenido->bloque2_enlace1 ?>">
                <?php $categoria = Categoria::find()->where("categoria.clave = 'TRAZ'")->one();?>
                <?php $producto = Producto::find()->where("categoria_id =". $categoria->id ." AND status = 1")->all(); ?>
                <?php if( $ip->country == 'Mexico'){ ?>
                    <span class="precio eng"><s>$<?= number_format($producto[0]->precios[0]->precio), ' MXN' ?></s></span>
                    <span class="precio">
                        <?php if ($producto[0]->precios[0]->precio_descuento != null & $producto[0]->precios[0]->precio_descuento > 0) { ?>
                            $<?= number_format($producto[0]->precios[0]->precio_descuento), ' MXN' ?>
                        <?php } else { ?>
                                $<?= number_format($producto[0]->precios[0]->precio), ' MXN' ?>
                        <?php } ?>
                    </span>
                <?php }else{ ?>
                    <span class="precio eng"><s>$<?= number_format($producto[0]->precios[0]->precio_usd, 2),' USD' ?></s></span>
                    <span class="precio">
                        <?php if ($producto[0]->precios[0]->precio_descuento_usd != null & $producto[0]->precios[0]->precio_descuento_usd > 0) { ?>
                            $<?= number_format($producto[0]->precios[0]->precio_descuento_usd, 2),' USD' ?>
                        <?php } else { ?>
                                $<?= number_format($producto[0]->precios[0]->precio_usd, 2),' USD' ?>
                        <?php } ?>
                    </span>
                <?php } ?>
                <?= Html::img($contenido->bloque2_imagen1, ['class' => 'nuevo-img']) ?>
                <div class="img-producto">
                    <?= Html::img($contenido->bloque2_fondo1, ['class' => 'img-responsive Traza_Tu_Foto', 'alt' => 'Personaliza tu chamarra a partir de una foto, dibujo o ilustración']) ?>
                    <div class="btn-producto flex-center">
                        <span class="btn-accion">
                            <?= $contenido->bloque2_boton1 ?>
                        </span>
                    </div>
                </div>
                <div class="envio-producto text-center">
                    <?= Html::img($contenido->bloque2_imagen2, ['class' => 'entrega-img']) ?>
                    <span class="entrega-text"><?= $contenido->bloque2_texto2  ?></span>
                </div>
            </a>
        </div>
        <div class="col-md-4 banner" id="explicanos">
            <a href="<?= $contenido->bloque3_enlace1 ?>">
                <?php $categoria = Categoria::find()->where("categoria.clave = 'ALPR'")->one();?>
                <?php $producto = Producto::find()->where("categoria_id =". $categoria->id ." AND status = 1")->all(); ?>
                <?php if( $ip->country == 'Mexico'){ ?>
                    <span class="precio eng"><s>$<?= number_format($producto[0]->precios[0]->precio), ' MXN' ?></s></span>
                    <span class="precio">
                        <?php if ($producto[0]->precios[0]->precio_descuento != null & $producto[0]->precios[0]->precio_descuento > 0) { ?>
                            $<?= number_format($producto[0]->precios[0]->precio_descuento), ' MXN' ?>
                        <?php } else { ?>
                            $<?= number_format($producto[0]->precios[0]->precio), ' MXN' ?>
                        <?php } ?>
                    </span>
                <?php }else{ ?>
                    <span class="precio eng"><s>$<?= number_format($producto[0]->precios[0]->precio_usd, 2),' USD' ?></s></span>
                    <span class="precio">
                        <?php if ($producto[0]->precios[0]->precio_descuento_usd != null & $producto[0]->precios[0]->precio_descuento_usd > 0) { ?>
                            $<?= number_format($producto[0]->precios[0]->precio_descuento_usd, 2),' USD' ?>
                        <?php } else { ?>
                            $<?= number_format($producto[0]->precios[0]->precio_usd, 2),' USD' ?>
                        <?php } ?>
                    </span>
                <?php } ?>
                <?= Html::img($contenido->bloque3_imagen1, ['class' => 'nuevo-img']) ?>
                <div class="img-producto">
                    <?= Html::img($contenido->bloque3_fondo1, ['class' => 'img-responsive Chamarra_Alta_Personalizacion', 'alt' => 'Diseña tu chamarra desde cero y crea algo nuevo']) ?>
                    <div class="btn-producto flex-center">
                        <span class="btn-accion">
                            <?= $contenido->bloque3_boton1 ?>
                        </span>
                    </div>
                </div>
                <div class="envio-producto text-center">
                    <?= Html::img($contenido->bloque3_imagen2, ['class' => 'entrega-img']) ?>
                    <span class="entrega-text"><?= $contenido->bloque3_texto2 ?></span>
                </div>
            </a>
        </div>
    </div>
    <div class="row hidden-mobile" id="features-assist">
        <div class="col-md-3 hidden-mobile">
            <?= Html::img('@web/images/hub_productos/pareja.jpg', ['class' => 'img-responsive pareja']) ?>
        </div>
        <div class="col-md-6 bloque-features" id="bloque-general-carac">
            <div class="border-bloque">
                <div class="bloques-carac">
                    <div class="img-carac">
                        <?php echo Html::img('@web/images/hecho_mx.png') ?>
                    </div>
                    <p>Hecho en México</p>
                </div>

                <div class="bloques-carac">
                    <div class="img-carac">
                        <?php echo Html::img('@web/images/tarjetaSegura.png') ?>
                    </div>
                    <p>Compra segura BBVA - Paypal</p>
                </div>
                <div class="bloques-carac tarjeta">
                    <div class="img-carac">
                        <?php echo Html::img('@web/images/3mesessi.png') ?>
                    </div>
                    <p>Pagos con tarjeta de crédito y débito</p>
                </div>
                <div class="bloques-carac camion">
                    <div class="img-carac">
                        <?php echo Html::img('@web/images/entregaBlack.png') ?>
                    </div>
                    <p>Entrega 2-10 días</p>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-xs-6 hidden-desktop text-center meses-mobile">
            <div class="row">
                <div class="col-sm-8 col-xs-8 text-right">
                    <span class="span-meses"><span class="important-text">6 meses</span><br>sin intereses</span>
                </div>
                <div class="col-sm-4 col-xs-4">
                        <?php echo Html::img('@web/images/hub_productos/meses.png', ['class' => 'img-responsive']) ?>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <div class="icons-payment text-center">
                        <?= Html::img('@web/images/pago/paypal.png') ?>
                        <?= Html::img('@web/images/pago/visa.png') ?>
                        <?= Html::img('@web/images/pago/mastercard.png') ?>
                        <?= Html::img('@web/images/pago/Amex.png') ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-sm-6 col-xs-6 bloque-asistencia text-center">
            <div class="title">Asistencia</div>
            <div class="asistencia-imgs ">
                <a class="asistencia-clic" href="https://web.whatsapp.com/send?phone=5215549368267?tr=529281824267405" target="_blank">
                    <?= Html::img('@web/images/whats-white.png', ['class' => 'hidden-mobile asistencia-img']) ?>
                </a>
                <a class="asistencia-clic" href="https://wa.me/+5215549368267?tr=529281824267405" target="_blank">
                    <?= Html::img('@web/images/whats-white.png', ['class' => 'hidden-desktop asistencia-img']) ?>
                </a>
                <a class="asistencia-messenger" href="https://m.me/VocaMXoficial?tr=529281824267405" target="_blank">
                    <?= Html::img('@web/images/messenger-white.png', ['class' => 'asistencia-img msn']) ?>
                </a>
            </div>
            <p class="explanation">¿Dudas?, Contáctanos</p>
        </div>
    </div>
    <div class="text-center funciona-title hidden-mobile">¿Cómo funciona?</div>
    <div class="row hidden-mobile" id="banners-pasos">
        <div class="col-md-4 col-sm-4 col-xs-4 banner">
            <div class="imagen-paso text-center">
                <?= Html::img('@web/images/hub_productos/elige.png') ?>
            </div>
            <div class="nombre-paso text-center">
                <span class="numero-paso">1</span> Elige un producto
            </div>
            <div class="hidden-mobile">
                <div class="explicacion-paso text-center">
                    Checa nuestros productos y elige el que más te guste
                </div>
                <?= Html::img('@web/images/hub_productos/paso1.png', ['class' => 'img-responsive']) ?>
            </div>
        </div>
        <div class="col-md-4 col-sm-4 col-xs-4 banner">
            <div class="imagen-paso text-center">
                <?= Html::img('@web/images/hub_productos/personaliza.png') ?>
            </div>
            <div class="nombre-paso text-center">
                <span class="numero-paso">2</span> Personalízalo
            </div>
            <div class="hidden-mobile">
                <div class="explicacion-paso text-center">
                    Personalízalo en línea y déjanos conocer tus peticiones especiales
                </div>
                <?= Html::img('@web/images/hub_productos/paso2.png', ['class' => 'img-responsive']) ?>
            </div>
        </div>
        <div class="col-md-4 col-sm-4 col-xs-4 banner">
            <div class="imagen-paso text-center">
                <?= Html::img('@web/images/hub_productos/luce.png') ?>
            </div>
            <div class="nombre-paso text-center">
                <span class="numero-paso">3</span> Luce único
            </div>
            <div class="hidden-mobile">
                <div class="explicacion-paso text-center">
                    Usa tu chamarra que te hará ver único porque sólo tú la tendrás
                </div>
                <?= Html::img('@web/images/hub_productos/paso3.png', ['class' => 'img-responsive']) ?>
            </div>
        </div>
    </div>
</div>
<input type="hidden" class="popup-display" value="<?= $popupDisplayed ?>" />
<div id="popup-cupon" class="white-popup mfp-hide bigger-popup">
    <div id="cupon-container">
          <?= Html::img($contenido->popup1_imagen1) ?>
        <!--<div class="row">
            <div class="col-md-7">
                <p class="cupon-expl">Aprovecha este cupón y obtén un <br class="hidden-lg hidde-md"><span class="cupon-cant">20% de descuento</span></p>
            </div>
        </div>-->
        <!--<div class="row">
            <div class="col-md-12 text-right" id="bloque-cupon-img">
                <div class="bloque-cupon-copy text-center">
                    <div class="copy-block">
                        <span class="cupon-block">Código: <span id="cupon-text">MEGA</span></span>
                        <button type="button" id="copiar-btn">Copiar</button>
                    </div>
                    <strong>Copia</strong> el cupón y <strong>pégalo</strong> al terminar tu compra
                </div>

            </div>-->
        </div>
</div>
