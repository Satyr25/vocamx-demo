<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\Pjax;
use app\models\Producto;
use app\assets\LazyAsset;
use yii\bootstrap\ActiveForm;

LazyAsset::register($this);
?>
<div id="bloque-header"></div>
<!--<div class="container-fluid">
    <ul class="list-unstyled multi-steps">
        <li class="paso-1 is-active">Elige diseño</li>
        <li class="paso-2">Registro</li>
        <li class="paso-3">Envío</li>
        <li class="paso-4">Pago</li>
        <li class="paso-5">Confirmación</li>
    </ul>
</div>-->

<!-- <div class="visible-sm visible-xs text-center franja-descuento-coleccion">
    <span class="text-center">20% EN TODA LA TIENDA &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; </span>
</div> -->
<div id="listado-productos" class="container">
    <?php Pjax::begin(['id' => 'pjax-deco']) ?>
    <div class="row text-center botones-filtro-wrapper visible-xs visible-sm filtro-mobile ">
        <div class="col-sm-3 col-xs-3 <?= ($filterBy == 'MUJ' ? 'selected' : '')?>">
            <?= Html::a('Mujer',
                ['bombers/coleccion', 'coleccion' => 2018 ,'filterBy' => 'MUJ'],
                ['class' => 'boton-filtro']
                ) ?>
        </div>
        <div class="col-sm-3 col-xs-3 <?= ($filterBy == 'HOM' ? 'selected' : '')?>">
            <?= Html::a('Hombre',
                ['bombers/coleccion', 'coleccion' => 2018 ,'filterBy' => 'HOM'],
                ['class' => 'boton-filtro']
                ) ?>
        </div>
        <div class="col-sm-3 col-xs-3 <?= ($filterBy == 'MEX' ? 'selected' : '')?>">
            <?= Html::a('México',
                ['bombers/coleccion', 'coleccion' => 2018 ,'filterBy' => 'MEX'],
                ['class' => 'boton-filtro']
                ) ?>
        </div>
          <div class="col-sm-3 col-xs-3 <?= ($filterBy == 'PAR' ? 'selected' : '')?>">
            <?= Html::a('Pareja',
                ['bombers/coleccion', 'coleccion' => 2018 ,'filterBy' => 'PAR'],
                ['class' => 'boton-filtro']
                ) ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-3 visible-lg visible-md" id="barra-lateral-container">
            <h1 class="titulo-pag">Decoracion Interiores</h1>
<!--
            <div class="row botones-filtro-wrapper">
                <div class=" row boton-wrapper <?= ($filterBy == 'MUJ' ? 'selected' : '')?>">
                    <a href="<?= Url::to(['bombers/coleccion', 'coleccion' => 2018, 'filterBy' => 'MUJ']) ?>">
                        <div class="col-md-6 text-left">Mujer</div>
                        <div class="col-md-6 text-right">
                            <i class="fas fa-angle-right"></i>
                        </div>
                    </a>
                </div>
                <div class=" row boton-wrapper <?= ($filterBy == 'HOM' ? 'selected' : '')?>">
                    <a href="<?= Url::to(['bombers/coleccion', 'coleccion' => 2018, 'filterBy' => 'HOM']) ?>">
                        <div class="col-md-6 text-left">Hombre</div>
                        <div class="col-md-6 text-right">
                            <i class="fas fa-angle-right"></i>
                        </div>
                    </a>
                </div>
                <div class=" row boton-wrapper <?= ($filterBy == 'MEX' ? 'selected' : '')?>">
                    <a href="<?= Url::to(['bombers/coleccion', 'coleccion' => 2018, 'filterBy' => 'MEX']) ?>">
                        <div class="col-md-6 text-left">México</div>
                        <div class="col-md-6 text-right">
                            <i class="fas fa-angle-right"></i>
                        </div>
                    </a>
                </div>
                 <div class=" row boton-wrapper <?= ($filterBy == 'PAR' ? 'selected' : '')?>">
                    <a href="<?= Url::to(['bombers/coleccion', 'coleccion' => 2018, 'filterBy' => 'PAR']) ?>">
                        <div class="col-md-6 text-left">Pareja</div>
                        <div class="col-md-6 text-right">
                            <i class="fas fa-angle-right"></i>
                        </div>
                    </a>
                </div>
            </div>
