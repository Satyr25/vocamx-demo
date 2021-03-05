<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\View;

$ip = Yii::$app->geoip->ip();
$moneda = ' USD';
if($ip->country == 'Mexico'){
    $moneda = ' MXN';
}
?>

<div id="bloque-header"></div>
<section class="white-section">
    <div class="container main-section">
        <div class="row">
            <div class="col-md-12 text-center">
                <h2 class="main-title">
                <?php if(!$descarga_recibo): ?>
                    ¡Compra Exitosa!
                <?php else: ?>
                    Tu pedido está pendiente de pago.
                <?php endif; ?>
                </h2>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 text-center">
                <?php if(!$descarga_recibo): ?>
                <p class="thanks-text">!Gracias <?= $cliente->nombre ?> por tu compra!</p>
                <?php else: ?>
                <a href="<?= $descarga_recibo ?>" target="_blank" class="btn-accion center-block" download>
                    Descarga tu ficha de pago
                </a>
                <object data="<?= $descarga_recibo ?>" type="application/pdf" id="recibo-pdf">
                    <embed src="<?= $descarga_recibo ?>" type="application/pdf"/>
                </object>
                <?php endif; ?>
                <p>
                    Hemos enviado un correo a <u class="email-info"><?= (isset($user->email) ? $user->email : $cliente->email) ?></u><br>
                    En caso de que no aparezca revisa en tu carpeta de <strong>SPAM</strong>
                </p>
            </div>
        </div>
        <div class="row order-info">
            <div class="col-md-12 text-center">
                <h2 class="titulo-seccion">Pedido: <?= $pedido->numero_pedido ?>&emsp;Fecha: <?= date( "d/m/Y", $pedido->created_at); ?></h2>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <p><span class="title-sub">STATUS:</span> <span class="normal-text"><?= $pedido->estado ?></span></p>
            </div>
        </div>
        <div class="row">
            <div class="col-md-8">
                <p class="title-sub">Envío</p>
                <div class="row">
                    <div class="col-md-4">
                        <p class="row-title">Proveedor:</p>
                    </div>
                    <div class="col-md-8">
                        <p class="normal-text"><?= $pedido->proveedor_envio ?></p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <p class="row-title">Tipo:</p>
                    </div>
                    <div class="col-md-8">
                        <p class="normal-text"><?= $pedido->servicio_envio ?></p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <p class="row-title">Costo:</p>
                    </div>
                    <div class="col-md-8">
                        <p class="normal-text">$<?= $pedido->costo_envios, $moneda?></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container main-section">
        <div class="row">
            <div class="col-md-6 text-left">
                <p class="title-sub">Pedido</p>
            </div>
            <div class="col-md-6 text-right">
                <p class="title-sub">Subtotal</p>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <table class="table product-table">
                    <tbody>
                    <?php $total = 0;
                    $total_productos = 0;
                    foreach($productos as $producto):

                    $total += $producto->total;
                    $total_productos += $producto->cantidad;
                    ?>
                        <tr class="row">
                            <td class="col-md-4">
                            <?php if($producto->imagen_personalizada){ ?>
                                <?= Html::img('@web/images/'.$producto->imagen_personalizada, ['class' => 'img-responsive']) ?>
                            <?php }else{ ?>
                                <?= Html::img('@web/images/'.$producto->foto, ['class' => 'img-responsive']) ?>
                            <?php } ?>
                            </td>
                            <td class="col-md-5">
                                <div class="row">
                                    <div class="col-md-4 title-sub">Producto:</div>
                                    <div class="col-md-8 normal-text">
                                        <?= $producto->nombre ?>
                                        <?php if($producto->color_decoracion){ ?>
                                            <?= $producto->color_decoracion ?>
                                        <?php } ?>
                                    </div>
                                </div>
                                <hr>
                                <?php if($producto->diseno): ?>
                                <div class="row">
                                    <div class="col-md-4 title-sub">Diseño:</div>
                                    <div class="col-md-8 normal-text"><?= $producto->diseno ?></div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-md-4 title-sub">Frase:</div>
                                    <div class="col-md-8 normal-text"><?= implode(' ', [$producto->linea1,$producto->linea2,$producto->linea3]) ?></div>
                                </div>
                                <hr>
                                <?php endif; ?>
                                <div class="row">
                                    <div class="col-md-4 title-sub">Cantidad:</div>
                                    <div class="col-md-8 normal-text"><?= $producto->cantidad ?></div>
                                </div>
                                <hr>
                                <?php if($producto->categoria != 'Extra' && $producto->categoria != 'HopeBox'): ?>
                                    <div class="row">
                                        <div class="col-md-4 title-sub">Talla:</div>
                                        <div class="col-md-8 normal-text">
                                            <?php if($producto->medidas_decoracion){ ?>
                                                <?= $producto->medidas_decoracion ?>
                                            <?php }else{ ?>
                                                <?= $producto->talla ?>
                                            <?php } ?>
                                        </div>
                                    </div>
                                    <hr>
                                <?php endif; ?>
                                <div class="row">
                                    <div class="col-md-4 title-sub">Precio:</div>
                                    <div class="col-md-8 normal-text">
                                        <?php if($producto->costo_decoracion){ ?>
                                            <?= $producto->costo_decoracion, $moneda ?>
                                        <?php }else{ ?>
                                            <?php if($producto->precio_descuento): ?>
                                            $<?= $producto->precio_descuento, $moneda ?> <s>$<?= $producto->precio, $moneda ?></s>
                                            <?php else: ?>
                                            <?= $producto->precio, $moneda ?>
                                            <?php endif; ?>
                                        <?php } ?>
                                    </div>
                                </div>
                                <?php if($producto->custom_mensaje){ ?>
                                <hr>
                                <div class="row">
                                    <div class="col-md-4 title-sub">mensaje:</div>
                                    <div class="col-md-8 normal-text"><?= $producto->custom_mensaje ?></div>
                                </div>
                                <?php } ?>
                                <?php if($producto->custom_comentarios){ ?>
                                <hr>
                                <div class="row">
                                    <div class="col-md-4 title-sub">Comentarios:</div>
                                    <div class="col-md-8 normal-text"><?= $producto->custom_comentarios ?></div>
                                </div>
                                <?php } ?>
                            </td>
                            <td class="col-md-3 text-right price-col">
                                <p class="normal-text">
                                    $<?= number_format($producto->total,2), $moneda ?>
                                </p>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                    <tfoot>
                        <tr class="row">
                            <td class="col-md-4"></td>
                            <td class="col-md-4 text-right">
                                <p><span class="title-sub">Total:</span> <span class="normal-text"><?= $total_productos ?> <?= $total_productos > 1 ? 'productos' : 'producto' ?></span></p>
                            </td>
                            <td class="col-md-4 text-right">
                                <p><span class="title-sub">Subtotal:</span> <span class="normal-text">$<?= number_format($total, 2), $moneda ?></span></p>
                                <p>
                                    <span class="title-sub">Envío:</span>
                                    <?php if(isset($cupon) && $cupon && $cupon->activo == 1): ?>
                                        <?php if($cupon->tipo == 'ENV'): ?>
                                            <span class="normal-text">GRATIS</span>
                                        <?php endif ?>
                                    <?php else: ?>
                                        <span class="normal-text">$<?= $pedido->proveedor_envio ? number_format($pedido->costo_envio,2) : $pedido->costo_envios, $moneda ?></span>
                                    <?php endif ?>
                                </p>
                                <?php if(isset($cupon) && $cupon && $cupon->activo == 1): ?>
                                    <?php if($cupon->tipo == 'DES'): ?>
                                    <?php $descuento = $cupon->descuento_fijo ?>
                                    <p><span class="title-sub">Cupón:</span> <span class="normal-text">-$<?= $cupon->descuento_fijo ?></span></p>
                                    <?php elseif ($cupon->tipo == 'DEP'): ?>
                                    <?php $descuento = $total * ($cupon->descuento_fijo / 100) ?>
                                    <p><span class="title-sub">Cupón:</span> <span class="normal-text">-$<?= number_format($descuento, 2) ?></span></p>
                                <?php elseif($cupon->tipo == 'SEG'): ?>
                                        <?php $descuento = ($total+($pedido->proveedor_envio ? $pedido->costo_envio : $pedido->costo_envios))*.10 ?>
                                    <?php else:
                                        $descuento = 0;
                                    endif;
                                else:
                                    $descuento = 0;
                                endif;
                                ?>
                                <?php $costo_envio = $pedido->proveedor_envio ? $pedido->costo_envio : $pedido->costo_envios ?>
                                <?php if($descuento > 0){ ?>
                                    <p><span class="title-sub">Descuento:</span> <span class="normal-text">$<?= number_format($descuento, 2), $moneda ?></span></p>
                                <?php } ?>
                                <p><span class="title-sub">Total:</span> <span class="normal-text">$<?= number_format($total + $costo_envio - $descuento, 2), $moneda ?></span></p>
                            </td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</section>
