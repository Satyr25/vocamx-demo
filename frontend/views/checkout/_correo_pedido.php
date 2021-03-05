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
                ¡Nuevo Pedido!
            </div>
            <div style="font-family:'Karla';margin-top:10px;font-size:20px;">
                Se registró un nuevo pedido.
            </div>
		</th>
	</tr>
    <tr>
        <td style="padding-top:30px;text-align:center;background-color:#fff;font-family:'Karla';">
			<div style="color:#000;font-size:18px;">
                <img src="https://www.vocamx.com/correo/pin.png" style="height:30px;margin-bottom:10px" />
				<div>
                    <?= $cliente->nombre ?><br>
                    Email: <?= $cliente->email ?><br>
                    Tel: <?= $cliente->telefono ?><br>
                    <?= $cliente->calle.' '.$cliente->num_ext.($cliente->num_int ? ' '.$cliente->num_int : '') ?>.<br>
                    <?= $cliente->colonia ?><br>
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
                    Proveedor de envio: <?= $envio->proveedor ?><br>
                    Fecha estimada de entrega: <?= $envio->entrega_estimada ?><br>
                    <?php if($envio->rastreo_carrier): ?>
                    Numero de seguimiento:<br>
                    <a href="https://enviaya.com.mx/track?track_ref=<?= $envio->rastreo_carrier ?>">
                        <?= $envio->rastreo_carrier ?>
                    </a><br>
                    <?php endif; ?>
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

                            <?php $prod = Producto::findOne($producto->producto); ?>
                            <?php $categoria = Categoria::findOne($prod->categoria_id); ?>
                            <?php if($categoria->clave == "ALPR" || $categoria->clave == "TRAZ" || $categoria->clave == "2018" ) { ?>
                                <?php if ($producto->custom_photo != null) { ?>
                                        <a class="btn-descargar" download="<?= $domain.'/images/'.$producto->custom_photo; ?>" style="background-color: #c10230; border: 0; color: #fff; font-family: 'Bebas Neue'; font-size: 1.3em; margin-top: 5px; max-width: 400px; padding: 5px 0; text-align: center; width: 24%; display: flex;
                                            padding-left: 20px; padding-right: 20px; text-decoration: none; margin-left: 89px;" href="<?= $domain.'/images/'.$producto->custom_photo; ?>">Descarga</a>
                                <?php }else if( $producto->imagen_personalizada){ ?>
                                    <a class="btn-descargar" download="<?= $domain.'/images/'.$producto->imagen_personalizada; ?>" style="background-color: #c10230; border: 0; color: #fff; font-family: 'Bebas Neue'; font-size: 1.3em; margin-top: 5px; max-width: 400px; padding: 5px 0; text-align: center; width: 24%; display: flex;
                                        padding-left: 20px; padding-right: 20px; text-decoration: none; margin-left: 89px;" href="<?= $domain.'/images/'.$producto->imagen_personalizada; ?>">Descarga</a>
                                <?php }else { ?>
                                      <a style="display: none;" href="<?= $domain.'/images/'.$producto->custom_photo;?>">Descarga</a>
                                <?php } ?>

                            <?php }?>

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
    <tr>
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
