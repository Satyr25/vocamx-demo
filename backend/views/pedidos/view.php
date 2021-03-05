<?php
use yii\helpers\Html;
use yii\helpers\Url;
use app\models\Foto;
use app\models\PersonalizaFoto;
?>
<section class="white-section">
    <div class="container main-section">
        <div class="row">
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
                        <p class="normal-text">$<?= $pedido->costo_envios ?></p>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
            <?php if($pedido->label_envio): ?>
                <a href="https://www.enviaya.com.mx<?= $pedido->label_envio ?>" id="etiqueta-envio" class="btn btn-accion">
                    Etiqueta de Envio
                </a>
            <?php endif; ?>
            <?php if($pedido->estado != 'Enviado'): ?>
                <a href="<?= Url::to(['pedidos/enviado', 'id' => $pedido->id]) ?>" class="btn btn-accion" id="marcar-enviado">
                    Marcar como enviado
                </a>
            <?php endif; ?>
            <?php if($pedido->estado_clave == 'ESP'){ ?>
                <a href="<?= $pedido->ficha_url ?>" class="btn btn-accion" id="marcar-enviado" target="_blank">
                    Imprimir ficha de pago
                </a>
            <?php } ?>
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
                    $foto = Foto::find()->where('producto_id='.$producto->producto)->one() ?>
                        <tr class="row">
                            <td class="col-md-4">
                            <?php if($producto->diseno): ?>
                                <?= Html::img('@web/images/'.$producto->imagen_personalizada, ['class' => 'img-responsive']) ?>
                            <?php elseif($producto->foto_id):
                                $customPhoto = PersonalizaFoto::findOne($producto->foto_id); ?>
                                <?= Html::img('@web/images/' . $customPhoto->custom_photo, ['class' => 'img-responsive']) ?>
                            <?php else: ?>
                                <?= Html::img('@web/images/'.$foto->archivo, ['class' => 'img-responsive']) ?>
                            <?php endif; ?>
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
                                <div class="row">
                                    <div class="col-md-4 title-sub">Precio:</div>
                                    <div class="col-md-8 normal-text">
                                        <?php if($producto->costo_decoracion){ ?>
                                            $<?= number_format($producto->costo_decoracion,2) ?>
                                        <?php }else if($producto->precio_descuento): ?>
                                        $<?= $producto->precio_descuento ?> <s>$<?= $producto->precio ?></s>
                                        <?php else: ?>
                                        <?= $producto->precio ?>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <hr>
                                <?php if($producto->custom_mensaje){ ?>
                                <div class="row">
                                    <div class="col-md-4 title-sub">Mensaje:</div>
                                    <div class="col-md-8 normal-text"><?= $producto->custom_mensaje ?></div>
                                </div>
                                <hr>
                                <?php } ?>
                                <?php if($producto->custom_comentarios){ ?>
                                <div class="row">
                                    <div class="col-md-4 title-sub">Comentarios:</div>
                                    <div class="col-md-8 normal-text"><?= $producto->custom_comentarios ?></div>
                                </div>
                                <?php } ?>
                            </td>
                            <td class="col-md-3 text-right price-col">
                                <p class="normal-text">
                                    $<?= number_format($producto->total,2) ?>
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
                                <p><span class="title-sub">Subtotal:</span> <span class="normal-text">$<?= number_format($total, 2) ?></span></p>
                                <p><span class="title-sub">Envío:</span> <span class="normal-text">$<?= number_format($pedido->costo_envios,2) ?></span></p>
                                <?php if(isset($cupon) && $cupon->activo == 1): ?>
                                    <?php if($cupon->tipo == 'DES'): ?>
                                    <?php $descuento = $cupon->descuento_fijo ?>
                                    <p><span class="title-sub">Cupón:</span> <span class="normal-text">-$<?= $cupon->descuento_fijo ?></span></p>
                                    <?php elseif($cupon->tipo == 'DEP'): ?>
                                    <?php $descuento = $total * ($cupon->descuento_fijo / 100) ?>
                                    <p><span class="title-sub">Cupón:</span> <span class="normal-text">-$<?= number_format($descuento, 2) ?></span></p>
                                    <?php else:
                                        $descuento = 0;
                                    endif;
                                    ?>
                                <?php endif; ?>
                                <?php $costo_envios = $pedido->costo_envios ?>
                                <p><span class="title-sub">Total:</span> <span class="normal-text">$<?= number_format($total + $costo_envios - $descuento, 2) ?></span></p>
                            </td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</section>
<section class="container gray-section main-section">
    <div class="row">
        <div class="col-md-6">
            <p class="title-sub">Datos de envío</p>
            <div class="row">
                <div class="col-md-2">
                    <p class="row-title">Dirección:</p>
                </div>
                <div class="col-md-10 normal-text">
                    <?= $cliente->calle ?>
                    <span class="row-title span-row-title"> Ext: </span> <?= $cliente->num_ext ?>
                    <?php if($cliente->num_int){ ?>
                        <span class="row-title span-row-title"> Int: </span><?= $cliente->num_int ?>
                    <?php } ?>
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
                    <p class="row-title">Entre calles:</p>
                </div>
                <div class="col-md-10 normal-text">
                    <?= $cliente->entre_calles ?>
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col-md-2">
                    <p class="row-title">Referencias:</p>
                </div>
                <div class="col-md-10 normal-text">
                    <?= $cliente->referencias ?>
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
                    <?= $cliente->calle ?>
                    <span class="row-title span-row-title"> Ext: </span> <?= $cliente->num_ext ?>
                    <?php if($cliente->num_int){ ?>
                        <span class="row-title span-row-title"> Int: </span><?= $cliente->num_int ?>
                    <?php } ?>
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
</section>