<section class="gray-section">
    <div class="container main-section">
        <div class="row">
            <div class="col-md-6">
                <p class="title-sub">Datos de envío</p>
                <div class="row">
                    <div class="col-md-2">
                        <p class="row-title">Dirección:</p>
                    </div>
                    <div class="col-md-10 normal-text">
                        <?= $cliente->calle ?> <?= $cliente->num_ext ?> <?= $cliente->num_int ? 'Interior '.$cliente->num_ext : '' ?>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-md-2">
                        <p class="row-title">Colonia:</p>
                    </div>
                    <div class="col-md-10 normal-text">
                        <?= $cliente->colonia ?>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-md-2">
                        <p class="row-title">Alcaldía:</p>
                    </div>
                    <div class="col-md-10 normal-text">
                        <?= $cliente->municipio ?>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-md-2">
                        <p class="row-title">C.P.:</p>
                    </div>
                    <div class="col-md-10 normal-text">
                        <?= $cliente->cp ?>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-md-2">
                        <p class="row-title">Estado:</p>
                    </div>
                    <div class="col-md-10 normal-text">
                        <?= $cliente->estado0->estadonombre ?>
                    </div>
                </div>
                <hr>
            </div>
            <div class="col-md-6 client-col">
                <p class="title-sub">Cliente</p>
                <div class="row">
                    <div class="col-md-3">
                        <p class="row-title">Nombre:</p>
                    </div>
                    <div class="col-md-9 normal-text">
                        <?= $cliente->nombre ?>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-md-3">
                        <p class="row-title">Teléfono:</p>
                    </div>
                    <div class="col-md-9 normal-text">
                        <?= $cliente->telefono ?>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-md-3">
                        <p class="row-title">Correo:</p>
                    </div>
                    <div class="col-md-9 normal-text">
                        <?= $cliente->email ?>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-md-3">
                        <p class="row-title">Dirección:</p>
                    </div>
                    <div class="col-md-9 normal-text">
                        <?= $cliente->calle ?> <?= $cliente->num_ext ?> <?= $cliente->num_int ? 'Interior '.$cliente->num_int : '' ?>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-md-3">
                        <p class="row-title">Colonia:</p>
                    </div>
                    <div class="col-md-9 normal-text">
                        <?= $cliente->colonia ?>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-md-3">
                        <p class="row-title">Alcaldía:</p>
                    </div>
                    <div class="col-md-9 normal-text">
                        <?= $cliente->municipio ?>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-md-3">
                        <p class="row-title">C.P.:</p>
                    </div>
                    <div class="col-md-9 normal-text">
                        <?= $cliente->cp ?>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-md-3">
                        <p class="row-title">Estado:</p>
                    </div>
                    <div class="col-md-9 normal-text">
                        <?= $cliente->estado0->estadonombre ?>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-md-3">
                        <p class="row-title">Forma de pago:</p>
                    </div>
                    <div class="col-md-9 normal-text">
                        <?= $pedido->paymentMethod ?>
                    </div>
                </div>
                <hr>
            </div>
        </div>
    </div>
