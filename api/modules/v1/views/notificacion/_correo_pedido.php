<?php
use yii\helpers\Html;
use yii\helpers\Url;
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
                    Tel: <?= $cliente->telefono ?>
                </div>
			</div>
		</td>
    </tr>
    <tr>
        <td style="padding-top:30px;">
            <table>
                <?php $domain = 'https://www.vocamx.com'?>
                <?php foreach($productos as $producto){ ?>
                    <tr>
                        <td style="width:300px;">
                            <?php if($producto->diseno){ ?>
                                <?php $src = $domain.'/images/'.$producto->imagen_personalizada; ?>
                            <?php }else{ ?>
                                <?php $src = $domain.'/images/'.$producto->foto; ?>
                            <?php } ?>
                            <img src="<?= $src ?>" style="width:300px;"/>
                        </td>
                        <td style="width:300px;">
                            <div style="font-family:'Bebas Neue';font-size:23px;">
                                <?= $producto->nombre ?>
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
                                <tr>
                                    <td style="font-family:'Karla';font-weight:bold;font-size:15px;width:100px;float:left;">
                                        Talla:
                                    </td>
                                    <td style="font-family:'Karla';font-size:15px;width:150px;float:left;">
                                        <?= $producto->talla ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="font-family:'Karla';font-weight:bold;font-size:15px;width:100px;float:left;">
                                        Cantidad:
                                    </td>
                                    <td style="font-family:'Karla';font-size:15px;width:150px;float:left;">
                                        <?= $producto->cantidad ?>
                                    </td>
                                </tr>
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
