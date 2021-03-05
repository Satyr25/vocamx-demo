<?php
use yii\helpers\Html;
?>
<div id="bloque-header"></div>
<div id="personaliza" class="bloque-contenido">
    <h2>Personaliza tu bomber</h2>
    <div>
        <div id="tipo-diseno">
            <a href="javascript:;" id="tuyo" class="seleccionado">CREA EL TUYO</a>
            <a href="javascript:;" id="escoje">ESCOJE UN DISEÑO</a>
            <div class="clear"></div>
        </div>
        <div id="caracteristicas">
            <div class="custom-select" id="modelo">
                <select id="select-modelo">
                    <option value="H" selected>Hombre</option>
                    <option value="M">Mujer</option>
                </select>
            </div>
            <div class="custom-select" id="talla">
                <select id="select-talla">
                    <option value=""></option>
                    <option value="S">(S)</option>
                    <option value="M">(M)</option>
                    <option value="L">(L)</option>
                </select>
            </div>
            <div class="clear"></div>
        </div>
        <div id="bloque-personalizacion" class="mostrando-H">
            <div id="colores">
                <a class="color seleccionado" href="javascript:;" id="gris"></a>
                <a class="color" href="javascript:;" id="plata"></a>
                <a class="clear"></a>
                <span>COLOR LETRA</span>
            </div>
            <div id="texto-personalizado" class="gris izquierda fuente-source_sans">
                 <div contenteditable="true" class="texto-personalizado"></div>
                 <div id="imagen-cargada"></div>
            </div>
            <div id="agregar-instagram">
                <a href="javascript:;">+</a>
            </div>
            <div id="captura-instagram">
                <a href="javascript:;" id="cerrar-instagram">
                    <?= Html::img('@web/images/personalizacion/cerrar.png') ?>
                </a>
                <div class="arroba-instagram">@</div>
                <input type="text" id="instagram" maxlength="12" />
                <?= Html::img('@web/images/personalizacion/pico_instagram.png', ['id'=>'pico-instagram']) ?>
            </div>
            <?= Html::img('@web/images/personalizacion/hombre.jpg', ['id' => 'modelo-H', 'class'=>'imagen-modelo seleccionado']) ?>
            <?= Html::img('@web/images/personalizacion/mujer.jpg', ['id' => 'modelo-M', 'class'=>'imagen-modelo']) ?>
        </div>
        <div id="opciones-extra" class="mfp-hide white-popup-block">
            <h2>Extras</h2>
            <div id="contenedor-extras">
                <div id="imagen-propia">
                    <a href="javascript:;" id="carga-archivo">
                        <span>
                            Carga tu <br>
                            Diseño en curvas
                        </span>
                    </a>
                    <input type="file" id="archivo-cargado" accept=".png,.svg" />
                </div>
            </div>
            <div id="selector-extras">
                <a href="javascript:;" id="alfabeto" class="opcion-extra" data-opcion="alfabeto">
                    Alfabeto
                </a>
                <a href="javascript:;" id="simbolos" class="opcion-extra" data-opcion="simbolos">
                    Símbolos
                </a>
                <a href="javascript:;" id="tu-diseno" class="opcion-extra seleccionado" data-opcion="diseno">
                    Carga tu diseño
                </a>
            </div>
        </div>
        <div id="herramientas-fuente">
            <div id="selector-alineacion">
                <a href="javascript:;" id="alineacion-izquierda" data-alineacion="izquierda">
                    <?= Html::img('@web/images/personalizacion/alineacion_izquierda.png') ?>
                </a>
                <a href="javascript:;" id="alineacion-centro" data-alineacion="centro">
                    <?= Html::img('@web/images/personalizacion/alineacion_centro.png') ?>
                </a>
                <a href="javascript:;" id="alineacion-derecha" data-alineacion="derecha">
                    <?= Html::img('@web/images/personalizacion/alineacion_derecha.png') ?>
                </a>
            </div>
            <div id="tamano-texto">
                <a href="javascript:;" id="texto-grande">+</a>
                <a href="javascript:;" id="texto-chico">-</a>
                <span>Tamaño</span>
            </div>
            <div id="grosor-texto">
                <a href="javascript:;" id="grosor-grande">+</a>
                <a href="javascript:;" id="grosor-chico">-</a>
                <span>Grosor</span>
            </div>
            <div id="alineacion-texto">
                <a href="javascript:;">
                    <?= Html::img('@web/images/personalizacion/alineacion_izquierda.png',['class' => 'alinea-izquierda seleccionado']) ?>
                    <?= Html::img('@web/images/personalizacion/alineacion_centro.png',['class' => 'alinea-centro']) ?>
                    <?= Html::img('@web/images/personalizacion/alineacion_derecha.png',['class' => 'alinea-derecha']) ?>
                </a>
            </div>
            <div id="otras-herramientas">
                <a href="#opciones-extra" id="abrir-extras">+</a>
            </div>
        </div>
        <div id="fuentes-bombers">
            <div class="fuentes">
                <div class="fuente">
                    <a href="javascript:;" class="seleccion-fuente fuente-arial" data-fuente="arial">
                        Mx
                    </a>
                </div>
                <div class="fuente">
                    <a href="javascript:;" class="seleccion-fuente fuente-arialnarrow" data-fuente="arialnarrow">
                        Mx
                    </a>
                </div>
                <div class="fuente">
                    <a href="javascript:;" class="seleccion-fuente fuente-advertising" data-fuente="advertising">
                        Mx
                    </a>
                </div>
                <div class="fuente">
                    <a href="javascript:;" class="seleccion-fuente fuente-akashi" data-fuente="akashi">
                        Mx
                    </a>
                </div>
                <div class="fuente">
                    <a href="javascript:;" class="seleccion-fuente fuente-beethoven" data-fuente="beethoven">
                        Mx
                    </a>
                </div>
                <div class="fuente">
                    <a href="javascript:;" class="seleccion-fuente fuente-gangofthree" data-fuente="gangofthree">
                        Mx
                    </a>
                </div>
                <div class="fuente">
                    <a href="javascript:;" class="seleccion-fuente fuente-haettenschweiler" data-fuente="haettenschweiler">
                        Mx
                    </a>
                </div>
                <div class="fuente">
                    <a href="javascript:;" class="seleccion-fuente fuente-komikaaxis" data-fuente="komikaaxis">
                        Mx
                    </a>
                </div>
                <div class="fuente">
                    <a href="javascript:;" class="seleccion-fuente fuente-oldenglish" data-fuente="oldenglish">
                        Mx
                    </a>
                </div>
                <div class="fuente">
                    <a href="javascript:;" class="seleccion-fuente fuente-supreme" data-fuente="supreme">
                        Mx
                    </a>
                </div>
                <div class="clear"></div>
            </div>
        </div>
        <div id="acciones-personalizacion">
            <a href="javascript:;" id="guardar" class="btn-accion">
                Guardar
            </a>
            <a href="javascript:;" id="compartir" class="btn-accion">
                Compartir
            </a>
            <a href="javascript:;" id="comprar-personalizada" class="btn-accion">
                <?= Html::img('@web/images/carrito.png',['class' => 'carrito_blanco']) ?>
                <?= Html::img('@web/images/carrito_negro.png',['class' => 'carrito_negro']) ?>Comprar
            </a>
            <div class="clear"></div>
        </div>
    </div>
</div>