</section>

<script>
    fbq('track', 'Purchase',{
        value: <?= $total ?>,
        currency: 'MXN',
        content_type: 'product',
        contents: [
            <?php foreach($productos as $i => $producto){ ?>
                {
                    id: <?= $producto->sku ?>,
                    content_name: '<?= $producto->nombre ?>',
                    quantity: <?= $producto->cantidad ?>,
                    item_price: <?= $producto->precio ?>
                }
                <?php if($i+1 < count($productos)){ ?>
                    ,
                <?php } ?>
            <?php } ?>
        ]
    });
</script>

<?php
$productosData = array();
foreach ($productos as $i => $producto) {
    $productoData = array();
    $productoData['name'] = $producto->nombre;
    $productoData['price'] = $producto->precio;
    $productoData['brand'] = 'VocaMX';
    $productoData['category'] = $producto->categoria;
    $productoData['variant'] = 'Negro';
    $productoData['quantity'] = $producto->cantidad;
    $productoData['coupon'] = '';
    array_push($productosData, $productoData);
}

$dataLayerData = array(
    'ec:purchase' => array(
        'actionField' => array(
            'id' => $pedido->numero_pedido,
            'affiliation' => 'VocaMX',
            'revenue' => $total,
            'tax' => '0',
            'shipping' => $pedido->costo_envios,
            'coupon' => ''
        ),
        'products' => $productosData,
    )
);
$this->registerJs("
    dataLayer.push( ". json_encode($dataLayerData) ." ),
    ga('send', 'pageview')",
    View::POS_HEAD
)
?>
