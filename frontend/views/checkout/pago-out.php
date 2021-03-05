<?php
use yii\helpers\Html;
use app\models\Foto;
use app\models\Producto;
use yii\helpers\ArrayHelper;
use yii\widgets\Pjax;
use frontend\models\forms\NewsletterForm;
use yii\bootstrap\ActiveForm;

$precioTotal = 0;
foreach ($productos as $producto) {
    $precioTotal += $producto->precio_descuento * $producto->cantidad;
}
$cantidadAltaProducto =0;
    foreach ($productos as $producto) {
    if ($producto->clave == "ALPR") {
        $cantidadAltaProducto ++;
    }
}
$ip = Yii::$app->geoip->ip();
if ($ip->country == 'Mexico'){
    $moneda = ' MXN';
} else {
    $moneda = ' USD';
}
?>
<div id="bloque-header"></div>
<div class="container banner-top">
    <div class="row display-flex">
        <div class="col-md-12 col-sm-12 col-xs-12">
            Compra protegida por
            <?= Html::img('@web/images/pago/openpay1.png', ['class' => 'img-banner']) ?>
            <?= Html::img('@web/images/pago/visa1.png', ['class' => 'img-banner']) ?>
            <?= Html::img('@web/images/pago/mastercard1.png', ['class' => 'img-banner']) ?>
            <?= Html::img('@web/images/pago/paypal1.png', ['class' => 'img-banner']) ?>
        </div>
    </div>