-->
            <div class="row bloque-asistencia text-center">
                <div class="title">Asistencia</div>
                    <div class="asistencia-imgs">
                        <a  class="asistencia-clic" href="https://web.whatsapp.com/send?phone=5215549368267?tr=529281824267405" target="_blank" data-pjax='0'>
                            <?= Html::img('@web/images/whats-white.png', ['class' => 'hidden-mobile asistencia-img']) ?>
                        </a>
                        <a  class="asistencia-clic" href="https://wa.me/+5215549368267?tr=529281824267405" target="_blank" data-pjax='0'>
                            <?= Html::img('@web/images/whats-white.png', ['class' => 'hidden-desktop asistencia-img']) ?>
                        </a>
                        <a  class="asistencia-messenger" href="https://m.me/VocaMXoficial?tr=529281824267405" target="_blank" data-pjax='0'>
                            <?= Html::img('@web/images/messenger-white.png', ['class' => 'asistencia-img msn']) ?>
                        </a>
                    </div>
                    <p class="explanation">¿Dudas?, Contáctanos</p>
            </div>
            <!--<div class="row">
                <div class="col-md-6 wo-padding">
                    <?php //Html::img('@web/images/coleccion/Arte.jpg', ['class' => 'img-responsive']) ?>
                </div>
                <div class="col-md-6 wo-padding">
                    <p class="titulo-personalizadas">Chamarras Personalizadas</p>
                    <a href="<?php //Url::to(['personalizacion/']) ?>" class="btn-accion full" data-pjax="0">Crea la tuya</a>
                    <div class="text-center">
                        <?php // Html::img('@web/images/coleccion/Descuento.png', ['class' => 'etiqueta-img'])  ?>
                        <p class="titulo-personalizadas">en toda la tienda</p>
                    </div>
                </div>
            </div>-->
        </div>
        <div class="col-md-9 col-sm-12 col-xs-12 productos-container">
            <?php foreach($productos as $producto): ?>
            <?php $precio_desc = $producto['precio'] - $producto['precio'] * .20; ?>
            <div class="col-md-4 col-sm-6 col-xs-6 producto-cell" id="producto-cell-<?= $producto['id'] ?>">
                <a href="<?= Yii::getAlias('@web/images/' . $producto['foto']) ?>" class="img-link lupa-img-cont">
                    <?= Html::img('@web/images/coleccion/zoom.png', ['class' => 'lupa-img']) ?>
                </a>
                <?php if($producto['sold'] == 0){ ?>
                    <!-- <button class="add-to-cart-btn visible-md visible-lg">+ Agregar al carrito</button>
                    <div class="botones-tallas text-center visible-md visible-lg">
                        <p class="botones-talla-text">Por favor selecciona una talla</p>
                        <div>
                            <?php $productoHelper = new Producto();
                            $tallas = $productoHelper->tallas($producto['id']);
                            foreach ($tallas as $talla) :
                            ?>

                            <?php if($talla->sold === '1'){ ?>
                                <button class="btn-sel-talla talla-sold" data-talla="<?= $talla->talla_id ?>" data-producto="<?= $producto['id'] ?>">
                                    <?= $talla->talla ?>
                                </button>
                            <?php } else { ?>
                                <button class="btn-sel-talla talla-buy" data-talla="<?= $talla->talla_id ?>" data-producto="<?= $producto['id'] ?>" >
                                    <?= $talla->talla ?>
                                </button>
                            <?php } ?>
                            <?php endforeach;  ?>
                        </div>
                        <div class="row botones-agregar">
                            <div class="col-md-6">
                                <button type="button" class="btn-carrito-hover btn-accion">Agregar</button>
                            </div>
                            <div class="col-md-6">
                                <button type="button" class="btn-carrito-cancel btn-accion">Cancelar</button>
                            </div>
                        </div>
                        <div class="row sold-row hidden">
                            <div class="col-md-12">
                                <p class=''>Sin existencias. Dejanos tu correo y nos comunicaremos contigo</p>
                                <?php $form = ActiveForm::begin([
                                    'id' => 'sold-correo'
                                ]);?>
                                <?= $form->field($soldCorreo, 'correo')->textInput(['class' => 'input-correo-sold'])->label(false) ?>
                                <?= $form->field($soldCorreo, 'producto_id')->hiddenInput(['value' => $producto['id']])->label(false) ?>
                                <?= $form->field($soldCorreo, 'talla_id')->hiddenInput()->label(false) ?>
                                <button type="submit" class="btn-accion" id="btn-sold-correo">Enviar</button>
                                <?php ActiveForm::end() ?>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div id="loader-carrito" class="lds-ring hidden"><div></div><div></div><div></div><div></div></div>
                        </div>
                    </div> -->
                <?php } ?>
                <?php if ($producto['sold'] == 1){ ?>
                    <div class="sold-out text-center visible-md visible-lg">
                        <p>SOLD OUT</p>
                    </div>
                <?php } ?>
                <a href="<?= Url::to(['decoracion/ver', 'id' => $producto['id']]) ?>" data-pjax="0">
                    <div class="producto-img-wrapper">
                        <!--<span class="descuento-img">-10%</span>-->
                        <img class="product-img" data-src="<?= Yii::getAlias('@web/images/' . $producto['foto']) ?>" />
                    </div>
                    <div class="text-center bomber-info">
                        <p class="visible-md visible-lg nombre-bomber"><?= $producto['nombre'] ?></p>
                        <span class="main-price">
                            <?php if ($producto['precio_descuento'] != null & $producto['precio_descuento'] > 0) { ?>
                               <?php if($producto['moneda'] == ' MXN'){ ?>
                                   $<?= number_format(round($producto['precio_descuento'], 0, PHP_ROUND_HALF_UP)) ,$producto['moneda'] ;  ?>
                               <?php } else { ?>
                                   $<?= number_format($producto['precio_descuento'], 2) ,$producto['moneda'] ;  ?>
                               <?php } ?>
                            <?php }else { ?>
                               <?php if($producto['moneda'] == ' MXN'){ ?>
                                    $<?= number_format(round($producto['precio'], 0, PHP_ROUND_HALF_UP)),$producto['moneda']; ?>
                               <?php } else { ?>
                                    $<?= number_format($producto['precio'], 2) ,$producto['moneda']; ?>
                               <?php } ?>
                            <?php } ?>
                        </span>
                        <!--<s>
                           <?php if($producto['moneda'] == ' MXN'){ ?>
                                $<?= number_format(round($producto['precio'], 0, PHP_ROUND_HALF_UP)),$producto['moneda']; ?>
                           <?php } else { ?>
                                $<?= number_format($producto['precio'], 2) ,$producto['moneda']; ?>
                           <?php } ?>
                        </s>
                        <div class="ahorro-block">
                            <span class="ahorro-span">
                                <span class="title">Ahorro: </span>
                                <?php if($producto['moneda'] == ' MXN'){ ?>
                                    $<?= round($producto['precio'] - ($producto['precio_descuento'])), $producto['moneda'];?>
                               <?php } else { ?>
                                    $<?= number_format($producto['precio'] - ($producto['precio_descuento']), 2), $producto['moneda'];?>
                               <?php } ?>
                            </span>
                        </div> -->
                    </div>
                </a>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
    <?php Pjax::end() ?>
</div>
