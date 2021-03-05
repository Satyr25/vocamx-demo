<?php
use yii\helpers\Html;
use yii\helpers\Url;
use app\models\Producto;
use app\models\Categoria;
?>
<style>
@import url('https://fonts.googleapis.com/css?family=Karla:400,700');
@font-face {
    font-family: 'Bebas Neue';
    src: url('https://www.vocamx.com/fonts/bebas/BebasNeue-Regular.eot');
    src: url('https://www.vocamx.com/fonts/bebas/BebasNeue-Regular.eot?#iefix') format('embedded-opentype'),
        url('https://www.vocamx.com/fonts/bebas/BebasNeue-Regular.woff2') format('woff2'),
        url('https://www.vocamx.com/fonts/bebas/BebasNeue-Regular.woff') format('woff'),
        url('https://www.vocamx.com/fonts/bebas/BebasNeue-Regular.ttf') format('truetype'),
        url('https://www.vocamx.com/fonts/bebas/BebasNeue-Regular.svg#BebasNeue-Regular') format('svg');
    font-weight: normal;
    font-style: normal;
}
</style>

<table style="width: 600px;" style="font-family:'Karla';font-size:15px;">
	<tr>
		<th style="background-color: #000; padding: 20px 0;color:#fff;">
			<a href="https://www.vocamx.com">
				<?= Html::img('https://www.vocamx.com/correo/logo.png', array('height'=>50))?>
			</a>
            <div style="font-family:'Karla';font-weight:bold;color:#fff;font-size:25px;margin-top:20px;">
                ¡COMPRA EXITOSA!
            </div>
            <div style="font-family:'Karla';margin-top:10px;font-size:19px;">
                ¡Gracias <?= $cliente->nombre ?> por tu compra!<br>
                <?php if(!$descarga_recibo){ ?>
                    Tu paquete llegará pronto.
                <?php } ?>
            </div>
		</th>
	</tr>

    <?php if(!$descarga_recibo){ ?>
        <?php if($envio->rastreo_carrier){ ?>
        	<tr>
        		<td style="padding-top:50px;text-align:center;background-color:#fff;font-family:'Karla';">
        			<div style="color:#000;font-size:18px;">
                        <img src="https://www.vocamx.com/correo/envio.png" style="width:30px;margin-bottom:10px" />
        				<div>C&oacute;digo de seguimiento:</div>
                        <div style="font-family:'Karla';font-weight:bold;">
                            <?= $envio->rastreo_carrier ?>
                        </div>
                        <a href="https://enviaya.com.mx/track?track_ref=<?= $envio->rastreo_carrier ?>"
                            style="display:block;color:#c31838;font-size:14px;text-decoration:none;margin-top:10px;">
                            Seguir envío
                        </a>
        			</div>
        		</td>
        	</tr>
        <?php } ?>
        <tr>
            <td style="padding-top:30px;text-align:center;background-color:#fff;font-family:'Karla';">
                <div style="color:#000;font-size:18px;">
                    <div>Proveedor de envio:</div>
                    <div style="font-family:'Karla';font-weight:bold;text-transform:uppercase;">
                        <?= $envio->proveedor ?>
                    </div>
                    <div>Fecha estimada de entrega:</div>
                    <div style="font-family:'Karla';font-weight:bold;text-transform:uppercase;">
                        <?= $envio->entrega_estimada ?>
                    </div>
                </div>
            </td>
        </tr>
    <?php }else{ ?>
        <tr>
            <td style="padding-top:50px;text-align:center;background-color:#fff;font-family:'Karla';">
                <div style="color:#000;font-size:18px;">
                    <img src="https://www.vocamx.com/correo/pago_pendiente.png" style="width:30px;margin-bottom:10px" />
                    <div>Ficha de pago:</div>
                    <a href="<?= $descarga_recibo ?>" style="font-family:'Karla';font-weight:bold;display:block;color:#c31838;text-decoration:none;margin-top:10px;">
                        Descargar
                    </a>
                </div>
            </td>
        </tr>
    <?php } ?>
    <tr>
        <td style="padding-top:30px;text-align:center;background-color:#fff;font-family:'Karla';">
			<div style="color:#000;font-size:18px;">
                <img src="https://www.vocamx.com/correo/pin.png" style="height:30px;margin-bottom:10px" />
				<div>
                    <?= $cliente->calle.' '.$cliente->num_ext.($cliente->num_int ? ' '.$cliente->num_int : '') ?>.<br>
                    <?php if($cliente->municipio){ ?>
                        <?= $cliente->municipio ?>.<br>
                    <?php } ?>
                    CP. <?= $cliente->cp ?>
                    <br>
                    <?php if($cliente->pais){ ?>
                        <?= $cliente->ciudad ?>, <?= $cliente->estado ?>. <?= $cliente->pais ?>
                    <?php } ?>
                    <br>
                    Entre calles: <?= $cliente->entre_calles ?><br>
                    Referencias: <?= $cliente->referencias ?><br>
                    Tel: <?= $cliente->telefono ?>

                </div>
			</div>
		</td>
    </tr>
    <tr>
        <td style="padding-top:30px;">
            <table>
                <?php $domain = yii\helpers\Url::base(true);?>
                <?php foreach($productos as $producto){ ?>
                    <tr>
                        <td style="width:300px;">
                            <?php if($producto->diseno){ ?>
                                <?php $src = $domain.'/images/'.$producto->imagen_personalizada; ?>
                            <?php }elseif($producto->custom_photo) { ?>
                                <?php $src = $domain.'/images/'.$producto->custom_photo; ?>
                            <?php }else{ ?>
                                <?php $src = $domain.'/images/'.$producto->foto; ?>
                            <?php } ?>
                            <img src="<?= $src ?>" style="width:300px;"/>
                        </td>
                        <td style="width:300px;">
                            <div style="font-family:'Bebas Neue';font-size:23px;">
                                <?= $producto->nombre ?>
                                <?php if($producto->color_decoracion){ ?>
                                    <?= $producto->color_decoracion ?>
                                <?php } ?>
                            </div>
                            <table>
                                <?php if($producto->diseno){ ?>
                                    <tr>
                                        <td style="font-family:'Karla';font-weight:bold;font-size:15px;width:100px;float:left;">
                                            Frase:
                                        </td>
                                        <td style="font-family:'Karla';font-size:15px;width:150px;float:left;">
                                            <?= implode(' ', [$producto->linea1,$producto->linea2,$producto->linea3]) ?>
                                        </td>
                                    </tr>
                                <?php } ?>
                                <?php if($producto->categoria != 'Extra' && $producto->categoria != 'HopeBox'): ?>
                                    <tr>
                                        <td style="font-family:'Karla';font-weight:bold;font-size:15px;width:100px;float:left;">
                                            Talla:
                                        </td>
                                        <td style="font-family:'Karla';font-size:15px;width:150px;float:left;">
                                            <?php if($producto->medidas_decoracion){ ?>
                                                <?= $producto->medidas_decoracion ?>
                                            <?php }else{ ?>
                                                <?= $producto->talla ?>
                                            <?php } ?>
                                        </td>
                                    </tr>
                                <?php endif; ?>
                                <tr>
                                    <td style="font-family:'Karla';font-weight:bold;font-size:15px;width:100px;float:left;">
                                        Cantidad:
                                    </td>
                                    <td style="font-family:'Karla';font-size:15px;width:150px;float:left;">
                                        <?= $producto->cantidad ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="font-family:'Karla';font-weight:bold;font-size:15px;width:100px;float:left;">
                                        Precio:
                                    </td>
                                    <td style="font-family:'Karla';font-size:15px;width:150px;float:left;">
                                        <?php if($producto->costo_decoracion){ ?>
                                            $<?= ($datos_pedido->cupon_id ? number_format($producto->total, 2) : number_format($producto->costo_decoracion * $producto->cantidad, 2)) ?>
                                        <?php }else{ ?>
                                            $<?= ($datos_pedido->cupon_id ? number_format($producto->total, 2) : number_format($producto->precio_descuento * $producto->cantidad, 2)) ?>
                                        <?php } ?>
                                    </td>
                                </tr>
                                <?php if($producto->custom_mensaje){ ?>
                                <tr>
                                    <td style="font-family:'Karla';font-weight:bold;font-size:15px;width:100px;float:left;">
                                        Mensaje:
                                    </td>
                                    <td style="font-family:'Karla';font-size:15px;width:150px;float:left;">
                                        <?= $producto->custom_mensaje ?>
                                    </td>
                                </tr>
                                <?php } ?>
                                <?php if($producto->custom_comentarios){ ?>
                                <tr>
                                    <td style="font-family:'Karla';font-weight:bold;font-size:15px;width:100px;float:left;">
                                        Comentarios:
                                    </td>
                                    <td style="font-family:'Karla';font-size:15px;width:150px;float:left;">
                                        <?= $producto->custom_comentarios ?>
                                    </td>
                                </tr>
                                <?php } ?>
                            </table>
                        </td>
                    </tr>
                <?php } ?>
            </table>
        </td>
    </tr>
        <td style="color:#000;font-size:23px;padding-top:50px;padding-bottom:30px;text-align:center;font-family:'Bebas Neue';">
            BOMBERS DE COOLTO
        </td>
    </tr>
    <tr>
        <td style="padding-top:10px;padding-bottom:10px;background-color:#000;text-align:center;">
            <a href="https://www.instagram.com/vocamxoficial/" style="text-decoration:none;">
                <img src="<?= $domain ?>/images/redes/instagram.png" style="display:inline-block;margin-left:10px;margin-right:10px;height:20px;" />
            </a>
            <a href="https://facebook.com/VocaMXoficial/" style="text-decoration:none;">
                <img src="<?= $domain ?>/images/redes/facebook.png" style="display:inline-block;margin-left:10px;margin-right:10px;height:20px;" />
            </a>
            <a href="https://www.youtube.com/channel/UCDNo8C3kImKRINqQY6ONehA" style="text-decoration:none;">
                <img src="<?= $domain ?>/images/redes/youtube.png" style="display:inline-block;margin-left:10px;margin-right:10px;height:20px;" />
            </a>
        </td>
    </tr>
</table>