</div>
<div class="checkout-block container">
    <div class="row">
        <div class="col-md-7 datos_personales" id="datos_personales-compra-bloque">
            <?php if (Yii::$app->user->isGuest): ?>
            <div class="opciones-identidad bloque row">
                <div class="muestra-bloque">
                    <h3 class="text-center hidden-md hidden-lg">
                        <span class="number-title">1</span>
                        <i class="far fa-check-circle"></i> Registro
                    </h3>
                    <p class="summary email hidden-md hidden-lg"></p>
                    <div class="col-md-12 hidden-sm hidden-xs text-center">
                        <h3>Registro</h3>
                        <div class="numero-paso">
                            <span class="number-title text-center">1</span>
                            <i class="far fa-check-circle"></i>
                        </div>
                    </div>
                </div>
                <div id="bloque-opciones-login">
                    <div class="row">
                        <div class="col-md-offset-3 col-md-6">
                            <div class="form-group field-registroform-nombre required">
                                <div class="input-group">
                                    <div class="input-group-addon"><i class="fas fa-at"></i></div>
                                    <?php $newsletterForm = new NewsletterForm();
                                    $form = ActiveForm::begin(['action' => 'mailing/add-mail', 'id' => 'newsletter-form']) ?>
                                    <input type="email" id="registroform-email" class="form-control" name="RegistroForm[email]" placeholder="Ingresa tu correo electrónico" aria-required="true" aria-invalid="true">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-offset-3 col-md-6 col-sm-12 col-xs-12 text-center">
                            <button type="submit" id="email-continue-btn" class="social-signin login">
                                Registrar
                            </button>
                            <?php ActiveForm::end() ?>
                        </div>
                        <div class="col-md-3"></div>
                    </div>
                </div>
            </div>
            <?php endif; ?>
            <?php if (Yii::$app->user->isGuest || !$cliente) : ?>
            <div class="registro bloque row">
                <div class="muestra-bloque inactive">
                    <h3 class="text-center hidden-lg hidden-md">
                        <span class="number-title">2</span>
                        <i class="far fa-check-circle"></i> Datos de compra
                    </h3>
                    <p class="summary registro hidden-md hidden-lg"></p>
                    <div class="col-md-12 hidden-sm hidden-xs text-center">
                        <h3>Datos de compra</h3>
                        <div class="numero-paso">
                            <span class="number-title text-center">2</span>
                            <i class="far fa-check-circle"></i>
                        </div>
                    </div>
                </div>
                <div id="bloque-registro-chk" class="oculto">
                    <?php echo $this->render('_registro', [
                        'registro' => $registro,
                        'paises' => $paises,
                        'cliente' => $cliente,
                        'continentes' => $continentes
                    ]);
                    ?>
                </div>
            </div>
            <?php endif; ?>
            <div class="envios bloque row">
                <div class="muestra-bloque inactive">
                    <h3 class="text-center hidden-md hidden-lg">
                        <span class="number-title">3</span>
                        <i class="far fa-check-circle"></i> Formas de envío
                    </h3>
                    <p class="summary envio hidden-md hidden-lg"></p>
                    <div class="col-md-12 hidden-sm hidden-xs text-center">
                        <h3>Envío</h3>
                        <div class="numero-paso">
                            <span class="number-title text-center">3</span>
                            <i class="far fa-check-circle"></i>
                        </div>
                    </div>
                </div>
                <div id="loader-envios" class="lds-ring oculto"><div></div><div></div><div></div><div></div></div>
                <div id="bloque-envios">
                    <?php if (Yii::$app->user->isGuest || !$cliente) { ?>
                        <?= $this->render('_envio_fijo', [
                                'pais' => $pais,
                                'continente' => $continente,
                            ]);
                        ?>
                    <?php } else { ?>
                    <?php echo $this->render('_envios', [
                        'direccion' => $direccion,
                        'pedido' => $pedido,
                        'costos_envio' => $costos_envio
                    ]);
                }
                ?>
                </div>
            </div>
            <div class="formas-pago bloque row">
                <div class="muestra-bloque inactive">
                    <h3 class="text-center hidden-md hidden-lg">
                        <span class="number-title">4</span>
                        <i class="far fa-check-circle"></i> Formas de pago
                    </h3>
                    <p class="summary pago hidden-md hidden-lg"></p>
                    <div class="col-md-12 hidden-sm hidden-xs text-center">
                        <h3>Formas de Pago</h3>
                        <div class="numero-paso">
                            <span class="number-title text-center">4</span>
                            <i class="far fa-check-circle"></i>
                        </div>
                    </div>
                </div>
                <div id="metodos-pago" class="oculto">
                    <?php
                    if (Yii::$app->user->isGuest || !$cliente) {
                        echo $this->render('_formas-pago', [
                            'tarjetaForm' => $tarjetaForm,
                            'tiendaForm' => $tiendaForm,
                            'mensualidades' => $mensualidades,
                            'openpay_id' => $openpay_id,
                            'openpay_public' => $openpay_public,
                            'openpay_production' => $openpay_production,
                            'cliente' => $cliente,
                            'precioTotal' => $precioTotal
                        ]);
                    } else {
                        echo $this->render('_formas-pago', [
                            'tarjetas' => $tarjetas,
                            'tarjetaForm' => $tarjetaForm,
                            'tiendaForm' => $tiendaForm,
                            'mensualidades' => $mensualidades,
                            'openpay_id' => $openpay_id,
                            'openpay_public' => $openpay_public,
                            'openpay_production' => $openpay_production,
                            'cliente' => $cliente,
                            'precioTotal' => $precioTotal
                        ]);
                    }
                    ?>
                </div>
            </div>
        </div>
        <div class="col-md-5 resumen hidden-sm hidden-xs" id="resumen-compra-bloque">
            <?php Pjax::begin(['id' => 'pjax-products-check', 'timeout' => 2000]); ?>
            <div class="col-md-12">
                <div class="bombers-compradas row">
                    <p class="text-center title">Detalle de compra</p>
                    <?php $total_productos = 0;
                    $row_counter = 0;
                    $productos_contador = 0;
                    $subtotal_productos = 0;?>
                    <?php foreach ($productos as $producto) :?>
                    <?php $display_producto = 'd-none'; ?>
                    <?php if($producto->clave != 'EXTR'){ ?>
                        <?php if($producto->clave == 'DECO'){ ?>
                            <?php $subtotal_productos += $producto->costo_decoracion * $producto->cantidad;?>
                            <?php $total_productos += $producto->costo_decoracion * $producto->cantidad; ?>
                        <?php }else{ ?>
                            <?php $subtotal_productos += $producto->precio * $producto->cantidad;?>
                            <?php $total_productos += $producto->precio_descuento * $producto->cantidad; ?>
                        <?php } ?>
                        <?php $display_producto = 'd-show'; ?>
                    <?php $foto = Foto::find()->where('producto_id=' . $producto->producto)->one(); ?>
                    <div class="col-md-12">
                        <div class="row bombers <?=$display_producto?>">
                            <div class="col-md-5 col-sm-5 col-xs-4 col-img-bomber text-right">
                                <?php if ($producto->diseno): ?>
                                <?= Html::img('@web/images/' . $producto->imagen_personalizada, ['class' => 'foto-bomber']) ?>
                                <?php elseif (isset($foto)): ?>
                                <?= Html::img('@web/images/' . $foto->archivo, ['class' => 'foto-bomber']) ?>
                                <?php endif ?>
                            </div>
                            <div class="col-md-7 col-sm-7 col-xs-8 col-info-bomber">
                                <button type="button" class="eliminar-producto-check" data-producto="<?= $producto->producto ?>" data-talla="<?= $producto->talla_id?>"><i class="fas fa-trash-alt"></i></button>
                                <div class="nombre-producto">
                                    <?= $producto->cantidad . ' x ' . $producto->nombre ?>
                                    <?php if($producto->clave == 'DECO'){ ?>
                                        <?= $producto->color_decoracion ?>
                                    <?php } ?>
                                </div>
                                <div class="campo-producto">
                                    <div class="row precio-text">
                                        <div class="col-md-12">
                                            <span class="campo-nombre">Precio:</span>
                                            <?php if($producto->clave == 'DECO'){ ?>
                                                <?= number_format($producto->costo_decoracion,2) ?>
                                            <?php }else if ($producto->precio_descuento != null & $producto->precio_descuento > 0) {?>
                                                 <span class="campo-valor">$ <?= number_format(($producto->precio_descuento), 2)?></span>
                                                 <span id="base-moneda"><?= $moneda ?></span>
                                            <?php } else{ ?>
                                                <?php if($moneda == ' USD' && $producto->clave == 'EXTR'){ ?>
                                                    <span class="campo-valor">GRATIS</span>
                                                <?php } else { ?>
                                                    <span class="campo-valor">$ <?= number_format(($producto->precio), 2), $moneda ?></span>
                                                <?php } ?>
                                            <?php } ?>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <span class="campo-nombre">Cantidad:</span>
                                            <button class="change-quantity minus <?=$producto->clave?>" data-cantidad="<?= $producto->cantidad?>" data-producto="<?= $producto->producto_carrito ?>" data-clave='<?= $producto->clave?>'=''>-</button>
                                            <?= $producto->cantidad ?>
                                            <button class="change-quantity plus <?=$producto->clave?>" data-cantidad="<?= $producto->cantidad?>" data-producto="<?= $producto->producto_carrito ?>" data-clave='<?= $producto->clave?>'=''>+</button>
                                        </div>
                                    </div>
                                    <?php if($producto->clave != 'EXTR' && $producto->clave != 'HOP'): ?>
                                    <div class="row">
                                        <?php $productoHelper = new Producto();
                                        $tallas = $productoHelper->tallasSold($producto->producto);
                                        $tallasArray = ArrayHelper::map($tallas, 'talla_id', 'talla');
                                        ?>

                                        <div class="col-md-12">
                                            Talla:
                                            <br>
                                            <?php if($producto->clave == 'DECO'){ ?>
                                                <?= $producto->medidas_decoracion ?>
                                            <?php }else{ ?>
                                                <?= Html::dropDownList('', $producto->talla_id, $tallasArray, [
                                                    'class' => 'change-size',
                                                    'data' => [
                                                        'producto' => $producto->producto_carrito,
                                                    ]
                                                ]) ?>
                                            <?php } ?>
                                        </div>
                                    </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                        <div class="product-info">
                            <input type="hidden" class="nombre_producto" value="<?= $producto->nombre ?>">
                            <input type="hidden" class="sku_producto" value="<?= $producto->sku ?>">
                            <?php if($producto->clave == 'DECO'){ ?>
                                <input type="hidden" class="precio_producto" value="<?= $producto->costo_decoracion ?>">
                            <?php }else{ ?>
                                <input type="hidden" class="precio_producto" value="<?= $producto->precio ?>">
                            <?php } ?>
                            <input type="hidden" class="categoria_producto" value="<?= $producto->categoria ?>">
                            <input type="hidden" class="cantidad_producto" value="<?= $producto->cantidad ?>">
                            <input type="hidden" class="id_facebook_producto" value="<?= $producto->id_fb ?>" />
                        </div>
                    </div>
                    <?php } ?>
                    <?php endforeach; ?>
                </div>
            </div>
                <?= Html::hiddenInput('precio-productos', $total_productos); ?>
                <?= Html::hiddenInput('cantidadAltaProducto', $cantidadAltaProducto); ?>
            <?php Pjax::end(); ?>
            <div class="bloque-total col-md-12">
                <div class="row cupones">
                    <div class="col-md-12">
                        <?= Html::hiddenInput('precio-total', $total_productos); ?>
                        <?= Html::hiddenInput('precio-envio', 0); ?>
                        <div class="row centrado">
                            <div class="cupon-wrapper text-center col-md-8">
                                <label for="codigo_descuento" class="label-descuento">CUPÓN:</label>
                                <?= Html::input('text', 'codigo_descuento', '' , [
                                    'class' => 'form-control new-input',
                                    'id' => 'cupon-input']
                                ); ?>
                                <button type="button" class="btn" id="cupon-btn-chk">OK</button>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 text-center">
                                <div id="loader-cupon" class="lds-ring hidden"><div></div><div></div><div></div><div></div></div>
                            </div>
                        </div>
                        <div class="row hidden letrero-cupones">
                            <div class="col-md-12 text-center">
                                <span class="letrero-cupon"></span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="total-lines row" id="subtotal-info">
                    <div class="col-md-offset-2 col-md-8">
                        <div class="row">
                            <div class="col-md-6 col-sm-4 col-xs-4">
                                <h3>SUBTOTAL</h3>
                            </div>

                            <div class="col-md-6 col-sm-8 col-xs-8 text-right">
                                <?php if ($total_productos != null & $total_productos > 0) { ?>
                                    <span class="prices-info" id="span-subtotal">$
                                        <?php echo number_format($total_productos, 2) ?>
                                    </span>
                                    <span class="prices-info span-moneda" ></span>
                                <?php } else { ?>
                                    <span class="prices-info" id="span-subtotal">$
                                        <?php echo number_format($subtotal_productos, 2) ?>
                                    </span>
                                    <span class="prices-info span-moneda" ></span>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                    <?php  $precio_perso = 0 ?>
                    <?php Pjax::begin(['id' => 'pjax-products-check2', 'timeout' => 2000]); ?>
                    <?php if($moneda == ' USD'){ ?>
                        <div class="col-sm-offset-2 col-sm-8">
                            <span>LA PERSONALIZACIÓN ES GRATIS</span>
                            <?php $total_productos += $producto->precio_descuento * $producto->cantidad; ?>
                            <i class="fas fa-info-circle info-perso" data-toggle="tooltip" data-placement="top" title="Te contactaremos después de recibir tu pedido para que tu personalización quede como quieres."></i>
                            <?= Html::hiddenInput('precio-perso', $precio_perso); ?>
                        </div>
                    <?php } else { ?>
                            <?php foreach($productos as $producto){ ?>
                            <?php if($producto->clave == 'EXTR'){ ?>
                            <?php $existe_perso = 1 ?>
                            <?php  $precio_perso =  $producto->precio * $producto->cantidad ?>
                            <div class="col-md-offset-2 col-md-5 col-perso">

                                <?php  $precio_perso =  $producto->precio * $producto->cantidad ?>
                                <?= Html::hiddenInput('precio-perso', $precio_perso); ?>
                                    <p style="margin:0;">PERSONALIZACIÓN</p>
                                    <span class="campo-nombre">Cantidad:</span>
                                    <button class="change-quantity minus <?=$producto->clave?>" data-cantidad="<?= $producto->cantidad?>" data-producto="<?= $producto->producto_carrito ?>" data-clave='<?= $producto->clave?>'=''>-</button>
                                    <?= $producto->cantidad ?>
                                    <button class="change-quantity plus <?=$producto->clave?>" data-cantidad="<?= $producto->cantidad?>" data-producto="<?= $producto->producto_carrito ?>" data-clave='<?= $producto->clave?>'=''>+</button>
                                    <button type="button" class="eliminar-producto-check2" data-producto="<?= $producto->producto ?>" data-talla="<?= $producto->talla_id?>"><i class="fas fa-trash-alt"></i></button>
                            </div>

                            <div class="col-md-3 col-precio-perso">
                                <span class='precio-perso'>$ <?= number_format($producto->precio*$producto->cantidad, 2) ?></span>
                            <i class="fas fa-info-circle info-perso2" data-toggle="tooltip" data-placement="top" title="Te contactaremos después de recibir tu pedido para que tu personalización quede como quieres."></i>
                            </div>
                            <?php } else { ?>
                                <?php $existe_perso = 0 ?>
                            <?php } ?>
                            <?php }  ?>
                            <?php if ($existe_perso == 0){ ?>
                            <div class="col-md-offset-2 col-md-8">
                                <p style="margin:0;">PERSONALIZACIÓN</p>
                                <span class="campo-nombre">Cantidad:</span>
                                <button class="add-custom-button add subtotal">-</button>
                                <?= 0 ?>
                                <button class="add-custom-button add subtotal">+</button>
                            </div>
                            <?php } ?>
                            <?= Html::hiddenInput('precio-perso', $precio_perso); ?>
                    <?php } ?>
                    <?php Pjax::end(); ?>
                </div>
                <div class="total-lines row hidden" id="cupon-info">
                    <div class="col-md-offset-2 col-md-8">
                        <div class="row">
                            <div class="col-md-8 col-sm-6 col-xs-6">
                                <h3>DESCUENTO</h3>
                            </div>
                            <div class="col-md-4 col-sm-6 col-xs-6 text-right">
                                <span class="prices-info" id="span-cupon"></span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="total-lines row">
                    <div class="col-md-offset-2 col-md-8">
                        <div class="row">
                            <div class="col-md-6 col-sm-4 col-xs-4">
                                <h3>ENVÍO</h3>
                            </div>
                            <div class="col-md-6 col-sm-8 col-xs-8 text-right">
                                <span class="prics-info" id="span-envio">$</span>
                                <span class="prices-info span-moneda" ></span>
                            </div>
                        </div>
                    </div>
                </div>
                <hr class="total-divider">
                <div class="total-lines row total">
                    <div class="col-md-offset-2 col-md-8">
                        <div class="row">
                            <div class="col-md-6 col-sm-4 col-xs-4">
                                <h3 class="total-info">TOTAL</h3>
                            </div>
                            <div class="col-md-6 col-sm-8 col-xs-8 text-right">
                                <strong>
                                    <span class="total-info" id="span-total"></span>
                                    <span class="prices-info span-moneda" ></span>
                                </strong>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 checkbox text-center">
                        <label class="term-cond"><input type="checkbox" name="terminos" id="acepta-terminos-out">Acepto <a href="<?= Yii::$app->request->BaseUrl ?>/legal/terminos_condiciones.pdf" target="_blank" class="link-terminos" data-pjax="0">Términos y condiciones</a></label>
                        <p class="help-terms text-center">Debes aceptar términos y condiciones para finalizar</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <a class="btn btn-accion" id="pre-finalizar">Realizar Pago</a>
                        <button class="btn btn-accion hidden" id="finalizar-compra-out" disabled>Realizar Pago</button>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <a href="https://m.me/VocaMXoficial?tr=529281824267405" target="_blank" class="boton-asistencia">
                            <?= Html::img('@web/images/ayuda.png', ['class' => 'img-boton-asistencia']) ?>&emsp;Ayuda inmediata
                        </a>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 text-center">
                        <div id="loader-pago" class="lds-ring hidden"><div></div><div></div><div></div><div></div></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="banner-bottom container">
    <div class="row">
        <div class="col-md-7">
            <?= Html::img('@web/images/banners/banner-garantia.jpg', ['class' => 'img-responsive']) ?>
        </div>
        <div class="col-md-5">
            <div class="row equal main-column-container">
                <div class="col-md-6 col-sm-6 col-xs-6">
                    <div class="row equal">
                        <div class="col-md-2 col-sm-2 col-xs-2 image-column">
                            <?= Html::img('@web/images/banners/seguridad.png', ['class' => 'img-responsive'])  ?>
                        </div>
                        <div class="col-md-10 col-sm-10 col-xs-10 text-column">
                            <span>
                                Garantía de seguridad en compra
                            </span>
                            <?= Html::img('@web/images/banners/garantiaseguridad.jpg', [
                                'class' => 'img-responsive'
                                ]
                            )  ?>
                        </div>
                    </div>
                    <div class="row equal">
                        <div class="col-md-2 col-sm-2 col-xs-2 image-column">
                            <?= Html::img('@web/images/banners/ssl.jpg', ['class' => 'img-responsive'])  ?>
                        </div>
                        <div class="col-md-10 col-sm-10 col-xs-10 text-column">
                            Nuestros sistemas de pago utilizan encriptación SSL que te mantienen seguro
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-sm-6 col-xs-6 text-center">
                    Vocabulario de México S.A. de C.V. <br>
                    RFC: VME181015A20 <br>
                    Ciudad de México
                </div>
            </div>
        </div>
    </div>
</div>
<input type="hidden" name="guest" value="<?php echo (Yii::$app->user->isGuest ? 1 : 0); ?>">
<input type="hidden" name="cupon_aplicado">
<input type="hidden" name="tipo_cupon">
<input type="hidden" name="cantidad_descuento">
<input type="hidden" name="cantidad_chamarras" id='cantidad-chamarras' value='<?= $cantidad_chamarras ?>'>
<input type="hidden" name="popup_mostrado" value="0">

<div id="popup-cupon" class="white-popup mfp-hide bigger-popup">
    <div id="cupon-container">
        <div class="row">
            <div class="col-md-7">
                <p class="cupon-expl">Aprovecha este cupon y obtén un <span class="cupon-cant">20% de descuento</span></p>
            </div>
        </div>
        <div id="popup-terminos" class=" white-popup mfp-hide bigger-popup">
            <div id="checkout-terminos">
                <span>Para poder continuar debes aceptar los términos y condiciones</span>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 text-right" id="bloque-cupon-img">
                <div class="bloque-cupon-copy text-center">
                    <div class="copy-block">
                        <span class="cupon-block">Código: <span id="cupon-text">MEGA</span></span>
                        <button type="button" id="copiar-btn">Copiar</button>
                    </div>
                    <strong>Copia</strong> el cupón y <strong>pégalo</strong> al terminar tu compra
                </div>
                <?= Html::img('@web/images/hub_productos/imagencupon.jpg') ?>
            </div>
        </div>
    </div>
</div>
<div id="popup-terminos" class="white-popup mfp-hide bigger-popup">
    <div id="checkout-terminos">
        <span></span>
    </div>
</div>


<?php foreach($productos as $producto){ ?>
    <?php if($producto->categoria != 'HopeBox'){ ?>
        <div id="noHope"></div>
    <?php break;} ?>
<?php } ?>

<div id="popup-extra-custom" class="white-popup mfp-hide bigger-popup">
    <div class="text-center request">
        <div class="add-buttons-wrapper">
            <?php if($moneda == ' MXN'){ ?>
                <p class="price">$150 pesos c/u</p>
                <button type="button" class="add-custom-button not-add" >No Agregar</button>
                <button type="button" class="add-custom-button add">Agregar</button>
            <?php } else { ?>
                <p class="price">GRATIS</p>
                <button type="button" class="add-custom-button add">Agregar</button>
            <?php } ?>
        </div>
    </div>
    <div class="text-center finish hidden">
        <p class="message"></p>
        <button type="button" class="add-custom-button not-add" >Cerrar</button>
    </div>
</div>


<!--
<section class="custom-social-proof" style="display:none;">
    <div class="custom-notification">
        <div class="custom-notification-container">
            <div class="custom-notification-image-wrapper">
                <?= Html::img('@web/images/carrito/bomberMensaje.jpg') ?>
            </div>
            <div class="custom-notification-content-wrapper">
                <p class="custom-notification-content text-center">
                    <span class="big-text">1,000 PERSONAS</span><br>
                    VIERON ESTA OFERTA EN<br>
                    ESTA SEMANA
                </p>
            </div>
        </div>
        <div class="custom-close"></div>
    </div>
</section>
-->

<div class="mfp-hide white-popup bigger-popup" id="pago-popup">
    <?= Html::img('@web/images/PopupPago.jpg',['class' => 'img-responsive']) ?>
    <a href="https://m.me/VocaMXoficial?tr=529281824267405" id="boton-pago-popup" target="_blank">Contáctanos</a>
</div>
