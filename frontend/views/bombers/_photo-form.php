<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\assets\LazyAsset;
use app\models\Producto;
use app\models\Categoria;

LazyAsset::register($this);

if(!$desktop):

$form = ActiveForm::begin([
    'id' => 'trazos-form',
    'options' => ['enctype' => 'multipart/form-data'],
    'action' => ['bombers/trazos', 'photo' => 'true']
    ])
?>
    <div class="bloque-formulario ">
        <div class="text-center franja-comenzar">
            <span class="text-left">COMENZAR</span>
        </div>
    </div>
    <div class="bloque-gris row ">
        <div class="col-md-5" id="sube-foto-bloque">
            <div class="row">
                <div id="sube-foto" class="col-sm-12 col-md-12">
                    <h3 class="text-red text-left">Paso 1:</h3>
                    <div class="row">
                        <div class="col-md-12 flex-center">
                            <label for="<?="fotoCustomM"?>" class="btn-accion label-replace-file" id="sube-foto-btn">
                                <?= Html::img('@web/images/personaliza_foto/subeFoto.png', ['class' => 'flecha-sube']) ?>
                                Sube tu imagen
                            </label>
                            <?= Html::img('@web/images/personaliza_foto/imagen.png', ['class' => 'imagen-subir'])?>
                            <i class="far fa-check-circle" id="subida-exito"></i>
                        </div>
                    </div>
                    <div id="name-file"></div>
                    <div id="imagen-cargada" style="display:none;">
                        <img src="" />
                    </div>
                    <?= $form->field($photoForm, 'fotoCustom')->fileInput(['id' => "fotoCustomM"])->label(false) ?>
                </div>
            </div>
        </div>
        <div class="col-md-7" id="info-foto-bloque">
            <div class="row">
                <div class="col-md-12">
                    <h3 class="text-red text-left" id="paso2">Paso 2:</h3>
                        <div class="textos-personaliza">
                            <?= $form->field($photoForm, 'mensaje')->input('text',['placeholder' => 'PERSONALIZA: FECHA,NOMBRE,@INSTAGRAM O FRASE'])  -> label(false)?>
                             <?= Html::img('@web/images/personaliza_foto/personaliza.png', ['class' => 'personaliza-img'])?>
                        </div>
                        <div class="textos-menu">
                            <h3 class="text-donde">¿DÓNDE QUIERES PERSONALIZAR?
                            <?= $form->field($photoForm, 'menu')->dropdownList(['Espalda' => 'Espalda', 'BicepDerechoExterno' => 'Bicep Derecho Externo', 'MangaDerecha' => 'Manga Derecha','Nuca' => 'Nuca(Etiqueta Interior)','ninguna' => 'Ninguna'],['placeholder' => 'PERSONALIZA: FECHA,NOMBRE,@INSTAGRAM O FRASE',]) -> label(false) ?>
                          </h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="bloque-gris2 row">
            <div class="col-md-5" >
                <a href="https://m.me/VocaMXoficial?tr=529281824267405" target="_blank" class="btn-ayuda-personalizacion asistencia-messenger hidden-lg hidden-md">
                <?= Html::img('@web/images/ayuda.png') ?>&emsp;<span>Ayuda</span><br>
            </a>
            </div>
             <div class="visible-sm visible-xs text-center franja-ayuda">
                <h3 class="text-center" id="texto-asistencia">¿QUIERES ASISTENCIA EN TU PEDIDO?</h3>
            </div>
            <div id="elementos-precio">
                <div id="producto-nuevo">
                     <H3 class="producto-nuevotitulo">PRODUCTOS</H3>
                      <label class="text-left"> <?= Html::img('@web/images/personaliza_foto/palomita.png', ['class' => 'palomita-img'])?> CHAMARRA NEGRA</label><br>
                     <label class="text-left"><?= Html::img('@web/images/personaliza_foto/palomita.png', ['class' => 'palomita-img'])?> TRAZADO DE IMAGEN</label><br>
                     <label class="text-left"> <?= Html::img('@web/images/personaliza_foto/palomita.png', ['class' => 'palomita-img'])?> ESTAMPADO PLATA</label><br>
                     <label class="text-left"> <?= Html::img('@web/images/personaliza_foto/palomita.png', ['class' => 'palomita-img'])?> PERSONALIZACIÓN</label><br>
                </div>
                <div id="numero-elementos">
                    <?= $form->field($photoForm, 'elementos')->input('number', ['min' => 1, 'max' => 5, 'value' => 1, 'autocomplete' => 'off'])  ?>
                    <input type="hidden" id="precio_base" value="1690" />
                    <input type="hidden" id="precio_base_tachado" value="2115" />
                </div>
                <div id="precio-trazado">
                    <?= $form->field($photoForm, 'precio')->hiddenInput()  ?>
                    <?php $categoria = Categoria::find()->where("categoria.clave = 'TRAZ'")->one();?>
                    <?php $producto = Producto::find()->where("categoria_id =". $categoria->id ." AND status = 1")->all(); ?>
                    <span id="texto-precio">
                        <span id="numero-precio">
                            <?php if ($producto[0]->precios[0]->precio_descuento != null & $producto[0]->precios[0]->precio_descuento > 0) { ?>
                                $<?= number_format($producto[0]->precios[0]->precio_descuento) ?>
                            <?php } else { ?>
                                $<?= number_format($producto[0]->precios[0]->precio) ?>
                            <?php } ?> 
                        </span>
                        <span class="precio-producto-chico">
                            <s>
                                $<?= number_format($producto[0]->precios[0]->precio)?>
                            </s>
                        </span>
                    </span>
                    <div class="ahorro-bomber">
                        <span class="title" >AHORRO: </span><span class="number">
                            <?php if ($producto[0]->precios[0]->precio_descuento != null & $producto[0]->precios[0]->precio_descuento > 0) { ?>
                                $<?= number_format($producto[0]->precios[0]->precio - $producto[0]->precios[0]->precio_descuento)?>
                            <?php } else { ?>
                                $<?= number_format($producto[0]->precios[0]->precio - $producto[0]->precios[0]->precio)?>
                            <?php }?>
                                
                            </span>
                    </div>
                    <div class="dia-entrega">
                        <span class="title">ENTREGAS 2 - 10 DÍAS </span>
                         <?= Html::img('@web/images/entregaBlack.png', ['class' => 'imagen-carrito-entrega'])?>
                    </div>
                </div>
                <div class="clear"></div>

                <div class="col-md-12">
                    <div class="form-group center-block" id="btn-siguiente">
                        <?= Html::submitButton('SIGUIENTE', ['class' => 'btn-accion submit-pic', 'id' => 'btn-siguiente'] ) ?>
                    </div>
                </div>
            </div>

            <div class="botones-tallas text-center">
                <p class="botones-talla-text">Por favor selecciona una talla</p>
                <div class="botones-talla">
                </div>
                <div class="row botones-agregar">
                    <div class="col-md-12">
                        <button type="button" class="add-cart-pic btn-accion">Agregar</button>
                    </div>
                    <div class="col-md-12">
                        <button type="button" class="cancel-cart-pic btn-accion">Cancelar</button>
                    </div>
                </div>
                <div class="col-md-12">
                    <div id="loader-carrito" class="lds-ring hidden"><div></div><div></div><div></div><div></div></div>
                </div>
            </div>
        </div>
<?php ActiveForm::end();
else:
$form = ActiveForm::begin([
    'id' => 'trazos-form-escritorio',
    'options' => ['enctype' => 'multipart/form-data'],
    'action' => ['bombers/trazos', 'photo' => 'true']
    ])
?>
    <div class="bloque-gris row hidden-sm hidden-xs">
        <div class="franja-comenzar-escritorio text-center">Comenzar</div>
            <div class="sube-imagen-escritorio" id="sube-imagen-bloque">
                <h3 class=" paso1">Paso 1:</h3>
                    <label for="<?= "fotoCustomD"?>" class="btn-accion label-replace-file" id="sube-foto-escri">
                        <?= Html::img('@web/images/personaliza_foto/subeFoto.png', ['class' => 'flecha-sube']) ?>
                                Sube tu imagen
                    </label>
                        <?= Html::img('@web/images/personaliza_foto/imagen.png', ['class' => 'imagen-subir-escri'])?>
                            <i class="far fa-check-circle" id="subida-exito-escri"></i>
                    <div id="name-file"></div>
                    <div id="imagen-cargada" style="display:none;">
                        <img src="" />
                    </div>
                    <?= $form->field($photoForm, 'fotoCustom')->fileInput(['id' => "fotoCustomD"])->label(false) ?>
            </div>
            <div class="personaliza-escri">
                <div class="col-md-2 titulo-paso">
                    <h3 class=" paso2">Paso 2:</h3>
                </div>
                <div class="col-md-8 mensaje">
                    <?= $form->field($photoForm, 'mensaje')->input('text',['placeholder' => 'PERSONALIZA: FECHA,NOMBRE,@INSTAGRAM O FRASE'])  -> label(false)?>
                </div>
                <div class="col-md-2 imagen-lapiz">
                    <?= Html::img('@web/images/personaliza_foto/personaliza.png', ['class' => 'personaliza-escritorio'])?>
                </div>
            </div>
            <div class="col-md-12">
                <div class="col-md-6 titulo-donde">
                    <h3 class="text-dondeescri">¿DÓNDE QUIERES PERSONALIZAR?</h3>
                </div>
            <div class="col-md-6 menu-posicion">
                <?= $form->field($photoForm, 'menu')->dropdownList(['Espalda' => 'Espalda', 'BicepDerechoExterno' => 'Bicep Derecho Externo', 'MangaDerecha' => 'Manga Derecha','Nuca' => 'Nuca(Etiqueta Interior)','ninguna' => 'Ninguna'],['placeholder' => 'PERSONALIZA: FECHA,NOMBRE,@INSTAGRAM O FRASE'],['id' => 'menu-posicion']) -> label(false) ?>
            </div>
        </div>
    </div>
    <div class="bloque-gris2 row hidden-sm hidden-xs">
        <div class="col-md-5" >
            <a href="https://m.me/VocaMXoficial?tr=529281824267405" target="_blank" class="btn-ayuda-escritorio asistencia-messenger">
                <?= Html::img('@web/images/ayuda.png') ?>&emsp;<span>Ayuda</span><br>
            </a>
        </div>
        <div class="text-center franja-ayuda-escritorio">
            <h3 class="text-center" id="texto-asistencia-escritorio">¿QUIERES ASISTENCIA EN TU PEDIDO?</h3>
        </div>
        <div id="elementos-precio-escritorio">
            <div id="producto-nuevo-escritorio">
                <H3 class="producto-nuevotitulo-escritorio">PRODUCTOS</H3>
                    <label class="text-left"> <?= Html::img('@web/images/personaliza_foto/palomita.png', ['class' => 'palomita-img'])?> CHAMARRA NEGRA</label><br>
                     <label class="text-left"><?= Html::img('@web/images/personaliza_foto/palomita.png', ['class' => 'palomita-img'])?> TRAZADO DE IMAGEN</label><br>
                     <label class="text-left"> <?= Html::img('@web/images/personaliza_foto/palomita.png', ['class' => 'palomita-img'])?> ESTAMPADO PLATA</label><br>
                     <label class="text-left"> <?= Html::img('@web/images/personaliza_foto/palomita.png', ['class' => 'palomita-img'])?> PERSONALIZACIÓN</label><br>
            </div>
            <div id="numero-elementos-escritorio">
                <?= $form->field($photoForm, 'elementos')->input('number', ['min' => 1, 'max' => 5, 'value' => 1, 'autocomplete' => 'off'],['id' => 'cantidad-elementos'])  ?>
                <input type="hidden" id="precio_base" value="1690" />
                <input type="hidden" id="precio_base_tachado" value="2115" />
            </div>
            <div id="precio-trazado-escritorio">
                <?= $form->field($photoForm, 'precio')->hiddenInput()  ?>
                <?php $categoria = Categoria::find()->where("categoria.clave = 'TRAZ'")->one();?>
                <?php $producto = Producto::find()->where("categoria_id =". $categoria->id ." AND status = 1")->all(); ?>
                <span id="texto-precio-escritorio">
                <span id="numero-precio-escritorio">
                    <?php if ($producto[0]->precios[0]->precio_descuento != null & $producto[0]->precios[0]->precio_descuento > 0) { ?>
                        $<?= number_format($producto[0]->precios[0]->precio_descuento) ?>
                    <?php } else { ?>
                        $<?= number_format($producto[0]->precios[0]->precio) ?>
                    <?php } ?> 
                </span>
                <span class="precio-producto-chico-escri">
                    <s>
                        $<?= number_format($producto[0]->precios[0]->precio)?>
                    </s>
                </span>
                </span>
            <div class="ahorro-bomber-escritorio">
                <span class="title" >AHORRO: </span><span class="number">
                    <?php if ($producto[0]->precios[0]->precio_descuento != null & $producto[0]->precios[0]->precio_descuento > 0) { ?>
                            $<?= number_format($producto[0]->precios[0]->precio - $producto[0]->precios[0]->precio_descuento)?>
                    <?php } else { ?>
                            $<?= number_format($producto[0]->precios[0]->precio - $producto[0]->precios[0]->precio)?>
                    <?php }?>                        
                </span>
            </div>
            <div class="dia-entrega-escritorio">
                <span class="title">ENTREGA 2 - 10 DÍAS </span>
                    <?= Html::img('@web/images/entregaBlack.png', ['class' => 'imagen-carrito-escritorio'])?>
                </div>
            </div>

            <div class="clear"></div>
        <div>
            <div class="col-md-4"></div>
            <div class="col-md-4">
                <div class="form-group center-block" id="btn-siguiente">
                        <?= Html::submitButton('SIGUIENTE', ['class' => 'btn-accion submit-pic', 'id' => 'btn-escritorio'] ) ?>
                </div>
            <div class="col-md-4"></div>
        </div>
        </div>
        </div>
        <div class="botones-tallas text-center">
            <p class="botones-talla-text">Por favor selecciona una talla</p>
            <div class="botones-talla">
        </div>
        <div class="row botones-agregar">
            <div class="col-md-12">
                <button type="button" class="add-cart-pic btn-accion">Agregar</button>
            </div>
            <div class="col-md-12">
                <button type="button" class="cancel-cart-pic btn-accion">Cancelar</button>
            </div>
        </div>
            <div class="col-md-12">
                <div id="loader-carrito" class="lds-ring hidden"><div></div><div></div><div></div>
            <div></div></div>
        </div>
    </div>
</div>
<input type="hidden" id="talla-hidden" name="talla">
<?php ActiveForm::end();
endif;
?>
